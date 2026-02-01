<?php 
    //  configuration

    // Fichier de récuperation.
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

    // Verifier le fichier à televerser.
    $errors=[];
    $succes=false;
    $file=$_FILES['image'];
    if($file['error'] !== UPLOAD_ERR_OK){
        switch($file['error']){
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $errors[]='le fichier est volumineux';
                break;
            case UPLOAD_ERR_PARTIAL:
                $errors[]='le fichier est partiellement televerser.';
                break;
            case UPLOAD_ERR_NO_FILE:
                $errors[]="Aucun fichier n'a été televerser .";
                break;
            default:
                $errors[]="Erreur inconnue lors du Televersage .";
        }
        return ['success'=>false, 'errors'=>$errors];
    }


    $allowedExtension=['jpg', 'jpeg', 'png'];
    $maxFileSize=5*1024*1024 ;

//    Recuperer le fichier Televerser.

// Globale fichier Media.
    $ImageTeleverser=$_FILES['image'];
    $Imagesize=$_FILES['image']['size'];
    $ImageName=$_FILES['image']['name'];
    $ImageTmp_name=$_FILES['image']['tmp_name'];

    // Verifier la taille.
    if($Imagesize > $maxFileSize){
        $errors[]="Le fichier est trop volumineux .";
    }

    // verifier l'extension.
    $fileExtension=strtolower(pathinfo($ImageName, PATHINFO_EXTENSION));
    if(! in_array($fileExtension, $allowedExtension)){
        $errors[]="Type de fichier non autorisé. Extension acceptée:". implode(', ', $allowedExtension);
    }

    // verifier le type mime.
    $finfo=finfo_open(FILEINFO_MIME_TYPE);
    $mimeType=finfo_file($finfo, $ImageTmp_name);
    

    $allowedMimeType=['image/jpg','image/png','image/jpeg'];
    if(! in_array($mimeType, $allowedMimeType)){
        $errors[]="Type Mime non autorisé .";
    }

    if(empty($errors)){
        // Telverser le fichier.
        $pathDirImage=$profileDir.basename($ImageName);

        if(move_uploaded_file($ImageTmp_name, $pathDirImage)){
             var_dump('Image televerser  avec succes !');
        }else{
             var_dump("Erreur lors du traitement");
        }
    }
    
  




   
