<?php
include("../../includes/header.php");

// Handle deletion if requested
if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $conn->query("DELETE FROM product_tests WHERE id = $id");
}

// Fetch product test associations
$sql = "SELECT 
          pt.id,
          p.product_name,
          p.product_id,
          t.test_id,
          d.name AS department_name
        FROM product_tests pt
        LEFT JOIN products p ON pt.product_id = p.product_id
        LEFT JOIN tests t ON pt.test_id = t.test_id
        LEFT JOIN departments d ON pt.department_id = d.id
        ORDER BY pt.id DESC";

$result = $conn->query($sql);
?>

<!-- Optional style for scrollable table -->
<style>
  .scrollable-table {
    overflow-x: auto;
  }

  table th, table td {
    white-space: nowrap;
  }
</style>

<div class="container-fluid page-body-wrapper">
  <?php include("../../includes/sidebar.php"); ?>

  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-center mb-4">Product Test Associations</h4>

              <div class="scrollable-table">
                <table class="table table-bordered w-100 text-dark">
                  <thead class="table-light">
                    <tr>
                      <th>ID</th>
                      <th>Product Name</th>
                      <th>Product ID</th>
                      <th>Test ID</th>
                      <th>Department</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                    ?>
                      <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['product_name']; ?></td>
                        <td><?= $row['product_id']; ?></td>
                        <td><?= $row['test_id']; ?></td>
                        <td><?= $row['department_name']; ?></td>
                        <td>
                          <a href="edit_product_test.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                        </td>
                        <td>
                          <a href="show_product_test.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this association?')">Delete</a>
                        </td>
                      </tr>
                    <?php
                      }
                    } else {
                      echo "<tr><td colspan='7' class='text-center'>No records found.</td></tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div> <!-- scrollable-table -->
            </div>
          </div>
        </div>
      </div>
    </div><!-- content-wrapper -->
  </div><!-- main-panel -->
</div><!-- page-body-wrapper -->

<?php include("../../includes/footer.php"); ?>
