<?php
get_header(); ?>
<?php $category_id= get_article_category_ID();$parent_category_id= get_category_root_id(get_article_category_ID()); ?>
	<div id="container" class="article">
    	<div class="content">
        	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="place"><a title="<?php _e('Go to homepage', 'dzf'); ?>" href="<?php echo get_settings('home'); ?>/"><?php _e('Home', 'dzf'); ?></a> > <a href="<?php echo get_category_link($parent_category_id); ?>"><?php echo get_cat_name($parent_category_id); ?></a>
<?php if ($category_id!=$parent_category_id){?> > <a href="<?php echo get_category_link($category_id); ?>"><?php echo get_cat_name($category_id); ?></a><?php } ?> > <?php the_title(); ?>
			</div>
            <div class="post" id="post-<?php the_ID(); ?>">
            	<div class="date"><span><?php the_time(__('Y')) ?></span><span class="f"><?php the_time(__('F')) ?><?php the_time(__('j')) ?></span></div>
            	<h2><a class="title" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<div class="info">
					<span class="author"><?php the_author_posts_link(); ?></span>
                    <span class="categories"><?php the_category(','); ?></span>
                    <?php
											$posttags = get_the_tags();
										  if ($posttags):
										?>
												<span class="tags"><?php the_tags('', ', ', ''); ?></span>
										<?php endif; ?>
                    <span class="views"><?php the_views(); ?></span>
                    <?php edit_post_link(__('Edit', 'dzf'), '','&raquo;'); ?>
                    <span class="comments"><?php comments_popup_link('<em>0</em>', '<em>1</em>', '<em>%</em>', ''); ?></span>
                    <?php if ($comments || comments_open()) : ?>
					<span class="addcomment"><a href="#respond"><?php _e('Leave a comment', 'dzf'); ?></a></span>
					<?php endif; ?>
					<div class="clear"></div>
				</div>
				<div class="con BSHARE_POP" id="a<?php the_ID(); ?>">
					<?php the_content(); ?>
					<div class="clear"></div>
				</div>
                <div class="under">
					<p>文章作者：<a href="<?php echo get_option('home'); ?>/"><?php the_author(); ?></a><br />本文地址：<a href="<?php the_permalink() ?>"><?php the_permalink() ?></a><br />版权所有 &copy; 转载时必须以链接形式注明作者和原始出处！</p>
				</div>
            </div>
            <div id="postnavi">
				<span class="prev">&laquo; <?php next_post_link('%link') ?></span>
				<span class="next"><?php previous_post_link('%link') ?> &raquo;</span>
				<div class="clear"></div>
			</div>
            <div class="like">
            	<?php
$backup = $post;
$tags = wp_get_post_tags($post->ID);
$tagIDs = array();
if ($tags) {
echo '<h4>或许你会感兴趣的文章</h4>';
echo '<ul>';
$tagcount = count($tags);
for ($i = 0; $i < $tagcount; $i++) {
$tagIDs[$i] = $tags[$i]->term_id;
}
$args=array(
'tag__in' => $tagIDs,
'post__not_in' => array($post->ID),
'showposts'=>8, // 显示相关日志篇数 
'caller_get_posts'=>1
);
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
while ($my_query->have_posts()) : $my_query->the_post(); ?>
<li><span><?php the_time(__('Y-m-d')) ?></span><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
<?php endwhile;
echo '</ul>';
} else { ?>
<ul>
<?php
query_posts(array('orderby' => 'rand', 'showposts' => 8)); //显示随机日志篇数
if (have_posts()) :
while (have_posts()) : the_post();?>
<li><span><?php the_time(__('Y-m-d')) ?></span><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></li>
<?php endwhile;endif; ?>
</ul>
<?php }
}
$post = $backup;
wp_reset_query();
?>

            </div>
            <?php endwhile;else : ?>
            <div class="errorbox">
            	<?php _e('Sorry, no posts matched your criteria.', 'dzf'); ?>
			</div>
            <?php endif; ?>
            <div class="comment_box">
            	<?php
	if (function_exists('wp_list_comments')) {
		comments_template('', true);
	} else {
		comments_template();
	}
?>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
<?php get_footer(); ?>
