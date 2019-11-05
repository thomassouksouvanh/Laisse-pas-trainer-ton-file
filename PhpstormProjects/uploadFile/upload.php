<?php
if (isset($_POST['submit']));{
    $file = $_FILES['fichier'];
    $fileName = $_FILES['fichier']['name'];
    $fileType = $_FILES['fichier']['type'];
    $fileSize = $_FILES['fichier']['size'];
    $fileTmpName = $_FILES['fichier']['tmp_name'];
    $fileError = $_FILES['fichier']['error'];


    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = $fileType=['jpg','png','gif','jpeg'];

    if(in_array($fileActualExt,$allowed)){
        if($fileError === 0 ){
            if($fileSize < 1000000){
                $fileNameNew = uniqid("",true).".".$fileActualExt;
                $fileDestination = 'images/'.$fileNameNew;
                move_uploaded_file($fileTmpName,$fileDestination);
                header('Location:index.php?uploadSucces');
            }else{
                echo " ton fichier dépasse les 1 méga octect";
            }
        }else {
            echo " Une erreur de téléchargement s'est produite";
        }
    }

}
