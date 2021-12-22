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



if (isset($activeId)) {
  echo $activeId;
}


 ?>


 <script type="text/javascript">
 $(document).ready(function(){
      var html= '
      <tr>
      <td><input class="form-control" type="text" name="txtStudID[]" required=""></td>
      <td><input class="form-control"  type="text" name="txtSectID[]"required=""></td>
      <td><input  class="form-control" type="text" name="txtGrade[]"></td>
      <td><input class="btn btn-warning"  type="button" name="remove" id="remove" value="remove"></td>
      </tr>
      ';
            var max = 5;
            var x = 1;
            $("#add").click(function()){
                if(x <= max){
              $("table_field").append(html);
                x++;
            }
           });
           $("#table_field").on('click','#remove', function()){
             $(this).closest('tr').remove();
              x--;
          });

 });

 </script>

      <div class="container">
      <form class="insert-form" id="insert_form" method="post" action="">
        <hr>
        <h1 class="text-center">ADD STUDENT TO CUENROLL PROGRAM </h1>
        <hr>
        <div class="input-field">
            <table class="table table-bordered" id="table_field">
              <tr>
                <th>
                  STUDENT IDENTIFICATION
                </th>
                <th>
                  SECTION IDENTIFICATION
                </th>
                <th>
                  STUDENT GRADE
                </th>
                <th>
                  ADD OR REMOVE
                </th>
              </tr>
                <?php
                  $conn = mysqli_connect("localhost","cs12","CUaDGKK8","cs12");

                  if(isset($_POST['save'])){
                    $txtStudID = $_POST['txtStudID'];
                    $txtSectID = $_POST['txtSectID'];
                    $txtGrade = $_POST['txtGrade'];

                      foreach ($txtStudID as $key => $value) {
                        $save = "INSERT INTO history(StudID,SectID,Grade)
                        VALUES('".$value."','".$txtStudID[$key]."','".$txtSectID[$key]."',
                        '".$txtGrade[$key]."')";
                        $query = mysqli_query($conn,$save);
                      }

                  }

                ?>



              <tr>
                <td>
                  <input class="form-control" type="text" name="txtStudID" required="">
                </td>
                <td>
                  <input class="form-control"  type="text" name="txtSectID" required="">
                </td>
                <td>
                  <input  class="form-control" type="text" name="txtGrade" >
                </td>
                  <td>
                    <input class="btn btn-warning"  type="button" name="add" id="add" value="Add">
                  </td>

              </tr>
              </table>
              <center>
                  <input class="btn btn-success"  type="submit" name="save" id="save" value="ENROLL">
                </center>
              </div>
            </form>
          </div>

  <?php
  include '../inc/footer.php';

  ?>
