<?php
$dataDir = 'data/';
$files = array_diff(scandir($dataDir), array('..', '.'));

$jsonFiles = array_filter($files, function ($file) use ($dataDir) {
    return pathinfo($file, PATHINFO_EXTENSION) === 'json';
});
?>
<!DOCTYPE html>
<html>
<head>
    <title>Select JSON File</title>
</head>
<body>
    <h2>Select JSON File to Edit</h2>
    <form action="edit.php" method="get">
        <label for="file">Choose a JSON file:</label>
        <select name="file" id="file">
            <?php foreach ($jsonFiles as $file) { ?>
                <option value="<?php echo htmlspecialchars($file); ?>"><?php echo htmlspecialchars($file); ?></option>
            <?php } ?>
        </select>
        <button type="submit">Proceed</button>
    </form>
</body>
</html>
