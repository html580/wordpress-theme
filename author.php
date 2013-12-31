<?php get_header(); ?>
	<div id="container">
    	<div class="content">
        	<?php if ( have_posts() ) the_post(); ?>
        	<div class="box"><?php printf( __( 'Author Archive: %s 的文章', 'dzf' ), "<span class='vcard'><a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a></span>" ); ?></div>
			<?php if ( get_the_author_meta( 'description' ) ) : ?>
			<div id="entry-author-info">
				<div id="author-avatar"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 60 ) ); ?></div><!-- #author-avatar -->
				<div id="author-description">
                	<h2><?php printf( __( '关于 %s', 'dzf' ), get_the_author() ); ?></h2>
					<?php the_author_meta( 'description' ); ?>
				</div><!-- #author-description	-->
			</div><!-- #entry-author-info -->
			<?php endif; ?>
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
            <div class="post" id="post-<?php the_ID(); ?>">
            	<div class="date"><span><?php the_time(__('Y')) ?></span><span class="f"><?php the_time(__('F')) ?><?php the_time(__('j')) ?></span></div>
            	<h2><a class="title" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
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
                    <?php edit_post_link(__('Edit', 'dzf'), '','&raquo;'); ?>
                    <span class="comments"><?php comments_popup_link('<em>0</em> Comments', '<em>1</em> Comment', '<em>%</em> Comments', 'Comments off'); ?></span>
					<div class="clear"></div>
				</div>
				<div class="intro">
					<?php if(is_category() || is_archive() || is_home() ) {
						the_excerpt();
						} else {
							the_content('Read the rest of this entry &raquo;'); 
					} 
					?>
				</div>
            </div>
            <?php endwhile;else : ?>
            <div class="errorbox">
            	<?php _e('Sorry, no posts matched your criteria.', 'dzf'); ?>
			</div>
            <?php endif; ?>
            <?php dzf_pagination($query_string); ?>
		</div><!-- #content -->
        <?php get_sidebar(); ?>
	</div><!-- #container -->
    
<?php get_footer(); ?>
