<?php
require_once '../Db/upload.php';
if (isset($_POST['upload'])) {
    // catching data
    $imageCategory = $_POST['imageCategory'];
    $imageName = filter_var($_POST['imageName'], FILTER_SANITIZE_STRING);
    //// making rando for image name
    $newRando = NewGuid();
    $imageNewName = $newRando.$_FILES["imageFile"]['name'];
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($imageNewName);
    if (move_uploaded_file($_FILES["imageFile"]['tmp_name'], $target_file)) {
        // upload completed , do things for DB..
        $worked = uploadImageToCategory($imageCategory , $imageName , $imageNewName);
        if($worked){
            echo "2";
        } else{
            echo "3";
        }
        
    } else {
        echo "1";
    }
};

function NewGuid() {
    $s = strtoupper(md5(uniqid(rand(), true)));

    $guidText = 'img_' .
            substr($s, 0, 8) . '-' .
            substr($s, 8, 4) . '-' .
            substr($s, 12, 4) . '-' .
            substr($s, 16, 4) . '-' .
            substr($s, 20) . '.' .
            substr(uniqid(), 9, -2) .
            substr(uniqid(), 7, -4) .
            rand(1, 9);

    return $guidText;
}

;
