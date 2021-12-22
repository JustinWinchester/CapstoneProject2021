<?php
	include '../inc/header.php';

	Session::CheckSession();

	$pin = ''; //Instantiate Pin
	$sid = ''; //Instantiate Student ID
	
	if (isset($_POST['pin'])) $pin = sanitizeString($_POST['pin']); //Student Enrollment Pin

    $sid = Session::get('id');
?>

<html> <!-- Enter Pin Form -->
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<b>Enter Enrollment Pin:</b> <input type="text" id="pin" name="pin" placeholder="pin number">	
		<input type="submit" name="confirm" value="confirm">
	</form>
</html>

<?php //Getting the student's correct pin for comparison
	if (isset($_POST['pin']))
	{
		$correct_pin = '';

		$conn = new mysqli("localhost", "cs12", "CUaDGKK8", "cs12");
		if ($conn->connect_error) die("Fatal Error");
							
		$pin = sanitizeMySql($conn, $_POST['pin']);

		$query = "SELECT StudPin
				  FROM Student
				  WHERE StudID = $sid";

		$result = $conn->query($query);
		if (!$result) die("Fatal Error");
														
		$row = $result->fetch_array(MYSQLI_ASSOC);
	
		$correct_pin = htmlspecialchars($row['StudPin']);
							
		$result->close();
		$conn->close(); 
	
	
		if(htmlspecialchars($row['StudPin']) == $pin) //Pin entered correctly
		{
				 ?>
					<form method="post" action="../AllUsers/CUENROLL.php" id="pinForm">
					<input type="hidden" id="pin_correct" name="pin_correct" value="true">	
					<input type="submit" style="display: none;">
					</form>
					<script type="text/javascript">
						document.getElementById("pinForm").submit();
					</script>
				 <?php
		}
		else //Pin entered incorrectly
		{
			echo "<br>Incorrect Pin";	
		}
	
	}
?>


<?php //Sanitize string functions

	function sanitizeString($var)
    {
    	if(get_magic_quotes_gpc())
        	$var = stripslashes($var);
        $var = strip_tags($var);
        $var = htmlentities($var);
        return $var;
    }  
		
	function sanitizeMySql($conn, $var)
	{
		$var = $conn->real_escape_string($var);
		$var = sanitizeString($var);
		return $var;
	}

?>