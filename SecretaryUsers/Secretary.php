<?php
require_once '../../CRUDOperations/component2.php';
require_once '../../CRUDOperations/operationStudent.php';
?>
<?php
  require_once '../inc/header.php';
Session::CheckSession();
  if(!isset($_SESSION['email']) || $_SESSION['roleid'] != "4"
){
  header("location:index.html");
}




?>


<!--Custom Style Sheet-->
<link rel="stylesheet" href="style.css">
</head>
<body>
<main>
<h1>Hi! : <?= $_SESSION['email']?></h1>
<h2>Your role in the system is : <?= $_SESSION['roleid']?></h2>
<a href="logout.php">Logout</a><a href="secretaryhome.php">Home</a>

<div class="container text-center">

  <h1 class="py-4 bg-dark text-light rounded"><i class="fas fa-swatchbook"</i> Student Records</h1>
<div class="d-flex justify-content-center">
  <form action="" method="post" class="w-50">
    <div class="pt-2">
    <?php inputElement("<i class='fas fa-id-badge'></i>","ID", "students_id",setID()); ?>
</div>
<div class="pt-2">
    <?php inputElement("<i class='fas fa-book'></i>","Student First Name", "StudFirstName",""); ?>
</div>
<div class="pt-2">
    <div class="col">
        <?php inputElement("<i class='fas fa-people-carry'></i>","Student Last Name", "StudLastName",""); ?>
    </div>
    <div class="pt-2">
        <?php inputElement("<i class='fas fa-book'></i>","Address", "StudAddress",""); ?>
      </div>
 <div class="pt-2">
<?php inputElement("<i class='fas fa-id-badge'></i>","City", "StudCity",""); ?>
</div>
<div class="pt-2">
    <?php inputElement("<i class='fas fa-book'></i>","Student Country", "StudCountry",""); ?>
</div>
<div class="pt-2">
    <div class="pt-2">
        <?php inputElement("<i class='fas fa-people-carry'></i>","Phone", "StudPhone",""); ?>
    </div>
    <div class="pt-2">
        <?php inputElement("<i class='fas fa-book'></i>","E-Mail", "StudEmail",""); ?>
      </div>
 <div class="pt-2">
<?php inputElement("<i class='fas fa-id-badge'></i>","Date Of Birth", "StudDOB",""); ?>
</div>
<div class="pt-2">
    <?php inputElement("<i class='fas fa-book'></i>","Student Enrolled Date", "StudEnrolled",""); ?>
</div>
<div class="pt-2">
    <div class="col">
        <?php inputElement("<i class='fas fa-people-carry'></i>","Student Password", "StudPassword",""); ?>
    </div>
    <div class="pt-2">
        <?php inputElement("<i class='fas fa-book'></i>","Student PIN", "StudPin",""); ?>
      </div>
 <div class="pt-2">
<?php inputElement("<i class='fas fa-id-badge'></i>", "Major ID", "MajID",""); ?>
</div>
<div class="pt-2">
    <?php inputElement("<i class='fas fa-book'></i>","Classification ID", "ClassID",""); ?>
</div>
</div>
      <div class="d-flex justify-content-center">
                         <?php buttonElement("btn-read","btn btn-primary","<i class='fas fa-sync'></i>","read","data-toggle='tooltip' data-placement='bottom' title='Read'"); ?>
                           
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
		<th>Major ID</th>
                <th>Classification ID</th>

		
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
        <td data-id="<?php echo $row['StudID']; ?>"><?php echo $row['StudID']; ?></td>
          <td data-id="<?php echo $row['StudID']; ?>"><?php echo $row['StudFirstName']; ?></td>
          <td data-id="<?php echo $row['StudID']; ?>"><?php echo $row['StudLastName']; ?></td>
          <td data-id="<?php echo $row['StudID']; ?>"><?php echo $row['StudAddress']; ?></td>
          <td data-id="<?php echo $row['StudID']; ?>"><?php echo $row['StudCity']; ?></td>
          <td data-id="<?php echo $row['StudID']; ?>"><?php echo $row['StudCountry']; ?></td>
          <td data-id="<?php echo $row['StudID']; ?>"><?php echo $row['StudPhone']; ?></td>
	  <td data-id="<?php echo $row['StudID']; ?>"><?php echo $row['StudEmail']; ?></td>
          <td data-id="<?php echo $row['StudID']; ?>"><?php echo $row['StudDOB']; ?></td>
          <td data-id="<?php echo $row['StudID']; ?>"><?php echo $row['StudEnrolled']; ?></td>
       	<td data-id="<?php echo $row['StudID']; ?>"><?php echo $row['StudPassword']; ?></td>
          <td data-id="<?php echo $row['StudID']; ?>"><?php echo $row['StudPin']; ?></td>
          <td data-id="<?php echo $row['StudID']; ?>"><?php echo $row['MajID']; ?></td>
	<td data-id="<?php echo $row['StudID']; ?>"><?php echo $row['ClassID']; ?></td>
	<td ><i class="fas fa-edit btnedit" data-id="<?php echo $row['StudID']; ?>"></i></td>
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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="main.js"></script>

<?php
  include '../inc/footer.php';

  ?>

