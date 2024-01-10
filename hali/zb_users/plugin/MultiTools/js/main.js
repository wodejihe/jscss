/*-------------------
*Description:        By www.yiwuku.com
*Website:            https://app.zblogcn.com/?id=1598
*Author:             尔今 erx@qq.com
*update:             2018-01-21(Last:2022-08-15)
-------------------*/

$(function(){
	//erx:Global
	var $mtfico = $(".mt-fix-ico"), $mtfbox = $(".mt-fix-box");
	$mtfico.children("a").each(function(){
		let $self = $(this), url = $self.attr("href"), tit = $self.children("span").text(), aname = $self.data("name");
		if(url == "#" || url == ""){
			$self.attr('href','javascript:;');
			if(!$self.hasClass("nop") && $self.hasClass("i-"+aname)){
				$self.click(function(){
					mtcShow(aname, tit);
				});
			}
		}
	});
	$mtfico.animate({opacity:1},800).append('<i class="fa fa-arrow-circle-left" title="切换模式"></i>');
	$mtfbox.prepend('<div class="mt-c-ti"><strong></strong><i class="fa fa-times-circle"></i></div>');
	$(".mt-main-wrap").append('<div class="mt-fix-bg"></div>');
	$(document).on("click",".mt-c-ti .fa, .mt-fix-bg",function(){
		$mtfbox.animate({top:"-100%",opacity:0},800);
		$(".mt-fix-bg").fadeOut();
	});
	$mtfico.mouseenter(function(){
		$(this).children(".fa").stop(true,false).delay(600).fadeIn(300);
	}).mouseleave(function(){
		$(this).children(".fa").stop(true,false).fadeOut(200);
	});
	$mtfico.children(".fa").click(function(){
		let $parent = $(this).parent();
		if($parent.hasClass("normal")){
			$parent.removeClass("normal").addClass("stretch");
			zbp.cookie.set("stretch", "stretch", 30);
		}else{
			$parent.removeClass("stretch").addClass("normal");
			zbp.cookie.set("stretch", "normal", 30);
		}
		$(".mt-fix-ico a span").hide().delay(800).show(0);
		$(".mt-fix-ico.stretch a span").css({display:'inline'});
	});
	function mtcShow(i, t){
		$(".mt-fix-bg").fadeIn();
		$(".mt-c-ti strong").text(t);
		$mtfbox.animate({top:'50%', opacity:1}, 500);
		$(".c-box").hide();
		$(".c-"+i).show();
		mtmDom();
	}
	function mtmDom(){
		var ht = $mtfbox.outerHeight();
		var wt = $mtfbox.outerWidth();
		$mtfbox.css({marginTop:-ht/2,marginLeft:-wt/2});
	}
	function mtIsmb(){
		var mtpwt = $(window).width();
		if(mtpwt <= 720){
			$mtfico.addClass("normal").removeClass("stretch").removeClass("msize60");
		}
	}
	mtIsmb();
	$(window).resize(function() {
		mtIsmb();
		mtmDom();
	});
	//erx:Weather
	if($(".c-weather").length){
		$(".c-weather").html("正在加载……");
		$(".i-weather").click(function(){
			if(!$(".c-weather iframe").length){
				$(".c-weather").html('<iframe width="620" scrolling="no" height="115" frameborder="0" allowtransparency="true" src="//i.tianqi.com/index.php?c=code&id=19&icon=1&temp=1&num=4&site=12"></iframe><p><a href="javascript:;" class="reload">[重新加载]</a><a href="http://www.weather.com.cn/forecast/" target="_blank" class="wto">[官网查看]</a></p>');
			}
		});
		$(".c-weather").on('click','.reload', function(){
			$(".c-weather iframe").attr("src","//i.tianqi.com/index.php?c=code&id=19&icon=1&temp=1&num=4&site=12");
		});
	}
	//erx:Calendar
	if($(".c-calendar").length){
		$.getScript(bloghost+'zb_users/plugin/MultiTools/js/calendar.js', function(){
			var lunar = calendar.solar2lunar();
			$(".c-calendar .d1").html('今天是 ' + lunar.cYear + '年' +lunar.cMonth +  '月' + lunar.cDay +'日（'+lunar.astro+'）&nbsp;'+lunar.ncWeek+'<br>农历'+lunar.lYear + '年' +lunar.IMonthCn+lunar.IDayCn+'&emsp;'+lunar.gzYear+'年&nbsp;'+lunar.gzMonth+'月&nbsp;'+lunar.gzDay+'日【'+lunar.Animal+'年】');
			xyMonth("mt-month");
		});
	}
	//erx:Share
	if($(".c-share").length){
		$(".pageurl").val(window.location.href);
		$(".c-share .copier").click(function(){
			$(".pageurl").select();
			document.execCommand("Copy");
			alert("复制成功！");
		});
	}
	//erx:Hotline
	if($(".c-hotline").length){
		$(".c-hotline a").each(function(){
			var hv = $(this).attr("href");
			hv = hv.replace(/ /g, "").replace(/\-/g,"").replace(/\,/g,"");
			$(this).attr("href", hv);
		});
	}
	//erx:Comment
	if($("#txaArticle").length){
		$(".i-comment").addClass("ic-yes");
		$(".i-comment").click(function(){
		    $("html, body").animate({scrollTop: $("#txaArticle").offset().top - 100},300);
		    $("#txaArticle").focus();
		});
	}else{
		$(".i-comment").remove();
	}
	//erx:Ulogin
	if(!$("#lr_mform").length){
		$(".xylogin").click(function(){
		    alert("抱歉，网站暂未安装《登录和注册》插件或配置登录地址");
		});
	}
	//erx:Music
	if($(".i-music").length){
		var xmute = true;
		$(".i-music").click(function(){
			var audio = $("audio"); 
		    if(audio != null){
	            audio.removeAttr("autoplay");
	            if(xmute){
	            	audio[0].pause();
	            	xmute = false;
	            }else{
	            	xmute = true;
	            	audio[0].play();
	            }
		    }
		});
	}
	//erx:Gotop
	$(".i-gotop").click(function(){
		$("html, body").animate({ scrollTop: 0 },200);
	});
});




























//Tips:以上js代码已尽最大努力简写和优化，如无绝对把握，切勿擅自修改  —— wwww.yiwuku.com 尔今(erx@qq.com)