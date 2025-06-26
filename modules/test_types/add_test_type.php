<?php include("../../includes/header.php"); ?>

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
                  <input type="text" class="form-control" id="test_name" name="test_name" placeholder="Enter Your Test Name">
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <input type="text" class="form-control" id="description" name="description" placeholder="Text">
                </div>
                
                <div class="text-center">
                  <button type="submit" name="addtesttype" class="btn btn-primary">Add Test Type</button>
                </div>
              </form>
              <?php
              if (isset($_POST['addtesttype'])) {
                include("../../includes/conn.php"); // Ensure DB connection
                $test_name = $_POST['test_name'];
                $description = $_POST['description'];
                
            

                $sql = "INSERT INTO test_types (test_name , description)
                        VALUES ('$test_name', '$description')";
                $result = $conn->query($sql);
                if ($result === TRUE) {
                  echo "<script>alert('Test Type Has Been Added Successfully');
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
