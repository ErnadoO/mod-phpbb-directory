<?php
/**
*
* @author Erwan NADER (ErnadoO) ernadoo@phpbb-services.com
* @package phpBB3
* @version $Id$
* @copyright (c) 2008 http://www.phpbb-services.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 * link class
 * @package phpBB3
 */
class link
{
	/**
	* Add a link into db
	*
	* @param array $data contains all datas to insert in db
	*/
	function add($data)
	{
		global $db, $auth, $config, $categorie;

		$db->sql_transaction('begin');

		$sql = 'INSERT INTO ' . DIR_LINK_TABLE . ' ' . $db->sql_build_array('INSERT', $data);
		$db->sql_query($sql);

		if (!$categorie->data['cat_validate'] || $auth->acl_get('a_') || $auth->acl_get('m_'))
		{
			$sql = 'UPDATE ' . DIR_CAT_TABLE . '
				SET cat_links = cat_links + 1
				WHERE cat_id = ' . (int)$data['link_cat'];
			$db->sql_query($sql);
		}
		elseif ($config['dir_mail'] && $config['email_enable'])
		{
			$this->notify_admin();
		}
		$db->sql_transaction('commit');
	}

	/**
	* Edit a link of the db
	*
	* @param array $data contains all datas to edit in db
	* @param int $u is link's id, for WHERE clause
	*/
	function edit($data, $url_id, $need_approval)
	{
		global $db, $cache;

		$old_cat = array_pop($data);

		if ($old_cat != $data['link_cat'] || $need_approval)
		{
			$db->sql_transaction('begin');

			$sql = 'UPDATE ' . DIR_CAT_TABLE . ' SET cat_links = cat_links - 1
				WHERE cat_id = ' . (int)$old_cat;
			$db->sql_query($sql);

			if(!$need_approval)
			{
				$sql = 'UPDATE ' . DIR_CAT_TABLE . ' SET cat_links = cat_links + 1
					WHERE cat_id = ' . (int)$data['link_cat'];
				$db->sql_query($sql);
			}
			else
			{
				$data['link_active'] = false;
			}

			$db->sql_transaction('commit');
		}

		$sql = 'UPDATE ' . DIR_LINK_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $data) . '
			WHERE link_id = ' . (int)$url_id;
		$db->sql_query($sql);

