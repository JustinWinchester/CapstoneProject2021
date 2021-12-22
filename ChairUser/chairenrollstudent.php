<?php
require_once("../../CRUDOperations/component2.php");
require_once("../../CRUDOperations/operationStudent.php");
require_once '../inc/header.php';




  
Session::CheckSession();
  if(!isset($_SESSION['email']) || $_SESSION['roleid'] != "3"
){
  header("location:index.html");
}




?>

<body>
<main>
<h2>Your role in the system is : <?= $_SESSION['roleid']?></h2>
<a href="logout.php">Logout</a><a href="chairhome.php">HOME</a>
<h1>Hi! : <?= $_SESSION['email']?></h1>

<div class="container text-center">

  <h1 class="py-4 bg-dark text-light rounded"><i class="fas fa-swatchbook"</i> Student Records</h1>
<div class="d-flex justify-content-center">
  <form action="" method="post" class="w-50">
    <div class="pt-2">
    <?php inputElement("<i class='fas fa-id-badge'></i>","ID", "student_id",setID()); ?>
</div>
<div class="pt-2">
    <?php inputElement("<i class='fas fa-book'></i>","Student First Name", "SFirstName",""); ?>
</div>
<div class="pt-2">
    <div class="col">
        <?php inputElement("<i class='fas fa-people-carry'></i>","Student Last Name", "SLastName",""); ?>
    </div>
    <div class="pt-2">
        <?php inputElement("<i class='fas fa-book'></i>","Address", "SAddress",""); ?>
      </div>
 <div class="pt-2">
<?php inputElement("<i class='fas fa-id-badge'></i>","City", "SCity",""); ?>
</div>
<div class="pt-2">
    <?php inputElement("<i class='fas fa-book'></i>","Student Country", "SCountry",""); ?>
</div>
<div class="pt-2">
    <div class="pt-2">
        <?php inputElement("<i class='fas fa-people-carry'></i>","Phone", "SPhone",""); ?>
    </div>
    <div class="pt-2">
        <?php inputElement("<i class='fas fa-book'></i>","E-Mail", "SEmail",""); ?>
      </div>
 <div class="pt-2">
<?php inputElement("<i class='fas fa-id-badge'></i>","Date Of Birth", "SDOB",""); ?>
</div>
<div class="pt-2">
    <?php inputElement("<i class='fas fa-book'></i>","Student Enrolled Date", "SEnrolled",""); ?>
</div>
<div class="pt-2">
    <div class="col">
        <?php inputElement("<i class='fas fa-people-carry'></i>","Student Password", "SPassword",""); ?>
    </div>
    <div class="pt-2">
        <?php inputElement("<i class='fas fa-book'></i>","Student PIN", "SPin",""); ?>
      </div>
 <div class="pt-2">
<?php inputElement("<i class='fas fa-id-badge'></i>","Faculty/Adviser ID", "FID",""); ?>
</div>
<div class="pt-2">
    <?php inputElement("<i class='fas fa-book'></i>","Student MajorID", "MID",""); ?>
</div>
</div>
      <div class="d-flex justify-content-center">
              <?php buttonElement("btn-create","btn btn-success","<i class='fas fa-plus'></i>","create","data-toggle='tooltip' data-placement='bottom' title='Create'"); ?>
              <?php buttonElement("btn-read","btn btn-primary","<i class='fas fa-sync'></i>","read","data-toggle='tooltip' data-placement='bottom' title='Read'"); ?>
              <?php buttonElement("btn-update","btn btn-light border","<i class='fas fa-pen-alt'></i>","update","data-toggle='tooltip' data-placement='bottom' title='Update'"); ?>
                     </div>
  </form>
</div>
</div>
<div>
<!-- Bootstrap table  -->
<div class="d-flex table-data">
    <table class="table table-striped table-dark">
        <thead class="thead-dark">
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
                <th>Student Password</th>
                <th>Student PIN</th>
		<th>AdviserID</th>
                <th>MajorID</th>

		
                <th>Edit</th>

              </tbody>
            </tr>
        </thead>
<tbody id="tbody">
<?php
if(isset($_POST['read'])){
  $result =getData();
   if($result){
     while($row=mysqli_fetch_assoc($result)){?>
       <tr>
         <td data-id="<?php echo $row['SID']; ?>"><?php echo $row['SID']; ?></td>
          <td data-id="<?php echo $row['SID']; ?>"><?php echo $row['SFirstName']; ?></td>
          <td data-id="<?php echo $row['SID']; ?>"><?php echo $row['SLastName']; ?></td>
          <td data-id="<?php echo $row['SID']; ?>"><?php echo $row['SAddress']; ?></td>
          <td data-id="<?php echo $row['SID']; ?>"><?php echo $row['SCity']; ?></td>
          <td data-id="<?php echo $row['SID']; ?>"><?php echo $row['SCountry']; ?></td>
          <td data-id="<?php echo $row['SID']; ?>"><?php echo $row['SPhone']; ?></td>
	  <td data-id="<?php echo $row['SID']; ?>"><?php echo $row['SEmail']; ?></td>
          <td data-id="<?php echo $row['SID']; ?>"><?php echo $row['SDOB']; ?></td>
          <td data-id="<?php echo $row['SID']; ?>"><?php echo $row['SEnrolled']; ?></td>
       	<td data-id="<?php echo $row['SID']; ?>"><?php echo $row['SPassword']; ?></td>
          <td data-id="<?php echo $row['SID']; ?>"><?php echo $row['SPin']; ?></td>
          <td data-id="<?php echo $row['SID']; ?>"><?php echo $row['FID']; ?></td>
	<td data-id="<?php echo $row['SID']; ?>"><?php echo $row['MID']; ?></td>
	<td ><i class="fas fa-edit btnedit" data-id="<?php echo $row['SID']; ?>"></i></td>
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



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script><script src="main.js"></script>
<?php
  include 'inc/footer.php';

  ?>
