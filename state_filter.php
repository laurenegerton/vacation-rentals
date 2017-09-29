<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "depreyj-db", "hed5gVlymx3PJKO7", "depreyj-db");
if($mysqli->connect_errno){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Filtered Properties</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="guest.php">Guests</a>
                </li>
                <li>
                    <a href="host.php">Hosts</a>
                </li>
                    </ul>
                </li>
            </ul>
            <div class="jumbotron well">
                <h2>
                    Available Properties by State
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="table-responsive">
    <table class="table table-condensed">
        <tr>
            <th>Description</th>
            <th>Cost Per Night</th>
            <th>Type of Property</th>
            <th>Street Address</th>
            <th>City</th>
            <th>State</th>
            <th>Zip Code</th>
            <th>Host</th>
        </tr>
<?php
if(!($query = $mysqli->prepare("SELECT description, daily_cost, pt.name AS type, st_address AS address, city, state, zip, CONCAT(h.fname, ' ', h.lname) AS host
    FROM properties p
    INNER JOIN property_type pt ON p.type_id= pt.type_id
    INNER JOIN hosts h ON p.host_id = h.host_id
    WHERE p.state = ?"))){
    echo "Prepare failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($query->bind_param("s", $_POST['state']))){
    echo "Bind failed: "  . $query->errno . " " . $query->error;
}
if(!($query->execute())){
    echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($query->bind_result($description, $daily_cost, $type, $address, $city, $state, $zip, $host))){
    "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while ($query->fetch()){
    echo "<tr>\n<td>" . $description . "\n</td>\n<td>" . $daily_cost . "\n</td>\n<td>" . $type . "\n</td>\n<td>" . $address . "\n</td>\n<td>" . $city . "\n</td>\n<td>" . $state . "\n</td>\n<td>" . $zip . "\n</td>\n<td>" . $host . "\n</td>\n</tr>";
}
$query->close();
?>
    </table>
    </div>
</div>
</html>