<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class='index' lang="zh-CN">
<head>

<!-- 头部 -->
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>程序员博客平台</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="/Public/bootstrap-3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap end -->
    <!-- Bootstrap -->
    <link href="/Public/bootstrap-3.3.0/css/H-ui.reset.css" rel="stylesheet" type="text/css" />
    <link href="/Public/h-ui-home/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<link rel="stylesheet" type="text/css" href="/Home/View/Public/Css/index1.css" />
<link rel="stylesheet" type="text/css" href="/Home/View/Public/Css/pamList.css" />
</head> 
<body id="body">
    <?php  $tuid = session("bkHmUser.uid"); ?>
<link rel="stylesheet" href="/Home/View/Public/Css/newhd.css">
<div class="Chder">
	<div class="ch_center">
		<div class="ch_title">Pgs程序员博客</div>
		<div class="ch_list">
			<ul class="ch_ul clear">
				<li class="hovers"><a class="a_on" href="<?php echo U('Index/index1');?>">首页</a></li>
				<li class="hovers">
					<a  class="a_on" href="<?php echo U('Program/pamList');?>">PHP</a>
					<div class="cg_ov">
						<a class="er" href="">ThinkPHP</a>
						<a class="er" href="">YII</a>
						<a class="er" href="">LY框架</a>
					</div>
				</li>
				<li class="hovers"><a  class="a_on">工具</a></li>
			</ul>
		</div>
		<div class="ch_dz">
		<?php if($tuid == true): ?><button class="ch_dz_tc" onclick="loginOut();">退出</button>
			<a class="my_bk" href="<?php echo U('User/Blog/index');?>">我的博客</a>
		<?php else: ?>
			<button class="ch_dz_dn" onclick="login();">登陆</button>
			<button class="ch_dz_zhc" onclick="reg();">注册</button><?php endif; ?>
		</div>
	</div>
</div>
<div id="dialog-confirm" class="hide"></div>

<!-- 引入公共js -->


<!-- 公共js -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/Public/bootstrap-3.3.0/js/bootstrap.min.js"></script>

<script type="text/javascript" src="/Public/h-ui/lib/layer/2.1/layer.js"></script> 
<!-- 引入弹窗js -->


<!-- 弹窗js -->
<link rel="stylesheet" href="/Public/artDialogV6/css/ui-dialog.css" />
<script src="/Public/artDialogV6/jquery-ui.min.js"></script>
<script language='javascript' src='/Public/artDialogV6/dialog-min.js'></script>

<script src="/Home/View/Public/Js/dialog.js"></script>
<!-- 标签js -->
<script src="/Public/bootstrap-3.3.0/js/tooltip.js"></script>

<!-- 页面js -->
<script src="/Home/View/Public/Js/header.js"></script>
<!-- <script src="./js/navline.js"></script> -->
 <script type="text/javascript">
  $('#example').tooltip('show');

  //注册
  function reg(){
    // var index = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
    var a = tcADialog({
      title:'新用户注册',
      width:400,
      url:"<?php echo U('Login/reg');?>"
    });
    a.add();
    // layer.close(index);
  }

  //登陆
  function login(){
    var a = tcADialog({
      title:'登陆',
      width:400,
      url:"<?php echo U('Login/login');?>"
    });
    a.add();
  }

  //退出登陆
  function loginOut(){
    $.ajax({
         type  : 'POST',
         url   : "<?php echo U('Login/loginOut');?>" ,
         async : true,   
        success : function(re){
            location.reload();
        }
    });
  }

	$(document).ready(function(){
		$(".hovers").hover(function(){

			$(this).children('.cg_ov').slideDown();

		},function(){
			$(this).children('.cg_ov').stop(true,true).hide();
			$(this).children('.cg_ov').slideUp();

		});
		
	  
	});	
</script>
    <div class="index_all">
        <div class="all_center clear">
            <div class="cenetr_right">
                <link rel="stylesheet" type="text/css" href="/Home/View/Public/Css/right.css" />
