<?php
require_once '../Db/multipleF.php';
require_once '../Model/category.php';

$categoriesArray = getAllCategories();
echo json_encode($categoriesArray);