		$cache->destroy('sql', DIR_LINK_TABLE);
	}

	/**
	* Del a link of the db
	*
	* @param int $u is link's id, for WHERE clause
	*/
	function del($url_id, $cat_id, $cron = false)
	{
		global $db, $mode, $phpEx, $phpbb_root_path, $user;

		if (confirm_box(true) || $cron)
		{
			$db->sql_transaction('begin');

			$url_array = is_array($url_id) ? $url_id : array($url_id);

			// Delete links datas
			$link_datas_ary = array(
				DIR_LINK_TABLE		=> 'link_id',
				DIR_COMMENT_TABLE	=> 'comment_link_id',
				DIR_VOTE_TABLE		=> 'vote_link_id',
			);

			$sql = 'SELECT link_banner FROM ' . DIR_LINK_TABLE . ' WHERE '. $db->sql_in_set('link_id', $url_array);
			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				if($row['link_banner'] && !preg_match('/^(http:\/\/|https:\/\/|ftp:\/\/|ftps:\/\/|www\.).+/si', $row['link_banner']))
				{
					if (file_exists($phpbb_root_path . 'images/directory/banners' .'/'. basename($row['link_banner'])))
					{
						@unlink($phpbb_root_path . 'images/directory/banners' .'/'. basename($row['link_banner']));
					}
				}
			}

			foreach ($link_datas_ary as $table => $field)
			{
				$db->sql_query("DELETE FROM $table WHERE ".$db->sql_in_set($field, $url_array));
			}

			$sql = 'UPDATE ' . DIR_CAT_TABLE . '
				SET cat_links = cat_links - '.sizeof($url_array).'
			WHERE cat_id = ' . (int)$cat_id;
			$db->sql_query($sql);

			$db->sql_transaction('commit');

			if($cron)
			{
				include($phpbb_root_path.'includes/acp/acp_directory.'.$phpEx);
				sync_dir_cat($this->categorie['cat_id']);
			}
			else
			{
				$meta_info = append_sid("{$phpbb_root_path}directory.$phpEx", "mode=cat&amp;id=$cat_id");
				meta_refresh(3, $meta_info);
				$message = $user->lang['DIR_DELETE_OK'] . "<br /><br />" . $user->lang('DIR_CLICK_RETURN_DIR', '<a href="' . append_sid("{$phpbb_root_path}directory.$phpEx") . '">', '</a>') . '<br /><br />' . $user->lang('DIR_CLICK_RETURN_CAT', '<a href="' . append_sid("{$phpbb_root_path}directory.$phpEx", "mode=cat&amp;id=$cat_id") . '">', '</a>');
				trigger_error($message);
			}
		}
		else
		{
			$s_hidden_fields = build_hidden_fields(array(
				'mode'	=> $mode,
				'id'	=> (int)$cat_id,
				'u'		=> (int)$url_id,
			));

			confirm_box(false, 'DIR_DELETE_SITE', $s_hidden_fields);
		}
	}

	/**
	* Increments link view counter
	*
	* @param int $u is link's id, for WHERE clause
	*/
	function view($url_id)
	{
		global $db, $user;

		$sql = 'SELECT link_id, link_url FROM ' . DIR_LINK_TABLE . '
					WHERE link_id = ' . (int)$url_id;
		$result = $db->sql_query($sql);
		$data = $db->sql_fetchrow($result);

		if (empty($data['link_id']))
		{
			trigger_error($user->lang['DIR_ERROR_NO_LINKS'], E_USER_ERROR);
		}

		$sql = 'UPDATE ' . DIR_LINK_TABLE . '
			SET link_view = link_view + 1
			WHERE link_id = ' . (int)$url_id;
		$db->sql_query($sql);

		redirect($data['link_url'], false, true);
		exit_handler();
	}

	/**
	* Verify that an URL exist before add into db
	*
	* @param string $url
	*
	* @return true if ok, else false.
	*/
	function checkurl($url)
	{
		$details = parse_url($url);

		if (!isset($details['port']))
		{
			$details['port'] = 80;
		}
		if (!isset($details['path']))
		{
			$details['path'] = "/";
		}

		if ($sock = @fsockopen($details['host'], $details['port'], $errno, $errstr, 1))
		{
			$requete = "GET ".$details['path']." HTTP/1.1\r\n";
			$requete .= "Host: ".$details['host']."\r\n\r\n";

			// Send a HTTP GET header
			fputs($sock, $requete);
			// answer from server
			$str = fgets($sock, 1024);
			preg_match("'HTTP/1\.. (.*) (.*)'U", $str, $parts);
			fclose($sock);

			if ($parts[1] == '404')
			{
				return false;
			}
			else
			{
				return true;
			}
		}
		return false;
	}

	/**
	* Delete the final '/', if no path
	*
	* @param string $url to clean
	*
	* @return the correct string.
	*/
	function clean_url($url)
	{
		$details = parse_url($url);

		if(isset($details['path']) && $details['path'] == '/' && !isset($details['query']))
		{
			return substr($url, 0, -1);
		}
		return $url;
	}

	/**
	 * Display a flag
	 *
	 * @param array $data link's data from db
	 *
	 * @return flag image.
	 */
	function display_flag($data)
	{
		global $phpbb_root_path, $user, $phpEx;

		$extra = '';

		if(!empty($data['link_flag']))
		{
			if (file_exists('images/directory/flags/'.$data['link_flag']))
			{
				if (file_exists("{$user->lang_path}{$user->lang_name}/mods/directory_flags.$phpEx"))
				{
					// include the file containing flags
					include("{$user->lang_path}{$user->lang_name}/mods/directory_flags.$phpEx");

					$iso_code = substr($data['link_flag'], 0, strpos($data['link_flag'], '.'));
					$country = (isset($flags[strtoupper($iso_code)])) ? $flags[strtoupper($iso_code)] : '';
					$extra = 'alt = "'.$country.'" title = "'.$country.'"';
				}

				return '<img src="' . $phpbb_root_path . 'images/directory/flags/' . $data['link_flag'] . '" '.$extra.' />&nbsp;';
			}
		}

		return '<img src="' . $phpbb_root_path . 'images/directory/flags/no_flag.png" />&nbsp;';

	}

	/**
	* Calculate the link's note
	*
	* @param int $total_note is sum of all link's notes
	* @param int $nb_vote is nb of votes
	*
	* @return the calculated note.
	*/
	function display_note($total_note, $nb_vote, $votes_status)
	{
		if(!$votes_status)
		{
			return;
		}

		global $user;

		$note = ($nb_vote < 1) ? '' : $total_note / $nb_vote;
		$note = (strlen($note) > 2) ? number_format($note, 1) : $note;
		$note = ($nb_vote) ? '<b>' . $user->lang('DIR_FROM_TEN', $note) . '</b>' : $user->lang['DIR_NO_NOTE'];

		return $note;
	}

	/**
	* Display the vote form for auth users
	*
	* @param array $data link's data from db
	*
	* @return the html code.
	*/
	function display_vote($data, $votes_status)
	{
		if(!$votes_status)
		{
			return;
		}

		global $user, $order, $start, $phpEx;
		global $directory_root_path, $auth;

		if ($user->data['is_registered'])
		{
			if ($auth->acl_get('u_vote_dir'))
			{
				if (empty($data['vote_user_id']))
				{
					$list = '<select name="vote">';
					for ( $i = 0; $i <= 10; $i++ )
					{
						$list .= '<option value="' . $i . '"' . (($i == 5) ? ' selected="selected"' : '') . '>' . $i . '</option>';
					}
					$list .= '</select>';

					$params = array(
						'mode'	=> 'cat',
						'id'	=> (int)$data['link_cat'],
						'start'	=> $start,
						'u'		=> (int)$data['link_id'],
						'order'	=> $order);

					return '<br /><form action="' . append_sid("{$directory_root_path}directory.$phpEx", $params, true) . '" method="post"><div>' . $list . '&nbsp;<input type="submit" name="submit_vote" value="' . $user->lang['DIR_VOTE'] . '" class="mainoption" /></div></form>';
				}
			}
		}
		return '<br />';
	}

	/**
	* Display link's thumb if thumb service enabled.
	* if thumb don't exists in db or if a new service was choosen in acp
	* thumb is research
	*
	* @param array $data link's data from db
	*
	* @return thumb or nothing.
	*/
	function display_thumb($data)
	{
		global $config, $db;

		if($config['dir_activ_thumb'])
		{
			if (!$data['link_thumb'] || ($config['dir_thumb_service_reverse'] && (!strstr($data['link_thumb'], 'ascreen.jpg') && (!strstr($data['link_thumb'], $config['dir_thumb_service'])))))
			{
				$thumb = $this->thumb_process($data['link_url']);

				$sql = 'UPDATE ' . DIR_LINK_TABLE . ' SET link_thumb = "' . $db->sql_escape($thumb) . '"
					WHERE link_id = ' . (int)$data['link_id'];
				$db->sql_query($sql);

				return $thumb;
			}
			return $data['link_thumb'];
		}
	}

	/**
	* Display and calculate PageRank if needed
	*
	* @param array $data link's data from db
	*
	* @return pr image, false or 'n/a'.
	*/
	function display_pagerank($data)
	{
		global $config, $db, $user;

		if($config['dir_activ_pagerank'])
		{
			if ($data['link_pagerank'] == '')
			{
				$pagerank = $this->pagerank_process($data['link_url']);

				$sql = 'UPDATE ' . DIR_LINK_TABLE . ' SET link_pagerank = ' . (int)$pagerank . '
					WHERE link_id = ' . (int)$data['link_id'];
				$db->sql_query($sql);
			}
			else
			{
				$pagerank = (int)$data['link_pagerank'];
			}

			$prpos=40*$pagerank/10;
			$prneg=40-$prpos;
			$html='<img src="http://www.google.com/images/pos.gif" width="'.$prpos.'" height="4" alt="'.$pagerank.'" /><img src="http://www.google.com/images/neg.gif" width="'.$prneg.'" height="4" alt="'.$pagerank.'" /> ';

			$pagerank = $pagerank == '-1' ? $user->lang['DIR_PAGERANK_NOT_AVAILABLE'] : $user->lang('DIR_FROM_TEN', $pagerank);
			return $html.$pagerank;
		}
		return false;
	}

	/**
	* Display and resize a banner
	*
	* @param array $data link's data from db
	* @param bool $have_banner
	*
	* @return banner image.
	*/
	function display_bann($data)
	{
		global $config, $phpbb_root_path;

		$s_banner = $path = '';

		if (!empty($data['link_banner']))
		{
			if (!preg_match('/^(http:\/\/|https:\/\/|ftp:\/\/|ftps:\/\/|www\.).+/si', $data['link_banner']))
			{
				$path = "{$phpbb_root_path}images/directory/banners/";
			}
			$path .= $data['link_banner'];

			list($width, $height, $type, $attr) = @getimagesize($path);
			if (($width > $config['dir_banner_width'] || $height > $config['dir_banner_height']) && $config['dir_banner_width'] > 0 && $config['dir_banner_height'] > 0)
			{
				$coef_w = $width / $config['dir_banner_width'];
				$coef_h = $height / $config['dir_banner_height'];
				$coef_max = max($coef_w, $coef_h);
				$width /= $coef_max;
				$height /= $coef_max;
			}

			$s_banner = '<img src="' . $path . '" width="' . $width . '" height="' . $height . '" alt="'.$data['link_name'].'" title="'.$data['link_name'].'" />';
		}

		return $s_banner;
	}

	/**
	* Display number of comments and link for posting
	*
	* @param int $u is link_id from db
	* @param int $nb_comments si number of comments for this link
	*
	* @return html code (counter + link).
	*/
	function display_comm($u, $nb_comment, $comments_status)
	{
		if(!$comments_status)
		{
			return;
		}

		global $user, $directory_root_path, $phpEx;

		$comment_url = append_sid("{$directory_root_path}directory_comment.$phpEx", array('u' => (int)$u));
		$l_nb_comment = ($nb_comment > 1) ? $user->lang['DIR_COMMENTS']: $user->lang['DIR_COMMENT'];
		$s_comment = '&nbsp;&nbsp;&nbsp;<a href="' . $comment_url . '" onclick="window.open(\'' . $comment_url . '\', \'phpBB_dir_comment\', \'HEIGHT=600, resizable=yes, scrollbars=yes, WIDTH=905\');return false;" class="gen"><b>' . $nb_comment . '</b> ' . $l_nb_comment . '</a>';

		return $s_comment;
	}

	/**
	* Add a vote in db, for a specifi link
	*
	* @param int $u is link_id from db
	*/
	function add_vote($u)
	{
		global $user, $db, $id, $start, $phpEx;
		global $directory_root_path, $order;

		if (!$user->data['is_registered'])
		{
			trigger_error('DIR_ERROR_VOTE_LOGGED');
		}

		$data = array(
			'vote_link_id' 		=> (int)$u,
			'vote_user_id' 		=> (int)$user->data['user_id'],
		);

		// We check if user had already vot for this website.
		$sql = 'SELECT vote_link_id FROM ' . DIR_VOTE_TABLE . ' WHERE ' . $db->sql_build_array('SELECT', $data);
		$result = $db->sql_query($sql);
		$data = $db->sql_fetchrow($result);

		if (!empty($data['vote_link_id']))
		{
			trigger_error('DIR_ERROR_VOTE');
		}

		$data = array(
			'vote_link_id' 		=> (int)$u,
			'vote_user_id' 		=> $user->data['user_id'],
			'vote_note'			=> request_var('vote', 0),
		);

		$db->sql_transaction('begin');

		$sql = 'INSERT INTO ' . DIR_VOTE_TABLE . ' ' . $db->sql_build_array('INSERT', $data);
		$db->sql_query($sql);

		$sql = 'UPDATE ' . DIR_LINK_TABLE . ' SET link_vote = link_vote + 1,
			link_note = link_note + ' . (int)$data['vote_note'] . '
		WHERE link_id = ' . (int)$u;
		$db->sql_query($sql);

		$db->sql_transaction('commit');

		$params = array(
			'mode'	=> 'cat',
			'id'	=> $id,
			'start'	=> $start,
			'order'	=> $order);

		$meta_info = append_sid("{$directory_root_path}directory.$phpEx", $params, true);
		meta_refresh(3, $meta_info);
		$message = $user->lang['DIR_VOTE_OK'] . '<br /><br />' . sprintf($user->lang['DIR_CLICK_RETURN_LIEN'], '<a href="' . append_sid("{$directory_root_path}directory.$phpEx", $params, true) . '">', '</a>');
		trigger_error($message);
	}

	/**
	* Send a email to administrator for notify a new link
	* when approbation enabled
	*/
	function notify_admin()
	{
		global $config, $db, $user;
		global $phpbb_root_path, $phpEx;

		if ($config['email_enable'])
		{
			// Get the appropriate username, etc.
			$sql = 'SELECT username, user_email, user_lang, user_jabber, user_notify_type
				FROM ' . USERS_TABLE . ' u, '. GROUPS_TABLE .' g, ' . USER_GROUP_TABLE . ' ug
				WHERE ug.user_id = u.user_id
					AND ug.user_pending = 0
					AND ug.group_id = g.group_id
					AND g.group_name = "ADMINISTRATORS"';
			$result = $db->sql_query($sql);

			if (!class_exists('messenger'))
			{
				include($phpbb_root_path . 'includes/functions_messenger.' . $phpEx);
			}
			$messenger	= new messenger(false);

			while ($row = $db->sql_fetchrow($result))
			{
				$messenger->template('mods/directory/validation', $row['user_lang']);
				$messenger->replyto($user->data['user_email']);
				$messenger->to($row['user_email'], $row['username']);

				$messenger->im($row['user_jabber'], $row['username']);
				$notify_type = $row['user_notify_type'];

				$messenger->headers('X-AntiAbuse: Board servername - ' . $config['server_name']);
				$messenger->headers('X-AntiAbuse: User_id - ' . $user->data['user_id']);
				$messenger->headers('X-AntiAbuse: Username - ' . $user->data['username']);
				$messenger->headers('X-AntiAbuse: User IP - ' . $user->ip);

				$messenger->assign_vars(array(
					'USERNAME'		=> htmlspecialchars_decode($row['username']),
				));

				$messenger->send($row['user_notify_type']);
			}
			$db->sql_freeresult($result);
		}
	}

	/**
	 * Send a email to user who want be notify of a new publication link
	 *
	 * @param array $data link's data from db
	 */
	function notify_member($site)
	{
		global $config, $db, $user;
		global $phpbb_root_path, $phpEx;

		$sql_array = array(
			'SELECT'	=> 'u.username, u.user_email, u.user_lang, u.user_jabber, u.user_notify_type',
			'FROM'		=> array(
					DIR_NOTIFICATION_TABLE	=> 'an'),
			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=> array(USERS_TABLE => 'u'),
					'ON'	=> 'an.n_user_id = u.user_id'
				)
			),
			'WHERE'		=> 'an.n_cat_id = ' . (int)$site['link_cat']);
		$sql = $db->sql_build_query('SELECT', $sql_array);
		$result = $db->sql_query($sql);

		if (!class_exists('messenger'))
		{
			include($phpbb_root_path . 'includes/functions_messenger.' . $phpEx);
		}
		$messenger	= new messenger(false);

		$row = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$username	= $row['username'];
			$email		= $row['user_email'];
			strip_bbcode($site['link_description']);

			$messenger->template('mods/directory/notification', $row['user_lang']);
			$messenger->replyto($config['board_email']);
			$messenger->to($email, $username);

			$messenger->im($row['user_jabber'], $row['username']);

			$messenger->headers('X-AntiAbuse: Board servername - ' . $config['server_name']);
			$messenger->headers('X-AntiAbuse: User_id - ' . $user->data['user_id']);
			$messenger->headers('X-AntiAbuse: Username - ' . $user->data['username']);
			$messenger->headers('X-AntiAbuse: User IP - ' . $user->ip);

			$messenger->assign_vars(array(
				'USERNAME'			=> $row['username'],
				'CAT_NAME'			=> strip_tags($site['cat_name']),
				'LINK_NAME'			=> $site['link_name'],
				'LINK_URL'			=> $site['link_url'],
				'LINK_DESCRIPTION'	=> $site['link_description'],
			));

			$messenger->send($row['user_notify_type']);
		}
		$db->sql_freeresult($result);
	}

	/**
	* Search an appropriate thumb for url
	*
	* @param string $url is link's url
	*
	* @return the thumb url
	*/
	function thumb_process($url)
	{
		global $config, $phpbb_root_path;

		if(!$config['dir_activ_thumb'])
		{
			return $phpbb_root_path.'images/directory/nothumb.gif';
		}

		$details = parse_url($url);

		$root_url		= $details['scheme'].'://'.$details['host'];
		$absolute_url	= isset($details['path']) ? $root_url.$details['path'] : $root_url;

		if($config['dir_activ_thumb_remote'])
		{
			if ($this->ascreen_exist($details['scheme'], $details['host']))
			{
				return $root_url.'/ascreen.jpg';
			}
		}
		return $config['dir_thumb_service'].$absolute_url;
	}

	/**
	 * Check if ascreen thumb exists
	 */
	function ascreen_exist($protocol, $host)
	{
		if ($thumb_info = @getimagesize($protocol.'://'.$host.'/ascreen.jpg'))
		{
			// Obviously this is an image, we did some additional tests
			if ($thumb_info[0] == '120' && $thumb_info[1] == '90' && $thumb_info['mime'] == 'image/jpeg')
			{
				return true;
			}
		}
		return false;
	}

	/**
	* primary work on banner, can edit, copy or check a banner
	*
	* @param string $banner is banner's remote url
	*/
	function banner_process(&$banner, &$error)
	{
		global $config, $phpbb_root_path;

		$old_banner = request_var('old_banner', '');

		$destination = 'images/directory/banners';

		// Can we upload?
		$can_upload = ($config['dir_storage_banner'] && file_exists($phpbb_root_path . $destination) && phpbb_is_writable($phpbb_root_path . $destination) && (@ini_get('file_uploads') || strtolower(@ini_get('file_uploads')) == 'on')) ? true : false;

		if ($banner && $can_upload)
		{
			$file = $this->banner_upload($banner, $error);
		}
		else if ($banner)
		{
			$file = $this->banner_remote($banner, $error);
		}
		else if (isset($_POST['delete_banner']) && $old_banner)
		{
			$this->banner_delete($destination, $old_banner);
			$banner = '';
			return;
		}

		if (!sizeof($error))
		{
			if ($banner && $old_banner && !preg_match('/^(http:\/\/|https:\/\/|ftp:\/\/|ftps:\/\/|www\.).+/si', $old_banner))
			{
				$this->banner_delete($destination, $old_banner);
			}

			$banner = isset($file) ? $file : '';
		}
		elseif(isset($file))
		{
			$this->banner_delete($destination, $file);
		}
	}

	/**
	* Copy a remonte banner to server.
	* called by banner_process()
	*
	* @param string $banner is banner's remote url
	*
	* @return file's name of the local banner
	*/
	function banner_upload($banner, &$error)
	{
		global $phpbb_root_path, $config, $db, $user, $phpEx;

		// Init upload class
		if(!class_exists('fileupload'))
		{
			include($phpbb_root_path . 'includes/functions_upload.' . $phpEx);
		}
		$upload = new fileupload('DIR_BANNER_', array('jpg', 'jpeg', 'gif', 'png'), $config['dir_banner_filesize']);

		$file = $upload->remote_upload($banner);

		$prefix = unique_id() . '_';
		$file->clean_filename('real', $prefix);

		$destination = 'images/directory/banners';

		// Move file and overwrite any existing image
		$file->move_file($destination, true);

		if (sizeof($file->error))
		{
			$file->remove();
			$error = array_merge($error, $file->error);
		}
		@chmod($file->destination_file, 0644);

		return $prefix .strtolower($file->uploadname);
	}

	/**
	* Check than remote banner exists
	* called by banner_process()
	*
	* @param string $banner is banner's remote url
	*
	* @return false if error, true for ok
	*/
	function banner_remote($banner, &$error)
	{
		global $config, $db, $user, $phpbb_root_path, $phpEx;

		if (!preg_match('#^(http|https|ftp)://#i', $banner))
		{
			$banner = 'http://' . $banner;
		}
		if (!preg_match('#^(http|https|ftp)://(?:(.*?\.)*?[a-z0-9\-]+?\.[a-z]{2,4}|(?:\d{1,3}\.){3,5}\d{1,3}):?([0-9]*?).*?\.(gif|jpg|jpeg|png)$#i', $banner))
		{
			$error[] = $user->lang['DIR_BANNER_URL_INVALID'];
			return false;
		}

		// Make sure getimagesize works...
		if (($image_data = @getimagesize($banner)) === false)
		{
			$error[] = $user->lang['DIR_BANNER_UNABLE_GET_IMAGE_SIZE'];
			return false;
		}

		if (!empty($image_data) && ($image_data[0] < 2 || $image_data[1] < 2))
		{
			$error[] = $user->lang['DIR_BANNER_UNABLE_GET_IMAGE_SIZE'];
			return false;
		}

		$width = $image_data[0];
		$height = $image_data[1];

		// Check image type
		if(!class_exists('fileupload'))
		{
			include($phpbb_root_path . 'includes/functions_upload.' . $phpEx);
		}
		$types		= fileupload::image_types();
		$extension	= strtolower(filespec::get_extension($banner));

		if (!empty($image_data) && (!isset($types[$image_data[2]]) || !in_array($extension, $types[$image_data[2]])))
		{
			if (!isset($types[$image_data[2]]))
			{
				$error[] = $user->lang['UNABLE_GET_IMAGE_SIZE'];
			}
			else
			{
				$error[] = sprintf($user->lang['DIR_BANNER_IMAGE_FILETYPE_MISMATCH'], $types[$image_data[2]][0], $extension);
			}
			return false;
		}

		if ($config['dir_banner_width'] || $config['dir_banner_height'])
		{
			if ($width > $config['dir_banner_width'] || $height > $config['dir_banner_height'])
			{
				$error[] = sprintf($user->lang['DIR_BANNER_WRONG_SIZE'], $config['dir_banner_width'], $config['dir_banner_height'], $width, $height);
				return false;
			}
		}

		return $banner;
	}

	/**
	* Delete a banner from server
	*
	* @param string $destination path to banner directory
	* @param string $file is file's name
	*
	* @return true if delete success, else false
	*/
	function banner_delete($destination, $file)
	{
		global $phpbb_root_path;

		if (substr($destination, -1, 1) == '/' || substr($destination, -1, 1) == '\\')
		{
			$destination = substr($destination, 0, -1);
		}

		if (file_exists($phpbb_root_path . $destination .'/'.$file))
		{
			@unlink($phpbb_root_path . $destination .'/'.$file);
			return true;
		}

		return false;
	}

	/**
	* PageRank Lookup (Based on Google Toolbar for Mozilla Firefox)
	*
	* @copyright 2012 HM2K <hm2k@php.net>
	* @link http://pagerank.phurix.net/
	* @author James Wade <hm2k@php.net>
	* @version $Revision: 2.1 $
	* @require PHP 4.3.0 (file_get_contents)
	* @updated 06/10/11
	*/
	function pagerank_process($q)
	{
		global $user;

		$googleDomains = Array(".com", ".com.tr", ".de", ".fr", ".be", ".ca", ".ro", ".ch");
		$seed = $user->lang['SEED'];
		$result = 0x01020345;
		$len = strlen($q);
		for ($i=0; $i<$len; $i++)
		{
			$result ^= ord($seed{$i%strlen($seed)}) ^ ord($q{$i});
			$result = (($result >> 23) & 0x1ff) | $result << 9;
		}
		if (PHP_INT_MAX != 2147483647)
		{
			$result = -(~($result & 0xFFFFFFFF) + 1);
		}
		$ch=sprintf('8%x', $result);
		$url='http://%s/tbr?client=navclient-auto&ch=%s&features=Rank&q=info:%s';
		$host = 'toolbarqueries.google'.$googleDomains[mt_rand(0,count($googleDomains)-1)];

		$url=sprintf($url,$host,$ch,$q);
		@$pr=trim(file_get_contents($url,false,$context));

		if(is_numeric(substr(strrchr($pr, ':'), 1)))
		{
			return substr(strrchr($pr, ':'), 1);
		}
		return '-1';
	}
}

