//Son sur logo

function playclip() {
	if (navigator.appName == "Microsoft Internet Explorer" && (navigator.appVersion.indexOf("MSIE 7")!=-1) || (navigator.appVersion.indexOf("MSIE 8")!=-1)) {
		if (document.all) {
			document.all.sound.src = "img/When_Your_Gone.mp3";
		}
	}	
	else {{
		var audio = document.getElementsByTagName("audio")[0];
		audio.play();
		}
	}
}


//Fonction menu page active

const sections = document.querySelectorAll("section");
const navLi = document.querySelectorAll("nav ul li");
window.onscroll = () => {
  var current = "";

  sections.forEach((section) => {
    const sectionTop = section.offsetTop;
    if (pageYOffset >= sectionTop - 60) {
      current = section.getAttribute("id"); }
  });

  navLi.forEach((li) => {
    li.classList.remove("active");
    if (li.classList.contains(current)) {
      li.classList.add("active");
    }
  });
};


//Slide site

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}

//Formulaire

var mailRegex = new RegExp (/^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/); // email ok
var telRegex = new RegExp (/^0[1-9]([-. ]?[0-9]{2}){4}$/); // Tel ok

//Vérification formulaire de contact
function verifierc(f)
{
	var nomOK = verifNom(f.nom);
	var prenomOK = verifPrenom(f.prenom);
	var telOK = verifTel(f.tel);
	var mailOK = verifMail(f.email);
	var demandeOK = verifDemande(f.demande);
	var result = false;
	
	if ( nomOK && prenomOK && telOK && mailOK && demandeOK ) // si tout est OK
	{
	result=true;
	alert("C'est reçu");
	}
	else
	{
	result=false;
	alert("Oups, il y eu un petit problème, veuillez réessayer");
	}
	return result;
}

// Vérification formulaire de commentaires
function verifiercom(f)
{
	var pseudoOK = verifPseudo(f.pseudo);
	var demandeOK = verifDemande(f.demande);
	var result = false;
	
	if ( pseudoOK && demandeOK ) // si tout est OK
	{
	result=true;
	alert("Merci pour votre contribution.");
	}
	else
	{
	result=false;
	alert("Veuillez remplir tous les champs du formulaire correctement.");
	}
	return result;
}

// Fonction de vérification par champ
function verifNom(champ)
{
	var result = false;
	var nomRempli = champRempli(champ); // false si le champ n'est pas rempli
	
	if (nomRempli)	// evite de dire que le formulaire est mal rempli si on le laisse vide et qu'on change de champ
	{
		if(champ.value.length < 2 || champ.value.length > 50)
			{
			alert("Votre nom ne doit pas excéder 50 caractères.");
			surligneErreur(champ, true);
      		return false;
			}
		else
			{
			surligneErreur(champ, false);
      		return true;
			}
	}
	else // Si le champ n'est pas rempli on laisse la couleur de base
	{
		champ.style.backgroundColor = "#fba";
	}
}


function verifPrenom(champ)
{
	var result = false;
	var prenomRempli = champRempli(champ); // false si le champ n'est pas rempli
	
	if (prenomRempli)	// evite de dire que le formulaire est mal rempli si on le laisse vide et qu'on change de champ
	{
		if(champ.value.length < 2 || champ.value.length > 50)
			{
			alert("Votre prénom ne doit pas excéder 50 caractères.");
			surligneErreur(champ, true);
      		return false;
			}
		else
			{
			surligneErreur(champ, false);
      		return true;
			}
	}
	else // Si le champ n'est pas rempli on laisse la couleur de base
	{
		champ.style.backgroundColor = "#fba";
	}
}


function verifTel(champ)
{
	var result = false;
	var telRempli = champRempli(champ); // false si le champ n'est pas rempli
	
	if (telRempli)	// evite de dire que le formulaire est mal rempli si on le laisse vide et qu'on change de champ
	{
		if (result = telRegex.test(champ.value))
			{		
			surligneErreur(champ, false);
			}
		else
			{
			alert("Le format de votre numéro de téléphone est incorrect. Veuillez tapez votre numéro à dix chiffres.");
			surligneErreur(champ, true);
			}	
		return result;
	}
	else // Si le champ n'est pas rempli on laisse la couleur de base
	{
		champ.style.backgroundColor = "#fba";
	}
}


function verifMail(champ)
{
	var result = false;
	var mailRempli = champRempli(champ); // false si le champ n'est pas rempli
	
	if (mailRempli)	// evite de dire que le formulaire est mal rempli si on le laisse vide et qu'on change de champ
	{
		if (result = mailRegex.test(champ.value))
			{		
			surligneErreur(champ, false); // pas d'erreur 
			}
		else
			{
			alert("Le format de votre adresse e-mail est incorrect.");
			surligneErreur(champ, true);	// erreur
			}
		return result;
	}
	else	// Si le champ n'est pas rempli on laisse la couleur de base
	{
		champ.style.backgroundColor = "#fba";
	}
	
}

function verifDemande(champ)
{
	var result = false;
	var demandeRempli = champRempli(champ); // false si le champ n'est pas rempli
	
	if (demandeRempli)	// evite de dire que le formulaire est mal rempli si on le laisse vide et qu'on change de champ
	{
		if(champ.value.length < 1 || champ.value.length > 2000)
			{
			alert("Votre message ne doit pas excéder 2000 caractères.");
			surligneErreur(champ, true);
      		return false;
			}
		else
			{
			surligneErreur(champ, false);
      		return true;
			}
	}
	else // Si le champ n'est pas rempli on laisse la couleur de base
	{
		champ.style.backgroundColor = "#fba";
	}
}

function verifPseudo(champ)
{
	var result = false;
	var pseudoRempli = champRempli(champ); // false si le champ n'est pas rempli
	
	if (pseudoRempli)	// evite de dire que le formulaire est mal rempli si on le laisse vide et qu'on change de champ
	{
		if(champ.value.length < 1 || champ.value.length > 50)
			{
			alert("Votre pseudo ne doit pas excéder 50 caractères.");
			surligneErreur(champ, true);
      		return false;
			}
		else
			{
			surligneErreur(champ, false);
      		return true;
			}
	}
	else // Si le champ n'est pas rempli on laisse la couleur de base
	{
		champ.style.backgroundColor = "#fba";
	}
}

// Renvoi false si le champ n'est pas rempli
function champRempli(champ)
{
	var result;
	if (champ.value == "")
	{
		result = false;
	}
	else
	{
		result = true;
	}	
	return result;
}

/* Si les champs ne sont pas bien remplis, on surligne le champ */
function surligneErreur(champ, erreur)
{
   if(erreur)
      champ.style.backgroundColor = "#fba";	// couleur rouge
   else
      champ.style.backgroundColor = ""; // couleur jaune
}

function surligner(obj){
	obj.style.backgroundColor= "#ee842e";
}
function desurligner(obj){
	obj.style.backgroundColor= "";
}