<div class="rgt_set">
	<input placeholder="请输入关键字"/>
	<button>搜索</button>
</div>
<div class="rgt_bq clear">
	<h2><div class="bq_bq">热门标签 <i class="Hui-iconfont">&#xe64b;</i></div></h2>
  	<ul class="rgt_ul clear">
	    <a href=""><li>Code Log</li></a>
	    <a href=""><li>CSS3</li></a>
	    <a href=""><li>HTML5</li></a>
	    <a href=""><li>ThinkPHP</li></a>
	    <a href=""><li>Hack</li></a>
	    <a href=""><li>JavaScript</li></a>
	    <a href=""><li>JQuery</li></a>
	    <a href=""><li>Tools</li></a>
	    <a href=""><li>Note</li></a>
  	</ul>
</div>
<div class="rgt_frend clear">
	<h2><div class="bq_bq">友情链接 <i class="Hui-iconfont">&#xe64b;</i></div></h2>
  	<ul class="rgt_ul clear">
	    <a href=""><li>YzmCMS</li></a>
        <a href=""><li>多骨鱼</li></a>
        <a href=""><li>封尘博客</li></a>
        <a href=""><li>叶落山城秋</li></a>
        <a href=""><li>高蒙博客</li></a>
        <a href=""><li>张艳博客</li></a>
        <a href=""><li>爱佳博客</li></a>
        <a href=""><li>飞信网</li></a>
        <a href=""><li>YzmCMS</li></a>
        <a href=""><li>多骨鱼</li></a>
        <a href=""><li>封尘博客</li></a>
        <a href=""><li>叶落山城秋</li></a>
        <a href=""><li>高蒙博客</li></a>
        <a href=""><li>张艳博客</li></a>
        <a href=""><li>爱佳博客</li></a>
        <a href=""><li>飞信网</li></a>
        <a href=""><li>YzmCMS</li></a>
        <a href=""><li>多骨鱼</li></a>
        <a href=""><li>封尘博客</li></a>
        <a href=""><li>叶落山城秋</li></a>
        <a href=""><li>高蒙博客</li></a>
        <a href=""><li>张艳博客</li></a>
        <a href=""><li>爱佳博客</li></a>
        <a href=""><li>飞信网</li></a>
        <a href=""><li>YzmCMS</li></a>
        <a href=""><li>多骨鱼</li></a>
        <a href=""><li>封尘博客</li></a>
        <a href=""><li>叶落山城秋</li></a>
        <a href=""><li>高蒙博客</li></a>
        <a href=""><li>张艳博客</li></a>
        <a href=""><li>爱佳博客</li></a>
        <a href=""><li>飞信网</li></a>
        <a href=""><li>YzmCMS</li></a>
        <a href=""><li>多骨鱼</li></a>
        <a href=""><li>封尘博客</li></a>
        <a href=""><li>叶落山城秋</li></a>
        <a href=""><li>高蒙博客</li></a>
        <a href=""><li>张艳博客</li></a>
        <a href=""><li>爱佳博客</li></a>
        <a href=""><li>飞信网</li></a>
  	</ul>	
