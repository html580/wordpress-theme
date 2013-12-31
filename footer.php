<div class="clear"></div>
<div id="footer">
    <div class="foot">
    	<?php if(is_home()&& !is_paged()):?>  
    	<div class="footer-widget">
    		<?php
					// A second sidebar for widgets, just because.
					if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>
				
						<?php dynamic_sidebar( 'secondary-widget-area' ); ?>
						<!-- #secondary .widget-area -->
				
				<?php endif; ?>
      </div>		 
      <?php endif; ?>
    	<div class="copy"><span><?php _e('Copyright &copy; ', 'dzf');?> 声明：本站所有资源全部收集于互联网，分享目的仅供大家学习与参考，如有侵权，请联系<a href="mailto:<?php bloginfo('admin_email'); ?>"><?php bloginfo('admin_email'); ?></a>及时删除！&nbsp;&nbsp;粤ICP备12026349号</span><a id="gotop" href="javascript:void(0);" onclick="MGJS.goTop();return false;"><?php _e('Top', 'dzf'); ?></a><?php wp_footer(); ?></div>
    	<?php $options = get_option('dzf_options'); if ($options['stat_content']) : ?>  <?php echo($options['stat_content']); ?><?php endif; ?>
	</div>
</div>
</div>
</body>
</html>