<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "depreyj-db", "hed5gVlymx3PJKO7", "depreyj-db");
if($mysqli->connect_errno){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
    }

if(!($stmt = $mysqli->prepare("DELETE FROM bookings WHERE EXISTS
                                (SELECT * FROM guests
                                WHERE guests.guest_id = bookings.guest_id
                                AND guests.fname = ? && guests.lname = ? && bookings.booking_id = ?);"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("sss", $_POST['first_name'], $_POST['last_name'], $_POST['booking_id']))){
    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
    echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Your Booking</title>
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
                    Your Current Bookings
                </h2>
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
  <h4>Remove a Booking</h4>
  <form action="remove_guest_booking.php" method="post" role="form" class="form-horizontal">
    <div class="form-group">
      <div class="col-sm-3"><label>Select Booking ID</label>
      <select id="booking_id" name="booking_id" class="form-control">
              <?php
                if(!($query = $mysqli->prepare(
                    "SELECT booking_id
                        FROM bookings b
                        INNER JOIN properties p ON p.prop_id = b.prop_id
                        INNER JOIN guests g ON g.guest_id = b.guest_id
                        WHERE g.fname = ? && g.lname = ?"))){
                    echo "Prepare failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!($query->bind_param("ss", $_POST['first_name'], $_POST['last_name']))){
                    echo "Bind failed: "  . $query1->errno . " " . $query1->error;
                }
                if(!($query->execute())){
                    echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!($query->bind_result($booking_id))){
                    "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                while ($query->fetch()){
                    echo '<option value="'.$booking_id.'"> ' . $booking_id . '</option>\n';
                }
                $query->close();
                ?>
              </select>
        </div>
        <div class="col-sm-1"><label>Guest</label><input type="text" readonly="readonly" id="first_name" name="first_name" class="form-control" value=<?php echo $_POST['first_name']; ?> ></div>
        <div class="col-sm-1"><label>Name</label><input type="text" readonly="readonly" id="last_name" name="last_name" class="form-control" value=<?php echo $_POST['last_name']; ?> ></div>
        </div>
        <button type="submit" class="btn btn-danger">Remove It</button>
    </div>
  </form>
  <hr>
</div>
<div class="container">
  <h4>Update a Booking</h4>
  <form action="update_booking.php" method="post" role="form" class="form-horizontal">
    <div class="form-group">
      <div class="col-sm-3"><label>Select Booking ID</label>
      <select id="booking_id" name="booking_id" class="form-control">
              <?php
                if(!($query = $mysqli->prepare(
                    "SELECT booking_id
                        FROM bookings b
                        INNER JOIN properties p ON p.prop_id = b.prop_id
                        INNER JOIN guests g ON g.guest_id = b.guest_id
                        WHERE g.fname = ? && g.lname = ?"))){
                    echo "Prepare failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!($query->bind_param("ss", $_POST['first_name'], $_POST['last_name']))){
                    echo "Bind failed: "  . $query1->errno . " " . $query1->error;
                }
                if(!($query->execute())){
                    echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!($query->bind_result($booking_id))){
                    "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                while ($query->fetch()){
                    echo '<option value="'.$booking_id.'"> ' . $booking_id . '</option>\n';
                }
                $query->close();
                ?>
              </select>
        </div>
        <div class="col-sm-3"><label>Check-In</label><input type="date" id="beg_date" name="beg_date" class="form-control"></div>
        <div class="col-sm-3"><label>Check-Out</label><input type="date" id="end_date" name="end_date" class="form-control"></div>
        <div class="col-sm-1"><label>Guest</label><input type="text" readonly="readonly" id="first_name" name="first_name" class="form-control" value=<?php echo $_POST['first_name']; ?> ></div>
        <div class="col-sm-1"><label>Name</label><input type="text" readonly="readonly" id="last_name" name="last_name" class="form-control" value=<?php echo $_POST['last_name']; ?> ></div>
        </div>
        <button type="submit" class="btn btn-info">Update It</button>
    </div>
  </form>
  <hr>
</div>
<div class="container">
<h2>Current Bookings</h2>
    <div class="table-responsive">
    <table class="table table-condensed">
        <tr>
            <th>Booking No.</th>
            <th>Guest Name</th>
            <th>Address</th>
            <th>Check-In Date</th>
            <th>Check-Out Date</th>
            <th>Total Cost</th>
        </tr>
        <?php
        if(!($query = $mysqli->prepare("
            SELECT booking_id as 'Booking No.', g.fname as Name, CONCAT(st_address,', ',city,', ',state) AS Address,
                b.beg_date as 'Check-In', b.end_date as 'Check-Out', b.total_cost as Total
                FROM bookings b
                INNER JOIN properties p ON p.prop_id = b.prop_id
                INNER JOIN guests g ON g.guest_id = b.guest_id
                WHERE g.fname = ? && g.lname = ?"))){
            echo "Prepare failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        if(!($query->bind_param("ss", $_POST['first_name'],$_POST['last_name']))){
            echo "Bind failed: "  . $query->errno . " " . $query->error;
        }
        if(!($query->execute())){
            echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        if(!($query->bind_result($booking_id, $name, $address, $beg_date, $end_date, $total_cost))){
            "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        while ($query->fetch()){
            echo "<tr>\n<td>" . $booking_id . "\n</td>\n<td>" . $name . "\n</td>\n<td>" . $address . "\n</td>\n<td>" . $beg_date . "\n</td>\n<td>" . $end_date . "\n</td>\n<td>" . $total_cost . "\n</td>\n</tr>";
        }
        $query->close();
        ?>
    </table>
    </div>
</div>
</html>

