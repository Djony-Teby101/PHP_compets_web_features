<?php
require_once("../config.php");

   if($_SERVER['REQUEST_METHOD']==='POST'){
        
        $nom=trim($_POST['nom'] ??'');
        $email=filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $phoneNumber=trim($_POST['telephone']);
        
        
        // verifier que tous les champs du formulaires sont remplis.
       if(empty($email) || empty($nom) || empty($phoneNumber)){
           $erreur[] = " Veuillez remplir tous les champs du formulaire.";
       }
       
       // Vérification des fichiers
        $requiredFiles = ['photo-profile', 'carte-grise', 'permis'];
        foreach ($requiredFiles as $file) {
            if (!isset($_FILES[$file]) || $_FILES[$file]['error'] !== 0) {
                $errors[] = "Le fichier '$file' est requis";
            }
        }
    }
   
     // Si erreurs, rediriger
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        var_dump($errors);
        // header("Location: ../login-sign/index.php");
        exit();
    }
    
    try{
        
         //   1. Vérifier si l'email existe déjà
        $checkEmail = $pdo->prepare("SELECT email FROM conducteur WHERE email= ?");
        $checkEmail->execute([$email]);
        
        $result=$checkEmail->fetch(PDO::FETCH_ASSOC);
        // var_dump($result);
        
        if ($checkEmail->rowCount() > 0) {
            $errors[] = "Cet email est déjà utilisé";
            $_SESSION['errors'] = $errors;
            // header("Location: ../login-sign/index.php");
            // exit();
            var_dump($errors);
        }
        
         // 2. Préparer les noms de fichiers
        $profileFileName = null;
        $carteFileName = null;
        $permisFileName = null;
        
        // 3. Créer les répertoires s'ils n'existent pas
        $baseDir = dirname(dirname(__FILE__));
        $dirs = [
            'profile' => $baseDir . "/uploads/profiles/",
            'carte' => $baseDir . "/uploads/carte_grises/",
            'permis' => $baseDir . "/uploads/permis/"
        ];
        
        foreach ($dirs as $dir) {
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
        }
        
         var_dump("Le nom...");
        
    }catch(Exception $e){
        
        
    }
   
?>