/**
 * comment class
 * @package phpBB3
 */
class comment
{
	/**
	* Add a comment
	*
	* @param array $data is link's data from db
	*/
	function add($data)
	{
		global $db, $config;

		$db->sql_transaction('begin');

		$sql = 'INSERT INTO ' . DIR_COMMENT_TABLE . ' ' . $db->sql_build_array('INSERT', $data);
		$db->sql_query($sql);

		$sql = 'UPDATE ' . DIR_LINK_TABLE . '
			SET link_comment = link_comment + 1
		WHERE link_id = ' . (int)$data['comment_link_id'];
		$db->sql_query($sql);

		$db->sql_transaction('commit');
	}

	/**
	* Edit a comment
	*
	* @param array $data is datas to edit
	* @param $id comment_id from db
	*
	*/
	function edit($data, $id)
	{
		global $db;

		$sql = 'UPDATE ' . DIR_COMMENT_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $data) . '
			WHERE comment_id = ' . (int)$id;
		$db->sql_query($sql);
	}

	/**
	* Delete a comment
	*
	* @param string $id is comment_id from db
	* @param string $u is link_db
	*/
	function del($id, $u)
	{
		global $user, $db, $phpEx;
		global $directory_root_path;

		if (confirm_box(true))
		{
			$db->sql_transaction('begin');

			$requete = 'DELETE FROM ' . DIR_COMMENT_TABLE . '
				WHERE comment_id = ' . (int)$id;
			$db->sql_query($requete);

			$sql = 'UPDATE ' . DIR_LINK_TABLE . '
				SET link_comment = link_comment - 1
			WHERE link_id = ' . (int)$u;
			$db->sql_query($sql);

			$db->sql_transaction('commit');

			$redirect_url = append_sid("{$directory_root_path}directory_comment.$phpEx", array('u' => (int)$u));
			redirect($redirect_url);
			//meta_refresh(3, $redirect_url);
			//$message = $user->lang['DIR_COMMENT_DELETE_OK'];
			//trigger_error($message);
		}
		else
		{
			confirm_box(false, 'DIR_COMMENT_DELETE', '', 'mods/directory/comment_body.html');
		}
	}
}

