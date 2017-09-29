<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "depreyj-db", "hed5gVlymx3PJKO7", "depreyj-db");
if($mysqli->connect_errno){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
    }

if(!($stmt = $mysqli->prepare("DELETE w, wp
                                FROM wishlists AS w INNER JOIN wishlist_props AS wp ON w.list_id = wp.list_id
                                INNER JOIN guests AS g ON g.guest_id = w.guest_id
                                WHERE g.fname = ? && g.lname = ? && w.listname = ?"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("sss", $_POST['first_name'], $_POST['last_name'], $_POST['listname']))){
    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
    echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Your Wishlists</title>
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
                    Your Wishlists
                </h2>
                <p>
                    View Favorite Properties
                </p>
            </div><span class="label label-default"></span>
        </div>
    </div>
</div>

<div class="container">
    <h2>Your Wishlists</h2>
    <div class="table-responsive">
    <table class="table table-condensed">
        <tr>
            <th>List ID</th>
            <th>List Name</th>
        </tr>
        <?php
        if(!($query = $mysqli->prepare(
            "SELECT wishlists.list_id as 'ID no.', listname as 'My Wishlists'
                FROM wishlists
                INNER JOIN guests g ON g.guest_id = wishlists.guest_id
                WHERE g.fname = ? && g.lname = ?"))){
            echo "Prepare failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        if(!($query->bind_param("ss", $_POST['first_name'], $_POST['last_name']))){
            echo "Bind failed: "  . $query1->errno . " " . $query1->error;
        }
        if(!($query->execute())){
            echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        if(!($query->bind_result($list_id, $listname))){
            "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        while ($query->fetch()){
            echo "<tr>\n<td>" . $list_id . "\n</td>\n<td>" . $listname . "\n</td>\n</tr>";
        }
        $query->close();
        ?>
    </table>
    </div>
</div>
<div class="container">
  <h2>Remove Wishlist</h2>
  <form action="remove_wishlist.php" method="post" role="form" class="form-horizontal">
    <div class="form-group">
      <div class="col-sm-3"><label>Select List</label>
      <select id="listname" name="listname" class="form-control">
          <?php
          if(!($stmt = $mysqli->prepare("SELECT wishlists.listname
                FROM wishlists
                INNER JOIN guests g ON g.guest_id = wishlists.guest_id
                WHERE g.fname = ? && g.lname = ?"))){
            echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
          }
          if(!($stmt->bind_param("ss", $_POST['first_name'], $_POST['last_name']))){
                    echo "Bind failed: "  . $query1->errno . " " . $query1->error;
                }
          if(!$stmt->execute()){
            echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }
          if(!$stmt->bind_result($listname)){
            echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
          }
          while($stmt->fetch()){
           echo '<option value="'.$listname.'"> ' . $listname . '</option>\n';
          }
          $stmt->close();
          ?>
          </select>
        </div>
        <div class="col-sm-1"><label>Guest</label><input type="text" readonly="readonly" id="first_name" name="first_name" class="form-control" value=<?php echo $_POST['first_name']; ?> ></div>
        <div class="col-sm-1"><label>Name</label><input type="text" readonly="readonly" id="last_name" name="last_name" class="form-control" value=<?php echo $_POST['last_name']; ?> ></div>
    </div>
      <div class="col-sm-3">
        <button type="submit" class="btn btn-danger pull-left">Remove It</button>
      </div>
    </div>
  </form>
  <hr>
</div>

<div class="container">
  <h2>Add to Wishlist</h2>
  <form action="wishlist_it.php" method="post" role="form" class="form-horizontal">
    <div class="form-group">
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
           echo '<option value="'.$prop_id.'"> ' . $prop_id . '</option>\n';
          }
          $stmt->close();
          ?>
          </select>
        </div>
        <div class="col-sm-3"><label>Select List</label>
            <select id="listname" name="listname" class="form-control">
              <?php
                if(!($query = $mysqli->prepare(
                    "SELECT listname
                        FROM wishlists
                        INNER JOIN guests g ON g.guest_id = wishlists.guest_id
                        WHERE g.fname = ? && g.lname = ?"))){
                    echo "Prepare failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!($query->bind_param("ss", $_POST['first_name'], $_POST['last_name']))){
                    echo "Bind failed: "  . $query1->errno . " " . $query1->error;
                }
                if(!($query->execute())){
                    echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                if(!($query->bind_result($listname))){
                    "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                while ($query->fetch()){
                    echo '<option value="'.$listname.'"> ' . $listname . '</option>\n';
                }
                $query->close();
                ?>
              </select>
        </div>
        <div class="col-sm-1"><label>Guest</label><input type="text" readonly="readonly" id="first_name" name="first_name" class="form-control" value=<?php echo $_POST['first_name']; ?> ></div>
        <div class="col-sm-1"><label>Name</label><input type="text" readonly="readonly" id="last_name" name="last_name" class="form-control" value=<?php echo $_POST['last_name']; ?> ></div>
    </div>
      <div class="col-sm-3">
        <button type="submit" class="btn btn-info pull-left">Add It</button>
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

