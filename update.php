<?php
$dataDir = 'data/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['file'])) {
        die("No file selected.");
    }

    $file = $_POST['file'];
    $filePath = $dataDir . $file;

    if (!file_exists($filePath) || pathinfo($file, PATHINFO_EXTENSION) !== 'json') {
        die("Invalid file.");
    }

    $jsonData = json_decode(file_get_contents($filePath), true);

    function updateJson(&$data, $postData) {
        foreach ($postData as $key => $value) {
            if (is_array($value)) {
                updateJson($data[$key], $value);
            } else {
                if ($value !== '') { // Only update non-empty fields
                    $data[$key] = $value;
                }
            }
        }
    }

    updateJson($jsonData, $_POST);

    file_put_contents($filePath, json_encode($jsonData, JSON_PRETTY_PRINT));

    echo "File updated successfully! <a href='index.php'>Go Back</a>";
}
?>
