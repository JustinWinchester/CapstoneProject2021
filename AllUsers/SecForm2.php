<?php	
include '../inc/header.php';

Session::CheckSession();

//echo session_id();

$_SESSION['page_count'] = $_SESSION['page_count'] ?? 0;
$_SESSION['page_count']++;

if ($_SESSION['page_count'] > 20){
    echo "Thank you for visiting our website 20 times";
    session_unset();
    session_destroy();
} 

	$sid = $s_first = $s_last = $aid = $major = ''; //Student Variables
	$fid = $f_first = $f_last = $dept = ''; //Faculty (Advisor) Variables
	
	if (isset($_POST['sid'])) $sid = sanitizeString($_POST['sid']); //Student ID
	if (isset($_POST['s_first'])) $s_first = sanitizeString($_POST['s_first']); //Student First Name
	if (isset($_POST['s_last'])) $s_last = sanitizeString($_POST['s_last']); //Student Last Name
	if (isset($_POST['aid'])) $aid = sanitizeString($_POST['aid']); // Advisor ID that is assigned to student
	if (isset($_POST['major'])) $major = sanitizeString($_POST['major']); //Student's Major
	
	if (isset($_POST['fid'])) $fid = sanitizeString($_POST['fid']); //Faculty ID
	if (isset($_POST['f_first'])) $f_first = sanitizeString($_POST['f_first']); //Faculty First Name
	if (isset($_POST['f_last'])) $f_last = sanitizeString($_POST['f_last']); //Faculty Last Name
	if (isset($_POST['dept'])) $dept = sanitizeString($_POST['dept']); //Department of Faculty Member
	
