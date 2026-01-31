<?php 
    //  configuration

    $uploadDir='uploads/';
    $profileDir= $uploadDir.'profile/';
    $carteDir=$uploadDir.'carte/';

 // Creer les fichier s'il n'existe pas.
    if(!file_exists($uploadDir)){
        mkdir($uploadDir, 0755,true);
    }   
    if(!file_exists($profileDir)){
        mkdir($profileDir, 0755, true);
    }
    if(!file_exists($carteDir)){
        mkdir($carteDir, 0755, true);
    }


    $allowedExtension=['jpg', 'jpeg', 'png'];
    $maxFileSize=5*1024*1024 ;

//    Recuperer le fichier Televerser.
    $ImageTeleverser=$_FILES['image'];
    $Imagesize=$_FILES['image']['size'];
    $ImageName=$_FILES['image']['name'];
    $ImageTmp_name=$_FILES['image']['tmp_name'];
    
    // Telverser le fichier.
    $pathDirImage=$profileDir.basename($ImageName);

    if(move_uploaded_file($ImageTmp_name, $pathDirImage)){
        var_dump('Image televerser  avec succes !');
    }else{
        var_dump("Erreur lors du traitement");
    }




   
