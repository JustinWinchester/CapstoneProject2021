<?php
include '../inc/header.php';

Session::CheckSession();

$logMsg = Session::get('logMsg');
if (isset($logMsg)) {
  echo $logMsg;
}
$msg = Session::get('msg');
if (isset($msg)) {
  echo $msg;
}
Session::set("msg", NULL);
Session::set("logMsg", NULL);
?>
<?php

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
          <h3><i class="fas fa-users mr-2"></i>User list <span class="float-right">Welcome! <strong>
            <span class="badge badge-lg badge-secondary text-white">
<?php
$firstname = Session::get('firstname');
if (isset($firstname)) {
  echo $firstname;
}
 ?></span>

          </strong></span></h3>
        </div>
        <div class="card-body pr-2 pl-2">

          <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th  class="text-center">Course Row Num</th>
                      <th  class="text-center">Course Name</th>
                      <th  class="text-center">Major ID & Title</th>
                      <th  class="text-center">Course Credits</th>
                      <th  class="text-center">Course Abreviation</th>

                    </tr>
                  </thead>
                  <tbody>


<?php
		$allUser = $users->selectAllCourseData();


                      if ($allUser) {
                        $i = 0;
                        foreach ($allUser as  $value) {
                          			$i++;
	?>

                      <tr class="text-center"
                      <?php if ( $value->CrsID) {
                        echo "style='background: ' ";
                      } ?>
                      >

                        <td><?php echo $i; ?></td>
                        <td><?php echo $value->CrsName; ?></td>
                        <td><?php echo $value-> MajID; ?> <br>
                          <?php if ($value->MajID  == '1'){
                          echo "<span class='badge badge-lg badge-info text-white'>Computer Science</span>";
                        } elseif ($value->MajID == '2') {
                          echo "<span class='badge badge-lg badge-dark text-white'>Information Technology</span>";
			 }?></td>
                        <td><?php echo $value->CrsCredits; ?></td>

                        <td><span class="badge badge-lg badge-secondary text-white"><?php echo $value->CrsAbr; ?></span></td>
                                                                       </tr>
    <?php if ($value->MajID == '1') {
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
  include '../inc/footer.php';

  ?>
