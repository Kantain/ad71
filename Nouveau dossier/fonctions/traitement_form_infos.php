<?php
session_start();
include('../classes/fpdm.php');

$post = $_POST;

/*echo $post['no_adherent'];
echo '<br>';
echo $post['nom'];
echo '<br>';
echo $post['prenom'];
echo '<br>';
echo $post['sexe'];
echo '<br>';
echo $post['date_naissance'];
echo '<br>';
echo $post['lieu_naissance'];
echo '<br>';
echo $post['nationalite'];
echo '<br>';
echo $post['no_secu'];
echo '<br>';
echo $post['adresse'];
echo '<br>';
echo $post['code_postal'];
echo '<br>';
echo $post['ville'];
echo '<br>';
echo $post['tel_fixe'];
echo '<br>';
echo $post['tel_portable_1'];
echo '<br>';
echo $post['tel_portable_2'];
echo '<br>';
echo $post['email'];
echo '<br>';*/
if(isset($post['newsletter'])){
	$newsletter = $post['newsletter'];
	unset($post['newsletter']);
}
else{
	$newsletter=null;
}

$photo = $post['photo'];

unset($post['photo']);
unset($post['valider_infos']);

$pdf = new FPDM('../modeles/doc_inscription.pdf');
$pdf->Load($post,true);
$pdf->Merge();
$pdf->Output(mb_strtoupper($post['nom']) . '-' . mb_strtoupper($post['prenom']) . '.pdf');
echo "Vos informations ont été enregistrées et sont en cours de traitement.";

$post['newsletter']=$newsletter;
$post['photo'] = $photo;
//ajout en bd a faire

header('Refresh:5;url=../');
?>