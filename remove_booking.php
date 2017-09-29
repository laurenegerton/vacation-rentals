<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "depreyj-db", "hed5gVlymx3PJKO7", "depreyj-db");
if($mysqli->connect_errno){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
    }

if(!($stmt = $mysqli->prepare("DELETE FROM bookings
                                WHERE booking_id = ?"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("s", $_POST['booking_id']))){
    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
    echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Current Bookings</title>
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
                    All Current Bookings
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="container">
  <h4>Remove a Booking</h4>
  <form action="remove_booking.php" method="post" role="form" class="form-horizontal">
    <div class="form-group">
      <div class="col-sm-3"><label>Select Booking ID</label>
      <select id="booking_id" name="booking_id" class="form-control">
          <?php
          if(!($stmt = $mysqli->prepare("SELECT booking_id
                                         FROM bookings
                                         ORDER BY booking_id"))){
            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
          }
          if(!$stmt->execute()){
            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }
          if(!$stmt->bind_result($booking_id)){
            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }
          while($stmt->fetch()){
           echo '<option value=" '. $booking_id . ' "> ' . $booking_id . '</option>\n';
          }
          $stmt->close();
          ?>
          </select>
        </div></div>
        <button type="submit" class="btn btn-danger">Remove It</button>
    </div>
  </form>
  <hr>
</div>
<div class="container">
    <div class="table-responsive">
    <table class="table table-condensed">
        <tr>
            <th>Booking No.</th>
            <th>Description</th>
            <th>City</th>
            <th>State</th>
            <th>Check-In Date</th>
            <th>Check-Out Date</th>
            <th>Host</th>
        </tr>
<?php
if(!($query = $mysqli->prepare("
    SELECT b.booking_id as 'Booking No.', p.description, p.city as city, p.state as state, b.beg_date, b.end_date, CONCAT(h.fname, ' ', h.lname) AS host
        FROM bookings b
        INNER JOIN properties p ON p.prop_id = b.prop_id
        INNER JOIN guests g ON g.guest_id = b.guest_id
        INNER JOIN hosts h ON h.host_id = p.host_id
        ORDER BY b.beg_date ASC"))){
    echo "Prepare failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($query->execute())){
    echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($query->bind_result($booking_id, $description, $city, $state, $beg_date, $end_date, $host))){
    "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while ($query->fetch()){
    echo "<tr>\n<td>" . $booking_id . "\n</td>\n<td>" . $description . "\n</td>\n<td>" . $city . "\n</td>\n<td>" . $state . "\n</td>\n<td>" . $beg_date . "\n</td>\n<td>" . $end_date . "\n</td>\n<td>" . $host . "\n</td>\n</tr>";
}
$query->close();
?>
    </table>
    </div>
</div>
</html>