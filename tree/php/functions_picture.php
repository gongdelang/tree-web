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
			case "xiazai-gonggao":$div.="<a href='xiazai.php?form=xiazai-gonggao'>相关公告</a></div>";break;
			case "xiazai-ziliao":$div.="<a href='xiazai.php?form=xiazai-ziliao'>相关资料</a></div>";break;
			case "xiazai-qikan":$div.="<a href='xiazai.php?form=xiazai-qikan'>电子期刊</a></div>";break;
			
			default:$div.="<a href='xiazai.php?form=xiazai-gonggao' >相关公告</a></div>";break;
		}
	$div.="<div class='background'></div></div>";
	echo $div;			
}

//------------分页--------------
function banner($form,$page){
		//获取总数据
		$total_sql="SELECT COUNT(*) FROM `$form` WHERE `view`='1'";
			$total_result=mysql_fetch_array(mysql_query($total_sql));
			$total=$total_result[0];
		$showPage=8;

		//计算共有多少页
	
		$total_pages=ceil($total/$showPage);
		//计算偏移量
		$pageOffset=($showPage-1)/2;
		//初始数据定义
		$page_banner="<div class='banner'>";
		$kaishi=1;
		$end=$total_pages;
		//显示banner
		if($page>1){
			$page_banner.="<a href='".$_SERVER['PHP_SELF']."?form={$form}&page=1'>首页</a>";
			$page_banner.="<a href='".$_SERVER['PHP_SELF']."?form={$form}&page=".($page-1)."'>上一页</a>";
		}
		else{
			$page_banner.="<span class='disable'>首页</span>";
			$page_banner.="<span class='disable'>上一页</span>";
		}
		if($total_pages>$showPage){
			if($page>$pageOffset+1){
				$page_banner.="...";	
			}
			//-------------------------------------------
			if($page>$pageOffset){
				$kaishi=$page-$pageOffset;
				$end=$total_pages>($page+$pageOffset)?($page+$pageOffset):$total_pages;
			}
			else{
				$kaishi=1;
				$end=$total_pages>$showPage?$showPage:$total_pages;
			}
			if($page+$pageOffset>$total_pages){
				$kaishi=$kaishi-($page+$pageOffset-$end);
			}
		}
		//-------显示分页条
		for($i=$kaishi;$i<=$end;$i++){
			if($page==$i){
				$page_banner.="<span class='current'>{$i}</span>";
			}
			else{
				$page_banner.="<a href='".$_SERVER['PHP_SELF']."?form={$form}&page=".$i."'>{$i}</a>";
			}
		}
		//-------------------------------------------
		if($total_pages>$showPage&&$total_pages>($page+$pageOffset)){
			$page_banner.="...";	
		}
		if($page<$total_pages){
			$page_banner.="<a href='".$_SERVER['PHP_SELF']."?form={$form}&page=".($page+1)."'>下一页</a>";
			$page_banner.="<a href='".$_SERVER['PHP_SELF']."?form={$form}&page=".$total_pages."'>尾页</a>";
		}
		else{
			$page_banner.="<span class='disable'>下一页</span>";
			$page_banner.="<span class='disable'>尾页</span>";
		}
		//-------------------------------------------

		//-------------------------------------------
		$page_banner.="<form action='".$_SERVER['PHP_SELF']."' method='get'>";
		$page_banner.="共".$total_pages."页/".$total."个，";
		$page_banner.="<input type='hidden' name='form' value='{$form}'>";
		$page_banner.="跳到第<input class='in1' type='text' size='2' name='page'>页";
		$page_banner.="<input class='in2' type='submit' value='确定' />";
		$page_banner.="</form>";
		$page_banner.="</div>";
		echo $page_banner; 
}
//-----------------------------------------------------
//------------content--------------
function  fengye($form,$page){
		$star=($page-1)*8;
		$end=($page)*8;
		$dao=open_form_id_daoxu($form);
		$i=0;
	
		$li="<ul class='ul1'>";
		while($row=mysql_fetch_array($dao)){
			//图片数量
			$img_array=explode("|",$row["picture"]);
			$img_many=count($img_array);
			if($star<=$i&&$i<$end){
				if($star<$end){
					++$star;
					$li.="<li>";
					$li.="<a href='picture_detail.php?form=".$form."&page=".$page."&id=".$row["id"]."'>";
					$li.="<img src='picture/".$row["picture_title"]."/".$img_array[0]."' width='230' height='150'>";
					$li.="<p>";
					//判断tite字符串长度
					$get_row=substr_cut($row["title"],30);
					$li.=$get_row;
					$li.="</p>";
					$li.="<div class='span'>";
					$li.="<span class='span1'></span>";
					$li.="<span class='span2'>".$row["hit"]."</span>";
					$li.="<span class='span3'>".$row["time"]."</span>";
					$li.="<div style='clear: both;'></div>";
					$li.="</div>";
					$li.="</a>";	
					$li.="</li>";
				}
			}
			++$i;

		}
		$li.="</ul>";
		echo $li;
		banner($form,$page);
}
?>