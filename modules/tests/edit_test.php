<?php
include("../../includes/header.php");

// Get test ID
if (!isset($_GET['id'])) {
  echo "Invalid request.";
  exit;
}

$test_id = $_GET['id'];

// Fetch test data
$sql = "SELECT * FROM tests WHERE id = $test_id";
$result = $conn->query($sql);
if (!$result || $result->num_rows === 0) {
  echo "Test not found.";
  exit;
}
$test = $result->fetch_assoc();

// Fetch products and test types for dropdowns
$products = $conn->query("SELECT product_id, product_name FROM products");
$test_types = $conn->query("SELECT id, test_name FROM test_types");

// Update logic
if (isset($_POST['update'])) {
  $product_id = $_POST['product_id'];
  $test_type_id = $_POST['test_type_id'];
  $tested_by = $_POST['tested_by'];
  $status = $_POST['status'];
  $remarks = $_POST['remarks'];
  $criteria = $_POST['criteria'];
  $observed_output = $_POST['observed_output'];

  $update_sql = "UPDATE tests SET
                    product_id = '$product_id',
                    test_type_id = '$test_type_id',
                    tested_by = '$tested_by',
                    status = '$status',
                    remarks = '$remarks',
                    criteria = '$criteria',
                    observed_output = '$observed_output'
                 WHERE id = $test_id";

  if ($conn->query($update_sql)) {
    header("Location: show_test.php");
    exit;
  } else {
    echo "Error updating record: " . $conn->error;
  }
}
?>

<div class="container-fluid page-body-wrapper">
  <?php include("../../includes/sidebar.php"); ?>

  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row justify-content-center">
        <div class="col-md-10 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-center mb-4">Edit Test</h4>

              <form method="POST">
                <div class="form-group mb-3">
                  <label>Test ID (Auto-generated)</label>
                  <input type="text" class="form-control" value="<?= $test['test_id']; ?>" readonly>
                </div>

                <div class="form-group mb-3">
                  <label>Product</label>
                  <select name="product_id" class="form-control" required>
                    <?php while ($row = $products->fetch_assoc()) { ?>
                      <option value="<?= $row['product_id']; ?>" <?= $row['product_id'] == $test['product_id'] ? 'selected' : ''; ?>>
                        <?= $row['product_name']; ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group mb-3">
                  <label>Test Type</label>
                  <select name="test_type_id" class="form-control" required>
                    <?php while ($row = $test_types->fetch_assoc()) { ?>
                      <option value="<?= $row['id']; ?>" <?= $row['id'] == $test['test_type_id'] ? 'selected' : ''; ?>>
                        <?= $row['test_name']; ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group mb-3">
                  <label>Tested By</label>
                  <input type="text" name="tested_by" class="form-control" value="<?= $test['tested_by']; ?>" required>
                </div>

                <div class="form-group mb-3">
                  <label>Status</label>
                  <select name="status" class="form-control" required>
                    <option value="">-- Select Status --</option>
                    <option value="Pending" <?= (isset($test['status']) && $test['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                    <option value="Passed" <?= (isset($test['status']) && $test['status'] == 'Passed') ? 'selected' : ''; ?>>Passed</option>
                    <option value="Failed" <?= (isset($test['status']) && $test['status'] == 'Failed') ? 'selected' : ''; ?>>Failed</option>
                  </select>
                </div>

                <div class="form-group mb-3">
                  <label>Remarks</label>
                  <textarea name="remarks" class="form-control" rows="2"><?= $test['remarks']; ?></textarea>
                </div>

                <div class="form-group mb-3">
                  <label>Criteria</label>
                  <textarea name="criteria" class="form-control" rows="2"><?= $test['criteria']; ?></textarea>
                </div>

                <div class="form-group mb-4">
                  <label>Observed Output</label>
                  <textarea name="observed_output" class="form-control" rows="2"><?= $test['observed_output']; ?></textarea>
                </div>

                <button type="submit" name="update" class="btn btn-success w-100">Update Test</button>
              </form>

            </div> <!-- card-body -->
          </div> <!-- card -->
        </div> <!-- col -->
      </div> <!-- row -->
    </div> <!-- content-wrapper -->
  </div> <!-- main-panel -->
</div> <!-- page-body-wrapper -->

<?php include("../../includes/footer.php"); ?>
