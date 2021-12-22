<?php
require_once '../../CRUDOperations/component2.php';
require_once '../../CRUDOperations/operationStudent.php';
require_once '../inc/header.php';

?>


<!--Custom Style Sheet-->
<link rel="stylesheet" href="style.css">

</head>
  <body>
    <main>
      <h1>Hi! : <?= $_SESSION['useremail']?></h1>
        <h2>Your role in the system is : <?= $_SESSION['userrole']?></h2>
          <a href="logout.php">Logout</a>
          <a href="secretaryhome.php">Home</a>
            <div class="container text-center">
              <h1 class="py-4 bg-dark text-light rounded"><i class="fas fa-swatchbook"> Student Records</h1>
                <div class="d-flex justify-content-center">
                  <form action="" method="post" class="w-50">
                  <div>
                    <?php inputElement2("ID", "students_id",setID()); ?>
                  </div>
                  <div>
                    <?php inputElement2("Student First Name", "StudFirstName",""); ?>
                  </div>
                  <div>
                  <div class="col">
                    <?php inputElement2("Student Last Name", "StudLastName",""); ?>
                  </div>
                  <div>
                    <?php inputElement2("Address", "StudAddress",""); ?>
                  </div>
                  <div>
                    <?php inputElement2("City", "StudCity",""); ?>
                  </div>
                  <div>
                    <?php inputElement2("Student Country", "StudCountry",""); ?>
                  </div>
                  <div>
                  <div>
                    <?php inputElement2("Phone", "StudPhone",""); ?>
                  </div>
                  <div>
                    <?php inputElement2("E-Mail", "StudEmail",""); ?>
                  </div>
                  <div>
                    <?php inputElement2("Date Of Birth", "StudDOB",""); ?>
                  </div>
                  <div>
                    <?php inputElement2("Student Enrolled Date", "StudEnrolled",""); ?>
                  </div>
                  <div>
                    <div class="col">
                        <?php inputElement2("Student Password", "StudPassword",""); ?>
                    </div>
                    <div>
                      <?php inputElement2("Student PIN", "StudPin",""); ?>
                    </div>
                    <div>
                      <?php inputElement2( "Major ID", "MajID",""); ?>
                    </div>
                    <div>
                      <?php inputElement2("Classification ID", "ClassID",""); ?>
                    </div>
                  </div>
                  <div class="d-flex justify-content-center">
                    <?php buttonElement("btn-read","btn btn-primary","<i class='fas fa-sync'></i>","read","data-toggle='tooltip' data-placement='bottom' title='Read'"); ?>                  
                  </div>
                  </form>
            </div>
      </div>

<div>
<!-- Output table  -->
<div >
    <table >
        <thead >
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
		<th>City</th>
                <th>Country</th>
                <th>Phone</th>
                <th>E-Mail</th>
		<th>Date Of Birth</th>
                <th>Date Enrolled</th>
                <th>Password</th>
                <th>PIN</th>
		<th>Major ID</th>
                <th>Classification ID</th>

		
                

              </tbody>
            </tr>
        </thead>
<tbody id="tbody">
  <?php
    if(isset($_POST['read'])){
      $result =getData();
    if($result){
      while($row=mysqli_fetch_assoc($result)){
  ?>
  <tr>     
    <td ><?php echo $row['StudID']; ?></td>
    <td ><?php echo $row['StudFirstName']; ?></td>
    <td ><?php echo $row['StudLastName']; ?></td>
    <td ><?php echo $row['StudAddress']; ?></td>
    <td ><?php echo $row['StudCity']; ?></td>
    <td ><?php echo $row['StudCountry']; ?></td>
    <td ><?php echo $row['StudPhone']; ?></td>
	  <td><?php echo $row['StudEmail']; ?></td>
    <td ><?php echo $row['StudDOB']; ?></td>
    <td><?php echo $row['StudEnrolled']; ?></td>
    <td ><?php echo $row['StudPassword']; ?></td>
    <td ><?php echo $row['StudPin']; ?></td>
    <td ><?php echo $row['MajID']; ?></td>
    <td ><?php echo $row['ClassID']; ?></td>
  </tr>
       <?php
     }
   }
}
  ?>
  
</tbody>
</table>
</div>
</main>




<?php
  include 'inc/footer.php';

  ?>

