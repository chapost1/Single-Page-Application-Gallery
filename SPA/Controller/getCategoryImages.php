<?php
require_once '../Db/multipleF.php';
require_once '../Model/image.php';
if(isset($_POST['getCategoryImages'])){
    $categoryId = $_POST['categoryId'];
    $imagesArray = getCategoryImages($categoryId);
    echo json_encode($imagesArray);
}
