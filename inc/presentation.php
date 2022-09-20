<?php function age($date) { 
    $age = date('Y') - $date; 
   if (date('md') < date('md', strtotime($date))) { 
       return $age - 1; 
   } 
   return $age; 
}           
?>            
            <div class="cpres">
                <h1><img src="../img/photo.jpg" alt="Ma photo"></h1>
                <ul>
                    <li><u>Nom</u> : Alves</li>
                    <li><u>Prénom</u> : Alexandre</li>
                    <li><u>Age</u> : <?php echo age('1982-09-09'); ?> ans</li>
                    <li><u>Profession</u> : En formation de développeur web chez Osengo</li>
                    <li><u>Lieu de naissance</u> : Lunel (Hérault)</li>
                    <li><u>Lieu de résidence</u> : Saint Gilles (Gard)</li>
                    <li><u>Situation familiale</u> : Divorcé, père de deux filles de <span title="Amélie &hearts;"><?php echo age('2010-08-09'); ?></span> et <span title="Pauline &hearts;"><?php echo age('2013-01-31'); ?></span> ans</li>
                    <li><u>Objectif professionnel</u> : Devenir développeur web</li>
                    <li><u>Languages maitrisés</u> : HTML et CSS</li>
                </ul>
            </div>