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

if (isset($_GET['id'])) {
  $userid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);

}

 ?>
      <div class="card ">
        <div class="card-header">
		<a href="<?php echo $_SERVER['HTTP_REFERER'] ?>">Back</a>
          <h3><i class="fas fa-users mr-2"></i>Faculty Class Rosters <span class="float-right">Welcome! <strong>
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

          <table id="datatableid" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
	<th  class="text-center">SL</th>

                                             <th  class="text-center">Semester</th>
                                             <th  class="text-center">Student Identification Number</th>
                                             <th  class="text-center">Student First Name</th>
                                             <th  class="text-center">Student Last Name</th>
			<th  class="text-center">Semeseter Start</th>
                      <th  class="text-center">Semester End</th>
<th  class="text-center">Time Abr</th>
                      <th  class="text-center">Location</th>
<th  class="text-center">Course Name</th>
                      <th  class="text-center">Course Credits</th>
<th  class="text-center">Course Abr</th>
                      <th  class="text-center">Faculty Last Name</th>

                    </tr>
                  </thead>
                  <tbody>


<?php


		$allUser =$users->selectClassRosters($userid);





                      if ($allUser) {
                        $i = 0;
                        foreach ($allUser as  $value) {
                          			$i++;
	?>

                      <tr class="text-center"
                      <?php if ( $value-> SemYear) {
                        echo "style='background: ' ";
                      } ?>
                      >

                        <td><?php echo $i; ?></td>
                                               <td><?php echo $value-> SemSemester; ?>
                                                 <td><?php echo $value-> id; ?>
                                                 <td><?php echo $value-> StudFirstName; ?>
                                                 <td><?php echo $value-> StudLastName; ?>

<td><?php echo $value-> SemStart; ?>
<td><?php echo $value-> SemEnd; ?>
<td><?php echo $value-> TimeAbr; ?>
<td><?php echo $value-> RoomLocation; ?>
<td><?php echo $value-> CrsName; ?>
<td><?php echo $value-> CrsCredits; ?>
<td><?php echo $value-> CrsAbr; ?>


                        <td><span class="badge badge-lg badge-secondary text-white"><?php echo $value->FacLastName; ?></span></td>
                                                                       </tr>
    <?php if ($value->CrsAbr == '1314') {
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
