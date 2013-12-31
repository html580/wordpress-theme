	<div class="sidebar">
		<?php if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>
		<div class="block search_form">
        	<?php include (TEMPLATEPATH . '/searchform.php'); ?>
        </div>
		<div class="block rad">
        	<?php $options = get_option('dzf_options'); if ($options['showcase_title']) : ?>
			<h3><?php echo($options['showcase_title']); ?></h3>
			<?php endif; ?>
        	<?php $options = get_option('dzf_options'); if ($options['showcase_content']) : ?>
			<div class="rad_c"><?php echo($options['showcase_content']); ?></div>
			<?php endif; ?>
		</div>
        <div class="block feed_form">
        	<h3>RSS <?php _e('Feed', 'dzf'); ?></h3>
            <ul>
            	<li><a rel="external nofollow" title="<?php _e('Subscribe with ', 'dzf'); _e('Google', 'dzf'); ?>" href="http://fusion.google.com/add?feedurl=<?php $options = get_option('dzf_options'); if ($options['feed_url']) {echo($options['feed_url']);} else  bloginfo('rss2_url'); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/icon_google.gif" alt="<?php _e('Subscribe with ', 'dzf'); _e('Google', 'dzf'); ?>" /></a></li>
                <li><a rel="external nofollow" title="<?php _e('Subscribe with ', 'dzf'); _e('Xian Guo', 'dzf'); ?>" href="http://www.xianguo.com/subscribe.php?url=<?php $options = get_option('dzf_options'); if ($options['feed_url']) {echo($options['feed_url']);} else  bloginfo('rss2_url'); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/icon_xianguo.gif" alt="<?php _e('Subscribe with ', 'dzf'); _e('Xian Guo', 'dzf'); ?>" /></a></li>
                <li><a rel="external nofollow" title="<?php _e('Subscribe with ', 'dzf');_e('QQ ', 'dzf'); _e('Email feed', 'dzf'); ?>" href="http://mail.qq.com/cgi-bin/feed?u=<?php $options = get_option('dzf_options'); if ($options['feed_url']) {echo($options['feed_url']);} else  bloginfo('rss2_url'); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/icon_qq.gif" alt="<?php _e('Subscribe with ', 'dzf');_e('QQ ', 'dzf'); _e('Email feed', 'dzf'); ?>" /></a></li>
                <li><a rel="external nofollow" title="<?php _e('Subscribe with ', 'dzf'); _e('Zhua Xia', 'dzf'); ?>" href="<?php $options = get_option('dzf_options'); if ($options['feed_url_email']) {echo($options['feed_url_email']);} else  bloginfo('rss2_url'); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/icon_mail.gif" alt="<?php _e('Subscribe with ', 'dzf'); _e('Zhua Xia', 'dzf'); ?>" /></a></li>
            </ul>
        </div>
        <div class="block categories cat"><h3><?php _e('Categories: ', 'dzf'); ?></h3>
        	<ul>
        	<?php wp_list_categories('order=asc&show_count=1&title_li=0'); ?>
            </ul>
        </div>
        <div class="block">
        	<h3>
			<?php
			if (is_single()) {
			echo _e('最新文章', 'dzf');
			} else {
			echo _e('随机文章', 'dzf');
			}
			?>
    		</h3>
        	<ul>
            	<?php
				if (is_single()) {
					$posts = get_posts('numberposts=10&orderby=post_date');
				} else {
					$posts = get_posts('numberposts=10&orderby=rand');
				}
				foreach($posts as $post) {
					setup_postdata($post);
					echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
				}
				$post = $posts[0];
				?>
            </ul>
        </div>
        <div class="block"><h3><?php _e('最受欢迎文章', 'dzf'); ?></h3>
        	<ul>
            	<?php $result = $wpdb->get_results("SELECT comment_count,ID,post_title,post_date FROM $wpdb->posts where post_type <> 'page' ORDER BY comment_count DESC LIMIT 0 , 10"); 
				foreach ($result as $topten) { 
				$postid = $topten->ID; 
				$title = $topten->post_title;
				$post_date = $topten->post_date;
				$commentcount = $topten->comment_count; 
				if ($commentcount != 0) { ?> 
                <li><span><?php echo $post_date; ?></span><a href="<?php echo get_permalink($postid); ?>" title="<?php echo $title ?>"><?php echo $title ?></a></li> 
				<?php } } ?>
            </ul>
        </div>
        <div class="block comment"><h3><?php _e('最新评论' ,'dzf'); ?></h3>
        	<ul>
            	<?php
                global $wpdb;
				$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,comment_author_url, SUBSTRING(comment_content,1,25) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT 10";
				$comments = $wpdb->get_results($sql);
				$output = $pre_HTML;
				foreach ($comments as $comment) {
					$output .= "\n<li class=\"new\">" . $comment->comment_author . "  评论道：<br /> <a href=\"" . get_permalink($comment->ID) . "#comment-" . $comment->comment_ID . "\" title=\"". $comment->comment_author. ":" . $comment->post_title . "\">" . strip_tags($comment->com_excerpt) ."</a></li>";
					}
					$output .= $post_HTML;
					echo $output;
				?>

                
            </ul>
        </div>
        <div class="block"><h3><?php _e('Blog Archives' ,'dzf'); ?></h3>
        	<ul>
            	<?php wp_get_archives('type=monthly'); ?>
            </ul>
        </div>
        <!-- tag cloud -->
        <?php if (!is_single()) : ?>
		<div class="block" id="tag_cloud"><h3><?php _e('Tag Cloud' ,'dzf'); ?></h3>
            <p><?php wp_tag_cloud('smallest=8&largest=16'); ?></p>
        </div>
		<?php endif; ?>
        <?php  if ( is_home() || is_page() ) { ?>
        <div class="block links"><h3><?php _e('Blogroll', 'dzf'); ?></h3>
        	<ul>
            	<?php wp_list_bookmarks('title_li=&categorize=0'); ?>
            </ul>
        </div>
		<?php } ?>
        <?php endif; ?>
        <div class="block"><h3><?php _e('Meta', 'dzf'); ?></h3>
        	<ul>
            	<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
            </ul>
        </div>
         
	</div>
	
  