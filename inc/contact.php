        <div class="cfor">
			<h1>Me contacter</h1>
			<p>N'hésitez à me contacter via le formulaire ci-dessous ou via mes réseaux sociaux.</p>

<?php
// Tableau contenant les messages d'erreur lies a la validation de chaque 
// champ du formulaire.
// On utilisera le nom du champ comme cle du tableau
$errs = array();

$nom = "";
$prenom = "";
$tel = "";
$email = "";
$demande = "";

// S'il s'agit du premier affichage, le bouton submit n'a pas ete presse
// il n'y a pas de validation a effectuer. Sinon $_POST["submit"] n'est pas
// vide (et contient la valeur "Enregistrer")
if (isset($_POST['submit'])) {
if (isset($_POST['host']) && empty($_POST['host'])) //Si "host" est vide
{  

    $nom = stripSlashes($_POST["nom"]);
    if (strlen($nom) == 0) 
        $errs["nom"][] = "Veuillez indiquer votre nom";
    if (strlen($nom) > 50) 
        $errs["nom"][] = "Votre nom ne doit pas excéder 50 caractères.";

    $prenom = stripSlashes($_POST["prenom"]);
    if (strlen($prenom) == 0) 
        $errs["prenom"][] = "Veuillez indiquer votre prénom";
    if (strlen($prenom) > 50) 
        $errs["prenom"][] = "Votre prénom ne doit pas excéder 50 caractères.";

    $tel = stripSlashes($_POST["tel"]);
    if (strlen($tel) == 0) {
        $errs["tel"][] = "Veuillez indiquer votre numéro de téléphone";
    } elseif (!preg_match('#^0[1-9]([-. ]?[0-9]{2}){4}$#',$tel)) {
        $errs["tel"][] = "Le format de votre numéro de téléphone est incorrect. Veuillez tapez votre numéro à dix chiffres.";
    }

    $email = stripSlashes($_POST["email"]);
    if (strlen($email) == 0) {
        $errs["email"][] = "Veuillez indiquer votre adresse e-mail";
    } elseif (!preg_match('#^[[:alnum:]]([-_.]?[[:alnum:]])*@[[:alnum:]]([-_.]?[[:alnum:]])*\.([a-z]{2,4})$#',$email)) {
        $errs["email"][] = "Le format de votre adresse e-mail est incorrect.";
    }
    
    $demande = stripSlashes($_POST["demande"]);
    if (strlen($demande) == 0) 
        $errs["demande"][] = "Veuillez formuler votre message";
    if (strlen($demande) > 2000) 
        $errs["demande"][] = "Votre message ne doit pas excéder 2000 caractères.";

    if (count($errs) == 0) {

// Insertion du message à l'aide d'une requête préparée
$req = $bdd->prepare('INSERT INTO contact (nom, prenom, tel, email, temps, demande, valide) VALUES(?, ?, ?, ?, NOW(), ?, 0)');
$req->execute(array($_POST['nom'], $_POST['prenom'], $_POST['tel'], $_POST['email'], $_POST['demande']));

$headers ='From: "nom"<nepasrepondre@alexandrealves.fr>'."\n";
$headers .='Reply-To: nepasrepondre@alexandrealves.fr'."\n";
$headers .='Content-Type: text/plain; charset="iso-8859-1"'."\n";
$headers .='Content-Transfer-Encoding: 8bit'; 
mail('envoyerunmail@alexandrealves.fr','Nouveau message sur le site pro','Va voir ton site boloss'.$headers); //attention, certains hebergeurs deactivent la fonction mail 
}
}}
?>
<div class="cform">
<?php
// Si des erreurs ont été trouvée, les afficher sous forme de liste
if (count($errs) == 1) {
    echo "<div class=\"err\"><p class=\"ok\">Oups... Il y a une erreur<br />Corrigez-la afin que votre message me parvienne correctement</p><ol>";
    foreach ($errs as $champEnErreur => $erreursDuChamp) {
        foreach ($erreursDuChamp as $erreur) {
            echo "<li>".$erreur."</li>";
        }
    }
    echo "</ol></div>";
}
elseif (count($errs) > 1) {
    echo "<div class=\"err\"><p class=\"ok\">Oups... Il y a quelques erreurs<br />Corrigez-les afin que votre message me parvienne correctement</p><ol>";
    foreach ($errs as $champEnErreur => $erreursDuChamp) {
        foreach ($erreursDuChamp as $erreur) {
            echo "<li>".$erreur."</li>";
        }
    }
    echo "</ol></div>";
}
elseif (isset($_POST['submit']) && (count($errs) == 0)) {
echo "<p class=\"ok\">J'ai bien reçu votre message. Je vous recontacte au plus vite.</p>"; }
?>
<form method="post" action="#contact" onsubmit="return verifierc(this);">
<fieldset>
<legend><h3>Formulaire de contact :</h3></legend>
<input class="host" id="host" name="host" type="text" value=""/>
<ul>
<li><label for="nom">Nom</label><input type="text" placeholder="entrez votre nom ici" id="nom" name="nom" onblur="verifNom(this)" value="<?php if (count($errs) == 0)  echo "";  else echo htmlEntities($nom); ?>" required/></li>
<li><label for="prenom">Prénom</label><input type="text" placeholder="entrez votre prénom ici" id="prenom" name="prenom" onblur="verifPrenom(this)" value="<?php if (count($errs) == 0)  echo "";else echo htmlEntities($prenom); ?>" required/></li>
<li><label for="tel">Téléphone</label><input type="tel" placeholder="entrez votre numéro de téléphone ici" id="tel" name="tel" onblur="verifTel(this)" value="<?php if (count($errs) == 0)  echo ""; else echo htmlEntities($tel); ?>" required/></li>
<li><label for="email">Mail</label><input type="email" placeholder="entrez votre email ici" id="email" name="email" onblur="verifMail(this)" value="<?php if (count($errs) == 0)  echo "";  else echo htmlEntities($email); ?>" required/></li>
<li><label for="demande">Message</label><textarea id="demande" placeholder="tapez ici votre message" name="demande" onblur="verifDemande(this)" required><?php if (count($errs) == 0)  echo "";else echo htmlEntities($demande); ?></textarea></li>
</ul>
<input type="submit" name="submit" value="Envoyer" />
</fieldset>

</form>

<ul>
    <li><a href="https://www.linkedin.com/in/alexandre-alves-7b2bba102/"><i class="fab fa-linkedin fa-3x" title="Linkedin"></i></a></li>
    <li><a href="https://github.com/AlexandrosOmega"><i class="fab fa-github fa-3x" title="Github"></i></a></li>
</ul>

</div>
</div>