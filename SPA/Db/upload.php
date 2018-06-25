<?php
require 'connection.php';
function uploadImageToCategory($imageCategory, $imageName, $imageNewName) {
    $conn = $GLOBALS['conn'];
    try {
        /// first search for category
        $sqlSearchCategory = "SELECT * FROM categories WHERE name ='" . $imageCategory . "'";
        $result = $conn->query($sqlSearchCategory);
        if (!$result) {
            throw new Exception("");
        };
        if ($result->num_rows > 0) {
            //if found just take id
            /// category exists
            $row = $result->fetch_assoc();
            //take category id.
            $categoryId = $row['category_id'];
        } else {
            // if not found - create and than take Id
            // not exist yet. create one.
            $sqlAddCategory = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
            $sqlAddCategory->bind_param("s", $imageCategory);
            $addedCategory = $sqlAddCategory->execute();
            $sqlSearchCategory = "SELECT * FROM categories WHERE name ='" . $imageCategory . "'";
            $result2 = $conn->query($sqlSearchCategory);
            if (!$result2) {
                throw new Exception("");
            };
            $row = $result2->fetch_assoc();
            //take category id.
            $categoryId = $row['category_id'];
        };
        /// and than when we finally have category ID to add to images so..
        // go to upload table and add image with specific category id
        $sqlAddImage = $conn->prepare("INSERT INTO uploads (category_id , name , location ) VALUES (? , ? , ?)");
        $sqlAddImage->bind_param("sss", $categoryId, $imageName, $imageNewName);
        $result3 = $sqlAddImage->execute();
        $conn->close();
        return true;
    } catch (Exception $e) {
        $conn->close();
        return false;
    }
}
