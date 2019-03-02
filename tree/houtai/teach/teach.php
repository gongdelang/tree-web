<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>后台管理_视频</title>
<link rel="stylesheet" href="../css/chuShiHua.css" type="text/css" /><!--初始化css样式-->
<link rel="stylesheet" href="../css/information.css" type="text/css" /><!--本网页的css样式-->
<?php include("../php/functions_teach.php") ?><!--资讯-函数库-->
<!--js样式star-->
<script type="text/javascript" src="../js/jquery.min.js"></script>
<!--js样式end-->
</head>
<body>
		<!--头背景star-->
		<div id="top-header"></div>
		<!--头背景end-->
		
		
		
		
		<!--||导航栏-（首页）star-->
		<div id="bg">
			<div class="top-menu">
				<ul id="all_title">
					<li><a href="houtai.php" class="width4 active">数据管理</a></li>
					<li><a href="information/information.php?form=1&page=1" class="width4">资讯信息</a></li>
					<li><a href="information/information.php?form=3&page=1" class="width4">服务动态</a></li>
					<li><a href="knowledge/knowledge.php" class="width5">知识库</a></li>
					<li><a href="picture/picture.php" class="width5">图片库</a></li>    <!--市场行情information.php-->
					<li><a href="general/general.php" class="width4">资源概况</a></li>              <!--种植教学 teach.php-->
					<li><a href="ziyuan/ziyuan.php?form=1" class="width4">种质资源</a></li>     <!--农资信息 nongzi.php-->
					<li><a href="xiazai/xiazai.php" class="width5">资料共享</a></li>
				</ul>
			<!--搜索框star-->
				<div class="top-search">
					<a id='tuichu' href='../tuichu.php'>管理员退出</a>
				</div>
			<!--搜索框end-->
			</div>
		</div>
		<!--||导航栏-（首页）end>-->
	    <!--去掉4个像素-->
    	<div style="width: 1004px; height: 4px; background: #ffffff;margin:0px auto;"></div>
	    <!--||导航栏-（首页）end>-->
		
    
    
	    <!-------------------------------------------------------->
	    <!--总的内容-->
		<div id="all-content">
			<!--左边的导航栏-->
			<div id="left-nav">
				<?php left_nav($form); ?>
			</div>
			<div id="right-content">
				<div class="title">
						<div class="nav">
							<span>您当前的位置是:</span>
							<a href="../houtai.php">后台管理></a>
							<?php nei_nav($form);?>
						</div>
						<div class="background"></div>
				</div>
				<div class="content">
							<!--表界面-->
							<?php fengye($form,$page,$module); ?>
						<div class="banner"><!--banner条-->
							<?php banner($form,$page); ?>
						</div>
					<script>
							$(function(){
								$("#shanchu").click(function(){
									var msg = "您真的确定要删除吗？\n\n请确认！";
									if (confirm(msg)==true){
										return true;
									}
									else{
										return false;
									}
								});
							});
						</script>
				</div>
			</div>
		</div>
		
		
		
	<!-------------------------------------------------------->
  	<!--尾-->
	<div id="bottom">
		<div class="span">
			<div class="span1">
				<p>友情链接：</p>
				<div>
					<a href="http://www.xjxnw.gov.cn" target="_blank">兴农网</a>
					<a href="http://www.zgny.com.cn" target="_blank">中国农业网</a>
					<a href="http://www.chinapesticide.gov.cn" target="_blank">中国农药信息网</a>
					<a href="http://www.grain.gov.cn" target="_blank">中国粮食信息网</a>

				</div>
				<div>
					<a href="http://www.gofei.net" target="_blank">农批网</a>
					<a href="http://www.agri.cn" target="_blank">中国农业信网</a>
					<a href="http://www.nongyao001.com" target="_blank">中国农药第一网</a>
					<a href="http://www.zgncpw.com" target="_blank">中国农产品网</a>
				</div>
			</div>
			<div class="span2">
				<p>关于我们：</p>
				<div class="p">
					<p>联系地址：浙江省多媒体大赛</p>
					<p>联系电话：***********/**********</p>
				</div>
				<div class="p">
				 <p>官方邮箱：***********@qq.com</p>
				</div>
			</div>
			<div class="span3">
					<a href="../../index.php" target="_blank">新疆农业技术学习平台</a>
			</div>
		</div>
	</div>
</body>
</html>

