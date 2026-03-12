<?php // @Author Rémi Dubrulle
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Favonline ~ Vos favoris vous suivent partout !</title>
	<META http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<META name="description" content="Favonline : vos favoris vous suivent partout !" lang="FR" xml:lang="FR" />
	<META name="Keywords" content="favonline, favori, favoris, marque page" />
	<META name="Author" content="Rémi Dubrulle" />
	<META name="Copyright" content="Remi Dubrulle" />
	<META name="robots" content="all" />
	<META NAME="Description" CONTENT="Author: A.N. Author, Illustrator: P. Picture, Category: Books, Price:  £9.24, Length: 784 pages">
	<META NAME="google-site-verification" CONTENT="+nxGUDJ4QpAZ5l9Bsjdi102tLVC21AIh5d1Nl23908vVuFHs34="/>

	<META name="image" content="http://dubydul.free.fr/images/logo.png" />
	<META property="og:image" content="http://dubydul.free.fr/images/logo.png" />
	<link rel="shortcut icon" href="../images/logo.png"  type="image/x-icon" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="main.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<div id="main">
		<h1>FavOnline</h1>
		<h2>~ Vos favoris vous suivent partout !</h2>

		<div id="add">
			<form id="add_link" name="add_link" action="" method="post">
				<input type="text" id="i_link" name="link" value="link"/>
				<input type="text" id="i_name" name="name" value="name"/>
				<select name="folder" id="sel_folder">
				<?php
					$t_folder = Array('','tmp','gag','gif','fun','html','jeux','amazing','insolite','à_suivre','utile','vidéo','autre');
					foreach($t_folder as $f){
						echo '<option value="'.$f.'">'.ucfirst($f).'</option>';
					}
				?>
				</select>
				<input type="submit" name="send" value="ok"/>
				<span><~ Ajoutez vos liens !</span>
				<img class="btn_edit" src="../images/icone.ico" alt="X" title="edit"/>
				<span> Pour éditer</span>
				<span class="note not4 n4 visible"></span>
				<span> Pour noter</span>
			</form>
			<div id="status" class="rez"></div>
		</div>

		<div id="content">
			<div class="list_link">
				<?php
					include('http://dubydul.free.fr/favonline/main.php');
				?>
			</div>
		</div>
		<div id="preview">
		<iframe src="" border=0>Link Preview</iframe>
		</div>
	</div>

	<div id="miniature"><iframe src="" border=0></iframe></div>


	<div id="footer">
		<g:plusone size="small"></g:plusone>
	<a href="https://twitter.com/share" class="twitter-share-button" data-via="dubydul" data-lang="fr" data-count="none" data-hashtags="dubydul">Tweeter</a>

	</div>

<!-- +1 google-->
<script type="text/javascript">
  window.___gcfg = {lang: 'fr'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<!-- twiter -->
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

</body>
</html>
