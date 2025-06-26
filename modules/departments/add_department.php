<?php include("../../includes/header.php"); ?>

<div class="container-fluid page-body-wrapper">
  <?php include("../../includes/sidebar.php"); ?>

  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-8 grid-margin stretch-card mx-auto">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-center">Departments</h4>
              <form class="forms-sample" method="POST" action="">
                <div class="form-group">
                  <label for="NAME">Department Name</label>
                  <input type="text" class="form-control" id="Name" name="Name" placeholder="Enter Your Department Name">
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <input type="text" class="form-control" id="description" name="description" placeholder="Text">
                </div>
                
                <div class="text-center">
                  <button type="submit" name="adddepartment" class="btn btn-primary">Add Department</button>
                </div>
              </form>
              <?php
              if (isset($_POST['adddepartment'])) {
                include("../../includes/conn.php"); // Ensure DB connection
                $Name = $_POST['Name'];
                $description = $_POST['description'];
                
            

                $sql = "INSERT INTO departments (Name , description)
                        VALUES ('$Name', '$description')";
                $result = $conn->query($sql);
                if ($result === TRUE) {
                  echo "<script>alert('Department Has Been Added Successfully');
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
