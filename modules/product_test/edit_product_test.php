<?php
include("../../includes/header.php");

// Get ID from query string
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request.");
}
$id = $_GET['id'];

// Fetch current product_test record
$current = $conn->query("SELECT * FROM product_tests WHERE id = $id")->fetch_assoc();
if (!$current) {
    die("Record not found.");
}

// Fetch dropdown options
$products = $conn->query("SELECT id, product_id, product_name FROM products ORDER BY product_name ASC");
$tests = $conn->query("SELECT id, test_id FROM tests ORDER BY test_id DESC");
$departments = $conn->query("SELECT id, name FROM departments ORDER BY name ASC");

// Handle form submission
if (isset($_POST['submit'])) {
    $product_id = $_POST['product_id'];
    $test_id = $_POST['test_id'];
    $department_id = $_POST['department_id'];

    $update_sql = "UPDATE product_tests 
                   SET product_id = '$product_id', test_id = '$test_id', department_id = '$department_id' 
                   WHERE id = $id";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Product Has Been Updated Successfully');
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
              <h4 class="card-title text-center mb-4">Edit Product Test Association</h4>

              <?php if (isset($error)) : ?>
                <div class="alert alert-danger"><?= $error ?></div>
              <?php endif; ?>

              <form method="POST">
                <div class="form-group mb-3">
                  <label for="product_id">Select Product</label>
                  <select name="product_id" class="form-control" required>
                    <option value="">-- Select Product --</option>
                    <?php while ($row = $products->fetch_assoc()) : ?>
                      <option value="<?= $row['product_id'] ?>" <?= ($row['product_id'] == $current['product_id']) ? 'selected' : '' ?>>
                        <?= $row['product_name'] ?> (<?= $row['product_id'] ?>)
                      </option>
                    <?php endwhile; ?>
                  </select>
                </div>

                <div class="form-group mb-3">
                  <label for="test_id">Select Test</label>
                  <select name="test_id" class="form-control" required>
                    <option value="">-- Select Test --</option>
                    <?php while ($row = $tests->fetch_assoc()) : ?>
                      <option value="<?= $row['test_id'] ?>" <?= ($row['test_id'] == $current['test_id']) ? 'selected' : '' ?>>
                        <?= $row['test_id'] ?>
                      </option>
                    <?php endwhile; ?>
                  </select>
                </div>

                <div class="form-group mb-4">
                  <label for="department_id">Select Department</label>
                  <select name="department_id" class="form-control" required>
                    <option value="">-- Select Department --</option>
                    <?php while ($row = $departments->fetch_assoc()) : ?>
                      <option value="<?= $row['id'] ?>" <?= ($row['id'] == $current['department_id']) ? 'selected' : '' ?>>
                        <?= $row['name'] ?>
                      </option>
                    <?php endwhile; ?>
                  </select>
                </div>

                <button type="submit" name="submit" class="btn btn-success w-100">Update Association</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- content-wrapper -->
  </div> <!-- main-panel -->
</div> <!-- container-fluid -->

<?php include("../../includes/footer.php"); ?>
