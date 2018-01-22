
<?php

function recuperer(){
 if (file_exists("../fichier info venant de FFJ.csv"))
     $fp = fopen("../fichier info venant de FFJ.csv", "r"); 
 else
     { /* le fichier n'existe pas */
       echo "Fichier introuvable !<br>Importation stoppée.";
       exit();
     }
    while (!feof($fp)) /* Et Hop on importe */
    { /* Tant qu'on n'atteint pas la fin du fichier */ 
       $ligne = fgets($fp,4096); /* On lit une ligne */  
       /* On récupère les champs séparés par ; dans liste*/
       
       $liste = explode( ",",$ligne); 
       echo $ligne;
       echo '<br>'; 

	   /*$champ2 .= $liste[2];
$champ3 .= $liste[3];*/
}
}
recuperer();

?>
