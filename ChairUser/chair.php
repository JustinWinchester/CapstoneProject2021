<?php
require_once '../../CRUDOperation/component2.php';
require_once '../../CRUDOperation/operationStudent.php';
<?php
  require_once '../inc/header.php';
Session::CheckSession();
  if(!isset($_SESSION['email']) || $_SESSION['roleid'] != "3"
){
  header("location:index.html");
}




?>

<body>



<main>
<h1>Hi! : <?= $_SESSION['email']?></h1>

<h2>Your role in the system is : <?= $_SESSION['roleid']?></h2>
<a href="logout.php">Logout</a><a href="chairhome.php">HOME</a>




<div class="container text-center">

  <h1 class="py-4 bg-dark text-light rounded"><i class="fas fa-swatchbook"</i> Student Records</h1>

      <div class="d-flex justify-content-center">
  <form action="" method="post" class="w-50">
    <div class="pt-2">
    <?php inputElement("<i class='fas fa-id-badge'></i>","ID", "student_id",setID()); ?>
</div>
              
              <?php buttonElement("btn-read","btn btn-primary","<i class='fas fa-sync'></i>","read","data-toggle='tooltip' data-placement='bottom' title='Read'"); ?>
                            </div>
  </form>
</div>

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
