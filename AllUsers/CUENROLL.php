<?php
include '../inc/header.php';
Session::CheckSession();

$sId =  Session::get('roleid');

if ($sId ) { 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ENROLL'])) {

  $ENROLL = $users->CUENROLL($_POST);
}

if (isset($ENROLL)) {
  echo $ENROLL;
}

if ($sId == '1') //check if student actually did the correct pin
{
	if (!isset($_POST['pin_correct']))
	{
		header("Location: ../StudentUsers/TESTenterPin.php");
	}
	else
	{
		if (htmlspecialchars($_POST['pin_correct']) != 'true')
		{
			header("Location: ../StudentUsers/TESTenterPin.php");
		}
			
	}

}

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
	header('Location:index.php');
}

if ($sId != '1')
{

 ?>




 <div class="container">
 <form class="insert-form" id="insert_form" method="post" action="">
   <hr>
   <h1 class="text-center">ADD STUDENT TO CUENROLL PROGRAM </h1>
   <hr>
   <div class="input-field">
       <table class="table table-bordered" id="table_field">
         <tr>
           <th>
             STUDENT IDENTIFICATION
           </th>
           <th>
             SECTION IDENTIFICATION
           </th>
           <th>
             STUDENT GRADE
           </th>
           <th>
             ADD OR REMOVE
           </th>
         </tr>

                       <tr>
                         <td>

                           <label for="adviserstudentid">Student Identification Number</label>
                           <input type="text" name="StudID"  class="form-control" required="">
                         </td>
                         <td>
                           <label for="advisersectid">Section Identification Number</label>
                           <input type="text" name="SectID"  class="form-control">
                         </td>
                         <td>
                           <label for="grade">Enter Student Grade</label>
                           <select class="form-control" name="Grade" id="Grade">
                             <option value=""></option>
                             <option value="NOT DECIDED">TO BE DETERMINED</option>
                             <option value="4.0">A</option>
                             <option value="3.0">B</option>
                             <option value="2.0">C</option>
                <option value="1.0">D</option>
                 <option value="0.0">A</option>



                           </select>
                         </td>
                           <td>
                             <input class="btn btn-warning"  type="button" name="add" id="add" value="Add">
                           </td>

                       </tr>
                       </table>
                       <center>
                         <div class="form-group">
                           <button type="submit" name="ENROLL" class="btn btn-success">CUENROLL</button>
                         </div>
                         </center>
                       </div>
                     </form>
                   </div>



                   <div class="card-body pr-2 pl-2">

                     <table id="example" class="table table-striped table-bordered" style="width:100%">
                             <thead>
                               <tr>
                                 <th  class="text-center">Enroll History Row Num</th>
                                 <th  class="text-center">Student Identification Number</th>
                                 <th  class="text-center">Student First Name</th>
                                 <th  class="text-center">Student Last Name</th>
                                 <th  class="text-center">Course Name</th>
                                 <th  class="text-center">Course Credits</th>
                                 <th  class="text-center">Course Abreviation</th>
                                 <th  class="text-center">Semester</th>
                                 <th  class="text-center">Faculty Last Name</th>

                               </tr>
                             </thead>
                             <tbody>


               <?php
               $allUser = $users->selectEnrollmentHistory();


                                 if ($allUser) {
                                   $i = 0;
                                   foreach ($allUser as  $value) {
                                           $i++;
               ?>

                                 <tr class="text-center"
                                 <?php if ( $value->id) {
                                   echo "style='background: ' ";
                                 } ?>
                                 >

                                   <td><?php echo $i; ?></td>
                                   <td><?php echo $value->id; ?></td>
                                   <td><?php echo $value-> StudFirstName; ?> <br>
                                     <?php if ($value->id  == '1'){
                                     echo "<span class='badge badge-lg badge-info text-white'>Computer Science</span>";
                                   } elseif ($value->id == '2') {
                                     echo "<span class='badge badge-lg badge-dark text-white'>Information Technology</span>";
                  }?></td>
                          <td><?php echo $value->StudLastName; ?></td>
                                  <td><?php echo $value->CrsName; ?></td>

                               <td><?php echo $value->CrsCredits; ?></td>

                                   <td><span class="badge badge-lg badge-secondary text-white"><?php echo $value->CrsAbr; ?></span></td>
                                    <td><?php echo $value->SemSemester; ?></td>
                                      <td><?php echo $value->FacLastName; ?></td>

                                                                                  </tr>
                                    <?php if ($value->id == '1') {
                                       echo "";
                                     } ?>

                               <?php }}else {?>
                                 <tr class="text-center">
                              <td><?php echo Session::get("id"); ?></td>

                 </tr>
                             <?php } ?>






                </tbody>

                         </table>











                   </div>
                 </div>




           <?php
          // include '../inc/footer.php';
}

if ($sId == '1')
{
           ?>




 <div class="card ">
   <div class="card-header">
          <h3 class='text-center'>ENROLL STUDENT IN SECTION</h3>
        </div>
        <div class="cad-body">



            <div style="width:600px; margin:0px auto">

            <form class="" action="" method="post">
                <div class="form-group pt-3">
                 <div class="form-group">
                  <label for="adviserstudentid">Student Identification Number</label>
                  <?php echo '<input type="text" name="StudID" value="' . Session::get("id") . '" class="form-control" readonly>'; ?>
                </div>
		 <div class="form-group">
                  <label for="advisersectid">Section Identification Number</label>
                  <input type="text" name="SectID"  class="form-control">
                </div>

	         <!--      <div class="form-group">
                  <div class="form-group">
                    <label for="sel1">Select Student Grade</label>
                    <select class="form-control" name="Grade" id="Grade">
                      <option value=""></option>
                      <option value="N/A">N/A</option>
                      <option value="4.0">A</option>
                      <option value="3.0">B</option>
                      <option value="2.0">C</option>
		              <option value="1.0">D</option>
		              <option value="0.0">A</option> 



                    </select>
                  </div> -->

		</div>
                <div class="form-group">
                  <button type="submit" name="ENROLL" class="btn btn-success">CUENROLL</button>
                </div>


            </form>
          </div>


        </div>
      </div>

<?php

}
include '../inc/footer.php';

}else{

  header('Location:index.php');

}
  ?>
