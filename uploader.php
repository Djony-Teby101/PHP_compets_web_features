<?php
$dossier = 'uploads/';
if (!is_dir($dossier)) mkdir($dossier, 0777, true);

 $tmp_name=$_FILES['fichier']['tmp_name'];
 $nom=$_FILES['fichier']['name'];

if(!empty($nom)){
     $nom_fichier = basename($nom);
     $chemin_final = $dossier . $nom_fichier;


     if(move_uploaded_file($tmp_name, $chemin_final)){
        echo "le fichier a été televerser $chemin_final";
     }else{
        echo "Erreur lors du chargement du $nom_fichier";
     }
}

?>
