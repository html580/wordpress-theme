<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
	<div class="form">
		<input name="s" type="text" id="s" onblur="if (this.value =='') this.value='搜索文章...'" onfocus="this.value=''" onclick="if (this.value=='搜索文章...') this.value=''" value="搜索文章..." class="inputbox" />
		<span>
		<input type="submit" name="button" id="button" value="" class="go" />
		</span>
	</div>
</form>