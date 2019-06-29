<?php
If (filter_has_var(INPUT_POST, 'submit')) {
    session_start();
    $files = $_FILES['files'];
    $totalFiles = count($files['name']);
    $allowedType = ['jpg','jpeg','pdf','png'];
    $userId = 1002;
    if (!file_exists('uploads')) {mkdir('uploads');}
    if (!file_exists("uploads/user$userId")) {mkdir("uploads/user$userId");}
    $dir = "uploads/user$userId";
    if (array_filter($files['error'])) {
        $_SESSION['error'] = $files['error'];
        header("Location: index.php");
    }
    for ($i = 0; $i < $totalFiles; $i++) {
        $fileName = basename($files['name'][$i]);
        $fileTempt = $files['tmp_name'][$i];
        $fileSize = $files['size'][$i]; 
        if ($fileSize > 32000000) {
            $_SESSION['error'][] = 1;
            header("Location: index.php");
            exit();
        }
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (!in_array($fileExt,$allowedType)) {
            $_SESSION['error'][] = 'ext';
            header("Location: index.php");
            exit();
        }
        $fileName = "uploads/user$userId/" . uniqid('') . "$i.$fileExt";
        move_uploaded_file($fileTempt, $fileName);
    }
} 
 header("Location: index.php");



