<?php
// Function to read a CSV file
function readCSV($csvFile) {
    $fileHandle = fopen($csvFile, 'r');
    $csvData = array();
    while (($row = fgetcsv($fileHandle, 0, ",")) !== FALSE) {
        $csvData[] = $row;
    }
    fclose($fileHandle);
    return $csvData;
}

// Function to search in a CSV file
function searchCSV($csvFile, $columnNumber, $searchKey) {
    $csvData = readCSV($csvFile);
    $matchingRows = array();
    foreach ($csvData as $row) {
        if ($row[$columnNumber-1] == $searchKey) {
            $matchingRows[] = $row;
        }
    }
    return $matchingRows;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $csvFile = $_FILES["csv_file"]["tmp_name"];
    $columnNumber = $_POST["column_number"];
    $searchKey = $_POST["search_key"];

    $result = searchCSV($csvFile, $columnNumber, $searchKey);

    // Display result
    if ($result) {
        $resultHtml = "<h2>Matching rows:</h2><ul>";
        foreach ($result as $row) {
            $resultHtml .= "<li>" . implode(", ", $row) . "</li>";
        }
        $resultHtml .= "</ul>";
        header("Location: index.html?result=" . urlencode($resultHtml));
    } else {
        header("Location: index.html?result=No matching rows found.");
    }
}
?>