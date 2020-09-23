<?php
/**
 * This is a sample data hardcoded as of now,
 * but it could be anything pulled from any
 * database in future. Rest of the code to 
 * display data-set does not change.
 * For eg:
 * $data = getDataFromDatabase();
 */
$data = [
    [1, "owner-1", "2020-01-01", 11.1451, 12.1452 ],
    [2, "owner-1", "2020-02-01", 11.2451, 12.2452 ],
    [3, "owner-1", "2020-03-01", 11.3451, 12.3452]
];

function renderDataAsHtmlTable($data)
{    
    $markup = "<table class='table table-bordered'>";
    if (empty($data)) {
        $markup .= "<tr><td class='text-center'>No Data found!</td></tr>"; 
    } else {
        foreach ($data as $row) {
            $markup .= "<tr>";
            foreach($row as $column) {
                $markup .= "<td>$column</td>";
            }
            $markup .= "</tr>";
        }
    }

    return $markup .= "</table>";
}

function getDataFromDatabase()
{
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "myDB";
    $data = [];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, owner, date, v1, v2 FROM TableName";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            $data[] = $row;            
        }
    } 
    $conn->close();
    return $data;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - A generic "pivot" function</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h4>Sample Data</h4>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php
                    echo renderDataAsHtmlTable($data);
                ?>
            </div>
        </div>
    </div>
</body>
</html>