/**
 * categorie class
 * @package phpBB3
 */
class categorie
{
	var $data = array();

	/**
	* Get somes categorie infos
	*/
	function categorie($id = 0)
	{
		global $db;

		if ($id)
		{
			$sql = 'SELECT cat_id, cat_name, parent_id, left_id, right_id, cat_parents, cat_must_describe, cat_allow_votes, cat_allow_comments, cat_links, cat_validate, cat_link_back, cat_cron_enable, cat_cron_next, cat_cron_freq, cat_cron_enable, cat_cron_nb_check
				FROM ' . DIR_CAT_TABLE . '
				WHERE cat_id = ' . (int)$id;
			$result = $db->sql_query($sql);
			if(!$this->data = $db->sql_fetchrow($result))
			{
				send_status_line(410, 'Gone');

				trigger_error('DIR_ERROR_NO_CATS');
			}
			$db->sql_freeresult($result);
		}
	}

	/**
	 * static function for get approval setting
	 * used in edit mode for test the setting of new category's link
	 */
	function need_approval($id)
	{
		global $db;

		$sql = 'SELECT cat_validate
				FROM ' . DIR_CAT_TABLE . '
				WHERE cat_id = ' . (int)$id;
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);

		return (int)$row['cat_validate'];
	}

	/**
	 * Generate a list of directory'scategories
	 *
	 * @param int $select_id is selected cat
	 *
	 * @retur html code
	 */
	function make_cat_select($select_id)
	{
		global $db, $user;

		// This query is identical to the jumpbox one
		$sql = 'SELECT cat_id, cat_name, parent_id, left_id, right_id
			FROM ' . DIR_CAT_TABLE . '
			ORDER BY left_id ASC';
		$result = $db->sql_query($sql, 600);

		$right = 0;
		$padding_store = array('0' => '');
		$padding = '';
		$cat_list = ($select_id) ? '' : '<option value="0" selected="selected" style="font-weight:bold;">'.$user->lang['DIR_NONE']. '</option>';

		while ($row = $db->sql_fetchrow($result))
		{
			if ($row['left_id'] < $right)
			{
				$padding .= '&nbsp; &nbsp;';
				$padding_store[$row['parent_id']] = $padding;
			}
			else if ($row['left_id'] > $right + 1)
			{
				$padding = (isset($padding_store[$row['parent_id']])) ? $padding_store[$row['parent_id']] : '';
			}

			$right = $row['right_id'];

			$selected = (($row['cat_id'] == $select_id) ? ' selected="selected"' : '');
			$cat_list .= '<option value="' . $row['cat_id'] . '"' . $selected . '>' . $padding . $row['cat_name'] . '</option>';
		}
		$db->sql_freeresult($result);
		unset($padding_store);

		return $cat_list;
	}

	/**
	* Display cat or subcat
	*/
	function display()
	{
		global $db, $template, $phpbb_root_path;
		global $directory_root_path, $auth, $phpEx;

		$cat_rows	= $subcats = array();
		$parent_id	= $visible_cats = 0;
		$sql_from	= '';

		$body = ($this->data) ? 'mods/directory/view_cat.html' : 'mods/directory/body.html';

		$sql_array = array(
			'SELECT'	=> 'cat_id, left_id, right_id, parent_id, cat_name, cat_desc, display_subcat_list, cat_desc_uid, cat_desc_bitfield, cat_desc_options, cat_links, cat_icon, cat_count_all',
			'FROM'		=> array(
				DIR_CAT_TABLE => ''
			),
		);

		if (!$this->data)
		{
			$root_data = array('cat_id' => 0);
			$sql_where = '';
		}
		else
		{
			$root_data = $this->data;
			$sql_where = 'left_id > ' . $root_data['left_id'] . ' AND left_id < ' . $root_data['right_id'];
		}

		$sql = $db->sql_build_query('SELECT', array(
			'SELECT'	=> $sql_array['SELECT'],
			'FROM'		=> $sql_array['FROM'],

			'WHERE'		=> $sql_where,

			'ORDER_BY'	=> 'left_id',
			));

		$result = $db->sql_query($sql);

		$branch_root_id = $root_data['cat_id'];
		while ($row = $db->sql_fetchrow($result))
		{
			$dir_cat_id = $row['cat_id'];

			if ($row['parent_id'] == $root_data['cat_id'] || $row['parent_id'] == $branch_root_id)
			{
				// Direct child of current branch
				$parent_id = $dir_cat_id;
				$cat_rows[$dir_cat_id] = $row;
			}
			else
			{
				$subcats[$parent_id][$dir_cat_id]['display'] = ($row['display_subcat_list']) ? true : false;
				$subcats[$parent_id][$dir_cat_id]['name'] = $row['cat_name'];
				$subcats[$parent_id][$dir_cat_id]['links'] = $row['cat_links'];
				$subcats[$parent_id][$dir_cat_id]['parent_id'] = $row['parent_id'];
			}
		}
		$db->sql_freeresult($result);

		// Used to tell whatever we have to create a dummy category or not.
		$last_catless = true;

		foreach ($cat_rows as $row)
		{
			$visible_cats++;
			$dir_cat_id = $row['cat_id'];

			$folder_image = $folder_alt = '';
			$subcats_list = array();

			// Generate list of subcats if we need to
			if (isset($subcats[$dir_cat_id]))
			{
				foreach ($subcats[$dir_cat_id] as $subcat_id => $subcat_row)
				{
					$row['cat_links'] = ($row['cat_count_all']) ? ($row['cat_links']+$subcat_row['links']) : $row['cat_links'];

					if ($subcat_row['display'] && $subcat_row['parent_id'] == $dir_cat_id)
					{
						$subcats_list[] = array(
							'link'		=> append_sid("{$directory_root_path}directory.$phpEx", array('mode' => 'cat', 'id' => $subcat_id)),
							'name'		=> $subcat_row['name'],
							'links'		=> $subcat_row['links']
						);
					}
					else
					{
						unset($subcats[$dir_cat_id][$subcat_id]);
					}
				}
			}

			$template->assign_block_vars('cat', array(
				'CAT_NAME'				=> $row['cat_name'],
				'CAT_DESC'				=> generate_text_for_display($row['cat_desc'], $row['cat_desc_uid'], $row['cat_desc_bitfield'], $row['cat_desc_options']),
				'CAT_LINKS'				=> $row['cat_links'],
				'CAT_IMG'				=> $phpbb_root_path . 'images/directory/icons/'.$row['cat_icon'],

				'U_CAT'					=> append_sid("{$directory_root_path}directory.$phpEx", array('mode' => 'cat', 'id' => $row['cat_id']))
			));

			// Assign subcats loop for style authors
			foreach ($subcats_list as $subcat)
			{
				$template->assign_block_vars('cat.subcat', array(
					'U_CAT'		=> $subcat['link'],
					'CAT_NAME'	=> $subcat['name'],
					'CAT_LINKS'	=> $subcat['links']
				));
			}
		}
		if ($this->data)
		{
			$param = '&amp;id='.$this->data['cat_id'];
		}
		else
		{
			$param = '';
		}

		$template->assign_vars(array(
			'S_AUTH_ADD'		=> $auth->acl_get('u_submit_dir') && $root_data['cat_id'],
			'S_AUTH_SEARCH'		=> $auth->acl_get('u_search_dir'),
			'S_HAS_SUBCAT'		=> ($visible_cats) ? true : false,

			'U_MAKE_SEARCH'		=> append_sid("{$directory_root_path}directory_search.$phpEx"),
			'U_NEW_SITE' 		=> append_sid("{$directory_root_path}directory.$phpEx", "mode=new" . $param, true),
		));

		$template->set_filenames(array('body' => $body));

		return $root_data;
	}
}

