
/*
 * Superfish v1.4.8 - jQuery menu widget
 * Copyright (c) 2008 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 * 	http://www.opensource.org/licenses/mit-license.php
 * 	http://www.gnu.org/licenses/gpl.html
 *
 * CHANGELOG: http://users.tpg.com.au/j_birch/plugins/superfish/changelog.txt
 */

;(function($){
	$.fn.superfish = function(op){

		var sf = $.fn.superfish,
			c = sf.c,
			$arrow = $(['<span class="',c.arrowClass,'"> &#187;</span>'].join('')),
			over = function(){
				var $$ = $(this), menu = getMenu($$);
				clearTimeout(menu.sfTimer);
				$$.showSuperfishUl().siblings().hideSuperfishUl();
			},
			out = function(){
				var $$ = $(this), menu = getMenu($$), o = sf.op;
				clearTimeout(menu.sfTimer);
				menu.sfTimer=setTimeout(function(){
					o.retainPath=($.inArray($$[0],o.$path)>-1);
					$$.hideSuperfishUl();
					if (o.$path.length && $$.parents(['li.',o.hoverClass].join('')).length<1){over.call(o.$path);}
				},o.delay);	
			},
			getMenu = function($menu){
				var menu = $menu.parents(['ul.',c.menuClass,':first'].join(''))[0];
				sf.op = sf.o[menu.serial];
				return menu;
			},
			addArrow = function($a){ $a.addClass(c.anchorClass).append($arrow.clone()); };
			
		return this.each(function() {
			var s = this.serial = sf.o.length;
			var o = $.extend({},sf.defaults,op);
			o.$path = $('li.'+o.pathClass,this).slice(0,o.pathLevels).each(function(){
				$(this).addClass([o.hoverClass,c.bcClass].join(' '))
					.filter('li:has(ul)').removeClass(o.pathClass);
			});
			sf.o[s] = sf.op = o;
			
			$('li:has(ul)',this)[($.fn.hoverIntent && !o.disableHI) ? 'hoverIntent' : 'hover'](over,out).each(function() {
				if (o.autoArrows) addArrow( $('>a:first-child',this) );
			})
			.not('.'+c.bcClass)
				.hideSuperfishUl();
			
			var $a = $('a',this);
			$a.each(function(i){
				var $li = $a.eq(i).parents('li');
				$a.eq(i).focus(function(){over.call($li);}).blur(function(){out.call($li);});
			});
			o.onInit.call(this);
			
		}).each(function() {
			var menuClasses = [c.menuClass];
			if (sf.op.dropShadows  && !($.browser.msie && $.browser.version < 7)) menuClasses.push(c.shadowClass);
			$(this).addClass(menuClasses.join(' '));
		});
	};

	var sf = $.fn.superfish;
	sf.o = [];
	sf.op = {};
	sf.IE7fix = function(){
		var o = sf.op;
		if ($.browser.msie && $.browser.version > 6 && o.dropShadows && o.animation.opacity!=undefined)
			this.toggleClass(sf.c.shadowClass+'-off');
		};
	sf.c = {
		bcClass     : 'sf-breadcrumb',
		menuClass   : 'sf-js-enabled',
		anchorClass : 'sf-with-ul',
		arrowClass  : 'sf-sub-indicator',
		shadowClass : 'sf-shadow'
	};
	sf.defaults = {
		hoverClass	: 'sfHover',
		pathClass	: 'overideThisToUse',
		pathLevels	: 1,
		delay		: 800,
		animation	: {opacity:'show'},
		speed		: 'normal',
		autoArrows	: true,
		dropShadows : true,
		disableHI	: false,		// true disables hoverIntent detection
		onInit		: function(){}, // callback functions
		onBeforeShow: function(){},
		onShow		: function(){},
		onHide		: function(){}
	};
	$.fn.extend({
		hideSuperfishUl : function(){
			var o = sf.op,
				not = (o.retainPath===true) ? o.$path : '';
			o.retainPath = false;
			var $ul = $(['li.',o.hoverClass].join(''),this).add(this).not(not).removeClass(o.hoverClass)
					.find('>ul').hide().css('visibility','hidden');
			o.onHide.call($ul);
			return this;
		},
		showSuperfishUl : function(){
			var o = sf.op,
				sh = sf.c.shadowClass+'-off',
				$ul = this.addClass(o.hoverClass)
					.find('>ul:hidden').css('visibility','visible');
			sf.IE7fix.call($ul);
			o.onBeforeShow.call($ul);
			$ul.animate(o.animation,o.speed,function(){ sf.IE7fix.call($ul); o.onShow.call($ul); });
			return this;
		}
	});

  $.scrolltotop = function(options){
		options = jQuery.extend({
			startline : 100,				//出现返回顶部按钮离顶部的距离
			scrollto : 0,					//滚动到距离顶部的距离，或者某个id元素的位置
			scrollduration : 500,			//平滑滚动时间
			fadeduration : [ 500, 100 ],	//淡入淡出时间 ，[0]淡入、[1]淡出
			controlHTML : '<div id="scroll_top" title="回到顶部"></div><div id="scroll_comment" title="查看评论"></div><div id="scroll_bottom" title="转到底部"></div>',		//html代码
			className: 'scroll',					//样式名称
			titleName: '回到顶部',				//回到顶部的title属性
			offsetx : null,					//回到顶部 right 偏移位置
			offsety : null,					//回到顶部 bottom 偏移位置
			comments:false
		}, options);
		
		var state = {
			isvisible : false,
			shouldvisible : false
		};
		
		var current = this;
		
		var $body,$control,$cssfixedsupport;
		
		var init = function(){
			var iebrws = document.all;
			$cssfixedsupport = !iebrws || iebrws
					&& document.compatMode == "CSS1Compat"
					&& window.XMLHttpRequest
			$body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
			$control = $('<div class="'+options.className+'" id="scroll">' + options.controlHTML + '</div>').css({
				position : $cssfixedsupport ? 'fixed': 'absolute',
				opacity : 0,
				cursor : 'pointer'
			}).appendTo('body');
			if (document.all && !window.XMLHttpRequest && $control.text() != ''){
				$control.css({
					width : $control.width()
				});
			}
			if(options.comments){
				$("#scroll_comment").css({display:'block'});
				$("#scroll").css({top:'35%'})
			}
			togglecontrol();
			$('#scroll_top').click(function() {
				scrollup(0);
				return false;
			});
			$('#scroll_comment').click(function() {
				scrollup($('#commentform').offset().top);
				return false;
			});
			$('#scroll_bottom').click(function() {
				scrollup($('#footer').offset().top);
				return false;
			});
			$(window).bind('scroll resize', function(e) {
				togglecontrol();
			})
			
			return current;
		};
		
		var scrollup = function(dest) {
			if (!$cssfixedsupport){
				$control.css( {
					opacity : 0
				});
			}
			$body.animate( {
				scrollTop : dest
			}, options.scrollduration);
		};

		var keepfixed = function() {
			var $window = jQuery(window);
			var controlx = $window.scrollLeft() + $window.width()
					- $control.width() - options.offsetx;
			var controly = $window.scrollTop() + $window.height()
					- $control.height() - options.offsety;
			$control.css( {
				left : controlx + 'px',
				top : controly + 'px'
			});
		};

		var togglecontrol = function() {
			var scrolltop = jQuery(window).scrollTop();
			if (!$cssfixedsupport){
				keepfixed()
			}
			state.shouldvisible = (scrolltop >= options.startline) ? true : false;
			if (state.shouldvisible && !state.isvisible) {
				$control.stop().animate( {
					opacity : 1
				}, options.fadeduration[0]);
				state.isvisible = true;
			} else if (state.shouldvisible == false && state.isvisible) {
				$control.stop().animate( {
					opacity : 0
				}, options.fadeduration[1]);
				state.isvisible = false;
			}
		};
		
		return init();
	};
})(jQuery);
