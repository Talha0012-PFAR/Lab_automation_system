<?php
include("./includes/conn.php");
include("./includes/header.php");

// Filters
$filterProduct = $_GET['product_name'] ?? '';
$filterTestType = $_GET['test_type'] ?? '';
$filterStatus = $_GET['status'] ?? '';

// Query
$query = "
SELECT 
  tests.test_id,
  products.product_name,
  test_types.test_name,
  tests.tested_by,
  tests.status,
  tests.created_at
FROM tests
LEFT JOIN products ON tests.product_id = products.product_id
LEFT JOIN test_types ON tests.test_type_id = test_types.id
WHERE 1
";

if (!empty($filterProduct)) $query .= " AND products.product_name = '$filterProduct'";
if (!empty($filterTestType)) $query .= " AND test_types.test_name = '$filterTestType'";
if (!empty($filterStatus)) $query .= " AND tests.status = '$filterStatus'";
$query .= " ORDER BY tests.created_at DESC";

$result = $conn->query($query);

// Export to CSV
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename="report_export.csv"');
  $output = fopen("php://output", "w");
  fputcsv($output, ['Test ID', 'Product Name', 'Test Type', 'Tested By', 'Status', 'Date']);
  while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
      $row['test_id'],
      $row['product_name'],
      $row['test_name'],
      $row['tested_by'],
      $row['status'],
      $row['created_at']
    ]);
  }
  fclose($output);
  exit;
}
?>

<div class="container-fluid page-body-wrapper">
  <?php include("./includes/sidebar.php"); ?>

  <div class="main-panel">
    <div class="content-wrapper">

      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">

              <h4 class="card-title mb-4">Test Reports</h4>

              <form class="form-inline mb-4" method="get" action="">
                <select name="product_name" class="form-control mr-2 mb-2">
                  <option value="">All Products</option>
                  <?php
                  $products = $conn->query("SELECT DISTINCT product_name FROM products");
                  while ($row = $products->fetch_assoc()) {
                    $selected = ($filterProduct == $row['product_name']) ? 'selected' : '';
                    echo "<option $selected>" . $row['product_name'] . "</option>";
                  }
                  ?>
                </select>

                <select name="test_type" class="form-control mr-2 mb-2">
                  <option value="">All Test Types</option>
                  <?php
                  $testTypes = $conn->query("SELECT DISTINCT test_name FROM test_types");
                  while ($row = $testTypes->fetch_assoc()) {
                    $selected = ($filterTestType == $row['test_name']) ? 'selected' : '';
                    echo "<option $selected>" . $row['test_name'] . "</option>";
                  }
                  ?>
                </select>

                <select name="status" class="form-control mr-2 mb-2">
                  <option value="">All Statuses</option>
                  <option value="Passed" <?= $filterStatus == 'Passed' ? 'selected' : '' ?>>Passed</option>
                  <option value="Failed" <?= $filterStatus == 'Failed' ? 'selected' : '' ?>>Failed</option>
                  <option value="Pending" <?= $filterStatus == 'Pending' ? 'selected' : '' ?>>Pending</option>
                </select>

                <button type="submit" class="btn btn-primary mr-2 mb-2">Apply Filters</button>
                <a href="?<?= http_build_query(array_merge($_GET, ['export' => 'csv'])) ?>" class="btn btn-success mb-2">Export to CSV</a>
              </form>

              <div class="table-responsive">
                <table class="table table-bordered text-dark">
                  <thead class="thead-light">
                    <tr>
                      <th>Test ID</th>
                      <th>Product</th>
                      <th>Test Type</th>
                      <th>Tested By</th>
                      <th>Status</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($result->num_rows > 0): ?>
                      <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                          <td><?= $row['test_id']; ?></td>
                          <td><?= $row['product_name']; ?></td>
                          <td><?= $row['test_name']; ?></td>
                          <td><?= $row['tested_by']; ?></td>
                          <td><?= $row['status']; ?></td>
                          <td><?= $row['created_at']; ?></td>
                        </tr>
                      <?php endwhile; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="6" class="text-center">No records found</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>
      </div>

    </div>
    <?php include("./includes/footer.php"); ?>
  </div>
</div>
