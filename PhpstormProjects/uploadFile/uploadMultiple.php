<?php
if(isset($_POST['submit']))
{
    if(count($_FILES['fichier']['name'])>0)
    {
        for ($i = 0; $i < count($_FILES['fichier']['name']); $i++) {
            $tmpFilePath = $_FILES['upload']['tmp_name'][$i];
            if ($tmpFilePath != "") {
                $shortname = $_FILES['fichier[']['name'][$i];
                $filePath  = 'images/' . date('d - m - Y - H - i') . '-' . $_FILES['fichier']['name'][$i];
                if (move_uploaded_file($tmpFilePath, $filePath)) {
                    $files[]= $shortname;
                }
            }
        }

    }
}