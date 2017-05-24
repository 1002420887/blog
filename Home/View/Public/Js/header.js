
//顶部下拉效果
$(".dropdown").hover(function(){
	$(this).addClass('open').find('.dropdown-toggle').attr('aria-expanded','true');
},function(){
	$(this).removeClass('open').find('.dropdown-toggle').attr('aria-expanded','false');
});

