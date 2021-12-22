<?php
  require_once '../logindb.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die("Fatal Error");

  $query  = "SELECT CrsID, CrsName,CrsCredits,CrsAbr FROM Course
UNION
SELECT FacID, FacFirstName, FacLastName,FacOfficePhone FROM Faculty
ORDER BY CrsID";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed");

  $rows = $result->num_rows;
  echo "<table><tr> <th>Id</th> <th>Name</th><th>Crds/Last Name</th><th>CrsAbrev/FacPhone</th></tr>";

  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $result->data_seek($j);
  	$row = $result->fetch_array(MYSQLI_NUM);

  	echo "<tr>";
    for ($k = 0 ; $k < 4 ; ++$k)
      echo "<td>" . htmlspecialchars($row[$k]) . "</td>";
  	echo "</tr>";
  }

  echo "</table>";
?>
