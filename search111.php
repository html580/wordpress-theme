<?php get_header(); ?>
	<div id="container">
    	<div class="content">
        	<div class="place" style="color:#DF0031;"><?php printf( __('Keyword: &#8216;%1$s&#8217;', 'dzf'), wp_specialchars($s, 1) ); ?> <?php _e('Search Results', 'dzf'); ?></div>
            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
            <div class="post" id="post-<?php the_ID(); ?>">
            	<div class="date"><span><?php the_time(__('Y')) ?></span><span class="f"><?php the_time(__('F')) ?><?php the_time(__('j')) ?></span></div>
            	<h2><a class="title" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<div class="info">
                    <span class="categories"><?php the_category(','); ?></span>
                    <span class="tags"><?php the_tags('', ', ', ''); ?></span>
					<?php if ($options['author']) : ?><span class="author"><?php the_author_posts_link(); ?></span><?php endif; ?>
                    <?php edit_post_link(__('Edit', 'dzf'), '','&raquo;'); ?>
                    <span class="comments"><?php comments_popup_link('<em>0</em> Comments', '<em>1</em> Comment', '<em>%</em> Comments', 'Comments off'); ?></span>
					<div class="clear"></div>
				</div>
				<div class="intro">
					<?php the_content('<strong style="font-size:15px;">ÔÄ¶ÁÈ«ÎÄ...</strong>'); ?>
				</div>
            </div>
            <?php endwhile;else : ?>
            <div class="errorbox">
            	<p><?php _e('Sorry, no posts matched your criteria.', 'dzf'); ?></p>
                <?php get_search_form(); ?>
			</div>
            <?php endif; ?>
            <?php dzf_pagination($query_string); ?>
		</div><!-- #content -->
        <?php get_sidebar(); ?>
	</div><!-- #container -->
    
<?php get_footer(); ?>