/**
 * directory_cron class
 * @package phpBB3
 */
class directory_cron extends link {

	var $categorie	= array();

	/**
	* Constructor
	*/
	function directory_cron($catrow)
	{
		$this->categorie = $catrow;
	}

	function check()
	{
		global $db, $user;

		$del_array = $update_array = array();

		$sql_array = array(
		'SELECT'	=> 'l.link_id, l.link_back, l.link_guest_email, l.link_nb_check, l.link_user_id, l.link_name, l.link_url, l.link_description, u.user_lang, u.user_email, u.username, u.user_jabber, u.user_notify_type, u.user_dateformat',
		'FROM'		=> array(
				DIR_LINK_TABLE	=> 'l'),
		'LEFT_JOIN'	=> array(
				array(
					'FROM'	=> array(USERS_TABLE	=> 'u'),
					'ON'	=> 'l.link_user_id = u.user_id'
				),
		),
		'WHERE'		=> "l.link_back <> ''
			AND l.link_active = 1
				AND link_cat = " . (int)$this->categorie['cat_id']
		);
		$sql = $db->sql_build_query('SELECT', $sql_array);
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			if(validate_link_back($row['link_back'], false, true) !== false)
			{
				if(!$this->categorie['cat_cron_nb_check'] || ($row['link_nb_check']+1) >= $this->categorie['cat_cron_nb_check'])
				{
					$del_array[] = $row['link_id'];
				}
				else
				{
					// A first table containing links ID to update
					$update_array[] = $row['link_id'];
					// A second array containing several information used when sending the reminder email
					$mail_array[] = $row;
				}
			}
		}
		$db->sql_freeresult($result);

