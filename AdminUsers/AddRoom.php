
<?php // sqltest.php
// requirements
require_once '../inc/header.php';
require_once '../../config/logindb.php';
// connection to database
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Fatal Error");

// deletes room from table
if (isset($_POST['delete']) && isset($_POST['RoomID'])) {
    $id   = get_post($conn, 'RoomID');
    $query  = "DELETE FROM Time WHERE RoomID='$id'";
    $result = $conn->query($query);
    if (!$result) echo "DELETE failed<br><br>";
}

//checks if data is set
if (
    isset($_POST['RoomID'])   &&
    isset($_POST['RoomLocation'])
) {

    $id         = get_post($conn, 'RoomID');
    $roomloc   = get_post($conn, 'RoomLocation');

    // inserts into room table
    $query    = "INSERT INTO Room VALUES" .
        "('$id','$roomloc')";
    $result   = $conn->query($query);
    if (!$result) echo "INSERT failed<br><br>";
}
// form to input new room
echo <<<_END


  <div style="width:100%; margin:0px auto">

  <form action="AddRoom.php" method="post"><pre>
  <div class="form-group">
    <label for="RoomID">Room Identification Number</label>
    <input type="text" name="RoomID"  class="form-control">
    </div>
    <div class="form-group">
   <label for="SectID">Room's Location</label>
    <input type="text" name="RoomLocation" class="form-control">
    </div>

              <input type="submit" value="ADD NEW ROOM DATA">
  </pre></form>
  
_END;

// queries and displays all rooms
$query  = "SELECT * FROM Room";
$result = $conn->query($query);
if (!$result) die("Database access failed");

$rows = $result->num_rows;

for ($j = 0; $j < $rows; ++$j) {
    $row = $result->fetch_array(MYSQLI_NUM);

    $r0 = htmlspecialchars($row[0]);
    $r1 = htmlspecialchars($row[1]);
    echo <<<_END
  <pre>
    Room ID        $r0
    Room Location $r1
    <form action='AddRoom.php' method='post'>
      <input type='hidden' name='delete' value='yes'>
      <input type='hidden' name='id' value='$r0'>
      <input type='submit' value='DELETE RECORD'>
    </form>
  </pre>
_END;
}

$result->close();
$conn->close();

function get_post($conn, $var)
{
    return $conn->real_escape_string($_POST[$var]);
}
?>

<?php
include '../inc/footer.php';

?>
