<?php // @Author Rémi Dubrulle
session_start();


include_once("../Back/conn/connection.php");
include_once("../fonction.php");

function autotri($url){
	if( strpos($url,'youtube') || strpos($url,'vimeo') || strpos($url,'daylimotion') ){
		return 'vidéo';
	}elseif( strpos($url,'9gag') ){
		return '9Gag';
	}else{
		return false;
	}
}
function minify($url){
	$url = str_replace('http://','',$url);
	$url = str_replace('www.','',$url);
	$url = str_replace('.com','',$url);
	$url = str_replace('.fr','',$url);
	$url = str_replace('&feature=player_embedded','',$url);
	$url = str_replace('.',' ',$url);
	$url = str_replace('/',' ',$url);
	return $url; 
}
$id = connect("param");

	if(isset($_POST['name']) && $_POST['name'] != "name"){
		$name = strval($_POST['name']);
	}else{
		$name = null;
	}
	if(isset($_POST['link']) && $_POST['link'] != "link"){
		$link = strip_tags(strval($_POST['link']));
	}else{
		$link = null;
	}
	if(isset($_POST['folder']) ){
		$folder = speReplace(strval($_POST['folder']));
	}else{
		$folder = null;
	}

	if(isset($_POST['id'])){
		$id_edit = intval($_POST['id']);
	}else{
		$id_edit = null;
	}

	if(isset($_POST['IDLien'])){
		$IDLien = intval($_POST['IDLien']);
	}else{
		$IDLien = null;
	}
	
	
	
	if($link != null){
		//add
		if(!$folder){
			$folder = autotri($link);
		}
		$requete= "Insert into fav values(null,'".speReplace($name)."','$link', 0, '$folder', NOW() )";	
		$reponse = mysql_query($requete,$id) or die(mysql_error());
	}
	if($id_edit != null){
		//edit
		if(!$folder){
			$folder = autotri($link);
		}
		$requete= "Update fav SET name='".speReplace($name)."', note=0, folder='$folder' where id=$id_edit";	
		$reponse = mysql_query($requete,$id) or die(mysql_error());
	}
	if($IDLien != null){
		//suppr
		$requete= "Delete from links where Id=$IDLien";	
		$reponse = mysql_query($requete,$id) or die(mysql_error());
	}
	
	if(false && isset($_GET['maintenance'])){	
		$requete= "Select * from fav where note>=0 order by folder ASC, note desc, id desc";	
		$list = mysql_query($requete,$id) or die(mysql_error());
		if($list){
			while($donnees = mysql_fetch_array($list)){
				copy($donnees['link'], 'min/'.$donnees['id'].'.gif');
			/*
				$ch = curl_init($donnees['link']);
				$fp = fopen('./min/'.$donnees['id'].'.gif', 'wb');
				curl_setopt($ch, CURLOPT_FILE, $fp);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_exec($ch);
				curl_close($ch);
				fclose($fp);
				
				if(autotri($donnees['link']) != ''){
					//$requete= 'Update fav SET folder="'.autotri($donnees['link']).'" where id='.$donnees['id'];	
					//$reponse = mysql_query($requete,$id) or die(mysql_error());
					//echo $donnees['id'].' - '.$donnees['name']?$donnees['name']:$donnees['link'].' UPDATE ! </br>';
				}
				*/
			}
		}
	}