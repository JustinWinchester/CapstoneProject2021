<?php
include'../../config/database.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>PRINT SCHEDULE C U ENROLL ME</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>User Data</h2>
      <table class="table table-bordered print">
        <thead>
          <tr>
            <th>Sec Row No</th>
            <th>Section ID</th>
            <th>Section Max Students</th>
		 <th>Semester</th>
            <th>Semester Year</th>
            <th>Semester Start Date</th>
 <th>End Date</th>
            <th>TimeAbr</th>
            <th>RoomLocation</th>
 <th>CrsName</th>
            <th>CrsCredits</th>
            <th>CrsAbr</th>
 <th>FacID</th>
            <th>FacLastName</th>
            <th>Department Identification</th>
<th>Department Name</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sn=1;
          $user_qry="SELECT * from CourseCatalog";
          $user_res=mysqli_query($con,$user_qry);
          while($user_data=mysqli_fetch_assoc($user_res))
          {
          ?>
          <tr>
            <td><?php echo $sn; ?></td>
            <td><?php echo $user_data['SectID']; ?></td>
            <td><?php echo $user_data['SectMaxStud']; ?></td>
        <td><?php echo $user_data['SemSemester']; ?></td>
            <td><?php echo $user_data['SemYear']; ?></td>
<td><?php echo $user_data['SemStart']; ?></td>
            <td><?php echo $user_data['SemEnd']; ?></td>
<td><?php echo $user_data['TimeAbr']; ?></td>
            <td><?php echo $user_data['RoomLocation']; ?></td>
<td><?php echo $user_data['CrsName']; ?></td>
            <td><?php echo $user_data['CrsCredits']; ?></td>
<td><?php echo $user_data['CrsAbr']; ?></td>
            <td><?php echo $user_data['FacID']; ?></td>
<td><?php echo $user_data['FacLastName']; ?></td>
            <td><?php echo $user_data['DepID']; ?></td>
	  <td><?php echo $user_data['DepName']; ?></td>

	</tr>
          <?php
          $sn++;
          }
          ?>
        </tbody>
      </table>

      <div class="text-center">
        <a href="user_data_print.php" class="btn btn-primary">Print</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>
