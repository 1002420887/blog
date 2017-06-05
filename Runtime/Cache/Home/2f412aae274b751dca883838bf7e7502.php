<?php if (!defined('THINK_PATH')) exit();?>	
  
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
    <!-- 自己样式 -->
    <link rel="stylesheet" type="text/css" href="/Home/View/Public/Css/header.css" />
    <link rel="stylesheet" type="text/css" href="/Home/View/Public/Css/index.css" />
    <link rel="stylesheet" type="text/css" href="/Home/View/Public/Css/footer.css" />
    <!-- 自己样式 END -->
  </head>
  <body>
    <!-- header -->
    
<?php
$tuid = (int)session("bkHmUser.uid"); $tpname = session("bkHmUser.pname"); $hIndex = U('Index/index'); $uIndex = U('User/Index/index'); $uBlog = U('User/Blog/index'); $tnavh = ''; if($tuid){ $list = M('user_cla')->field('*,concat(pid,",",id) as path')->where('uid = '.$tuid)->order("path,id")->select(); foreach ($list as $k => $v) { $list[$k]['nbsp'] = str_repeat("&nbsp; &nbsp;",count(explode(',', $v['pid']))-1); } $tArr = ''; foreach ($tList as $k => $v) { if($v['fid'] == 0){ $tArr[] = $v; unset($tList[$k]); } } foreach ($tList as $k => $v) { foreach ($tArr as $key => $value) { if(in_array($value['id'],explode(',', $v['pid']))){ $tArr[$key]['arr'][] = $v; } } } $tnavh = '<a href="$hIndex"><li class="sel">首页</li></a>'; if(is_array($tArr)){ foreach($tArr as $k=>$v){ $tnavhS = ''; $tnavhS .= '<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">'; foreach($v['arr'] as $key=>$val){ $tnavhS .= '<li role="presentation"><a title="" role="menuitem" tabindex="-1" href="'.U('List/index',array('cid'=>$val['id'])).'"> '.$val['nbsp'].'|-'.$val['name'].'</a></li>'; } $tnavhS .= '</ul>'; $tnavh .= '<li class="l dropdown"><a title="tech" href="'.U('List/index',array('cid'=>$v['id'])).'" class="dropdown-toggle">'.$v['name'].'</a>'.$tnavhS.'</li>'; } } } if($tuid){ $isLogin =<<<THINK
<!-- 登陆 -->
<li class="r dropdown">
  <a href="$uIndex" class="dropdown-toggle">$tpname <span class="caret"></span></a>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
     <li role="presentation"><a role="menuitem" tabindex="-1" href="$uBlog">我的博客</a></li>
     <li role="presentation"><a role="menuitem" target="_blank" tabindex="-1" href="http://www.pgsnote.com:3000/editor">写博客</a></li>
     <li role="presentation" class="divider"></li>
     <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:loginOut();">退出</a></li>
   </ul>
</li>
THINK;
 }else{ $isLogin =<<<THINK
<!-- 未登录 -->
<a href="">
 <li class="r login">
   <a href="javascript:login();">登陆</a> <span class="sla">/</span> <a href="javascript:reg();">注册</a>
 </li>
</a>
THINK;
 } $html = <<<THINK
<!-- header -->
<style type="text/css">
	.head-nav .dropdown-toggle span{
		-webkit-transition: -webkit-transform 0.2s ease-out; 
		-moz-transition: -moz-transform 0.2s ease-out; 
		transition: transform 0.2s ease-out;
	}

	.head-nav .dropdown:hover span{
		-webkit-transform: rotate(180deg); 
		-moz-transform: rotate(180deg); 
		transform: rotate(180deg); 
	}
</style>
<div class="head-nav">
  <div class="hd_con w1170">
  	<div class="navbar-header"> 
  	    <a class="navbar-brand hidden-sm" href="$hIndex">Pgs 程序员博客</a>
  	</div>
    <ul>
      
      $tnavh
      <a href=""><li>在线工具</li></a>
      $isLogin
    </ul>
  </div>
