<?php
$mysqli = NEW MySQLi('localhost', 'cs12','CUaDGKK8', 'cs12' );
$resultset = $mysqli ->query ("SELECT StudFirstName FROM Student ");

$color1 = "teal";
$color2 = "lightblue";
$color = $color1;

?>
<select name="Students">
  <?php
  while($rows = $resultset->fetch_assoc())
  {
    $color == $color1 ? $color = $color2 : $color = $color1;
    $studentname  = $rows['StudFirstName'];
            echo "<option value='$studentname' style = 'background:$color; color : white' >$studentname</option>";
  }
  ?>
</select>
