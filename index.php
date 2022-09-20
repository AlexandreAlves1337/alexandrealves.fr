<?php

include(__DIR__.'/config.php');

$title = "Objectif : développeur web !"; 
$desc = "Décrouvez qui je suis, mes objectifs, mon portfolio de développement web et mes autres expériences.";

include(__DIR__.'/header.php');

?>
    <section id="presentation">
		<?php include(__DIR__.'/inc/presentation.php'); ?>
    </section>
    <section id="sites">
		<?php include(__DIR__.'/inc/portfolio.php'); ?>
        </section>
	<section id="experiences">
		<?php include(__DIR__.'/inc/cv.php'); ?>
	</section>
	<section id="contact">
		<?php include(__DIR__.'/inc/contact.php'); ?>
	</section>

<script src="../js/js.js"></script>
<!--Google Analytics-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-89718649-1', 'auto');
  ga('send', 'pageview');
</script>
</body>

</html>