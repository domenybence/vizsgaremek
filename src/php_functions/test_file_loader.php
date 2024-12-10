<?php
$file_path = "../test.uqw";

if (file_exists($file_path)) {
    $file_content = file_get_contents($file_path);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Text File</title>
</head>
<body>
    <h1>Content of the Text File:</h1>
    <?php echo htmlspecialchars($file_content); ?>
</body>
</html>