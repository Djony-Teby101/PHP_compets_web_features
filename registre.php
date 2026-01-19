
   <?php

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
    var_dump($_FILES['photo-profile']);

?>
