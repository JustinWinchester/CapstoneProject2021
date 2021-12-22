<?php //For viewAdvisees Page

	if (isset($_POST['student_id'])) //From ajax on viewAdvisees page
	{
		$new_pin = rand(10000000, 99999999); //generate random pin
		
		$conn = new mysqli("localhost", "cs12", "CUaDGKK8", "cs12");
		if ($conn->connect_error) die("Fatal Error");
							
		$sid = sanitizeMySql($conn, $_POST['student_id']); //get student id

		$query = "UPDATE Student
				  SET StudPin = $new_pin
				  WHERE StudID = $sid";
		$result = $conn->query($query);
		
		mysqli_close($conn);
	}
	

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