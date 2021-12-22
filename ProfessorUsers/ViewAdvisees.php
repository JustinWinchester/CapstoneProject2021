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

<script>
    $.myjQuery = function(sid) { //Will Update Student Pin with random pin
		$.ajax({
			type: "POST",
			url: "changePin.php",
			data: { student_id: sid }
		})
    };
	$.myjQuery2 = function(sid) { //Will Send student generic email with their Pin
		$.ajax({
			type: "POST",
			url: "sendPin.php",
			data: { student_id: sid }
		})
    };
    function changePin(sid) { //Called in button
        $.myjQuery(sid);
		location.reload();
    };
	function sendPin(sid) {
		$.myjQuery2(sid);
		alert("Pin Sent");
	};
</script>


      <div class="card ">
        <div class="card-header">
		<a href="<?php echo $_SERVER['HTTP_REFERER'] ?>">Back</a>
          <h3><i class="fas fa-users mr-2"></i>Faculty Advisee Listings<span class="float-right">Welcome Professor! <strong>
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
	<th  class="text-center">SL</th>

                                             <th  class="text-center">Faculty Identification</th>
                      <th  class="text-center">Faculty Member Last Name</th>
			<th  class="text-center">Student Last Name</th>
                      <th  class="text-center">Student First Name</th>
<th  class="text-center">Student Identification</th>
<th  class="text-center">Student Pin</th>
<th  class="text-center">Actions</th>

                    </tr>
                  </thead>
                  <tbody>


<?php


		$allUser = $users->selectAdviseeByFacultyID($userid);





                      if ($allUser) {
                        $i = 0;
                        foreach ($allUser as  $value) {
                          			$i++;
	?>

                      <tr class="text-center"
                      <?php if ( $value-> FacID) {
                        echo "style='background: ' ";
                      } ?>
                      >

                        <td><?php echo $i; ?></td>
                                               <td><?php echo $value-> FacID; ?>
<td><?php echo $value-> FacLastName; ?>
<td><?php echo $value-> StudLastName; ?>
<td><?php echo $value-> StudFirstName; ?>
<td><?php echo $value-> StudID; ?>
<td><?php echo $value-> StudPin; ?>
<?php $student_id = $value->StudID;?>
<td>
	<button class="btn btn-info btn-sm" type="button" id="<?php echo $i?>" onclick="changePin(<?php echo $student_id?>);">Re-Roll Pin</button> <br />
	<button class="btn btn-info btn-sm" type="button" id="<?php echo $i?>" onclick="sendPin(<?php echo $student_id?>);">Send Pin</button>
	<button class="btn btn-info btn-sm" type="button" id="<?php echo $i?>" onclick="window.open('../AllUsers/PrintMySchedule.php?id=<?php echo $student_id?>');">Print Schedule</button>

</td>




                                                                       </tr>
    <?php if ($value->FacID== '') {
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
