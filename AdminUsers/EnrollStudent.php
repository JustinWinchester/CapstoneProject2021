<?php // sqltest.php
require_once '../inc/header.php';

require_once '../../config/logindb.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Fatal Error");

//if (isset($_GET['id'])) {
//$userid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);
//}
if (isset($_POST['delete']) && isset($_POST['StudID'])) {
    //  $id = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);
    $id   = get_post($conn, 'StudID');
    $query  = "DELETE FROM History WHERE StudID='$id'";
    $result = $conn->query($query);
    if (!$result) echo "DELETE failed<br><br>";
}

if (
    isset($_POST['StudID'])   &&
    isset($_POST['SectID'])
    //isset($_POST['Grade']))
) {
    //  $id = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);
    $id     = get_post($conn, 'StudID');
    $sectid = get_post($conn, 'SectID');
    // $grade   = get_post($conn, 'Grade');

    $query    = "INSERT INTO History VALUES" .
        "('$id','$sectid')";
    $result   = $conn->query($query);
    if (!$result) echo "INSERT failed<br><br>";
}

echo <<<_END
  <div style="width:600px; margin:0px auto">

  <form action="EnrollStudent.php" method="post"><pre>
  <div class="form-group">
    <label for="StudID">Student Identification Number</label>
    <input type="text" name="StudID"  class="form-control">
    </div>
    <div class="form-group">
   <label for="SectID">Section Identification Number</label>
    <input type="text" name="SectID" class="form-control">
    </div>

 <input type="submit" value="ENROLL STUDENT">
  </pre></form>
_END;

$query  = "SELECT * FROM History ";
$result = $conn->query($query);
if (!$result) die("Database access failed");

$rows = $result->num_rows;

for ($j = 0; $j < $rows; ++$j) {
    $row = $result->fetch_array(MYSQLI_NUM);

    $r0 = htmlspecialchars($row[0]);
    $r1 = htmlspecialchars($row[1]);
    $r2 = htmlspecialchars($row[2]);
    echo <<<_END
  <pre>
    StudID ID        $r0
    Section ID $r1
    Grade $r2
      </pre>
  <form action='EnrollStudent.php' method='post'>
  <input type='hidden' name='delete' value='yes'>
  <input type='hidden' name='id' value='$r0'>
  <input type='submit' value='DELETE RECORD'></form>
_END;
}

$result->close();
$conn->close();

function get_post($conn, $var)
{
    return $conn->real_escape_string($_POST[$var]);
}
?>


<div style="width:600px; margin:0px auto">
    <h3><i class="fas fa-users mr-2"></i>Course Catalog <span class="float-right">Welcome! <strong>
        <?php
            $firstname = Session::get('firstname');
            if (isset($firstname)) {
                echo $firstname;
            }
        ?>
        </span></strong></span>
    </h3>



    <table id="datatableid">
        <thead>
            <tr>
                <th class="text-center">Section ID</th>
                <th class="text-center">Major</th>
                <th class="text-center">Course Abreviation</th>
                <th class="text-center">Course Name</th>
                <th class="text-center">Credits</th>
                <th class="text-center">Time</th>
                <th class="text-center">Location</th>
                <th class="text-center">Instructor</th>
                <th class="text-center">Semester</th>
                <th class="text-center">Course Start</th>
                <th class="text-center">Course End</th>
                <th class="text-center">Max Students</th>
            </tr>
        </thead>

        <tbody>
            <?php
                $allUser = $users->selectAllCourseCatalogData();
                if ($allUser) {
                    $i = 0;
                    foreach ($allUser as  $value) {
                        $i++;
            ?>
                <tr class="text-center" <?php if ($value->SectID) {
                                                echo "style='background: ' ";
                                            } ?>>
                    <td><?php echo $value->SectID; ?></td>
                    <td><?php echo $value->DepName . ": "; ?>
                        <?php
                            if ($value->DepID  == '2') {
                                echo "<span class='badge badge-lg badge-info text-white'>Computer Science</span>";
                            } elseif ($value->DepID == '3') {
                                echo "<span class='badge badge-lg badge-dark text-white'>Information Technology</span>";
                            } ?>
                    </td>
                    <td><?php echo $value->CrsAbr; ?></td>
                    <td><?php echo $value->CrsName; ?></td>
                    <td><?php echo $value->CrsCredits; ?></td>
                    <td><?php echo $value->TimeAbr; ?></td>
                    <td><?php echo $value->RoomLocation; ?></td>
                    <td><?php echo $value->FacLastName; ?></td>
                    <td><?php echo $value->SemSemester; ?></td>
                    <td><?php echo $value->SemStart; ?></td>
                    <td><?php echo $value->SemEnd; ?></td>
                    <td><?php echo $value->SectMaxStud; ?></td>

                </tr>
            <?php
                if ($value->DepID == '2') {
                    echo "";
                    }
            ?>

            <?php }
            } else { ?>
                <tr class="text-center">
                    <td><?php echo Session::get("id"); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
include '../inc/footer.php';

?>