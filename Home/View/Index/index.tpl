	
  <include file="Public:head"/>
    <!-- 自己样式 -->
    <link rel="stylesheet" type="text/css" href="__CSS__/header.css" />
    <link rel="stylesheet" type="text/css" href="__CSS__/index.css" />
    <link rel="stylesheet" type="text/css" href="__CSS__/footer.css" />
    <!-- 自己样式 END -->
  </head>
  <body>
    <!-- header -->
    <include file="Public:header"/>
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
         <foreach name="list" item="v">
          <!-- 循环box -->
          <div class="blog-box pd bs-example-tooltip">
            <div class="tooltip left" role="tooltip">
              <div class="tooltip-arrow"></div>
              <div class="tooltip-inner">
               
                {$v['name']}
              </div>
            </div>
            <a href="{:U('Index/cont','id='.$v['id'])}" class="title" title="">{$v['title']}</a>
            <div class="logmain">
              <div class="l left">
                <img src="__IMAGES__/9.jpg"/>
              </div>
              <div class="r right">
                <div class="code" style="overflow: hidden;">
                  {$v['content']}
                </div>
                <div class="auth-note r">
                  <span><i class="Hui-iconfont">&#xe690;</i> {$v['time']|date="Y-m-d",###}</span>
                  <span><i class="Hui-iconfont">&#xe725;</i> {$v['rnum']}次</span>
                  <span><i class="Hui-iconfont">&#xe622;</i> <a href="">{$v['cnum']}评论</a></span>
                  <span><i class="Hui-iconfont">&#xe697;</i> {$v['zan']}赞</span>
                </div>
              </div>
            </div>
          </div>
          <!-- 循环box end -->
        </foreach>
        <div class="page">
          {$page}
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
    
    <include file="Public:pubjs"/>
    <!-- 引入弹窗js -->
   
    <include file="Public:artDialog"/>
    <!-- 标签js -->
    <script src="/Public/bootstrap-3.3.0/js/tooltip.js"></script>

    <!-- 页面js -->
    <script src="__JS__/header.js"></script>
    <!-- <script src="./js/navline.js"></script> -->
     <script type="text/javascript">
      $('#example').tooltip('show');

      //注册
      function reg(){
        // var index = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
        var a = tcADialog({
          title:'新用户注册',
          width:400,
          url:"{:U('Login/reg')}"
        });
        a.add();
        // layer.close(index);
      }

      //登陆
      function login(){
        var a = tcADialog({
          title:'登陆',
          width:400,
          url:"{:U('Login/login')}"
        });
        a.add();
      }

      //退出登陆
      function loginOut(){
        $.ajax({
             type  : 'POST',
             url   : "{:U('Login/loginOut')}" ,
             async : true,   
            success : function(re){
                location.reload();
            }
        });
      }

    </script>   

  </body>
</html>