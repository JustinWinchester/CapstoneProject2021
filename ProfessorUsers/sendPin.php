<?php //For viewAdvisees Page

	if (isset($_POST['student_id'])) //From ajax on viewAdvisees page
	{	
		$conn = new mysqli("localhost", "cs12", "CUaDGKK8", "cs12");
		if ($conn->connect_error) die("Fatal Error");
							
		$sid = sanitizeMySql($conn, $_POST['student_id']); //get student id

		$query = "SELECT StudEmail, StudPin 
				  FROM Student 
				  WHERE StudID = $sid";
		$result = $conn->query($query);
		$row = $result->fetch_assoc();
		
		$to = htmlspecialchars($row['StudEmail']);
        $subject = "Enrollment Pin";
         
        $message = "Your Enrollment Pin: " . htmlspecialchars($row['StudPin']);
         $header = "From: NoReply@wolverine.cameron.edu \r\n";
         $header .= "Cc: \r\n";
         $header .= "MIME-Version: ";
         $header .= "Content-type: text/html\r\n";
		 
        $retval = mail ($to,$subject,$message,$header);
         
        if( $retval == true ) {
           echo "Message sent successfully...";
        }else {
           echo "Message could not be sent...";
        }
		 
		//mail(htmlspecialchars($row['StudEmail']), "Enrollment Pin", htmlspecialchars($row['StudPin']));
		
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