<?php 
function recuperer(){
echo "<table>"; 
$fichier = "../Fonctions dans AD71.csv"; 
$fic = fopen($fichier, 'rb'); 
$nb_lignes=0;   //Init du nombre de lignes
$nb_lignes_max=17;  //On parametre ici le nombre max de lignes a afficher
$nb_colonnes_max=8;  //On parametre ici le nombre max de colonnes a afficher
for ($ligne = fgetcsv($fic, 1024, ";"); !feof($fic); $ligne = fgetcsv($fic, 1024, ";")) { 
  if($nb_lignes<$nb_lignes_max){
    echo "<tr>"; 
    $j = sizeof($ligne); 
    if($j>$nb_colonnes_max){$j=$nb_colonnes_max;} // On limite à 2 colonnes
    for ($i = 0; $i < $j; $i++) { 
      echo "<td>".$ligne[$i]."</td>"; 
    } 
    echo "</tr>"; 
  }
  $nb_lignes++;
 
} 
echo "</table>\n"; 
}
recuperer();

?>