</div>
<!-- header end -->
THINK;
 echo $html; ?>


    


    
    <!-- header end -->

    <!-- 搜索框 -->
    <nav>
      <form>
        <!-- <input type="" name=""/> -->
        <div class="form-group has-feedback text-center">
          <!-- <label class="control-label" for="inputSuccess2">phpbloger php Programmer's blog notes</label> -->
          <label class="control-label" for="inputSuccess2">phpbloger &nbsp; PHP Programmer's blog notes</label>
          <input type="text" class="form-control" id="inputSuccess2">
          <span class="glyphicon glyphicon-search form-control-feedback"></span>
        </div>
      </form>
    </nav>
    <!-- 搜索框 END -->
  
    <!-- 中间主要部分 -->
    <div class="main w1170 cl">

      <!-- 左边box -->
      <div class="main-l l">
         <?php if(is_array($list)): foreach($list as $key=>$v): ?><!-- 循环box -->
          <div class="blog-box pd bs-example-tooltip">
            <div class="tooltip left" role="tooltip">
              <div class="tooltip-arrow"></div>
              <div class="tooltip-inner">
               
                <?php echo ($v['name']); ?>
              </div>
            </div>
            <a href="<?php echo U('Index/cont','id='.$v['id']);?>" class="title" title=""><?php echo ($v['title']); ?></a>
            <div class="logmain">
              <div class="l left">
                <img src="/Home/View/Public/Images/9.jpg"/>
              </div>
              <div class="r right">
                <div class="code" style="overflow: hidden;">
                  <?php echo ($v['content']); ?>
                </div>
                <div class="auth-note r">
                  <span><i class="Hui-iconfont">&#xe690;</i> <?php echo (date("Y-m-d",$v['time'])); ?></span>
                  <span><i class="Hui-iconfont">&#xe725;</i> <?php echo ($v['rnum']); ?>次</span>
                  <span><i class="Hui-iconfont">&#xe622;</i> <a href=""><?php echo ($v['cnum']); ?>评论</a></span>
                  <span><i class="Hui-iconfont">&#xe697;</i> <?php echo ($v['zan']); ?>赞</span>
                </div>
              </div>
            </div>
          </div>
          <!-- 循环box end --><?php endforeach; endif; ?>
        <div class="page">
          <?php echo ($page); ?>
        </div>
      </div>
      <!-- 左边box end-->
      <!-- 右边box -->
      <div class="main-r r">
        <div class="class-menu main-r-box r">
          <h2>热门标签 <i class="Hui-iconfont">&#xe64b;</i></h2>
          <div class="main-r-line"></div>
          <ul>
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
      </div>
      <!-- 右边box end-->
    </div>
    <!-- 中间主要部分end -->
    
    <div class="link pd w1170">
      <h2>友情链接</h2>
      <ul>
        <a href=""><li>YzmCMS官网</li></a>
        <a href=""><li>多骨鱼</li></a>
        <a href=""><li>封尘博客</li></a>
        <a href=""><li>叶落山城秋</li></a>
        <a href=""><li>高蒙博客</li></a>
        <a href=""><li>张艳博客</li></a>
        <a href=""><li>爱佳博客</li></a>
        <a href=""><li>飞信网</li></a>
        <a href=""><li>YzmCMS官网</li></a>
        <a href=""><li>多骨鱼</li></a>
        <a href=""><li>封尘博客</li></a>
        <a href=""><li>叶落山城秋</li></a>
        <a href=""><li>高蒙博客</li></a>
        <a href=""><li>张艳博客</li></a>
        <a href=""><li>爱佳博客</li></a>
        <a href=""><li>飞信网</li></a>
        <a href=""><li>YzmCMS官网</li></a>
        <a href=""><li>多骨鱼</li></a>
        <a href=""><li>封尘博客</li></a>
        <a href=""><li>叶落山城秋</li></a>
        <a href=""><li>高蒙博客</li></a>
        <a href=""><li>张艳博客</li></a>
        <a href=""><li>爱佳博客</li></a>
        <a href=""><li>飞信网</li></a>
        <a href=""><li>YzmCMS官网</li></a>
        <a href=""><li>多骨鱼</li></a>
        <a href=""><li>封尘博客</li></a>
        <a href=""><li>叶落山城秋</li></a>
        <a href=""><li>高蒙博客</li></a>
        <a href=""><li>张艳博客</li></a>
        <a href=""><li>爱佳博客</li></a>
        <a href=""><li>飞信网</li></a>
        <a href=""><li>YzmCMS官网</li></a>
        <a href=""><li>多骨鱼</li></a>
        <a href=""><li>封尘博客</li></a>
        <a href=""><li>叶落山城秋</li></a>
        <a href=""><li>高蒙博客</li></a>
        <a href=""><li>张艳博客</li></a>
        <a href=""><li>爱佳博客</li></a>
        <a href=""><li>飞信网</li></a>
      </ul>
    </div>

    

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

    </script>   

  </body>
</html>