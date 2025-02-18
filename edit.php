<?php
$dataDir = 'data/';

if (!isset($_GET['file'])) {
    die("No file selected.");
}

$file = $_GET['file'];
$filePath = $dataDir . $file;

if (!file_exists($filePath) || pathinfo($file, PATHINFO_EXTENSION) !== 'json') {
    die("Invalid file.");
}

$jsonData = json_decode(file_get_contents($filePath), true);

function renderInputFields($data, $prefix = '') {
    foreach ($data as $key => $value) {
        $name = $prefix . $key;
        if (is_array($value)) {
            echo "<h3>$key:</h3>";
            renderInputFields($value, $name . "[");
        } else {
            echo "<label>$key: </label>";
            echo "<input type='text' name='{$name}]' value='" . htmlspecialchars($value) . "'><br>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit JSON File</title>
</head>
<body>
    <h2>Editing: <?php echo htmlspecialchars($file); ?></h2>
    <form action="update.php" method="post">
        <input type="hidden" name="file" value="<?php echo htmlspecialchars($file); ?>">
        <?php renderInputFields($jsonData); ?>
        <button type="submit">Update</button>
    </form>
</body>
</html>
