<?php
//requirements
require_once("../../CRUDOperations/component2.php");
require_once("../../CRUDOperations/operationFaculty.php");
require_once '../inc/header.php';

Session::CheckSession();
// if not an admin send to landing page
if (
    !isset($_SESSION['email']) || $_SESSION['roleid'] != "5"
) {
    header("location:index.html");
}

?>

<!-- body of faculty page for admins -->

<body>
    <main>
        <h1>Hi! : <?= $_SESSION['email'] ?></h1>
        <h2>Your role in the system is : <?= $_SESSION['roleid'] ?></h2>
        <a href="logout.php">Logout</a><a href="adminhome.php">Home</a>

        <div class="container text-center">

            <h1 class="py-4 bg-dark text-light rounded"><i class="fas fa-swatchbook" </i> Faculty & Staff Records</h1>
            <div class="d-flex justify-content-center">
                <form action="" method="post" class="w-50">
                    <div class="pt-2">
                        <?php inputElement("<i class='fas fa-id-badge'></i>", "ID", "faculty_id", setID()); ?>
                    </div>
                    <div class="pt-2">
                        <?php inputElement("<i class='fas fa-book'></i>", "Member First Name", "FacFirstName", ""); ?>
                    </div>
                    <div class="pt-2">
                        <div class="col">
                            <?php inputElement("<i class='fas fa-people-carry'></i>", "Member Last Name", "FacLastName", ""); ?>
                        </div>
                        <div class="pt-2">
                            <?php inputElement("<i class='fas fa-book'></i>", "Office Phone", "FacOfficePhone", ""); ?>
                        </div>
                        <div class="pt-2">
                            <?php inputElement("<i class='fas fa-id-badge'></i>", "Password", "FacPassword", ""); ?>
                        </div>
                        <div class="pt-2">
                            <?php inputElement("<i class='fas fa-book'></i>", "Faculty Location", "FacLocation", ""); ?>
                        </div>
                        <div class="pt-2">
                            <?php inputElement("<i class='fas fa-book'></i>", "Faculty Phone", "FacPhone", ""); ?>
                        </div>
                        <div class="pt-2">
                            <?php inputElement("<i class='fas fa-book'></i>", "Faculty Email", "FacEmail", ""); ?>
                        </div>
                        <div class="pt-2">
                            <div class="pt-2">
                                <?php inputElement("<i class='fas fa-people-carry'></i>", "Role ID", "RoleID", ""); ?>
                            </div>
                            <div class="pt-2">
                                <?php inputElement("<i class='fas fa-book'></i>", "Department ID", "DepID", ""); ?>
                            </div>

                        </div>
                        <div class="d-flex justify-content-center">
                            <?php buttonElement("btn-create", "btn btn-success", "<i class='fas fa-plus'></i>", "create", "data-toggle='tooltip' data-placement='bottom' title='Create'"); ?>
                            <?php buttonElement("btn-read", "btn btn-primary", "<i class='fas fa-sync'></i>", "read", "data-toggle='tooltip' data-placement='bottom' title='Read'"); ?>
                            <?php buttonElement("btn-update", "btn btn-light border", "<i class='fas fa-pen-alt'></i>", "update", "data-toggle='tooltip' data-placement='bottom' title='Update'"); ?>
                            <?php buttonElement("btn-delete", "btn btn-danger", "<i class='fas fa-trash-alt'></i>", "delete", "data-toggle='tooltip' data-placement='bottom' title='Delete'"); ?>
                            <?php deleteBtn(); ?>
                        </div>
                </form>
            </div>

            <!-- Bootstrap table  -->
            <div class="d-flex table-data">
                <table class="table table-striped table-dark">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Office Phone</th>
                            <th>Faculty Password</th>
                            <th>Faculty Location</th>
                            <th>Faculty Phone</th>

                            <th>E-Mail</th>
                            <th>Role Id</th>
                            <th>Department Id</th>


                            </tbody>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php
                        // queries and displays all faculty
                        if (isset($_POST['read'])) {
                            $result = getData();
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td data-id="<?php echo $row['FacID']; ?>"><?php echo $row['FacID']; ?></td>
                                        <td data-id="<?php echo $row['FacID']; ?>"><?php echo $row['FacFirstName']; ?></td>
                                        <td data-id="<?php echo $row['FacID']; ?>"><?php echo $row['FacLastName']; ?></td>
                                        <td data-id="<?php echo $row['FacID']; ?>"><?php echo $row['FacOfficePhone']; ?></td>
                                        <td data-id="<?php echo $row['FacID']; ?>"><?php echo $row['FacPassword']; ?></td>
                                        <td data-id="<?php echo $row['FacID']; ?>"><?php echo $row['FacLocation']; ?></td>
                                        <td data-id="<?php echo $row['FacID']; ?>"><?php echo $row['FacPhone']; ?></td>
                                        <td data-id="<?php echo $row['FacID']; ?>"><?php echo $row['FacEmail']; ?></td>
                                        <td data-id="<?php echo $row['FacID']; ?>"><?php echo $row['RoleID']; ?></td>
                                        <td data-id="<?php echo $row['FacID']; ?>"><?php echo $row['DepID']; ?></td>

                                        <td><i class="fas fa-edit btnedit" data-id="<?php echo $row['FacID']; ?>"></i></td>
                                    </tr>
                        <?php
                                }
                            }
                        }

                        ?>
                    </tbody>
                </table>
            </div>
    </main>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="main3.js"></script>

    <?php
    include '../inc/footer.php';

    ?>