		if (sizeof($del_array))
		{
			$this->del($del_array, $this->categorie['cat_id'], true);
		}
		if (sizeof($update_array))
		{
			$this->update($update_array, $mail_array);
		}
	}

	function auto_check($prune_freq)
	{
		global $db;

		$sql = 'SELECT cat_name
			FROM ' . DIR_CAT_TABLE . '
			WHERE cat_id = ' . (int)$this->categorie['cat_id'];
		$result = $db->sql_query($sql, 3600);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		if ($row)
		{
			$next_prune = time() + ($prune_freq * 86400);

			$this->check();

			$sql = 'UPDATE ' . DIR_CAT_TABLE . "
			SET cat_cron_next = $next_prune
			WHERE cat_id = " . (int)$this->categorie['cat_id'];
			$db->sql_query($sql);

			add_log('admin', 'LOG_DIR_AUTO_PRUNE', $row['cat_name']);
		}

		return;
	}

	function update($u_array, $m_array)
	{
		global $db, $phpbb_root_path;


		$sql = 'UPDATE ' . DIR_LINK_TABLE . '
			SET link_nb_check = link_nb_check + 1
				WHERE ' . $db->sql_in_set('link_id', $u_array);
		$db->sql_query($sql);

		$this->notify($m_array);
	}

	function notify($m_array)
	{
		global $phpbb_root_path, $phpEx, $user, $config;

		$user->add_lang(array('common', 'mods/directory'));

		if(!class_exists('messenger'))
		{
			include($phpbb_root_path . 'includes/functions_messenger.' . $phpEx);
		}
		$messenger	= new messenger(false);

		$row = array();
		$next = (time() + ($this->categorie['cat_cron_freq'] * 86400));
		foreach($m_array as $row)
		{
			strip_bbcode($row['link_description']);

			$messenger->template('mods/directory/error_check', $row['user_lang']);
			$messenger->replyto($config['board_email']);
			$messenger->to($row['user_email'], $row['username']);

			$messenger->im($row['user_jabber'], $row['username']);

			$messenger->headers('X-AntiAbuse: Board servername - ' . $config['server_name']);
			$messenger->headers('X-AntiAbuse: User_id - ' . $user->data['user_id']);
			$messenger->headers('X-AntiAbuse: Username - ' . $user->data['username']);
			$messenger->headers('X-AntiAbuse: User IP - ' . $user->ip);

			$messenger->assign_vars(array(
				'USERNAME'			=> $row['username'],
				'CAT_NAME'			=> strip_tags($this->categorie['cat_name']),
				'LINK_NAME'			=> $row['link_name'],
				'LINK_URL'			=> $row['link_url'],
				'LINK_DESCRIPTION'	=> $row['link_description'],
				'NEXT_CRON' 		=> $user->format_date($next, 'd M Y, H:i')
			));

			$messenger->send($row['user_notify_type']);
		}
	}
}

