<?php include("../../includes/header.php");
$id = ($_GET['id']);
$sql = "select * from departments where id = $id";
$result = $conn->query($sql);
$departments = mysqli_fetch_assoc($result);


?>

<div class="container-fluid page-body-wrapper">
  <?php include("../../includes/sidebar.php"); ?>

  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-8 grid-margin stretch-card mx-auto">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-center">Update Department</h4>
              <form class="forms-sample" method="POST" action="">
                <div class="form-group">
                  <label for="NAME">Department Name</label>
                  <input type="text" class="form-control" id="NAME" name="NAME" value="<?php echo $departments['NAME'] ?>" placeholder="Enter Your Departmant Name">
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <input type="text" class="form-control" id="description" name="description" value="<?php echo $departments['description'] ?>" placeholder="Text">
                </div>

                <div class="text-center">
                  <button type="submit" name="update" class="btn btn-primary">Update Department</button>
                </div>
              </form>
              <?php
              if (isset($_POST['update'])) {
                $NAME = $_POST['NAME'];
                $description = $_POST['description'];
                $sql = "update departments set NAME = '$NAME' , description = '$description' where id = $id ";
                $result = $conn->query($sql);
                if ($result == true) {
                  echo "<script>
    alert('Department Has Been Updated Successfully');
    window.location.href='show_department.php';
    </script>";
                }
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include("../../includes/footer.php"); ?>
                