</div>
            </div>
            <div class="cenetr_left">
               <div class="Info_center">
                  <div class="center_l">
                        <div class="info_title"><?php echo ($info['title']); ?></div>
                        <div class="info_oter">
                            <ul class="oter_ul clear" >
                                <li><a title="发表时间：<?php echo (date("Y-m-d",$v['time'])); ?>"><i class="Hui-iconfont">&#xe690;</i> <?php echo (date("Y-m-d",$info['time'])); ?></a></li>
                                <li><a><i class="Hui-iconfont">&#xe697;</i> <?php echo ($info['zan']); ?>赞</a></li>
                                <li><a><i class="Hui-iconfont">&#xe622;</i> <?php echo ($info['cnum']); ?>评论</a></li>
                                <li><a><i class="Hui-iconfont">&#xe725;</i> <?php echo ($info['rnum']); ?>次</a></li>
                            </ul>
                        </div>
                        <div class="info_body">
                            <?php echo ($info['content']); ?>
                        </div>
                        <div class="info_fz clear">
                            <button class="dashang">打赏</button>
                            <button class="fenxiang">分享</button>
                        </div>
                  </div>

               </div>
               <div class="naxt_center">
                   <div class="naxt_l_cewn">
                       <div class="tet">评论留言</div>
                       <div class="orter_pl">
                           <ul>
                           <?php if(is_array($pl)): foreach($pl as $key=>$v): ?><li class="clear">
                                    <div class="name_pl"><span class="name"><?php echo ($v['uname']); ?></span><span class="pl_time">2017-06-14 12:45:06</span><a class="huifu">回复</a></div>
                                    <div class="pl_body clear">
                                        <div class="pl_toux"><img src="/Home/View/Public/img/index/2017032858da05cfe46e8.jpg"/></div>
                                        <div class="b_bodys">
                                        <?php echo ($v[body]); ?>
                                        </div>
                                        
                                    </div>
                                    <ul class="pl_hui">
                                    <!-- <?php if(is_array($ph)): foreach($ph as $key=>$h): ?><if condition='$h[''] eq 0'>
                                        <li>
                                            <div class="name_pl"><span class="name">辛巴死士</span><span class="pl_time">2017-06-14 12:45:06</span><a class="huifu">回复</a></div>
                                            <div class="pl_body clear">
                                                <div class="pl_toux"><img src="/Home/View/Public/img/index/2017032858da05cfe46e8.jpg"/></div>
                                                <div class="b_bodys"><a href="">回复 <span>錵艺</span>：</a>
                                                扫附近的卢萨卡几点开两三点。冻死了富士康节食减肥。分么股份地接口的的首付款独守空房当牲口。大方公开分单联开关更符合客观方面会徕木股份公开规范(*/ω＼*)
                                                扫附近的卢萨卡几点开两三点。冻死了富士康节食减肥。分么股份地接口的的首付款独守空房当牲口。大方公开分单联开关更符合客观方面会徕木股份公开规范(*/ω＼*)
                                                扫附近的卢萨卡几点开两三点。冻死了富士康节食减肥。分么股份地接口的的首付款独守空房当牲口。大方公开分单联开关更符合客观方面会徕木股份公开规范(*/ω＼*)
                                                </div>
                                                
                                            </div>
                                        </li><?php endforeach; endif; ?> -->
                                    </ul>
                                </li><?php endforeach; endif; ?>
                           </ul>
                       </div>
                       <div class="text">
                           <textarea placeholder="输入文字进行评论" name="body"></textarea>
                       </div>
                       <div class="add_pl clear">
                           <button id="add_rw">评论</button>
                       </div>
                   </div>

               </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="/Home/View/Public/Css/footer.css">
<footer>
    <div class="ftcla">
      <a>TC网公约</a> <span>|</span>
      <a>联系我们</a> <span>|</span>
      <a>开放API</a> <span>|</span>
      <a>手机版</a>
    </div>

    <div class="ft-address">
      <a>© 2016 TC宠物网 (上海市广元西路55号浩然高科技大厦1808室)（周一至周日，9:00-18:00）</a> 
    </div>

    <div class="ft-icp">
      <a>沪公网安备31010402000116号</a> 
    </div>
</footer>
</body>
<script type="text/javascript">
$("#add_rw").on('click',function(){
    var body=$("textarea[name='body']").val();
    var id = <?php echo ($info['id']); ?>;
    if(body ==""){
        layer.msg('请输入评论内容！'); return false;
    }
    $.post('<?php echo U("Program/addRw");?>',{by:body,id:id},function(e){
            if(e.r == 1){
                layer.msg('请先登陆！'); return false;
            }else if(e.r == 2){
                layer.msg('请选择评论文章！'); return false;
            }else if(e.r == 101){
                layer.msg('评论失败！'); return false;
            }else if(e.r == 100){
                layer.msg('评论成功！');
                location.reload();
            }
    },'json');
});
</script>