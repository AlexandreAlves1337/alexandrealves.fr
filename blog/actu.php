<?php include($_SERVER['DOCUMENT_ROOT'] . '/config.php'); ?>
<?php 
$reponse = $bdd->prepare('SELECT titre FROM actu WHERE id= ?'); // Sélection du titre pour l'afficher dans la barre d'adresse
$reponse->execute(array($_GET['id']));
$donnees = $reponse->fetch();
$title = (stripslashes($donnees['titre']));
$desc = "Mon blog personnel où je pose mes réflexions sur le monde qui nous entoure sans filtre ni tabou et sur de nombreux sujets qui font l'actualité.";
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/header.php'); ?>
<?php
$reponse->closeCursor();
?>
<div class="main">
<div class="blog">
<div class="blogleft">
<?php

$reponse = $bdd->prepare('SELECT * FROM actu WHERE id= ?');
$reponse->execute(array($_GET['id']));
$donnees = $reponse->fetch(); /*On affiche l'actu*/
if(empty($donnees)) {header('location: 404.php');} /*Sauf si l'actu n'existe pas dans ce cas on affiche la page 404*/

$titre = (stripslashes($donnees['titre'])); 
$contenu = (stripslashes($donnees['contenu']));
$suite = (stripslashes($donnees['suite']));
$date= date('d/m/Y \&\a\g\r\a\v\e\; H\hi', $donnees['timestamp']);

echo '<div class="actu">
    ' . $titre . '
    <p>' . $contenu . '<br /></p>
	<p>' . $suite . '<br /></p>
	<p><em>le ' . $date . '</em></p>
	</div>';

    $reponse->closeCursor();
	
$reponse = $bdd->prepare('SELECT COUNT(id) as nbCom FROM com WHERE idactu= ?');
$reponse->execute(array($_GET['id']));
$donnees = $reponse->fetch();

$nbCom = $donnees['nbCom'];
$perPage = 4;
$nbPage = ceil($nbCom/$perPage);

if (isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<=$nbPage) {$cPage = $_GET['p'];} else {$cPage = 1;}


$reponse = $bdd->prepare('SELECT * FROM com WHERE idactu= ? ORDER BY id DESC LIMIT '.(($cPage-1)*$perPage).','.($perPage).'');
$reponse->execute(array($_GET['id']));

while( $donnees = $reponse->fetch())  /*On liste les éventuels commentaires*/
{
$pseudo = htmlspecialchars($donnees['pseudo']);
$comment = nl2br(htmlspecialchars($donnees['comment']));
$idactu = $donnees['idactu'];

echo 
'<p><strong>' . $pseudo . '</strong> a commenté :<br />' . $comment . '</p>';
}

for($i=1;$i<=$nbPage;$i++) {
	if ($i==$cPage) { echo ' '.$i.' /';}
	else {echo ' <a href=\'actu.php?id='.$idactu.'?p='.$i.'\'>'.$i.'</a> /';}
}
    $reponse->closeCursor();

// Tableau contenant les messages d'erreur lies a la validation de chaque champ du formulaire. On utilise le nom du champ comme cle du tableau
$errs = array();

$pseudo = "";
$comment = "";

if (isset($_POST['submit']) && empty($_POST['host'])) // Le formulaire est validé et ce n'est pas un robot donc on traite les données
{  
    $pseudo = stripSlashes($_POST["pseudo"]);
    if (empty($pseudo)) 
        $errs["pseudo"][] = "Veuillez indiquer votre pseudo";
    if (strlen($pseudo) > 50) 
        $errs["pseudo"][] = "Votre pseudo ne doit pas excéder 50 caractères.";
    
    $comment = stripSlashes($_POST["comment"]);
    if (empty($comment))
        $errs["comment"][] = "Veuillez formuler votre commentaire";
    if (strlen($comment) > 2000) 
        $errs["comment"][] = "Votre commentaire ne doit pas excéder 2000 caractères.";

    if (count($errs) == 0) {

// Insertion du message à l'aide d'une requête préparée
$req = $bdd->prepare('INSERT INTO com (pseudo, comment, idactu) VALUES(?, ?, ?)');
$req->execute(array($_POST['pseudo'], $_POST['comment'], $_GET['id']));
header('location: actu.php?id='.$_GET['id']);

}
}
?>
<?php
// Si des erreurs ont été trouvée, les afficher sous forme de liste
if (count($errs) == 1) {
    echo "<div class=\"err\"><p class=\"ok\">Oups... Il y a une erreur<br />Corrigez-la afin que votre commentaire me parvienne correctement</p><ol>";
    foreach ($errs as $champEnErreur => $erreursDuChamp) {
        foreach ($erreursDuChamp as $erreur) {
            echo "<li>".$erreur."</li>";
        }
    }
    echo "</ol></div>";
}
elseif (count($errs) > 1) {
    echo "<div class=\"err\"><p class=\"ok\">Oups... Il y a quelques erreurs<br />Corrigez-les afin que votre commentaire me parvienne correctement</p><ol>";
    foreach ($errs as $champEnErreur => $erreursDuChamp) {
        foreach ($erreursDuChamp as $erreur) {
            echo "<li>".$erreur."</li>";
        }
    }
    echo "</ol></div>";
}
?>
<form method="post" onsubmit="return verifiercom(this);">
<fieldset>
<legend>Commentaires</legend>
<input class="host" id="host" name="host" type="text" value=""/>
<ul>
<li><label for="pseudo">Pseudo</label><input type="text" id="pseudo" name="pseudo" onblur="verifPseudo(this)" value="<?php if (count($errs) == 0)  echo "";  else echo htmlEntities($pseudo); ?>"></li>
<li><label for="comment">Commentaires</label><textarea id="comment" name="comment" onblur="verifDemande(this)"><?php if (count($errs) == 0)  echo "";else echo htmlEntities($comment); ?></textarea></li>
</ul>
<input type="submit" name="submit" value="C'est parti" />
</fieldset>

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
