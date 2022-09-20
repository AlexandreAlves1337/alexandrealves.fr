<?php include($_SERVER['DOCUMENT_ROOT'] . '/config.php'); ?>
<?php 
$title = "Pour regarder la Paillade"; 
$desc = "Une page avec lien direct vers les vidéos de streaming sans pages intermediaires.";
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/header.php'); ?>
<div class="main">
<div class="blog">
<div class="blogleft">
<div class="iframe"><iframe src="http://www.streaming-foot.info/schedule.php" frameborder="0" height="600" scrolling="yes" width="100%"></iframe></div>
<div class="listestream">
	<ul>
	<?php
	$chaine = 1;

	while ($chaine <= 199)
	{
		echo '<li><a href="http://www.foot-live.info/lecteur.php?id=' . $chaine . '">Chaine ' . $chaine . '</a></li>';
		$chaine++;
	}
	?>
	</ul>
</div>
<form id="formstream" method="post" action="<?php if (isset($_POST['num'])) {$num = stripSlashes($_POST['num']); header('Location: http://www.foot-live.info/lecteur.php?id='.$num.''); } ?>">
<div class="cols"><label for="num">Numéro de chaine :</label></div>
<div class="colp"><input type="number" name="num" id="num" /></div>
<div class="cols"><input type="submit" value="Regardez" /></div>
</form>
</div>
<div class="blogright">
   <div>
		<ul>
			<li><a href="./index.php">Accueil</a></li>
			<li><a href="./stream2.php">Choix 1</a></li>
			<li><a href="http://streamonsports.com/864-les-chaines-en-clair.html">Choix 2</a></li>
			<li><a href="./stream.php">Choix 3</a></li>
		</ul>
	</div>
	<div>
		<a class="twitter-timeline" data-height="300px" data-theme="light" href="https://twitter.com/Alextiomarus">Tweets by Alextiomarus</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
	</div>
</div>
</div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/footer.php'); ?>
