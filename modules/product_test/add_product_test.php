<?php
include("../../includes/header.php");

// Fetch dropdown data
$products = $conn->query("SELECT id, product_id, product_name FROM products ORDER BY product_name ASC");
$tests = $conn->query("SELECT id, test_id FROM tests ORDER BY test_id DESC");
$departments = $conn->query("SELECT id, name FROM departments ORDER BY name ASC");

// Handle form submission
if (isset($_POST['submit'])) {
    $product_id = $_POST['product_id'];
    $test_id = $_POST['test_id'];
    $department_id = $_POST['department_id'];

    $sql = "INSERT INTO product_tests (product_id, test_id, department_id) 
            VALUES ('$product_id', '$test_id', '$department_id')";

    if ($conn->query($sql) === TRUE) {
         echo "<script>alert('Product Has Been Added Successfully');
                  window.location.href='show_product_test.php';
                   </script>";
    } 
}
?>

<div class="container-fluid page-body-wrapper">
  <?php include("../../includes/sidebar.php"); ?>

  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row justify-content-center">
        <div class="col-md-8 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-center mb-4">Add Product Test Association</h4>

              <?php if (isset($error)) : ?>
                <div class="alert alert-danger"><?= $error ?></div>
              <?php endif; ?>

              <form method="POST" action="">
                <div class="form-group mb-3">
                  <label for="product_id">Select Product</label>
                  <select name="product_id" class="form-control" required>
                    <option value="">-- Select Product --</option>
                    <?php while ($row = $products->fetch_assoc()) : ?>
                      <option value="<?= $row['product_id'] ?>"><?= $row['product_name'] ?> (<?= $row['product_id'] ?>)</option>
                    <?php endwhile; ?>
                  </select>
                </div>

                <div class="form-group mb-3">
                  <label for="test_id">Select Test</label>
                  <select name="test_id" class="form-control" required>
                    <option value="">-- Select Test --</option>
                    <?php while ($row = $tests->fetch_assoc()) : ?>
                      <option value="<?= $row['test_id'] ?>"><?= $row['test_id'] ?></option>
                    <?php endwhile; ?>
                  </select>
                </div>

                <div class="form-group mb-4">
                  <label for="department_id">Select Department</label>
                  <select name="department_id" class="form-control" required>
                    <option value="">-- Select Department --</option>
                    <?php while ($row = $departments->fetch_assoc()) : ?>
                      <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                    <?php endwhile; ?>
                  </select>
                </div>

                <button type="submit" name="submit" class="btn btn-primary w-100">Add Association</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- content-wrapper -->
  </div> <!-- main-panel -->
</div> <!-- container-fluid -->

<?php include("../../includes/footer.php"); ?>
