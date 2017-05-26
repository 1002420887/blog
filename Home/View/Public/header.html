
<?php
$tuid   = session(C('WEB_SESSION'))['uid'];
$tpname = session(C('WEB_SESSION'))['pname'];
$hIndex = U('Index/index');
$uIndex = U('User/Index/index');
$uBlog  = U('User/Blog/index');

$tnavh = '';
if($tuid){
	$tList = D('User_cla')->selAnav('uid = '.$tuid,'*,concat(pid,",",id) as path','path,id'); 

	$tArr = '';

	foreach ($tList as $k => $v) {
	  if($v['fid'] == 0){
	    $tArr[] = $v;
	    unset($tList[$k]);
	  }
	}

	foreach ($tList as $k => $v) {
	  foreach ($tArr as $key => $value) {
	    if(in_array($value['id'],explode(',', $v['pid']))){
	      $tArr[$key]['arr'][] = $v;
	    }
	  }
	}

	$tnavh = '<a href="$hIndex"><li class="sel">首页</li></a>';
	if(is_array($tArr)){
		foreach($tArr as $k=>$v){
		  
		  $tnavhS = '';
		  $tnavhS .= '<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">';
		  foreach($v['arr'] as $key=>$val){
		    $tnavhS .= '<li role="presentation"><a title="" role="menuitem" tabindex="-1" href="'.U('List/index',array('cid'=>$val['id'])).'"> '.$val['nbsp'].'|-'.$val['name'].'</a></li>';
		  }
		  $tnavhS .= '</ul>';

		  $tnavh .= '<li class="l dropdown"><a title="tech" href="'.U('List/index',array('cid'=>$v['id'])).'" class="dropdown-toggle">'.$v['name'].'</a>'.$tnavhS.'</li>';
		}
	}
}



if($tuid){
	$isLogin =<<<str
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
str;
}else{
	$isLogin =<<<str
<!-- 未登录 -->
<a href="">
 <li class="r login">
   <a href="javascript:login();">登陆</a> <span class="sla">/</span> <a href="javascript:reg();">注册</a>
 </li>
</a>
str;
}

$html = <<<str
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
str;

echo $html;

?>


    


    