

<style type="text/css">
	#laydate_box,#laydate_box *{
		box-sizing: content-box;
	}
	.bushtable tr td{
		line-height: 30px;
	}
	#edui26_content{
		z-index:1000000;
	}
	#dialogForm .table tr td{
		border-top: none !important;
	}

	#dialogForm p{
		padding:5px 0; 
		font-size: 14px;
	}

	.clo7{
		color: #777;
	}

	#dialogForm .table tr td{
		/*padding:10px 0; */
		font-size: 14px;
		padding-top:12px; 
		padding-bottom:12px; 
		line-height: 30px;
	}
</style>
<form id="dialogForm">
	<!-- <p class="dthd">用户名：</p>
	<div class="form-group">
	    <div class="input-group">
	      <input class="form-control" type="text" placeholder="手机号">
	      <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
	    </div>
	</div>
	<p class="dthd">密码：</p>
	<div class="form-group">
	    <div class="input-group">
	      <input class="form-control" type="email" placeholder="输入密码">
	      <div class="input-group-addon">@</div>
	    </div>
	</div>
	<p class="dthd">确认密码：</p>
	<div class="form-group">
	    <div class="input-group">
	      <input class="form-control" type="email" placeholder="确认密码">
	       <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
	    </div>
	 </div> -->
	<table class="table">
		<tbody class="box_1">
			<tr>
				<td class="text-right">手机号:</td>
				<td class="text-left">
					<input class="form-control" name="uname" type="text" placeholder="手机号">
				</td>
			</tr>
			<tr>
				<td class="text-right">验证码:</td>
				<td class="text-left">
					<div class="input-group">
					  <input class="form-control" name="code" type="text" placeholder="输入验证码">
					  <div class="input-group-addon yz_send">发送</div>
					</div>
				</td>
			</tr>
			<tr>
				<td class="text-right">密码:</td>
				<td class="text-left">
					<input class="form-control" name="pwd" type="password" placeholder="确认密码">
				</td>
			</tr>
			<tr>
				<td class="text-right">确认密码:</td>
				<td class="text-left">
					<input class="form-control" name="pwd1" type="password" placeholder="输入密码">
				</td>
			</tr>
			<tr>
				<td class="text-right">其它方式:</td>
				<td class="text-left">
					<a href="{:U('Login/QLogin')}"><img src="__IMAGES__/qq_login.png"/></a>
					<small class="clo7">（推荐）</small>
				</td>
			</tr>
		</tbody>
	</table>
</form>

<script type="text/javascript">
    
    


var cliobj = $(".yz_send");
var time   = 60;
var childWindow;

//点击发送效果
cliobj.bind('click',function cli(){

	var mobile = $("input[name='uname']").val();

	if(!(/^1[34578]\d{9}$/.test(mobile))){
       layer.msg('号码式不正确'); 
       return false; 
	}

	$.ajax({
	     type  : 'POST',
	     url   : "{:U('Login/send')}" ,
	     data  : {mobile : mobile} ,
	     async : true,   
	    success : function(re){
	    	if(re == 'success'){
	    		layer.msg('发送成功');
	    		cliobj.unbind('click');
	    		var ter = setInterval(function(){
	    			time -- ;
	    			cliobj.html(time);
	    			if(time <= 0){
	    				time = 60;
	    				clearInterval(ter);
	    				cliobj.html('发送');
	    				cliobj.bind('click',cli);
	    			}
	    		},1000);
	    	}else{
	    		layer.msg(re,{time:1000});
	    	}
	    }
	});
});

//qq login js
function toQzoneLogin(){
    childWindow = window.open("{:U('Login/QLogin')}","TencentLogin","width=450,left=20,top=150,height=320,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
} 

function closeChildWindow(){
    childWindow.close();
}
</script>