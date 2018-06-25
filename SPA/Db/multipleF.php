<?php

require 'connection.php';

function getAllCategories() {
    $conn = $GLOBALS['conn'];
    $sqlSelectAll = "SELECT * FROM categories";
    try {
        $result = $conn->query($sqlSelectAll);
        if (!$result) {
            throw new Exception("");
        }
        if ($result->num_rows > 0) {
            $categoriesArray = array();
            while ($row = $result->fetch_assoc()) {
                $currentCategory = new category($row['category_id'], $row['name']);
                array_push($categoriesArray, $currentCategory);
            }
        }
    } catch (Exception $e) {
        
    }
    $conn->close();
    return $categoriesArray;
}

;

function getCategoryImages($categoryId) {
    $conn = $GLOBALS['conn'];
    $sqlSelectAll = "SELECT * FROM uploads WHERE category_id ='" . $categoryId . "'";
    try {
        $result = $conn->query($sqlSelectAll);
        if (!$result) {
            throw new Exception("");
        }
        if ($result->num_rows > 0) {
            $imagessArray = array();
            while ($row = $result->fetch_assoc()) {
                $currentImage = new image($row['upload_id'], $row['category_id'], $row['name'], $row['location']);
                array_push($imagessArray, $currentImage);
            }
        }
    } catch (Exception $e) {
        
    }
    $conn->close();
    return $imagessArray;
}

;

function getCategoryHint($hint) {
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM categories WHERE name LIKE '%$hint%'";
    $result = $conn->query($sql);

    $json = array();

    while ($row = $result->fetch_assoc()) {
        array_push($json, $row['name']);
    }
    $conn->close();
    return $json;
}
