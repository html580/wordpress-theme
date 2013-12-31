<?php get_header(); ?>
	<div id="container">
    	<div class="content">
			<?php $options = get_option('dzf_options'); if ($options['notice'] && $options['notice_content']) : ?>
			<div class="notice">
				<p><span>公告：</span><?php echo($options['notice_content']); ?></p>
			</div>
			<?php endif; ?>
        	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<?php if(is_sticky()) : ?>
            <div class="sticky" id="post-<?php the_ID(); ?>">
            	<h2>[置顶] <a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
            </div>
            <?php else : ?>
            <div class="post" id="post-<?php the_ID(); ?>">
            	<div class="date"><span><?php the_time(__('Y')) ?></span><span class="f"><?php the_time(__('F')) ?><?php the_time(__('j')) ?></span></div>
            	<h2><a href="<?php the_permalink() ?>" target="_blank"><?php the_title(); ?></a></h2>
				<div class="info">
                    <span class="categories"><?php the_category(','); ?></span>
                    <?php
											$posttags = get_the_tags();
										  if ($posttags):
										?>
												<span class="tags"><?php the_tags('', ', ', ''); ?></span>
										<?php endif; ?>
                    <span class="views"><?php the_views(); ?></span>
					<?php if ($options['author']) : ?><span class="author"><?php the_author_posts_link(); ?></span><?php endif; ?>
                    <?php edit_post_link(编辑, '','&raquo;'); ?>
                    <span class="comments"><?php comments_popup_link('<em>0</em>', '<em>1</em>', '<em>%</em>', ''); ?></span>
					<div class="clear"></div>
				</div>
				<div class="intro">
					<?php the_content('<strong style="font-size:15px;">阅读全文...</strong>'); ?>
				</div>
            </div>
<?php endif; ?>
            <?php endwhile;else : ?>
            <div class="errorbox">
            	<?php _e('Sorry, no posts matched your criteria.', 'dzf'); ?>
			</div>
            <?php endif; ?>
            <?php dzf_pagination($query_string); ?>
			<div class="clear"></div>
		</div><!-- #content -->
        <?php get_sidebar(); ?>
    
	</div><!-- #container -->
	
	
<?php get_footer(); ?>
