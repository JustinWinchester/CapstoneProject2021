<?php
include 'inc/header.php';

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
                      <th  class="text-center">T L</th>
			<th  class="text-center">Time ID</th>
                      <th  class="text-center">Time Abbreviation</th>
                                         </tr>
                  </thead>
                  <tbody>
                   
                               
<?php
		$allUser = $users->selectAllTiimeData();
					  
		 
                      if ($allUser) {
                        $i = 0;
                        foreach ($allUser as  $value) {
                          			$i++;
	?>		
                     
                      <tr class="text-center"
                      <?php if ( $value->RoomID) {
                        echo "style='background:#2C2B28 ' ";
                      } ?>
                      >

                        <td><?php echo $i; ?></td>
                        <td><?php echo $value->TimeID; ?></td>
                        <td><?php echo $value-> TimeAbr; ?> <br>
                          <?php if ($value->TimeID  == '1'){
                          echo "<span class='badge badge-lg badge-info text-white'>Computer Science</span>";
                        } elseif ($value->TimeID == '2') {
                          echo "<span class='badge badge-lg badge-dark text-white'>Information Technology</span>";
			 }?></td>
                                                   <?php if ($value->TimeID == '1') {
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
  include 'inc/footer2.php';

  ?>
