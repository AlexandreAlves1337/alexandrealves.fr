<?php 
   $path = $_SERVER['DOCUMENT_ROOT'];
   $path .= "/config.php";
   include_once($path);
?>
<?php 
$title = "Le blog"; 
$desc = "Mon blog personnel où je pose mes réflexions sur le monde qui nous entoure sans filtre ni tabou et sur de nombreux sujets qui font l'actualité.";
?>
<?php 
   $path = $_SERVER['DOCUMENT_ROOT'];
   $path .= "/header.php";
   include_once($path);
?>
<div class="main">
<div class="blog">
<div class="blogleft">
En construction...
<!--<?php
/*$reponse = $bdd->query('SELECT * FROM actu ORDER BY id DESC LIMIT 0, 5');

while( $donnees = $reponse->fetch()) 
{
$titre = (stripslashes($donnees['titre'])); 
$contenu = (stripslashes($donnees['contenu']));
$date= date('d/m/Y \&\a\g\r\a\v\e\; H\hi', $donnees['timestamp']);
$id = (intval($donnees['id']));

echo '<div class="actu">
    <a href="actu.php?id=' . $id . '" title="' . $titre . '">' . $titre . '</a>
    <p>' . $contenu . '<br />
	<a href="actu.php?id=' . $id . '" title="Lire l\'article : ' . $titre .'">Lire cet article</a>
    </p>
	<p><em>le ' . $date . '</em></p>
	</div>';

}
    $reponse->closeCursor();*/
?>-->
</div>
<div class="blogright">
   <div>
		<ul>
			<li><a href="./index.php">Accueil</a></li>
			<li><a href="http://channelstream.live/">Choix 1</a></li>
			<li><a href="http://streamonsport.club/">Choix 2</a></li>
		</ul>
	</div>
	<div>
		<a class="twitter-timeline" data-height="300px" data-theme="light" href="https://twitter.com/AlexandrosOmega">Tweets by AlexandrosOmega</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
	</div>
</div>
</div>
</div>
<?php 
   $path = $_SERVER['DOCUMENT_ROOT'];
   $path .= "./footer.php";
   include_once($path);
?>