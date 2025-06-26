<?php 
include("../../includes/header.php");

// Fetch dropdown data
$productQuery = "SELECT * FROM products";
$productResult = $conn->query($productQuery);

$typeQuery = "SELECT * FROM test_types";
$typeResult = $conn->query($typeQuery);

// Auto-generate test_id (e.g., TST001, TST002...)
$testId = "TST001";
$lastIdQuery = "SELECT test_id FROM tests ORDER BY id DESC LIMIT 1";
$lastIdResult = $conn->query($lastIdQuery);
if ($lastIdResult->num_rows > 0) {
    $lastRow = $lastIdResult->fetch_assoc();
    $lastNumber = intval(substr($lastRow['test_id'], 3)) + 1;
    $testId = 'TST' . str_pad($lastNumber, 3, '0', STR_PAD_LEFT);
}

// Handle form submission
if (isset($_POST['submit'])) {
    $product_id = $_POST['product_id'];
    $test_type_id = $_POST['test_type_id'];
    $tested_by = $_POST['tested_by'];
    $status = $_POST['status'];
    $remarks = $_POST['remarks'];
    $criteria = $_POST['criteria'];
    $observed_output = $_POST['observed_output'];

    $sql = "INSERT INTO tests (test_id, product_id, test_type_id, tested_by, status, remarks, criteria, observed_output) 
            VALUES ('$testId', '$product_id', '$test_type_id', '$tested_by', '$status', '$remarks', '$criteria', '$observed_output')";
    $result = $conn->query($sql);

    if ($result) {
        echo "<script>alert('Test record added successfully'); window.location.href='show_test.php';</script>";
    } else {
        echo "<script>alert('Failed to add test record');</script>";
    }
}
?>

<div class="container-fluid page-body-wrapper">
    <?php include("../../includes/sidebar.php"); ?>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">Add New Test Record</h4>
                            <form method="POST" class="forms-sample">
                                <div class="form-group">
                                    <label for="test_id">Test ID</label>
                                    <input type="text" class="form-control" name="test_id" value="<?php echo $testId; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="product_id">Product</label>
                                    <select name="product_id" class="form-control" required>
                                        <option value="">Select Product</option>
                                        <?php while($row = $productResult->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['product_id']; ?>"><?php echo $row['product_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="test_type_id">Test Type</label>
                                    <select name="test_type_id" class="form-control" required>
                                        <option value="">Select Test Type</option>
                                        <?php while($row = $typeResult->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['test_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tested_by">Tested By</label>
                                    <input type="text" class="form-control" name="tested_by" required placeholder="Enter Name of Tester">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="">Select Status</option>
                                        <option value="Passed">Passed</option>
                                        <option value="Failed">Failed</option>
                                        <option value="Pending">Pending</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="remarks">Remarks</label>
                                    <textarea name="remarks" class="form-control" rows="3" placeholder="Remarks"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="criteria">Criteria</label>
                                    <textarea name="criteria" class="form-control" rows="3" placeholder="Criteria for Testing"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="observed_output">Observed Output</label>
                                    <textarea name="observed_output" class="form-control" rows="3" placeholder="Observed Output"></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="submit" class="btn btn-primary">Add Test</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>

<?php include("../../includes/footer.php"); ?>
