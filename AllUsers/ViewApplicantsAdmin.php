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
  $deactiveId = $users->userDeactivateByAdminApplicant($deactive);
}

if (isset($deactiveId)) {
  echo $deactiveId;
}
if (isset($_GET['active'])) {
  $active = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['active']);
  $activeId = $users->userActivateByAdminApplicant($active);
}

if (isset($activeId)) {
  echo $activeId;
}

?>
    <div class="card ">
      <div class="card-header">
          <h3><i class="fas fa-users mr-2"></i>APPLICANT LISTINGS<span class="float-right">Welcome! <strong>
            <span class="badge badge-lg badge-secondary text-white">
        <?php
        $username = Session::get('username');
          if (isset($username)) {
            echo $username;
        }
        ?>
      </span>
      </strong></span></h3>
      </div>

        <div class="card-body pr-2 pl-2">
          <table id="datatableid" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                      <th  class="text-center">Applicant ID</th>
                      <th  class="text-center">First Name</th>
                      <th  class="text-center">Last Name</th>
                      <th  class="text-center">Address</th>
                      <th  class="text-center">Status</th>
                      <th  class="text-center">City</th>
                      <th  class="text-center">Country</th>
                      <th  class="text-center">Applicant Phone</th>
                      <th  class="text-center">Applicant Email</th>
                      <th  class="text-center">Major</th>
                      <th  class="text-center">Date Of Birth</th>
                      <th  class="text-center">Date Applied</th>
                      <th  class="text-center">Class ID</th>
                      <th  class="text-center">Role Id</th>
                      <th  width='25%' class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                      $allUser = $users->selectAllApplicantData();
                        if ($allUser) {
                          $i = 0;
                        
                          foreach ($allUser as  $value){ 
                              $i++;                 
                    ?>

                  <tr class="text-center"
                    <?php if ( $value->RoleID) {
                        echo "style='background:' ";
                        } 
                    ?>
                  >

                    <td><?php echo $value->AppID; ?></td>
                    <td><?php echo $value->AppFirstName; ?></td>
                    <td><?php echo $value->AppLastName; ?> <br>
                          <?php if ($value->RoleID  == '5'){
                          echo "<span class='badge badge-lg badge-info text-white'>Admin</span>";
                        } elseif ($value->RoleID == '3') {
                          echo "<span class='badge badge-lg badge-dark text-white'>Editor</span>";
                        }elseif ($value->RoleID == '1') {
                            echo "<span class='badge badge-lg badge-dark text-white'>Student</span>";
                        } ?>
                    </td>
                    <td><?php echo $value->AppAddress; ?></td>
                    <td>
                      <?php if ($value->isActive == '0') { ?>
                        <span class="badge badge-lg badge-info text-white">Registered</span>
                      <?php }else{ ?>
                        <span class="badge badge-lg badge-danger text-white">Not Registered</span>
                      <?php } ?>
                    </td>
                    <td><span class="badge badge-lg badge-secondary text-white"><?php echo ($value->AppCity);  ?></span></td>
                    <td><span class="badge badge-lg badge-secondary text-white"><?php echo ($value->AppCountry);  ?></span></td>
                    <td><span class="badge badge-lg badge-secondary text-white"><?php echo ($value->AppPhone);  ?></span></td>
                    <td><span class="badge badge-lg badge-secondary text-white"><?php echo ($value->AppEmail);  ?></span></td>
                    <td><?php if($value->MajID == '1') {
                        echo "CS";
                      }elseif($value->MajID == '2'){
                        echo "IT";
                      }else echo "UNDECIDED"; ?>
                    </span></td>
                    <td><span class="badge badge-lg badge-secondary text-white"><?php echo ($value->AppDOB);  ?></span></td>
                    <td><span class="badge badge-lg badge-secondary text-white"><?php echo ($value->AppApplied);  ?></span></td>
                    <td><span class="badge badge-lg badge-secondary text-white"><?php echo ($value->ClassID);  ?></span></td>
                    <td><span class="badge badge-lg badge-secondary text-white"><?php echo ($value->RoleID);  ?></span></td>
                    <td>
                      <?php if ( Session::get("roleid") == '5') {?>
                        <?php if ($value->isActive == '0') {  ?>
                          <a onclick="return confirm('Have You Created This Account?')" class="btn btn-warning
                            <?php if (Session::get("id") == $value->AppID) {
                              echo "disabled";
                              }
                            ?>
                          btn-sm " href="?deactive=<?php echo $value->AppID;?>">Toggle Registration</a>
                        <?php } elseif($value->isActive == '1'){?>
                          <a onclick="return confirm('Are you sure To Activate ?')" class="btn btn-secondary
                            <?php if (Session::get("id") == $value->AppID) {
                              echo "disabled";
                              }
                            ?>
                          btn-sm " href="?active=<?php echo $value->AppID;?>">Register New Student</a>
                             <?php } ?>
                    </td>
                  <?php }
                          }
                            } ?>
                </tbody>
          </table>
      </div>
    </div>


  <?php
  include '../inc/footer.php';
  ?>
