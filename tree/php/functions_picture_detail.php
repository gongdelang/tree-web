<?php
include("open.php");
//参数处理
//-----------------------------------------------------
//由界面传过来的form参数
	if(!isset($_GET["form"])){
		$form=$sql_picture;
	}
	else if($_GET["form"]==""){
		$form=$sql_picture;
	}
	else{
		$form=$_GET["form"];
	}
//由界面传过来的page参数
	if(!isset($_GET["page"])){
		$page=1;
	}
	else if($_GET["page"]==""){
		$page=1;
	}
	else{
		$page=$_GET["page"];
	}
//由界面传过来的id参数
	if(!isset($_GET["id"])){
		$id=1;
	}
	else if($_GET["id"]==""){
		$id=1;
	}
	else{
		$id=$_GET["id"];
	}
//-----------------------------------------------------
//------------title--------------
function titile($form){
	$div="<div class='title'>";
	$div.="<div class='nav'>";
	$div.="<span>您当前的位置是:</span>";
	$div.="<a href='../index.php' target='_blank'>首页></a>";
	switch($form){
			case "information-new":$div.="<a href='information.php?form=".$form."'>行业动态</a></div>";break;
			case "information-gonggao":$div.="<a href='information.php?form=".$form."'>通知公告</a></div>";break;
			case "information-falv":$div.="<a href='information.php?form=".$form."'>法律法规</a></div>";break;
			
			case "knowledge-baike":$div.="<a href='information.php?form=".$form."'>百科知识</a></div>";break;
			case "knowledge-yuzhong":$div.="<a href='information.php?form=".$form."'>育种专题</a></div>";break;
			case "knowledge-yinzhong":$div.="<a href='information.php?form=".$form."'>>引种驯化</a></div>";break;
			
			case "service-anli":$div.="<a href='information.php?form=".$form."'>服务案例</a></div>";break;
			case "seervice-apply":$div.="<a href='information.php?form=".$form."'>申请服务</a></div>";break;
			
			default:$div.="<a href='information.php?form=".$form."'>行业动态</a></div>";break;
		}
	$div.="<div class='background'></div></div>";
	echo $div;			
}


//-----------------------------------------------------
//定义information-div-p标签-资讯
function detail($form,$id,$page){
	$result=open_form_id($form,$id);
	$row=mysql_fetch_array($result);
	//点击量
	$hit=$row["hit"]+1;
	$update="UPDATE `$form` SET `hit` = '$hit' WHERE `$form`.`id` = $id";
	mysql_query($update);
	//计算多少条id
	$total_sql="SELECT COUNT(*) FROM `$form`";
	$total_result=mysql_fetch_array(mysql_query($total_sql));
	$total=$total_result[0];
	//安装/打断
	//文字段落
	$p_array=explode("|",$row["content"]);
	$many=count($p_array);
	//图片数量
	$img_array=explode("|",$row["picture"]);
	$img_many=count($img_array);
	
	
	$div="<div class='con'><p class='tit'>";
	//标题
	$div.=$row["title"];
	//细节s
	$div.="</p><div class='xijie'>";
	$div.="<span>作者：".$row["author"]."</span>";
	$div.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>来源：".$row["laiyuan"];
	$div.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span>发表时间：";
	$div.=$row["time"]."</span>";
	$div.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>阅读量：".$row["hit"]."</span>";

	//-----------------------------------------------------
	$div.="</div><div class='main'>";
	//图片
	$div.="<div style='text-align: center; margin-top:20px;'>";
	$div.="<div id='content1'>";
	$div.="<div class='mygallery clearfix'>";
	$div.="<div class='tn3 album'>";
	$div.="<ol>";
	//图片
	for($x=0;$x<$img_many;$x++){
		$div.="<li>";
		$div.="<h4>".$row["title"]."</h4>";
		$div.="<div class='tn3 description'>图片".($x+1)."</div>";
		$div.="<a href='picture/".$row["picture_title"]."/".$img_array[$x]."'>";
		$div.="<img src='picture/".$row["picture_title"]."/".$img_array[$x]."' />";
		$div.="</a>";
		$div.="</li>";			
	}
	$div.="</ol>";
	$div.="</div>";
	$div.="</div>";
	$div.="</div>";
	$div.="</div>";
	$div.="<div style='clear:both;'></div>";
/*	$div.="<div style='text-align: center;margin-bottom: 20px'>图片来源网络</div>";*/
	//文字
	/*for($i=0;$i<$many;$i++){*/
		$div.="<p>";
		$div.=$p_array[0];
		$div.="</p>";
	/*}*/
	$div.="<a id='btnPrint'  href='#' class='dayin'>";
	$div.="打印本页";
	$div.="</a>";
	//返回上层
	$div.="<a href='picture.php?form=".$form."&page=".$page."' class='fanhui'>";
	$div.="返回上层";
	$div.="</a>";
	//清除浮动
	$div.="<div style='clear:both;'></div>";
	//上一下一
	$div.="<div class='a'>";
	if($id<$total){
		$id_up=$id+1;
		$result_up=open_form_id($form,$id_up);
		$row_up=mysql_fetch_array($result_up);
		$div.="<a href='picture_detail.php?form=".$_GET["form"]."&id=".$id_up."&page=".$page."'>";
		$div.="上一组：";
		//判断tite字符串长度
		$get_row=substr_cut($row_up["title"],60);
		$div.=$get_row;
		$div.="</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		$div.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
   } 				
		
	if($id>=2){
		$id_down=$id-1;
		$result_down=open_form_id($form,$id_down);
		$row_down=mysql_fetch_array($result_down);
		$div.="<a href='picture_detail.php?form=".$_GET["form"]."&id=".$id_down."&page=".$page."'>";
		$div.="下一组：";
		//判断tite字符串长度
		$get_row=substr_cut($row_down["title"],60);
		$div.=$get_row;
		$div.="</a>";
	}
	$div.="</div></div>";
	$div.="</div>";
   	echo $div;	

}

?>