/*
function _unaccent_compare_ci($a, $b)
{
	return strcasecmp(_remove_accents($a), _remove_accents($b));
}

function _remove_accents($str)
{
	if (version_compare(PHP_VERSION, '5.2.3', '>='))
	{
		$str = htmlentities($str, ENT_NOQUOTES, "UTF-8", false);
	}
	else
	{
		$str = htmlentities($str, ENT_NOQUOTES, "UTF-8");
	}

	$str = preg_replace('#&([A-za-z])(?:acute|breve|caron|cedil|circ|grave|ogon|orn|ring|slash|th|tilde|uml);#', '\1', $str);
	$str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
	$str = preg_replace('#&[^;]+;#', '', $str);

	return $str;
}
*/

/**
 * List flags
 *
 * @param string $dir is flag directory path
 * @param $value selected flag
 *
 * @return html code
 */
function get_dir_flag_list($value)
{
	global $user, $phpEx;

	$flags = array();
	$list = '';

	if (file_exists("{$user->lang_path}{$user->lang_name}/mods/directory_flags.$phpEx"))
	{
		// include the file containing flags
		include("{$user->lang_path}{$user->lang_name}/mods/directory_flags.$phpEx");
	}
	//uasort($flags, '_unaccent_compare_ci');
	asort($flags);

	foreach ($flags as $file => $name)
	{
		$img_file = strtolower($file).'.png';
		if (file_exists('images/directory/flags/'.$img_file))
		{
			$list .= '<option value="' . $img_file . '" ' . (($img_file == $value) ? 'selected="selected"' : '') . '>' . $name . '</option>';
		}
	}

	return ($list);
}

/*
* Return good key language
*
* @param int $validate true if approbation needed before publication
*/
function dir_submit_type($validate)
{
	global $user, $auth;

	if ($validate && !$auth->acl_get('a_'))
	{
		return ($user->lang['DIR_SUBMIT_TYPE_1']);
	}
	else if (!$validate && !$auth->acl_get('a_'))
	{
		return ($user->lang['DIR_SUBMIT_TYPE_2']);
	}
	else if ($auth->acl_get('a_'))
	{
		return ($user->lang['DIR_SUBMIT_TYPE_3']);
	}
	else if ($auth->acl_get('m_'))
	{
		return ($user->lang['DIR_SUBMIT_TYPE_4']);
	}
	trigger_error('DIR_ERROR_SUBMIT_TYPE');
}

/**
 * Generate directory navigation for navbar
 */
