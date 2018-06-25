<?php

require_once '../Db/multipleF.php';

    $hint = $_POST['hint'];
    $json = getCategoryHint($hint);
    echo json_encode($json);