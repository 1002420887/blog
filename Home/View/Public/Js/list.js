
var more    = $(".more");

more.click(function(){
	var li = $(this).parent().find('li');
	var lhei = li.height();
	var hei = Math.ceil(li.length/19)*lhei;

	if($(this).parent().height() == lhei){
		$(this).parent().css({'height':hei+'px',});
		$(this).find('a').text('收起');
	}else{
		$(this).parent().css({'height':lhei+'px',});
		$(this).find('a').text('更多...');
	}
});