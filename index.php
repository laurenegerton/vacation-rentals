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
  <title>Vacation Rentals - Your Home Away From Home</title>
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
                    Vacation Rentals
                </h2>
                <p>
                    Your home away from home.
                </p>
                <p>
                    <a class="btn btn-primary btn-large" href="guest.php">Guests</a>
                    <a class="btn btn-info btn-large" href="host.php">Hosts</a>
                    <a class="btn btn-info btn-warning" href="current_bookings.php">Current Bookings</a>
                </p>
            </div><span class="label label-default"></span>
        </div>
    </div>
</div>

<div class="container">
  <h3>Filter</h3>
  <form action="type_filter.php" method="post" role="form" class="form-horizontal">
    <div class="form-group">
      <div class="col-sm-3"><label>Type of Property</label>
      <select id="pname" name="pname" class="form-control">
          <?php
          if(!($stmt = $mysqli->prepare("SELECT name
                                         FROM property_type"))){
            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
          }
          if(!$stmt->execute()){
            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }
          if(!$stmt->bind_result($pname)){
            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }
          while($stmt->fetch()){
           echo '<option value="'.$pname.'"> ' . $pname . '</option>\n';
          }
          $stmt->close();
          ?>
        </select>
        </div>
    </div>
    <div class="col-sm-3">
        <button type="submit" class="btn btn-info pull-left">Filter</button>
    </div>
    </div>
  </form>
  <hr>
</div>
<div class="container">
<form action="desc_filter.php" method="post" role="form" class="form-horizontal">
    <div class="form-group">
      <div class="col-sm-3"><label>Description</label>
      <select id="description" name="description" class="form-control">
          <?php
          if(!($stmt = $mysqli->prepare("SELECT description
                                         FROM properties
                                         ORDER BY description"))){
            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
          }
          if(!$stmt->execute()){
            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }
          if(!$stmt->bind_result($description)){
            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }
          while($stmt->fetch()){
           echo '<option value="'.$description.'"> ' . $description . '</option>\n';
          }
          $stmt->close();
          ?>
        </select>
        </div>
    </div>
    <div class="col-sm-3">
        <button type="submit" class="btn btn-info pull-left">Filter</button>
    </div>
    </div>
  </form>
  <hr>
</div>
<div class="container">
  <form action="price_filter.php" method="post" role="form" class="form-horizontal">
    <div class="form-group">
      <div class="col-sm-3"><label>Daily Cost &lt </label>
      <select id="daily_cost" name="daily_cost" class="form-control">
          <option value="5000"> $5000</option>
          <option value="1000"> $1000</option>
          <option value="500"> $500</option>
          <option value="200"> $200</option>
          <option value="150"> $150</option>
          <option value="100"> $100 </option>
        </select>
        </div>
    </div>
    <div class="col-sm-3">
        <button type="submit" class="btn btn-info pull-left">Filter</button>
    </div>
    </div>
  </form>
  <hr>
</div>
<div class="container">
  <form action="city_filter.php" method="post" role="form" class="form-horizontal">
    <div class="form-group">
      <div class="col-sm-3"><label>City</label>
      <select id="city" name="city" class="form-control">
          <?php
          if(!($stmt = $mysqli->prepare("SELECT DISTINCT city
                                         FROM properties
                                         ORDER BY city"))){
            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
          }
          if(!$stmt->execute()){
            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }
          if(!$stmt->bind_result($city)){
            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }
          while($stmt->fetch()){
           echo '<option value="'.$city.'"> ' . $city . '</option>\n';
          }
          $stmt->close();
          ?>
        </select>
        </div>
    </div>
    <div class="col-sm-3">
        <button type="submit" class="btn btn-info pull-left">Filter</button>
    </div>
    </div>
  </form>
</div>
<div class="container">
  <form action="state_filter.php" method="post" role="form" class="form-horizontal">
    <div class="form-group">
      <div class="col-sm-3"><label>State</label>
      <select id="state" name="state" class="form-control">
          <?php
          if(!($stmt = $mysqli->prepare("SELECT DISTINCT state
                                         FROM properties
                                         ORDER BY state"))){
            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
          }
          if(!$stmt->execute()){
            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }
          if(!$stmt->bind_result($state)){
            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }
          while($stmt->fetch()){
           echo '<option value="'.$state.'"> ' . $state . '</option>\n';
          }
          $stmt->close();
          ?>
        </select>
        </div>
    </div>
    <div class="col-sm-3">
        <button type="submit" class="btn btn-info pull-left">Filter</button>
    </div>
    </div>
  </form>
  <hr>
</div>
<div class="container">
    <h2>All Available Properties</h2>
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
if(!($query = $mysqli->prepare("SELECT prop_id, description, daily_cost, pt.name AS type, st_address AS address, city, state, zip, CONCAT(h.fname, ' ', h.lname) AS host
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