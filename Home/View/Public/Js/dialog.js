jQuery(function($) {
	//override dialog's title function to allow for HTML titles
	$.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
		_title: function(title) {
			var $title = this.options.title || '&nbsp;'
			if (("title_html" in this.options) && this.options.title_html == true)
				title.html("<div class='widget-header'><h4 class='smaller'>" + $title + "</h4></div>");
			else title.text($title);
		}
	}));
});
// 倒计时弹框弹框
function tips(info, time, obj){
	var obj = obj || false;
	var t = time || 1;
	t *= 1000;
	if(obj !== false){obj.close().remove();}
	var k = dialog({
		title:"提示",
		content: info
	}).show();
	setTimeout(function(){
		k.close().remove();	
		if(obj !== false){
			window.location.reload();
		}
	}, t);
}

function actTips(info, obj, id, time){
	var obj = obj || false;
	var t = time || 1;
	t *= 1000;
	if(obj !== false){obj.close().remove();}
	var d = dialog({content: info}).show();
	setTimeout(function(){
		d.close().remove();	
		if(obj !== false){
			$("#row_" + id).remove();
		}
	}, t);
}
// 加载页面
function tcLoad(url,where){
	var where = where || '';
	var html = '';
	$.ajax({
		type: "GET",
		url: url,
		async:false,	
		data: where,
		success: function(data){
			html = data;
		}
	});
	return html;
}

