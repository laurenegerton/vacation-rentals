<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "depreyj-db", "hed5gVlymx3PJKO7", "depreyj-db");
if($mysqli->connect_errno){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
    }

if(!($stmt = $mysqli->prepare("INSERT INTO hosts(fname, lname, email) VALUES (?, ?, ?)"))){
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
  <title>Host Property</title>
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
                <li>
                    <a href="guest.php">Guests</a>
                </li>
                <li  class="active">
                    <a href="host.php">Hosts</a>
                </li>
                    </ul>
                </li>
            </ul>
            <div class="jumbotron well">
                <h2>
                    Host Your Property
                </h2>
                <p>
                    Earn money.
                </p>
            </div><span class="label label-default"></span>
        </div>
    </div>
</div>
<div class="container">
  <h2>Host It</h2>
  <form action="hosted.php" method="post" role="form" class="form-horizontal">
    <div class="form-group">
      <div class="col-sm-3"><label>Property Type</label>
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
      <div class="col-sm-3"><label>Street Address</label><input id="st_address" name="st_address" type="text" class="form-control" placeholder="Address"></div>
      <div class="col-sm-3"><label>City</label><input id="city" name="city" type="text" class="form-control" placeholder="City"></div>
      <label for="state" class="col-sm-3">State</label>
      <div class="col-sm-3">
        <select class="form-control" id="state" name="state">
          <option value="AK">Alaska</option>
          <option value="AL">Alabama</option>
          <option value="AR">Arkansas</option>
          <option value="AZ">Arizona</option>
          <option value="CA">California</option>
          <option value="CO">Colorado</option>
          <option value="CT">Connecticut</option>
          <option value="DC">District of Columbia</option>
          <option value="DE">Delaware</option>
          <option value="FL">Florida</option>
          <option value="GA">Georgia</option>
          <option value="HI">Hawaii</option>
          <option value="IA">Iowa</option>
          <option value="ID">Idaho</option>
          <option value="IL">Illinois</option>
          <option value="IN">Indiana</option>
          <option value="KS">Kansas</option>
          <option value="KY">Kentucky</option>
          <option value="LA">Louisiana</option>
          <option value="MA">Massachusetts</option>
          <option value="MD">Maryland</option>
          <option value="ME">Maine</option>
          <option value="MI">Michigan</option>
          <option value="MN">Minnesota</option>
          <option value="MO">Missouri</option>
          <option value="MS">Mississippi</option>
          <option value="MT">Montana</option>
          <option value="NC">North Carolina</option>
          <option value="ND">North Dakota</option>
          <option value="NE">Nebraska</option>
          <option value="NH">New Hampshire</option>
          <option value="NJ">New Jersey</option>
          <option value="NM">New Mexico</option>
          <option value="NV">Nevada</option>
          <option value="NY">New York</option>
          <option value="OH">Ohio</option>
          <option value="OK">Oklahoma</option>
          <option value="OR">Oregon</option>
          <option value="PA">Pennsylvania</option>
          <option value="PR">Puerto Rico</option>
          <option value="RI">Rhode Island</option>
          <option value="SC">South Carolina</option>
          <option value="SD">South Dakota</option>
          <option value="TN">Tennessee</option>
          <option value="TX">Texas</option>
          <option value="UT">Utah</option>
          <option value="VA">Virginia</option>
          <option value="VT">Vermont</option>
          <option value="WA">Washington</option>
          <option value="WI">Wisconsin</option>
          <option value="WV">West Virginia</option>
          <option value="WY">Wyoming</option>
        </select>
      </div>
      <div class="col-sm-2"><label>Zip</label><input id="zip" name="zip" type="number" class="form-control" placeholder="Zip"></div>
      <div class="col-sm-2"><label>Price Per Night($)</label><input id="daily_cost" name="daily_cost" type="number" class="form-control" placeholder="Price"></div>
      <div class="col-sm-4"><label>Brief Description</label><input id="description" name="description" type="text" class="form-control" placeholder="Description"></div><div class="col-sm-3"></div>
      <div class="col-sm-2"><label>First Name</label><input type="text" readonly="readonly" id="first_name" name="first_name" class="form-control" value=<?php echo $_POST['first_name']; ?> ></div>
      <div class="col-sm-2"><label>Last Name</label><input type="text" readonly="readonly" id="last_name" name="last_name" class="form-control" value=<?php echo $_POST['last_name']; ?> ></div>
    </div>
      <div class="col-sm-3">
        <button type="submit" class="btn btn-info pull-left">Host It</button>
      </div>
    </div>
  </form>
  <hr>
</div>
</html>