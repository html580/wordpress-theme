<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/images/comment.js"></script>

<?php
	// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
		die (__('Please do not load this page directly. Thanks!', 'dzf'));
	}

	$options = get_option('blocks_options');
	$trackbacks = array(); 
?>

<?php if ( !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
	<div class="block">
		<div class="ep small r"><?php _e('Enter your password to view comments.', 'dzf'); ?></div>
	</div>
<?php return; endif; ?>

<!-- You can start editing here. -->
<?php if ( $comments ) : ?>

	<ol class="commentlist">
	<?php
		// WordPress 2.7 or higher
		if (function_exists('wp_list_comments')) {
			wp_list_comments('type=comment&callback=custom_comments');
			$trackbacks = $comments_by_type['pings'];
		// WordPress 2.6.3 or lower
		} else {
			foreach ($comments as $comment) {
				if($comment->comment_type == 'pingback' || $comment->comment_type == 'trackback') {
					array_push($trackbacks, $comment);
				} else {
					custom_comments($comment, null, null);
					echo '</li>';
				}
			}
		}
	?>
	</ol>

<?php
	if (get_option('page_comments')) {
		$comment_pages = paginate_comments_links('echo=0');
		if ($comment_pages) {
?>
		<div id="commentnavi" class="block">
			<div class="g">
				<span class="pages"><?php _e('Comment pages', 'dzf'); ?></span>
				<div id="commentpager"><?php echo $comment_pages; ?></div>
			</div>
		</div>
<?php
		}
	}
?>
	<?php if($trackbacks) : ?>
		<div id="trackbacks" class="block">
			<h3>
				<span><a id="trackbacks_show" href="javascript:void(0);" onclick="MGJS.setStyleDisplay('trackbacks_hide','');MGJS.setStyleDisplay('trackbacks_box','');MGJS.setStyleDisplay('trackbacks_show','none');"><?php _e('显示', 'dzf'); ?></a>
				<a id="trackbacks_hide" href="javascript:void(0);" onclick="MGJS.setStyleDisplay('trackbacks_show','');MGJS.setStyleDisplay('trackbacks_box','none');MGJS.setStyleDisplay('trackbacks_hide','none');"><?php _e('隐藏', 'dzf'); ?></a>
                </span>
				<?php echo count($trackbacks); _e(' trackbacks', 'dzf'); ?>
			</h3>
			<div id= "trackbacks_box">
				<ul>
					<?php foreach ($trackbacks as $comment) : ?>
						<li>
							<small><?php comment_date('Y/m/d'); ?> - </small>
							<?php comment_author_link(); ?>
							<?php edit_comment_link(__('Edit', 'dzf'), ' <small>(', ')</small>'); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<script type="text/javascript">MGJS.setStyleDisplay('trackbacks_hide','none');MGJS.setStyleDisplay('trackbacks_box','none');</script>
	<?php endif; ?>

<?php elseif (comments_open()) : // If there are no comments yet. ?>
	<div class="block">
		<div class="small g"><?php _e('No comments yet.', 'dzf'); ?></div>
	</div>

<?php endif; ?>

<?php if (!comments_open()) : // If comments are closed. ?>
	<div class="block">
		<div class="small g"><?php _e('Comments are closed.', 'dzf'); ?></div>
	</div>

<?php elseif ( get_option('comment_registration') && !$user_ID ) : // If registration required and not logged in. ?>
	<div class="block">
		<div class="small g">
			<?php
				if (function_exists('wp_login_url')) {
					$login_link = wp_login_url();
				} else {
					$login_link = get_option('siteurl') . '/wp-login.php?redirect_to=' . urlencode(get_permalink());
				}
			?>
			<?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'dzf'), $login_link); ?>
		</div>
	</div>

<?php else : ?>
	<div id="respond">
	<form id="commentform" name="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
		<h3><?php _e('Leave a comment', 'dzf'); ?></h3>
		<?php if (function_exists('wp_list_comments')) : ?>
			<?php cancel_comment_reply_link(__('Cancel reply', 'dzf')) ?>
		<?php endif; ?>
		<div class="form_box">
        	<div class="text"><textarea name="comment" id="comment" class="textarea" cols="64" rows="8" tabindex="4"></textarea></div>
			<div class="form_info">
            	<div class="part">

				<?php if ( $user_ID ) : ?>
					<?php
						if (function_exists('wp_logout_url')) {
							$logout_link = wp_logout_url();
						} else {
							$logout_link = get_option('siteurl') . '/wp-login.php?action=logout';
						}
					?>
					<div class="row"><?php _e('Logged in as', 'dzf'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><strong><?php echo $user_identity; ?></strong></a>. <a href="<?php echo $logout_link; ?>" title="<?php _e('Log out of this account', 'dzf'); ?>"><?php _e('Logout &raquo;', 'dzf'); ?></a></div>

				<?php else : ?>
					<?php if ( $comment_author != "" ) : ?>
						<?php printf(__('Welcome back <strong>%s</strong>.', 'dzf'), $comment_author) ?>
						<span id="show_author_info"><a href="javascript:void(0);" onclick="MGJS.setStyleDisplay('author_info','');MGJS.setStyleDisplay('show_author_info','none');MGJS.setStyleDisplay('hide_author_info','');"><?php _e('Change &raquo;', 'dzf'); ?></a></span>
						<span id="hide_author_info"><a href="javascript:void(0);" onclick="MGJS.setStyleDisplay('author_info','none');MGJS.setStyleDisplay('show_author_info','');MGJS.setStyleDisplay('hide_author_info','none');"><?php _e('Close &raquo;', 'dzf'); ?></a></span>
					<?php endif; ?>

					<div id="author_info">
						<div><label for="author" class="small"><?php _e('Name', 'dzf'); ?> <?php if ($req) _e('*', 'dzf'); ?></label></div>
						<div><input type="text" class="textfield" name="author" id="author" value="<?php echo $comment_author; ?>" tabindex="1" /></div>
						<div><label for="email" class="small"><?php _e('E-Mail', 'dzf');?> <?php if ($req) _e('*', 'dzf'); ?> <?php _e('(不会被公开)', 'dzf');?></label></div>
						<div><input type="text" class="textfield" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" /></div>
						<div><label for="url" class="small"><?php _e('Website', 'dzf'); ?></label></div>
						<div><input type="text" class="textfield" name="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="3" /></div>
					</div>

					<?php if ( $comment_author != "" ) : ?>
						<script type="text/javascript">MGJS.setStyleDisplay('hide_author_info','none');MGJS.setStyleDisplay('author_info','none');</script>
					<?php endif; ?>

				<?php endif; ?>
				</div>

				<?php if (function_exists('wp_list_comments')) : ?>
					<?php comment_id_fields(); ?>
				<?php endif; ?>

				<div class="part">
					<input type="submit" id="submit" class="button" tabindex="5" value="<?php _e('Submit Comment', 'dzf'); ?> (Ctrl+Enter)" />
					<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
				</div>

				
			</div>

			<div class="clear"></div>
		</div>
		<?php do_action('comment_form', $post->ID); ?>
	</form>
	</div>

	<?php if ($options['ctrlentry']) : ?>
		<script type="text/javascript">MGJS.loadCommentShortcut();</script>
	<?php endif; ?>

<?php endif; ?>
<script type="text/javascript">
<!--//--><![CDATA[//><!--
    var commenttextarea = document.getElementById('comment');
    commenttextarea.onkeydown = function quickSubmit(e) {
        if (!e) var e = window.event;
        if (e.ctrlKey && e.keyCode == 13){
            document.getElementById('submit').click();
        }
    }
//--><!]]>
</script>