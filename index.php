<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="files[]" multiple="multiple">
            <input type="submit" name="submit" value="UPLOAD">
        </form>
        <div>
            <?php if (in_array(4, $_SESSION['error'] ?? Array())): ?>
            <p>Please choose a file to upload</p>
            <?php elseif (in_array(1, $_SESSION['error'] ?? Array())): ?>
            <p>Exceeded allowed files size</p>
            <?php elseif (in_array('ext', $_SESSION['error'] ?? Array())): ?>
            <p>1 or more files you uploaded have invalid type</p>
            <?php endif; ?>
        </div>
    </body>
</html>
<?php unset($_SESSION['error']); ?>