function generate_dir_nav(&$dir_cat_data)
{
	global $template, $phpEx;
	global $directory_root_path;

	// Get cat parents
	$dir_cat_parents = get_cat_parents($dir_cat_data);

	// Build navigation links
	if (!empty($dir_cat_parents))
	{
		foreach ($dir_cat_parents as $parent_cat_id => $parent_name)
		{
			$template->assign_block_vars('navlinks', array(
				'FORUM_NAME'	=> $parent_name,
				'FORUM_ID'		=> $parent_cat_id,
				'U_VIEW_FORUM'	=> append_sid("{$directory_root_path}directory.$phpEx", array('mode' => 'cat', 'id' => $parent_cat_id))
			));
		}
	}

	$template->assign_block_vars('navlinks', array(
		'FORUM_NAME'	=> $dir_cat_data['cat_name'],
		'FORUM_ID'		=> $dir_cat_data['cat_id'],
		'U_VIEW_FORUM'	=> append_sid("{$directory_root_path}directory.$phpEx", array('mode' => 'cat', 'id' => $dir_cat_data['cat_id']))
	));

	return;
}

/**
* Returns cat parents as an array. Get them from cat_data if available, or update the database otherwise
*
* @param array $dir_cat_data fatas from db
*/
function get_cat_parents(&$dir_cat_data)
{
	global $db;

	$dir_cat_parents = array();

	if ($dir_cat_data['parent_id'] > 0)
	{
		if ($dir_cat_data['cat_parents'] == '')
		{
			$sql = 'SELECT cat_id, cat_name
				FROM ' . DIR_CAT_TABLE . '
				WHERE left_id < ' . (int)$dir_cat_data['left_id'] . '
					AND right_id > ' . (int)$dir_cat_data['right_id'] . '
				ORDER BY left_id ASC';
			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				$dir_cat_parents[$row['cat_id']] = $row['cat_name'];
			}
			$db->sql_freeresult($result);

			$dir_cat_data['cat_parents'] = serialize($dir_cat_parents);

			$sql = 'UPDATE ' . DIR_CAT_TABLE . "
				SET cat_parents = '" . $db->sql_escape($dir_cat_data['cat_parents']) . "'
				WHERE parent_id = " . (int)$dir_cat_data['parent_id'];
			$db->sql_query($sql);
		}
		else
		{
			$dir_cat_parents = unserialize($dir_cat_data['cat_parents']);
		}
	}

	return $dir_cat_parents;
}

function recent_links()
{
	global $config, $db, $template, $user;
	global $directory_root_path, $phpEx;

	if($config['dir_recent_block'])
	{
		$limit_sql		= $config['dir_recent_rows'] * $config['dir_recent_columns'];
		$exclude_array	= explode(',', str_replace(' ', '', $config['dir_recent_exclude']));

		$sql_array = array(
			'SELECT'	=> 'l.link_id, l.link_cat, l.link_url, l.link_user_id, l.link_comment, l. link_description, l.link_vote, l.link_note, l.link_view, l.link_time, l.link_name, l.link_thumb, u.user_id, u.username, u.user_colour, c.cat_name',
			'FROM'		=> array(
					DIR_LINK_TABLE	=> 'l'),
			'LEFT_JOIN'	=> array(
					array(
						'FROM'	=> array(USERS_TABLE	=> 'u'),
						'ON'	=> 'l.link_user_id = u.user_id'
					),
					array(
						'FROM'	=> array(DIR_CAT_TABLE => 'c'),
						'ON'	=> 'l.link_cat = c.cat_id'
					)
			),
			'WHERE'		=> $db->sql_in_set('l.link_cat', $exclude_array, true).' AND l.link_active = 1',
			'ORDER_BY'	=> 'l.link_time DESC');

		$sql = $db->sql_build_query('SELECT', $sql_array);
		$result = $db->sql_query_limit($sql, $limit_sql, 0);
		$num = 0;
		$rowset = array();

		while ($site = $db->sql_fetchrow($result))
		{
			$rowset[$site['link_id']] = $site;
		}
		$db->sql_freeresult($result);

		if(sizeof($rowset))
		{
			$template->assign_block_vars('block', array(
				'S_COL_WIDTH'			=> (100 / $config['dir_recent_columns']) . '%',
			));

			foreach($rowset as $row)
			{
				if (($num % $config['dir_recent_columns']) == 0)
				{
					$template->assign_block_vars('block.row', array());
				}

				$template->assign_block_vars('block.row.col', array(
					'UC_THUMBNAIL'			=> '<a href="'.$row['link_url'].'" onclick="window.open(\''.$directory_root_path.'directory.'.$phpEx.'?mode=view_url&amp;u='.$row['link_id'].'\'); return false;"><img src="'.$row['link_thumb'].'" title="'.$row['link_name'].'" alt="'.$row['link_name'].'" /></a>',
					'NAME'					=> $row['link_name'],
					'USER'					=> get_username_string('full', $row['link_user_id'], $row['username'], $row['user_colour']),
					'TIME'					=> ($row['link_time']) ? $user->format_date($row['link_time']) : '',
					'CAT'					=> $row['cat_name'],
					'COUNT'					=> $row['link_view'],
					'COMMENT'				=> $row['link_comment'],

					'U_CAT'					=> append_sid("{$directory_root_path}directory.$phpEx", array('mode' => 'cat', 'id' => (int)$row['link_cat'])),
					'U_COMMENT'				=> append_sid("{$directory_root_path}directory_comment.$phpEx", array('u' => (int)$row['link_id'])),

					'L_DIR_SEARCH_NB_CLIC'	=> ($row['link_view'] > 1) ? $user->lang['DIR_SEARCH_NB_CLICS'] : $user->lang['DIR_SEARCH_NB_CLIC'],
					'L_DIR_SEARCH_NB_COMM'	=> ($row['link_comment'] > 1) ? $user->lang['L_DIR_SEARCH_NB_COMMS']: $user->lang['L_DIR_SEARCH_NB_COMM'],
				));
				$num++;
			}

			while (($num % $config['dir_recent_columns']) != 0)
			{
				$template->assign_block_vars('block.row.col2', array());
				$num++;
			}
		}
	}
}

function validate_link_back($remote_url, $optional, $cron = false)
{
	global $config;

	if(!$cron)
	{
		if (empty($remote_url) && $optional)
		{
			return false;
		}

		if (!preg_match('#^http[s]?://(.*?\.)*?[a-z0-9\-]+\.[a-z]{2,4}#i', $remote_url))
		{
			return 'DIR_ERROR_WRONG_DATA_BACK';
		}
	}

	if (false === ($handle = @fopen($remote_url, 'r')))
	{
		return 'DIR_ERROR_NOT_FOUND_BACK';
	}

	$buff = '';

	// Read by packet, faster than file_get_contents()
	while (!feof($handle))
	{
		$buff .= fgets($handle, 256);

		if(stristr($buff, $config['server_name']))
		{
			@fclose($handle);
			return false;
		}
	}
	@fclose($handle);

	return 'DIR_ERROR_NO_LINK_BACK';
}

$link = new link;

?>