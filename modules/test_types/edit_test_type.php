<?php include("../../includes/header.php");
$id = ($_GET['id']);
$sql = "select * from test_types where id = $id";
$result = $conn->query($sql);
$test_types = mysqli_fetch_assoc($result);


?>

<div class="container-fluid page-body-wrapper">
  <?php include("../../includes/sidebar.php"); ?>

  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-8 grid-margin stretch-card mx-auto">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-center">Product Test Type</h4>
              <form class="forms-sample" method="POST" action="">
                <div class="form-group">
                  <label for="test_name">Test Name</label>
                  <input type="text" class="form-control" id="test_name" name="test_name" value="<?php echo $test_types['test_name'] ?>" placeholder="Enter Your Test Name">
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <input type="text" class="form-control" id="description" name="description" value="<?php echo $test_types['description'] ?>" placeholder="Text">
                </div>

                <div class="text-center">
                  <button type="submit" name="update" class="btn btn-primary">Update Test Type</button>
                </div>
              </form>
              <?php
              if (isset($_POST['update'])) {
                $test_name = $_POST['test_name'];
                $description = $_POST['description'];
                $sql = "update test_types set test_name = '$test_name' , description = '$description' where id = $id ";
                $result = $conn->query($sql);
                if ($result == true) {
                  echo "<script>
    alert('Test Type Has Been Updated Successfully');
    window.location.href='show_test_type.php';
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
                