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
  <title>Property DB</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style>
.bg-1 {
	background-color: #2956B2; /* Blue */
	color: #ffffff;
}
body {
	font: 400 15px Lato, sans-serif;
	line-height: 1.8;
	color: #818181;
}
.
</style>

<body>
<div class="container-fluid bg-1">

<div class="container">
	<h2>Available Properties</h2>
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
if(!($stmt = $mysqli->prepare("SELECT description, daily_cost, pt.name AS type, st_address AS address, city, state, zip, h.fname AS host
	FROM properties p
	INNER JOIN property_type pt ON p.type_id= pt.type_id
	INNER JOIN hosts h ON p.host_id = h.host_id
	ORDER BY p.state;"))){
	echo "Prepare failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($stmt->execute())){
	echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($stmt->bind_result($description, $daily_cost, $type, $address, $city, $state, $zip, $host))){
	"Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while ($stmt->fetch()){
	echo "<tr>\n<td>" . $description . "\n</td>\n<td>" . $daily_cost . "\n</td>\n<td>" . $type . "\n</td>\n<td>" . $address . "\n</td>\n<td>" . $city . "\n</td>\n<td>" . $state . "\n</td>\n<td>" . $zip . "\n</td>\n<td>" . $host . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
	</div>
</div>

<!-- <div>
	<form method="post" action="addproperty.php">
		<fieldset>
			<legend>Property</legend>
			<p>Street Address: <input type="text" name="street_address" /></p>
			<p>City: <input type="text" name="city" /></p>
			<p>State: <input type="text" name="state" /></p>
			<p>Zip Code: <input type="text" name="zip" /></p>
			<p>Cost Per Night: <input type="text" name="cost_per_night" /></p>
			<p>Type of Property:
			<select>
				<option value="1">Apartment</option>
				<option value="2">Private Room</option>
				<option value="3">Bed in Shared Room</option>
				<option value="4">House</option>
			</select>
		</fieldset>

		<fieldset>
			<legend>Host</legend>
			<p>First Name: <input type="text" name="first_name" /></p>
			<p>Last Name: <input type="text" name="last_name" /></p>
			<p>Phone Number: <input type="text" name="phone_number" /></p>
			<p>Email Address: <input type="email" name="email" /></p>
		</fieldset>
		<p><input type="submit" name="add" value="Add Property"/>
		<input type="submit" name="update" value="Update Property"/></p>
	</form>
</div> -->

<div class="container">
  <h2>Book a Property</h2>
  <form role="form" class="form-horizontal">
    <div class="form-group">
      <div class="col-sm-3"><label>First name</label><input id="first_name" name="first_name" type="text" class="form-control" placeholder="First"></div>
      <div class="col-sm-3"><label>Last name</label><input id="last_name" name="last_name" type="text" class="form-control" placeholder="Last"></div>
      <div class="col-sm-3"><label>Email</label><input id="email" name="email" type="email" class="form-control" placeholder="Email"></div>
    </div>
    <div class="form-group">
      <div class="col-sm-3"><label>Check-In</label><input type="date" class="form-control" placeholder="First"></div>
      <div class="col-sm-3"><label>Check-Out</label><input type="date" class="form-control" placeholder="Last"></div>
      <div class="col-sm-3"><label>Select Property</label><select id="properties" name="properties" class="form-control">
	      <option value="1">Option one</option>
	      <option value="2">Option two</option>
	    </select>
	    </div>
    <div class="form-group">
      <div class="col-sm-3">
        <button type="submit" class="btn btn-info pull-left">Book It</button>
      </div>
    </div>
  </form>
  <hr>
</div>

<div class="container">
	<h2>Current Bookings</h2>
	<div class="table-responsive">
	<table class="table table-condensed">
		<tr>
			<th>Guest</th>
			<th>Property</th>
			<th>Check-In Date</th>
			<th>Check-Out Date</th>
			<th>Total Cost</th>
		</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT guest_id, prop_id, beg_date, end_date, total_cost FROM bookings"))){
	echo "Prepare failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($stmt->execute())){
	echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($stmt->bind_result($guest_id, $prop_id, $beg_date, $end_date, $total_cost))){
	"Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while ($stmt->fetch()){
	echo "<tr>\n<td>" . $guest_id . "\n</td>\n<td>" . $prop_id . "\n</td>\n<td>" . $beg_date . "\n</td>\n<td>" . $end_date . "\n</td>\n<td>" . $total_cost . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
	</div>
</div>

</body>
</html>

<!-- Guests
First Name
Last Name
Phone Number
Email


Bookings
Start Date
End Date
Total Cost
Property
Guest Name (append fname, lname)  -->