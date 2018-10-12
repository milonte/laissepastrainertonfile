<form action="/index.php" method="post" enctype="multipart/form-data">
    <input type="file" name="fichier[]"  multiple="multiple" />
    <input type="submit" value="Send" />
</form>


<?php
$errors = [];

if ($_FILES) {

    $mime_types = [
        'png' => 'image/png',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'gif' => 'image/gif',
    ];

    
/* var_dump($_FILES); */
    for ($i = 0; $i < count($_FILES['fichier']['name']); $i++) {

    // extension du file
        $mime_content = explode('/', mime_content_type($_FILES['fichier']['tmp_name'][$i]))[1]; 
    
     // si l'extension est de type image (pgn, jpg, ...)
        if (array_key_exists($mime_content, $mime_types)) { 

        // si le file fait moins de 1Mo
            if (filesize($_FILES['fichier']['tmp_name'][$i]) < 1000000) {

        // chemin vers un dossier sur le serveur qui va recevoir les fichiers uploadés (attention ce dossier doit être accessible en écriture)
                $uploadDir = 'upload/';
        // on génère un nom de fichier à partir du nom de fichier sur le poste du client (mais vous pouvez générer ce nom autrement si vous le souhaitez)
                $uploadFile = $uploadDir . basename(uniqid('image_').'.'.$mime_content);
    
        // on déplace le fichier temporaire vers le nouvel emplacement sur le serveur. Ca y est, le fichier est uploadé
                move_uploaded_file($_FILES['fichier']['tmp_name'][$i], $uploadFile);

            } else { // si le file fait PLUS de 1Mo
                $errors[$_FILES['fichier']['name'][$i]] = "image trop grosse : " . $_FILES['fichier']['name'][$i] . "<br />";
            }
        } else { // si le file n'est pas une image
            $errors[$_FILES['fichier']['name'][$i]] = "Pas une image ! : " . $_FILES['fichier']['name'][$i] . "<br />";
        }
    }
}

if ($errors) : ?>
        <div class='alert alert-danger'>
            <?php foreach ($errors as $err) {
                echo $err;
            } ?>
        </div>
            <?php 
            endif ?>

