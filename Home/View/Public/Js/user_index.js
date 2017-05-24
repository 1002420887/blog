
var sear  = $('.search-show');
var sites = $(".site-search");

sear.click(function(enent){
	sites.animate({
		'top':'80px',
	},200);
	enent.stopPropagation();
	$('body').one('click',function(){
		sites.animate({
			'top':'0',
		},200);
	});
});

sites.click(function(enent){
	enent.stopPropagation();
});