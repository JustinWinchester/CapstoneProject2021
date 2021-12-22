<?php
  require_once '../../config/logindb.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die("Fatal Error");

  $query  = "SELECT * FROM Course";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed");

  $rows = $result->num_rows;
  echo "<table><tr> <th>Course Id</th> <th>Course Name</th><th>Course Credits</th><th>Course ABBR.</th><th>Faculty ID</th><th>Major ID</th></tr>";

  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $result->data_seek($j);
  	$row = $result->fetch_array(MYSQLI_NUM);

  	echo "<tr>";
    for ($k = 0 ; $k < 6 ; ++$k)
      echo "<td>" . htmlspecialchars($row[$k]) . "</td>";
  	echo "</tr>";
  }

  echo "</table>";
?>
