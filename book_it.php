<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "depreyj-db", "hed5gVlymx3PJKO7", "depreyj-db");
if($mysqli->connect_errno){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
    }

if(!($stmt = $mysqli->prepare("INSERT INTO guests(fname, lname, email) VALUES (?, ?, ?)"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("sss", $_POST['first_name'],$_POST['last_name'],$_POST['email']))){
    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
    echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Guest Booking</title>
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
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li class="active">
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
                    Guest Booking
                </h2>
                <p>
                    Book your dream vacation.
                </p>
            </div><span class="label label-default"></span>
        </div>
    </div>
</div>
<div class="container">
  <h2>Book It</h2>
  <form action="booked.php" method="post" role="form" class="form-horizontal">
    <div class="form-group">
      <div class="col-sm-3"><label>Check-In</label><input type="date" id="beg_date" name="beg_date" class="form-control"></div>
      <div class="col-sm-3"><label>Check-Out</label><input type="date" id="end_date" name="end_date" class="form-control"></div>
      <div class="col-sm-3"><label>Select Property</label>
      <select id="prop_id" name="prop_id" class="form-control">
          <?php
          if(!($stmt = $mysqli->prepare("SELECT prop_id
                                         FROM properties
                                         ORDER BY prop_id"))){
            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
          }
          if(!$stmt->execute()){
            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }
          if(!$stmt->bind_result($prop_id)){
            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }
          while($stmt->fetch()){
           echo '<option value=" '. $prop_id . ' "> ' . $prop_id . '</option>\n';
          }
          $stmt->close();
          ?>
          </select>
        </div>
        <div class="col-sm-1"><label>Guest</label><input type="text" readonly="readonly" id="first_name" name="first_name" class="form-control" value=<?php echo $_POST['first_name']; ?> ></div>
        <div class="col-sm-1"><label>Name</label><input type="text" readonly="readonly" id="last_name" name="last_name" class="form-control" value=<?php echo $_POST['last_name']; ?> ></div>
    </div>

      <div class="col-sm-3">
        <button type="submit" class="btn btn-info pull-left">Book It</button>
      </div>
    </div>
  </form>
  <hr>
</div>

<div class="container">
  <h2>Create Wishlist</h2>
  <form action="wishlist.php" method="post" role="form" class="form-horizontal">
    <div class="form-group">
        <div class="col-sm-3"><label>Name of Wishlist</label><input type="text" id="listname" name="listname" class="form-control" placeholder="Name"></div>
        <div class="col-sm-1"><label>Guest</label><input type="text" readonly="readonly" id="first_name" name="first_name" class="form-control" value=<?php echo $_POST['first_name']; ?> ></div>
        <div class="col-sm-1"><label>Name</label><input type="text" readonly="readonly" id="last_name" name="last_name" class="form-control" value=<?php echo $_POST['last_name']; ?> ></div>
    </div>
      <div class="col-sm-3">
        <button type="submit" class="btn btn-info pull-left">Create</button>
      </div>
    </div>
  </form>
  <hr>
</div>


<div class="container">
    <h2>Available Properties</h2>
    <div class="table-responsive">
    <table class="table table-condensed">
        <tr>
            <th>Property ID</th>
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
if(!($query = $mysqli->prepare("SELECT prop_id, description, daily_cost, pt.name AS type, st_address AS address, city, state, zip, h.fname AS host
    FROM properties p
    INNER JOIN property_type pt ON p.type_id= pt.type_id
    INNER JOIN hosts h ON p.host_id = h.host_id
    ORDER BY prop_id;"))){
    echo "Prepare failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($query->execute())){
    echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($query->bind_result($prop_id, $description, $daily_cost, $type, $address, $city, $state, $zip, $host))){
    "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while ($query->fetch()){
    echo "<tr>\n<td>" . $prop_id . "\n</td>\n<td>" . $description . "\n</td>\n<td>" . $daily_cost . "\n</td>\n<td>" . $type . "\n</td>\n<td>" . $address . "\n</td>\n<td>" . $city . "\n</td>\n<td>" . $state . "\n</td>\n<td>" . $zip . "\n</td>\n<td>" . $host . "\n</td>\n</tr>";
}
$query->close();
?>
    </table>
    </div>
</div>
</html>