/**
 * 弹窗方法：验证提示(verify)
 * 参数配置：where:验证条件
 *			title:错误提示
 * 			time:提示时间
 */
 var tcVerify = function(where, title, time) {
 	var title = title || '填写数据不正确！';
 	var time = time || 2;
 	title = '<font color="#ba1704">' + title + '</font>';
 	if(!!where){
 		art.dialog.tips(title,time);
 		return false;
 	}
 	return true;
 }

 function tcADialog($obj) {

 	var tcADialog = new Object();

	/**
	 * 判断当前url是否存在参数
	 */
	 tcADialog.indexOf = function(){   
	 	var s = $obj.url.indexOf('?');   
	 	if(s === -1){
   			// 没有参数
   			return '?';
   		}else{
   			// 有参数
   			return '&';
   		}
   	}

	/**
	 * 弹窗方法：添加（add）
	 * 参数配置：title:弹窗标题
	 * 			width:弹窗宽度(整数，可选)
	 * 			url:数据处理地址
	 * 			cfun:回调函数 可在提交之前做验证 回调函数返回FALSE Ajax就不执行 true 执行
	 */
	 tcADialog.add = function() {
	 	var url = $obj.url + ( $obj.where ? (this.indexOf()+$obj.where) : '' );
	 	var d = dialog({
	 		title: $obj.title,
	 		width: $obj.width,
	 		height: $obj.height,
	 		content: tcLoad(url),
	 		okValue: '提交',
	 		ok: function () {
	 			var index = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
	 			var queryString = $("form#dialogForm").serialize();
	 			if( $obj.cfun && ($obj.cfun() === false) ){
	 				return;	
	 			}
	 			$.post(url,queryString,function(data){
	 				if (data === 'succeed') {
	 					d.close().remove();
	 					layer.close(index);
	 					tips('<font color="#14a303">' + $obj.title + '成功</font>');
	 					setTimeout(function() {
	 						location.reload();
	 					}, 400);
	 				} else if (data === 'error') {
	 					layer.close(index);
	 					tips('<font color="#ba1704">' + $obj.title + '失败</font>');
	 					return false;
	 				} else {
	 					layer.close(index);
	 					tips('<font color="#d14c32">' + data + '</font>');
	 					return false;
	 				}
	 			});
	 			return false;
	 		},
	 		cancelValue: '取消',
	 		cancel: function () {
	 			$("#dialog-confirm").html('');
	 			$("#laydate_box").remove();
	 			d.close().remove();
	 		}
	 	}).showModal();
	 }

	/**
	 * 弹窗方法：修改(edit)
	 * 参数配置：title:弹窗标题
	 * 			width:弹窗宽度(整数，可选)
	 * 			height:弹窗高度（整数，可选）
	 * 			url:数据处理地址
	 * 			where:update条件
	 * 			cfun:回调函数 可在提交之前做验证 回调函数返回FALSE Ajax就不执行 true 执行
	 */
	 tcADialog.edit = function() {
	 	var url = $obj.url + ( $obj.where ? (this.indexOf()+$obj.where) : '' );

	 	var d = dialog({
	 		title: $obj.title,
	 		width: $obj.width,
	 		height: $obj.height,
	 		content: tcLoad(url),
	 		okValue: '提交',
	 		ok: function () {
	 			var index = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
	 			var queryString = $("form#dialogForm").serialize();
	 			if( $obj.cfun && ($obj.cfun() === false) ){
	 				return;	
	 			}
	 			$.post(url,queryString,function(data){
	 				if (data === 'succeed') {
	 					d.close().remove();
	 					layer.close(index);
	 					tips('<font color="#14a303">' + $obj.title + '成功</font>');
	 					setTimeout(function() {
	 						location.reload();
	 					}, 400);
	 				} else if (data === 'error') {
	 					layer.close(index);
	 					tips('<font color="#ba1704">' + $obj.title + '失败</font>');
	 					return false;
	 				} else {
	 					layer.close(index);
	 					tips('<font color="#d14c32">' + data + '</font>');
	 					return false;
	 				}
	 			});
	 			return false;
	 		},
	 		cancelValue: '取消',
	 		cancel: function () {
	 			$("#dialog-confirm").html('');
	 			$("#laydate_box").remove();
	 			d.close().remove();
	 		}
	 	}).showModal();
	 }

	/**
	 * 弹窗方法：删除(del)
	 * 参数配置：title:弹窗标题
	 * 			url:数据处理地址
	 * 			tips:提示删除内容
	 * 			where:update条件
	 */
	 tcADialog.del = function() {
		// alert($obj.url);
		var url = $obj.url + ( $obj.where ? (this.indexOf()+$obj.where) : '' );
		
		var d = dialog({
			title: '提示',
			content: '<div class="alert alert-info bigger-110">您正在删除 <font color="#ff5200">' + $obj.tips + '</font> 此操作将不可恢复，请谨慎操作.' + '</div>' + '<div class="space-6"></div>' + '<p class="bigger-110 center grey">' + '<i class="ace-icon fa fa-hand-o-right blue bigger-120"></i>' + '是否确定删除?' + '</p>',
			okValue: '确定',
			ok: function () {
				var index = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
				$.ajax({
					timeout: 0,
					type: "POST",
					url: url,
					data: "&" + $obj.where,
					dataType: "JSON",
					success: function(data) {
						d.close().remove();
						if (data === 'succeed') {
							layer.close(index);
							d.close().remove();
							tips('<font color="#14a303">' + $obj.title + '成功</font>');
							setTimeout(function() {
								location.reload();
							}, 400);
						} else if (data === 'error') {
							layer.close(index);
							tips('<font color="#ba1704">' + $obj.title + '失败</font>');
							return false;
						} else {
							layer.close(index);
							tips('<font color="#d14c32">' + data + '</font>');
							return false;
						}
					}
				});
			},
			cancelValue: '取消',
			cancel: function () {}
		}).showModal();


	}

	/**
	 * 弹窗方法：信息显示(info)
	 * 参数配置：title:弹窗标题
	 * 			width:弹窗宽度(整数，可选)
	 * 			height:弹窗高度（整数，可选）
	 * 			url:数据获取地址
	 * 			where:查询条件
	 */
	 tcADialog.info = function() {
		// alert($obj.width);
		var url = $obj.url + ( $obj.where ? (this.indexOf()+$obj.where) : '' );
		var width = 400;
		// var height = 300;
		if ($obj.width) {
			width = $obj.width;
		}
		// if ($obj.height) {
		// 	height = $obj.height;
		// }

		var d = dialog({
			title: $obj.title,
			width: width,
			// height:height,
			content: tcLoad(url),
			okValue: '关闭',
			ok: function () {
				$("#dialog-confirm").html('');
				$("#laydate_box").remove();
				d.close().remove();
			}
		}).showModal();

	}

	return tcADialog;
}
