<?php
	include("open.php");

//参数处理
//-----------------------------------------------------
//由界面传过来的form参数
	if(!isset($_GET["form"])){
		$form=$sql_service_anli;
	}
	else if($_GET["form"]==""){
		$form=$sql_service_anli;
	}
	switch($_GET["form"]){
		case 1:$form=$sql_service_anli;break;
		default:$form=$sql_service_anli;break;
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


//-----------------------------------------------------
//定义service-div-p标签-资讯
function detail_nav($get_form,$page){
	if($get_form=="")
	{
		$get_form=1;
	}
	$nav="<span>您当前的位置是:</span><a href='../houtai.php'>后台管理></a>";
	switch($get_form){
		case 1:$nav.="<a href='service.php?form=".$get_form."'>服务案例></a>";break;
	}
	
	switch($get_form){
		case 1:$nav.="<span>服务案例</span>";break;
	}	
	echo $nav;
}
//-----------------------------------------------------
//定义service-div-p标签-资讯
function detail($form,$id,$page){
	$row=open_form_id($form,$id);
	//计算多少条id
	
	$total_sql="SELECT COUNT(*) FROM `$form`";
	$total_result=mysql_fetch_array(mysql_query($total_sql));
	$total=$total_result[0];
	if($form=="service-policy-biaozhun"){
		$p_array=explode("|",$row["content"]);
		$many=count($p_array);
	}
	//安装/打断
	else{
		$p_array=explode("|",$row["content"]);
		$many=count($p_array);
		}
	$div="<p class='tit'>";
	//标题
	$div.=$row["title"];
	//细节
	$div.="</p><div class='xijie'><span>作者：";
	if(!$row["author"]){
		$div.="未知";
	}
	else{$div.=$row["author"];}
	$div.="&nbsp;&nbsp;&nbsp;&nbsp;</span><span>来源：";
	if(!$row["laiyuan"]){
		$div.="未知";
	}
	else{$div.=$row["laiyuan"];}
	$div.="&nbsp;&nbsp;&nbsp;&nbsp;</span><span>发表时间：";
	$div.=$row["time"]."</span>";
	//-----------------------------------------------------
	$div.="</div><div class='main'>";
	//文字
	$div.="<p>";
	$div.=$p_array[0];
	$div.="</p>";
	//图片
	if($row["picture"]){
		$div.="<div style='text-align: center; margin-top:20px;'><img alt='图片' width='710' height='411' src='../../service/";
		$div.=$row["picture"];
		$div.="'></div><div style='text-align: center;margin-bottom: 20px'>图片来源网络</div>";
	}
	//文字
	for($i=1;$i<$many;$i++){
		$div.="<p>";
		$div.=$p_array[$i];
		$div.="</p>";
	}
	//上一下一
	$div.="<div class='a'>";
	if($id<$total){
		$id_up=$id+1;
		$row_up=open_form_id($form,$id_up);
		$div.="<a href='service_detail.php?form=".$_GET["form"]."&id=".$id_up."&page=".$page."'>";
		$div.="上一篇：";
		$div.=$row_up["title"];
		$div.="</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		$div.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
   } 				
		
	if($id>=2){
		$id_down=$id-1;
		$row_down=open_form_id($form,$id_down);
		$div.="<a href='service_detail.php?form=".$_GET["form"]."&id=".$id_down."&page=".$page."'>";
		$div.="下一篇：";
		$div.=$row_down["title"];
		$div.="</a>";
	}
	$div.="</div></div>";
   	echo $div;	
}


?>