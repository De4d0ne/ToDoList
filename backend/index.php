<?php

header('Content-Type: application/json');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('DATA_FILE_NAME', 'data.json');

$data = [];
if (file_exists(DATA_FILE_NAME)) {
    $content = file_get_contents(DATA_FILE_NAME);
    $data = json_decode($content, true);
    if (!is_array($data)) {
        $data = [];
    }
}

if (
    isset($_GET['api-name']) &&
    is_string($_GET['api-name'])
) {
    if (
        isset($_POST['taskInput']) &&
        is_string($_POST['taskInput'])
    ) {
        if (!in_array($_POST['taskInput'], $data)) {
            $data[] = $_POST['taskInput'];

            $content = json_encode($data);
            file_put_contents(DATA_FILE_NAME, $content);
        }
    }
}

echo json_encode($data, JSON_PRETTY_PRINT);