<?php
//requirements
include '../inc/header.php';
Session::CheckSession();
$sId =  Session::get('roleid');
// if admin
if ($sId === '5') { ?>
    <?php
    // adds new student
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUser'])) {

        $userAdd = $users->addNewStudentUserByAdmin($_POST);
    }

    if (isset($userAdd)) {
        echo $userAdd;
    }


    ?>

    <!-- body for add new student -->
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
                            <input type="text" name="StudFirstName" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="username">Last Name</label>
                            <input type="text" name="StudLastName" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="facOphone">Address</label>
                            <input type="text" name="StudAddress" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" name="StudCity" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="faclocation">Country</label>
                            <input type="text" name="StudCountry" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="facphone">Phone</label>
                            <input type="text" name="StudPhone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="StudEmail" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="studentdob">Date of Birth</label>
                            <input type="date" name="StudDOB" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="studenrolled">Date Enrolled </label>
                            <input type="date" name="StudEnrolled" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="StudPassword" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="studpin">Personal Identification Number</label>
                            <input type="text" name="StudPin" class="form-control">
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                <label for="sel1">Choose Major Identification</label>
                                <select class="form-control" name="MajID" id="majid">
                                    <option value="2">Information Technology</option>
                                    <option value="1">Computer Science</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="form-group">
                                    <label for="sel1">Choose Classifcation</label>
                                    <select class="form-control" name="ClassID" id="classid">
                                        <option value="4">Senior</option>
                                        <option value="3">Junior</option>
                                        <option value="2">Sophomore</option>
                                        <option value="1">Freshman</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="sel1">Select user Role</label>
										<input type="text" name="RoleID" id="roleid" class="form-control" value="1" placeholder="Student" readonly>
                                <!--        <select class="form-control" name="RoleID" id="roleid">
                                            <option value="5">Admin</option>
                                            <option value="4">Secretary</option>
                                            <option value="3">Chair</option>
                                            <option value="2">Faculty</option>
                                            <option value="1">Student</option>
                                        </select> -->
                                    </div>
                                    <div class="form-group">
                                        <label for="isactive">Deactivate Initial User Account</label>
                                        <input type="text" name="isActive" class="form-control">
                                    </div>




                                </div>
                                <div class="form-group">
                                    <button type="submit" name="addUser" class="btn btn-success">Add User</button>
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
