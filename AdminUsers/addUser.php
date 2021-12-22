<?php
//requirements
include '../inc/header.php';
Session::CheckSession();
$sId =  Session::get('roleid');
// if admin
if ($sId === '5') { ?>
    <?php
    // adds new user
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUser'])) {

        $userAdd = $users->addNewUserByAdmin($_POST);
    }

    if (isset($userAdd)) {
        echo $userAdd;
    }


    ?>

    <!-- body of add new user page -->
    <div class="card ">
        <div class="card-header">
            <h3 class='text-center'>Add New User</h3>
        </div>
        <div class="cad-body">



            <div style="width:100%; margin:0px auto">

                <form class="" action="" method="post">
                    <div class="form-group pt-3">
                        <div class="form-group">
                            <label for="username">First Name</label>
                            <input type="text" name="FacFirstName" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="username">Last Name</label>
                            <input type="text" name="FacLastName" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="facOphone">Faculty Office Phone</label>
                            <input type="text" name="FacOfficePhone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="FacPassword" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="faclocation">Faculty Location</label>
                            <input type="text" name="FacLocation" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="facphone">Faculty Phone</label>
                            <input type="text" name="FacPhone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="FacEmail" class="form-control">
                        </div>
						<div class="form-group">
                            <div class="form-group">
                                <label for="sel1">Department</label>
                                <select class="form-control" name="DepID" >
                                    <option value="2">Information Technology</option>
                                    <option value="1">Computer Science</option>
                                </select>
                        </div>
						
                        <div class="form-group">
                            <div class="form-group">
                                <label for="sel1">Select user Role</label>
                                <select class="form-control" name="RoleID" id="roleid">
                                    <option value="5">Admin</option>
                                    <option value="4">Secretary</option>
                                    <option value="3">Chair</option>
                                    <option value="2">Faculty</option>
                                    <option value="1">Student</option>



                                </select>
                            </div>
                            <div class="form-group">
                                <label for="isactive">Deactivate Initial User Account</label>
                                <input type="text" name="isActive" class="form-control">
                            </div>

                        </div>
                        <div class="form-group">
                            <button type="submit" name="addUser" class="btn btn-success">Register</button>
                        </div>


                </form>
            </div>
        </div>
    </div>

<?php
} else {

    header('Location:index.php');
}
?>

<?php
include '../inc/footer.php';

?>