<?php
// requirements
require_once '../../CRUDOperations/component2.php';
require_once '../../CRUDOperations/operationpractice.php';
require_once '../inc/header.php';
Session::CheckSession();
// if not admin send to landing page
if (
    !isset($_SESSION['email']) || $_SESSION['roleid'] != "5"
) {
    header("location:index.html");
}

?>
<!-- body of student page for admin -->
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View and Add Students</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <h1>Hi! : <?= $_SESSION['email'] ?></h1>
    <link href="styles.css" rel="stylesheet">
    <link href="discover.css" rel="stylesheet">

    <h2>Your role in the system is : <?= $_SESSION['roleid'] ?></h2>
    <a href="logout.php">Logout</a><a href="adminhome.php">Home</a>
    <!--Custom Style Sheet-->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <div class="container text-center">

            <h1 class="py-4 bg-dark text-light rounded"><i class="fas fa-swatchbook" </i> Student Records</h1>
            <div class="d-flex justify-content-center">
                <form action="" method="post" class="w-50">
                    <div class="pt-2">
                        <?php inputElement("<i class='fas fa-id-badge'></i>", "ID", "student_id", setID()); ?>
                    </div>
                    <div class="pt-2">
                        <?php inputElement("<i class='fas fa-book'></i>", "Student Name", "student_name", ""); ?>
                    </div>
                    <div class="row pt-2">
                        <div class="col">
                            <?php inputElement("<i class='fas fa-people-carry'></i>", "Course", "student_course", ""); ?>
                        </div>
                        <div class="col">
                            <?php inputElement("<i class='fas fa-book'></i>", "Major", "student_major", ""); ?>
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
                            <th>Student Name</th>
                            <th>Student Course</th>
                            <th>Student Major</th>
                            <th>Edit</th>

                            </tbody>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php
                        // queries and displays all students
                        if (isset($_POST['read'])) {
                            $result = getData();
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td data-id="<?php echo $row['id']; ?>"><?php echo $row['id']; ?></td>
                                        <td data-id="<?php echo $row['id']; ?>"><?php echo $row['student_name']; ?></td>
                                        <td data-id="<?php echo $row['id']; ?>"><?php echo $row['student_course']; ?></td>
                                        <td data-id="<?php echo $row['id']; ?>"><?php echo $row['student_major']; ?></td>
                                        <td><i class="fas fa-edit btnedit" data-id="<?php echo $row['id']; ?>"></i></td>
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
    <script src="main2.js"></script>

    <?php
    include '../inc/footer.php';

    ?>