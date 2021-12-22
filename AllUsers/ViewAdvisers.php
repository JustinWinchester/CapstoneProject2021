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
          <h3><i class="fas fa-users mr-2"></i>Adviser list <span class="float-right">Welcome! <strong>
            <span class="badge badge-lg badge-secondary text-white">
<?php
$username = Session::get('username');
if (isset($username)) {
  echo $username;
}
 ?></span>

          </strong></span></h3>
        </div>
        <div class="card-body pr-2 pl-2">

          <table id="datatableid" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th  class="text-center">AL</th>
                          <th  class="text-center">Student ID</th>
                      <th  class="text-center">Student First Name</th>
                      <th  class="text-center">Student Last Name</th>

                      <th  class="text-center">Faculty First Name</th>
                      <th  class="text-center">Faculty Last Name</th>
                      <th  class="text-center">Faculty ID</th>


                    </tr>
                  </thead>
                  <tbody>
                    <?php

                      $allUser = $users->selectAllAdviserData();

                      if ($allUser) {
                        $i = 0;
                        foreach ($allUser as  $value) {
                          $i++;

                     ?>

                      <tr class="text-center"
                      <?php if ( $value->FacID) {
                        echo "style='background:' ";
                      } ?>
                      >

                        <td><?php echo $i; ?></td>
                        <td><?php echo $value->StudID; ?></td>
                        <td><?php echo $value->StudFirstName; ?> <br>

                        <td><?php echo $value->StudLastName; ?></td>

                        <td><span class="badge badge-lg badge-secondary text-white"><?php echo $value->FacFirstName; ?></span></td>

                        <td><span class="badge badge-lg badge-secondary text-white"><?php echo ($value->FacLastName);  ?></span></td>
			 <td><span class="badge badge-lg badge-secondary text-white"><?php echo ($value->FacID);  ?></span></td>



                      </tr>
                    <?php }}else{ ?>
                      <tr class="text-center">
                      <td>No user availabe now !</td>
                    </tr>
                    <?php } ?>

                  </tbody>

              </table>









        </div>
      </div>



  <?php
  include '../inc/footer.php';

  ?>
