<?php
require_once '../inc/header.php';

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
  $removeUser = $users->deleteUserById2($remove);
}

if (isset($removeUser)) {
  echo $removeUser;
}
if (isset($_GET['deactive'])) {
  $deactive = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['deactive']);
  $deactiveId = $users->userDeactiveByAdmin2($deactive);
}

if (isset($deactiveId)) {
  echo $deactiveId;
}
if (isset($_GET['active'])) {
  $active = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['active']);
  $activeId = $users->userDeactiveByAdmin2($active);
}

if (isset($activeId)) {
  echo $activeId;
}

?>

<div class="card ">
  <div class="card-header">
    <h3><i class="fas fa-users mr-2"></i>Student Listings <span class="float-right">Welcome! <strong>
      <span class="badge badge-lg badge-secondary text-white">
        <?php
          $username = Session::get('username');
            if (isset($username)) {
              echo $username;
            }
        ?>
      </span>
      </strong></span>
    </h3>
  </div>

  <div class="card-body pr-2 pl-2">
    <table id="datatableid" class="table table-striped table-bordered" style="width:100%">
      <thead>
        <tr>
          <th  class="text-center">SL</th>
          <th  class="text-center">Student ID</th>
          <th  class="text-center">First</th>
          <th  class="text-center">Last Name</th>
          <th  class="text-center">Student Address</th>
          <th  class="text-center">City</th>
          <th  class="text-center">Status</th>
          <th  class="text-center">Country</th>
          <th  class="text-center">Student Phone</th>
          <th  class="text-center">Student Email</th>
          <th  class="text-center">Date of Birth</th>
          <th  class="text-center">Date Enrolled</th>
          <th  class="text-center">Student Password</th>
          <th  class="text-center">PIN</th>
          <th  class="text-center">Major Id</th>
          <th  class="text-center">Class ID</th>
          <th  class="text-center">Role Id</th>
          <th  width='25%' class="text-center">Action</th>
        </tr>
      </thead>

      <tbody>
        <?php
          $allUser = $users->selectAllUserData2();
          if ($allUser) {
            $i = 0;
          foreach ($allUser as  $value) {
            $i++;
        ?>
        <tr class="text-center"
          <?php if ( $value->StudID) {
            echo "style='background:' ";
            }
          ?>
        >
          <td><?php echo $i; ?></td>
          <td><?php echo $value->StudID; ?></td>
          <td><?php echo $value->StudFirstName; ?></td>
          <td><?php echo $value->StudLastName; ?> <br>
            <?php if ($value->RoleID  == '5'){
              echo "<span class='badge badge-lg badge-info text-white'>Admin</span>";
              } elseif ($value->RoleID == '3') {
              echo "<span class='badge badge-lg badge-dark text-white'>Chair</span>";
              }elseif ($value->RoleID == '1') {
              echo "<span class='badge badge-lg badge-dark text-white'>Student</span>";
              }
            ?>
          </td>
          <td><?php echo $value->StudAddress; ?></td>
          <td><span class="badge badge-lg badge-secondary text-white"><?php echo $value->StudCity; ?></span></td>
          <td>
            <?php if ($value->isActive == '0') { ?>
            <span class="badge badge-lg badge-info text-white">Active</span>
            <?php }else{ ?>
            <span class="badge badge-lg badge-danger text-white">Deactive</span>
            <?php } ?>
          </td>
          <td><span class="badge badge-lg badge-secondary text-white"><?php echo ($value->StudCountry);  ?></span></td>
          <td><span class="badge badge-lg badge-secondary text-white"><?php echo ($value->StudPhone);  ?></span></td>
          <td><span class="badge badge-lg badge-secondary text-white"><?php echo ($value->StudEmail);  ?></span></td>
          <td><span class="badge badge-lg badge-secondary text-white"><?php echo ($value->StudDOB);  ?></span></td>
          <td><span class="badge badge-lg badge-secondary text-white"><?php echo ($value->StudEnrolled);  ?></span></td>
          <td><span class="badge badge-lg badge-secondary text-white"><?php echo ($value->StudPassword);  ?></span></td>
          <td><span class="badge badge-lg badge-secondary text-white"><?php echo ($value->StudPin);  ?></span></td>
          <td><span class="badge badge-lg badge-secondary text-white"><?php echo ($value->MajID);  ?></span></td>
          <td><span class="badge badge-lg badge-secondary text-white"><?php echo ($value->ClassID);  ?></span></td>
          <td><span class="badge badge-lg badge-secondary text-white"><?php echo ($value->RoleID);  ?></span></td>
          <td>
            <?php if ( Session::get("roleid") == '5') {?>
              <a class="btn btn-success btn-sm
                  " href="../AllUsers/profile.php?id=<?php echo $value->StudID;?>">View</a>
              <a class="btn btn-info btn-sm " href="../AllUsers/profile.php?id=<?php echo $value->StudID;?>">Edit</a>
              <a class="btn btn-info btn-sm " href="../StudentUsers/Sched2.php?id=<?php echo $value->StudID;?>">Schedule</a>
              <a onclick="return confirm('Are you sure To Delete ? This ACTION CANNOT be Undone!')" class="btn btn-danger
                <?php if ( $value->StudID) {
                  echo "disabled";
                  } 
                ?>
                btn-sm " href="?remove=<?php echo $value->StudID;?>">Remove
              </a>
            <?php if ($value->isActive == '0') {  ?>
              <a onclick="return confirm('Are you sure you would like To De-activate User ?')" class="btn btn-warning
                <?php if ($value->StudID) {
                  echo "disabled";
                  }
                ?>
                btn-sm " href="?deactive=<?php echo $value->StudID;?>">Disable</a>
            <?php } elseif($value->isActive == '1'){?>
              <a onclick="return confirm('Are you sure you want To Activate this User ?')" class="btn btn-secondary
                <?php if ($value->StudID) {
                  echo "disabled";
                  }
                ?>
                btn-sm " href="?active=<?php echo $value->StudID;?>">Active</a>
                <?php } ?>
            <?php  }elseif($value->StudID  && Session::get("roleid") == '3'){ ?>
              <a class="btn btn-success btn-sm " href="../AllUsers/profile.php?id=<?php echo $value->StudID;?>">View</a>
              <a class="btn btn-info btn-sm " href="../AllUsers/profile.php?id=<?php echo $value->StudID;?>">Edit</a>
              <a class="btn btn-info btn-sm " href="../StudentUsers/Sched2.php?id=<?php echo $value->StudID;?>">Schedule</a>
            <?php  }elseif( Session::get("roleid") == '3'){ ?>
              <a class="btn btn-success btn-sm
                <?php if ($value->RoleID == '1') {
                  echo "disabled";
                  }
                ?>
                " href="../AllUsers/profile.php?id=<?php echo $value->StudID;?>">View</a>
              <a class="btn btn-info btn-sm
                  <?php if ($value->RoleID == '1') {
                    echo "disabled";
                    }
                  ?>
                " href="../AllUsers/profile.php?id=<?php echo $value->StudID;?>">Edit</a>
                        <?php }elseif(Session::get("id") == $value->StudID  && Session::get("roleid") == '4'){ ?>
                          <a class="btn btn-success btn-sm " href="../AllUsers/profile.php?id=<?php echo $value->StudID;?>">View</a>
                          <a class="btn btn-info btn-sm " href="../AllUsers/profile.php?id=<?php echo $value->StudID;?>">Edit</a>
                          <a class="btn btn-info btn-sm " href="../StudentUsers/Sched2.php?id=<?php echo $value->StudID;?>">Schedule</a>
                        <?php }else{ ?>
                          <a class="btn btn-success btn-sm
                          <?php if ($value->RoleID == '1') {
                            echo "disabled";
                          } ?>
                          " href="../AllUsers/profile.php?id=<?php echo $value->StudID;?>">View</a>

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