?>	
		
	<html> 
		<head>
			<style>
			.item1 { grid-area: header; }
			.item2 { grid-area: confirm; }
			.item3 { grid-area: student; }
			.item4 { grid-area: faculty; }
			.item5 { grid-area: slist; }
			.item6 { grid-area: flist; }
			
			.grid-container {
			  display: grid;
			  grid-template-areas:
				'header header header header header header'
				'confirm confirm confirm confirm confirm confirm'
				'student student student faculty faculty faculty'
				'slist slist slist flist flist flist';
			  grid-gap: 10px;
			  background-color: white;
			  padding: 10px;
			}
			
			.grid-container > div {
			  background-color: lightgray;
			  text-align: center;
			  padding: 20px 0;
			  font-size: 30px;
			}
			</style>
		 		
			<script type="text/javascript">
			   function sanitizeJava(str) //Sanitize Selected Value in Scroll
			   {
    					str = str.replace(/[^a-z0-9αινσϊρό \.,_-]/gim,"");
    					return str.trim();
			   }		
				
			   function changeFunc1() { //Get Selected Student ID in Scroll and put in top text box
					var selectBox1 = document.getElementById("selectBox1");
					var selectedValue = sanitizeJava(selectBox1.options[selectBox1.selectedIndex].value);
					
					var student = document.getElementById("studID");
					student.value = selectedValue;
			   }
			   
			   function changeFunc2() { //Get Selected Faculty ID in Scroll and put in top text box
					var selectBox2 = document.getElementById("selectBox2");
					var selectedValue = sanitizeJava(selectBox2.options[selectBox2.selectedIndex].value);
					
					var faculty = document.getElementById("facID");
					faculty.value = selectedValue;
			   }
			
			</script>
		</head>
			
		<body>
		
				
			<div class="grid-container">
			  <div class="item1">Assign Student</div>
			  <div class="item2">
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					Assign <input type="text" id="studID" name="studID" placeholder="Student ID"> to 
					<input type="text" id="facID" name="facID" placeholder="Faculty ID">
					
					<input type="hidden" name="s_first" value="<?php echo htmlspecialchars($s_first);?>"> <!-- Hidden types for data retention in form -->
				    <input type="hidden" name="s_last" value="<?php echo htmlspecialchars($s_last);?>">
					<input type="hidden" name="sid" value="<?php echo htmlspecialchars($sid);?>">
					<input type="hidden" name="major" value="<?php echo htmlspecialchars($major);?>">
					<input type="hidden" name="aid" value="<?php echo htmlspecialchars($aid);?>">
					<input type="hidden" name="f_first" value="<?php echo htmlspecialchars($f_first);?>">
					<input type="hidden" name="f_last" value="<?php echo htmlspecialchars($f_last);?>">
					<input type="hidden" name="fid" value="<?php echo htmlspecialchars($fid);?>">
					<input type="hidden" name="dept" value="<?php echo htmlspecialchars($dept);?>">
					
					<input type="submit" name="confirm" value="confirm">
				</form>

			<?php 
				if(isset($_POST['confirm'])) //If confirm is hit try to assign student to adviser
				{
					$conn = new mysqli("localhost", "cs12", "CUaDGKK8", "cs12");
					if ($conn->connect_error) die("Fatal Error");
					
					$facID = sanitizeMySql($conn, $_POST['facID']); 
					$studID = sanitizeMySql($conn, $_POST['studID']);
					
					if(!empty($facID) && !empty($studID))
					{
						$exists = "SELECT * FROM Adviser WHERE StudID = $studID"; //Check if student exists in adviser table
						$checkExists = mysqli_query($conn, $exists);

						$validStudent = "SELECT StudID, StudFirstName, StudLastName FROM Student WHERE StudID = $studID"; //Used to check if student exists and to query
						$checkValidStudent = mysqli_query($conn, $validStudent);
						if(!$checkValidStudent) die("Fatal Error");
						$student = $checkValidStudent->fetch_array(MYSQLI_ASSOC);


						$validFaculty = "SELECT FacID, FacFirstName, FacLastName FROM Faculty WHERE FacID = $facID"; //Used to check if faculty exists and to query
						$checkValidFaculty = mysqli_query($conn, $validFaculty);
						if(!$checkValidFaculty) die("Fatal Error");
						$adviser = $checkValidFaculty->fetch_array(MYSQLI_ASSOC);

						$update = "UPDATE Adviser
							   SET FacID = $facID
						   	   WHERE StudID = $studID";
					
						if(mysqli_num_rows($checkExists) > 0 && mysqli_num_rows($checkValidStudent) > 0 && mysqli_num_rows($checkValidFaculty) > 0) 
						{											//Check if student is in Adviser Table and Student Exists and Faculty Exists
							$alter = mysqli_query($conn, $update); //Since student already in Adviser Table just assign the faculty id in the same row
							if(!$alter) die("Fatal Error");
						
							echo "Successful!  " . 
						     	     "(" . htmlspecialchars($student['StudID']) . " " . htmlspecialchars($student['StudFirstName']) . " " . htmlspecialchars($student['StudLastName']) . ")" .
						     	     " Assigned to " . 
						     	     "(" . htmlspecialchars($adviser['FacID']) . " " . htmlspecialchars($adviser['FacFirstName']) . " " . htmlspecialchars($adviser['FacLastName']) . ")";
						
						}
						elseif(mysqli_num_rows($checkValidStudent) > 0 && mysqli_num_rows($checkValidFaculty) > 0) //INSERT if student and faculty exists but student doesn't exist in adviser's table
						{
							$insertQuery = "INSERT INTO Adviser VALUES($studID, $facID)"; //Needs to be inserted because student doesn't exist in adviser table yet
						
							$insert = mysqli_query($conn, $insertQuery);
							if(!$insert) die("Fatal Error");
						
							echo "Successful!!  " . 
						     	     "(" . htmlspecialchars($student['StudID']) . " " . htmlspecialchars($student['StudFirstName']) . " " . htmlspecialchars($student['StudLastName']) . ")" .
						    	     " Assigned to " . 
						     	     "(" . htmlspecialchars($adviser['FacID']) . " " . htmlspecialchars($adviser['FacFirstName']) . " " . htmlspecialchars($adviser['FacLastName']) . ")";
					
						}
						else
						{
							echo "Incompatible Student or Faculty";
						}
					}
					else
					{
						echo 'Must Input Value';
					}
					mysqli_close($conn);
				} 
			?>
			  </div>
			  
			  <div class="item3">Student<br>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					First Name: <input type="text" name="s_first" placeholder="any" value="<?php echo htmlspecialchars($s_first);?>">
					Advisor ID: <input type="text" name="aid" placeholder="any" value="<?php echo htmlspecialchars($aid);?>"> <br />
					Last Name: <input type="text" name="s_last" placeholder="any" value="<?php echo htmlspecialchars($s_last);?>"> <br />
					Student ID: <input type="text" name="sid" placeholder="any" value="<?php echo htmlspecialchars($sid);?>">
					Major: 	<select name="major" size="1">
								<option value="">any</option>
								<option value="CS">CS</option>
								<option value="IT">IT</option>
							</select> <br />
							
							    <input type="hidden" name="f_first" value="<?php echo htmlspecialchars($f_first);?>"> <!-- Hidden types for data retention in form -->
							    <input type="hidden" name="f_last" value="<?php echo htmlspecialchars($f_last);?>">
							   	<input type="hidden" name="fid" value="<?php echo htmlspecialchars($fid);?>">
								<input type="hidden" name="dept" value="<?php echo htmlspecialchars($dept);?>">
								
					<input type="submit" id="search_students" name="search_students" value="Search Students">
				</form>
			  </div>
			  
			  <div class="item4">Faculty<br>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					First Name: <input type="text" name="f_first" placeholder="any" value="<?php echo htmlspecialchars($f_first);?>">
					Faculty ID: <input type="text" name="fid" placeholder="any" value="<?php echo htmlspecialchars($fid);?>"> <br />
					Last Name:  <input type="text" name="f_last" placeholder="any" value="<?php echo htmlspecialchars($f_last);?>">
					Department: <select name="dept" size="1">
									<option value="">any</option>
									<option value="CS">CS</option>
									<option value="IT">IT</option>
									<option value="STAFF">STAFF</option>
								</select> <br />
								
							    <input type="hidden" name="s_first" value="<?php echo htmlspecialchars($s_first);?>"> <!-- Hidden types for data retention in form -->
							    <input type="hidden" name="s_last" value="<?php echo htmlspecialchars($s_last);?>">
							   	<input type="hidden" name="sid" value="<?php echo htmlspecialchars($sid);?>">
								<input type="hidden" name="major" value="<?php echo htmlspecialchars($major);?>">
								<input type="hidden" name="aid" value="<?php echo htmlspecialchars($aid);?>">
								
					<input type="submit" id="seach_faculty" name="search_faculty" value="Search Faculty">
				</form>
			  </div>
			  
			  <div class="item5">SID firstname lastname major <br />
					<select id="selectBox1" size="10" onchange="changeFunc1();">
					   <option value="" disabled selected>SID     First_Name     Last_Name     Major</option>
					   <?php
							$conn = new mysqli("localhost", "cs12", "CUaDGKK8", "cs12");
							if ($conn->connect_error) die("Fatal Error");
							
							$sid = sanitizeMySql($conn, $_POST['sid']);
							$s_first = sanitizeMySql($conn, $_POST['s_first']);
							$s_last = sanitizeMySql($conn, $_POST['s_last']);
							$aid = sanitizeMySql($conn, $_POST['aid']);
							$major = sanitizeMySql($conn, $_POST['major']);
							
							if($aid != '')
							{
								$query = "SELECT DISTINCT a.StudID, a.StudFirstName, a.StudLastName, b.MajName, c.FacID
									  FROM Student a, Major b, Adviser c
									  WHERE a.MajID = b.MajID and
										    a.StudID like '%$sid%' and
									        a.StudFirstName like '%$s_first%' and
										    a.StudLastName like '%$s_last%' and
										    b.MajName like '%$major%' and
										    c.FacID like '%$aid%' and
										    c.StudID = a.StudID
									  ORDER BY a.StudLastName";
							}
							else
							{
								$query = "SELECT DISTINCT a.StudID, a.StudFirstName, a.StudLastName, b.MajName, c.FacID
									  FROM Student a, Major b, Adviser c
									  WHERE a.MajID = b.MajID and
										    a.StudID like '%$sid%' and
									        a.StudFirstName like '%$s_first%' and
										    a.StudLastName like '%$s_last%' and
										    b.MajName like '%$major%' and
										    c.StudID = a.StudID
									  ORDER BY a.StudLastName";
							}

							$result = $conn->query($query);
							if (!$result) die("Fatal Error");
														
							$rows = $result->num_rows;
							for ($i = 0; $i < $rows; $i++)
							{
								$row = $result->fetch_array(MYSQLI_ASSOC);
								echo '<option value=' . htmlspecialchars($row['StudID']) . '>' . 
														htmlspecialchars($row['StudID']) . "  " .
														htmlspecialchars($row['StudFirstName']) . "  " .
            											htmlspecialchars($row['StudLastName']) . "  " . 
														htmlspecialchars($row['MajName']) . "  " .
														htmlspecialchars($row['FacID']) . '</option>';
							}
							
							$result->close();
							$conn->close(); 
					   ?>
					</select>
			  </div>
			  <div class="item6">FID firstname lastname deptID <br />
					<select id="selectBox2" size="10" onchange="changeFunc2();">
					   <option value="" disabled selected>FID     First_Name     Last_Name     Department</option>
					   <?php
							$conn = new mysqli("localhost", "cs12", "CUaDGKK8", "cs12");
							if ($conn->connect_error) die("Fatal Error");
							
							$fid = sanitizeMySql($conn, $_POST['fid']);
							$f_first = sanitizeMySql($conn, $_POST['f_first']);
							$f_last = sanitizeMySql($conn, $_POST['f_last']);
							$dept = sanitizeMySql($conn, $_POST['dept']);


							$query = "SELECT DISTINCT a.FacID, a.FacFirstName, a.FacLastName, b.DepName
								      FROM Faculty a, Department b 
								      WHERE a.DepID = b.DepID and
									        a.FacID like '%$fid%' and
									        a.FacFirstName like '%$f_first%' and 
									        a.FacLastName like '%$f_last%' and
									        b.DepName like '%$dept%' and
											a.RoleID = 2
								      ORDER BY a.FacLastName";
							$result = $conn->query($query);
							if (!$result) die("Fatal Error");
							
							$rows = $result->num_rows;
							for ($i = 0; $i < $rows; $i++)
							{
								$row = $result->fetch_array(MYSQLI_ASSOC);
								echo '<option value=' . htmlspecialchars($row['FacID']) . '>' . 
														htmlspecialchars($row['FacID']) . "  " .
														htmlspecialchars($row['FacFirstName']) . "  " .
            											htmlspecialchars($row['FacLastName']) . "  " . 
														htmlspecialchars($row['DepName']) . '</option>';
							}
							
							$result->close();
							$conn->close();
					   ?>
					</select>
			  </div>
			</div>
		</body>
	</html>


<?php
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
    <?php
  include '../inc/footer.php';

  ?>

