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
                      <th  class="text-center">FL</th>
                      <th  class="text-center">First Name</th>
                      <th  class="text-center">Last Name</th>
                      <th  class="text-center">Faculty Office Phone</th>
                      <th  class="text-center">Status</th>
                      <th  class="text-center">Faculty Location</th>
                      <th  class="text-center">Faculty Phone</th>
                      <th  class="text-center">Faculty Email</th>
                      <th  class="text-center">Department</th>
                      <th  class="text-center">Role Id</th>
                      <th  width='25%' class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                      $allUser = $users->selectAllUserData3();

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
                        <td><?php echo $value->FacFirstName; ?></td>
                        <td><?php echo $value->FacLastName; ?> <br>
                          <?php if ($value->RoleID  == '5'){
                          echo "<span class='badge badge-lg badge-info text-white'>Admin</span>";
                        } elseif ($value->RoleID == '3') {
                          echo "<span class='badge badge-lg badge-dark text-white'>Editor</span>";
                        }elseif ($value->RoleID == '1') {
                            echo "<span class='badge badge-lg badge-dark text-white'>User Only</span>";
                        } ?></td>
                        <td><?php echo $value->FacOfficePhone; ?></td>

                        
                        <td>
                          <?php if ($value->isActive == '0') { ?>
                          <span class="badge badge-lg badge-info text-white">Active</span>
                        <?php }else{ ?>
                    <span class="badge badge-lg badge-danger text-white">Deactive</span>
                        <?php } ?>

                        </td>
                        <td><span class="badge badge-lg badge-secondary text-white"><?php echo ($value->FacLocation);  ?></span></td>
			 <td><span class="badge badge-lg badge-secondary text-white"><?php echo ($value->FacPhone);  ?></span></td>
 <td><span class="badge badge-lg badge-secondary text-white"><?php echo ($value->FacEmail);  ?></span></td>
 <td><?php if($value->DepID == '1') {
 	echo "Staff";
 }elseif($value->DepID == '2'){
 	echo "CS";
 }else echo "IT"; ?></span></td>
  <td><span class="badge badge-lg badge-secondary text-white"><?php echo ($value->RoleID);  ?></span></td>

                        <td>
                          <?php if ( Session::get("roleid") == '5') {?>
                            <a class="btn btn-success btn-sm
                            " href="profile.php?id=<?php echo $value->FacID;?>">View</a>
                            <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->FacID;?>">Edit</a>
                                <a class="btn btn-info btn-sm " href="../ProfessorUsers/FacultySchedule.php?id=<?php echo $value->FacID;?>">Schedule</a>
                            <a onclick="return confirm('Are you sure You Want To Delete This User? This action CANNOT Be Undone!')" class="btn btn-danger
                    <?php if (Session::get("id") == $value->FacID) {
                      echo "disabled";
                    } ?>
                             btn-sm " href="?remove=<?php echo $value->FacID;?>">Remove</a>

                             <?php if ($value->isActive == '0') {  ?>
                               <a onclick="return confirm('Are you sure You Want Deactivate This User?')" class="btn btn-warning
                       <?php if (Session::get("id") == $value->FacID) {
                         echo "disabled";
                       } ?>
                                btn-sm " href="?deactive=<?php echo $value->FacID;?>">Disable</a>
                             <?php } elseif($value->isActive == '1'){?>
                               <a onclick="return confirm('Are you sure To Activate ?')" class="btn btn-secondary
                       <?php if (Session::get("id") == $value->FacID) {
                         echo "disabled";
                       } ?>
                                btn-sm " href="?active=<?php echo $value->FacID;?>">Activate</a>
                             <?php } ?>




                        <?php  }elseif(Session::get("id") == $value->FacID  && Session::get("roleid") == '3' || '4'){ ?>
                          <a class="btn btn-success btn-sm " href="profile.php?id=<?php echo $value->FacID;?>">View</a>
                          <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->FacID;?>">Edit</a>
<a class="btn btn-info btn-sm " href="../ProfessorUsers/FacultySchedule.php?id=<?php echo $value->FacID;?>">Schedule</a>
<a class="btn btn-info btn-sm " href="../AllUsers/schedulepdf.php?id=<?php echo $value->FacID;?>"> Print Schedule</a>
                        <?php  }elseif( Session::get("roleid") == '3'){ ?>
                          <a class="btn btn-success btn-sm
                          <?php if ($value->RoleID == '1') {
                            echo "disabled";
                          } ?>
                          " href="profile.php?id=<?php echo $value->FacID;?>">View</a>
                          <a class="btn btn-info btn-sm
                          <?php if ($value->RoleID == '1') {
                            echo "disabled";
                          } ?>
                          " href="profile.php?id=<?php echo $value->FacID;?>">Edit</a>
                        <?php }elseif(Session::get("id") == $value->FacID  && Session::get("roleid") == '3' || '4'){ ?>
                          <a class="btn btn-success btn-sm " href="profile.php?id=<?php echo $value->FacID;?>">View</a>
                          <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->FacID;?>">Edit</a>
<a class="btn btn-info btn-sm " href="../ProfessorUsers/FacultySchedule.php?id=<?php echo $value->FacID;?>">Schedule</a>
                        <?php }else{ ?>
                          <a class="btn btn-success btn-sm
                          <?php if ($value->RoleID == '1') {
                            echo "disabled";
                          } ?>
                          " href="profile.php?id=<?php echo $value->FacID;?>">View</a>

                        <?php } ?>

                        </td>
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
