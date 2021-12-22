<?php
	include '../inc/header.php';

	//Session::CheckSession();

	//$logMsg = Session::get('logMsg');
	//if (isset($logMsg)) {
	//	echo $logMsg;
	//}
	//$msg = Session::get('msg');
	//if (isset($msg)) {
	//	echo $msg;
	//}
	//Session::set("msg", NULL);
	//Session::set("logMsg", NULL);


	if (isset($_GET['remove'])) {
		$remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove']);
		$removeUser = $users->deleteUserById($remove);
	}

	if (isset($removeUser)) {
		echo $removeUser;
	}
	
	if (isset($_GET['deactive'])) {
		$deactive = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['deactive']);
		$deactiveId = $users->userDeactiveByAdmin($deactive);
	}

	if (isset($deactiveId)) {
		echo $deactiveId;
	}
	
	if (isset($_GET['active'])) {
		$active = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['active']);
		$activeId = $users->userActiveByAdmin($active);
	}

	if (isset($activeId)) {
		echo $activeId;
	}


?>
      <div class="card ">
      <div class="card-header">
      <h3><i class="fas fa-users mr-2"></i>Course Catalog <span class="float-right">Welcome! <strong>
	  <span class="badge badge-lg badge-secondary text-white">
	  
		<?php
			$firstname = Session::get('firstname');
			if (isset($firstname)) {
				echo $firstname;
			}
		?>
	  </span></strong></span></h3>
      </div>
		
		
        <div class="card-body pr-2 pl-2">

          <table id="datatableid" class="display" style="width:100%">
                  <thead>
                    <tr>
					  <th  class="text-center">Section</th>
					  <th  class="text-center">Major</th>
                      <th  class="text-center">Course Abreviation</th>
                      <th  class="text-center">Course Name</th>
                      <th  class="text-center">Credits</th>
                      <th  class="text-center">Time</th>
                      <th  class="text-center">Location</th>
                      <th  class="text-center">Instructor</th>
                      <th  class="text-center">Semester</th>
                      <th  class="text-center">Course Start</th>
                      <th  class="text-center">Course End</th>
					  <th  class="text-center">Max Students</th>
                    </tr>
                  </thead>
                  <tbody>


<?php
		$allUser = $users->selectAllCourseCatalogData();


                      if ($allUser) {
                        $i = 0;
                        foreach ($allUser as  $value) {
                          			$i++;
?>

                      <tr class="text-center"
                      <?php if ( $value->SectID) {
                        echo "style='background: ' ";
                      } ?>
                      >
						<td><?php echo $value->SectID; ?></td>
                        <td><?php echo $value->DepName . ": "; ?>
						<?php 
							if ($value->DepID  == '2'){
								echo "<span class='badge badge-lg badge-info text-white'>Computer Science</span>";
							} elseif ($value->DepID == '3') {
								echo "<span class='badge badge-lg badge-dark text-white'>Information Technology</span>";
							}?></td>
                        <td><?php echo $value->CrsAbr; ?></td>
                        <td><?php echo $value->CrsName; ?></td>
                        <td><?php echo $value->CrsCredits; ?></td>
						<td><?php echo $value->TimeAbr; ?></td>
                        <td><?php echo $value->RoomLocation; ?></td>
						<td><?php echo $value->FacLastName; ?></td>
                        <td><?php echo $value->SemSemester; ?></td>
						<td><?php echo $value->SemStart; ?></td>
                        <td><?php echo $value->SemEnd; ?></td>
						<td><?php echo $value->SectMaxStud; ?></td>

                      </tr>
    <?php 
			if ($value->DepID == '2') {
				echo "";
            }
	?>

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
  include '../inc/footer.php';

  ?>
