<?php
include("includes/header.php");

// Fetch summary counts
$totalProducts = $conn->query("SELECT COUNT(*) AS total FROM products")->fetch_assoc()['total'];
$totalTests = $conn->query("SELECT COUNT(*) AS total FROM tests")->fetch_assoc()['total'];
$totalTestTypes = $conn->query("SELECT COUNT(*) AS total FROM test_types")->fetch_assoc()['total'];
$totalDepartments = $conn->query("SELECT COUNT(*) AS total FROM departments")->fetch_assoc()['total'];
$totalAssociations = $conn->query("SELECT COUNT(*) AS total FROM product_tests")->fetch_assoc()['total'];

// Fetch recent tests
$recentTests = $conn->query("
  SELECT t.test_id, p.product_name, tt.test_name, t.status, t.created_at
  FROM tests t
  LEFT JOIN products p ON t.product_id = p.product_id
  LEFT JOIN test_types tt ON t.test_type_id = tt.id
  ORDER BY t.created_at DESC
  LIMIT 5
");
?>

<div class="container-fluid page-body-wrapper">
  <?php include("includes/sidebar.php"); ?>

  <div class="main-panel">
    <div class="content-wrapper">
      <h3 class="mb-4 text-center">Dashboard</h3>

      <!-- Summary Cards -->
      <div class="row">
        <?php
        $cards = [
          ['title' => 'Total Products', 'count' => $totalProducts, 'icon' => 'box', 'color' => 'primary'],
          ['title' => 'Total Tests', 'count' => $totalTests, 'icon' => 'flask', 'color' => 'success'],
          ['title' => 'Test Types', 'count' => $totalTestTypes, 'icon' => 'clipboard-list', 'color' => 'info'],
          ['title' => 'Departments', 'count' => $totalDepartments, 'icon' => 'building', 'color' => 'warning'],
          ['title' => 'Associations', 'count' => $totalAssociations, 'icon' => 'link', 'color' => 'danger'],
        ];
        foreach ($cards as $card) :
        ?>
          <div class="col-md-4 col-xl-2 mb-4">
            <div class="card bg-<?= $card['color'] ?> text-white shadow">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <h5><?= $card['title'] ?></h5>
                    <h3><?= $card['count'] ?></h3>
                  </div>
                  <i class="fas fa-<?= $card['icon'] ?> fa-2x"></i>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Recent Tests -->
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-center mb-4">Recent Tests</h4>
              <div class="table-responsive">
                <table class="table table-bordered text-dark">
                  <thead class="table-light">
                    <tr>
                      <th>Test ID</th>
                      <th>Product Name</th>
                      <th>Test Type</th>
                      <th>Status</th>
                      <th>Created At</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($recentTests->num_rows > 0) : ?>
                      <?php while ($row = $recentTests->fetch_assoc()) : ?>
                        <tr>
                          <td><?= $row['test_id'] ?></td>
                          <td><?= $row['product_name'] ?></td>
                          <td><?= $row['test_name'] ?></td>
                          <td>
                            <?php
                            $badge = 'secondary';
                            if ($row['status'] === 'Passed') $badge = 'success';
                            elseif ($row['status'] === 'Failed') $badge = 'danger';
                            elseif ($row['status'] === 'Pending') $badge = 'warning';
                            ?>
                            <span class="badge bg-<?= $badge ?>"><?= $row['status'] ?></span>
                          </td>
                          <td><?= date('d M Y, h:i A', strtotime($row['created_at'])) ?></td>
                        </tr>
                      <?php endwhile; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="5" class="text-center">No recent tests found.</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div> <!-- card-body -->
          </div> <!-- card -->
        </div> <!-- col -->
      </div> <!-- row -->
    </div> <!-- content-wrapper -->
  </div> <!-- main-panel -->
</div> <!-- page-body-wrapper -->

<?php include("includes/footer.php"); ?>
