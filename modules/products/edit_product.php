<?php include("../../includes/header.php");
$id=($_GET['id']);
$sql="select * from products where id = $id";
$result=$conn->query($sql);
$products=mysqli_fetch_assoc($result);
?>

<div class="container-fluid page-body-wrapper">
  <?php include("../../includes/sidebar.php"); ?>

  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-8 grid-margin stretch-card mx-auto">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-center">Update Your Products</h4>
              <form class="forms-sample" method="POST" action="">
                <div class="form-group">
                  <label for="product_id">Product ID</label>
                  <input type="text" class="form-control" id="product_id" name="product_id" value="<?php echo $products['product_id']?>" placeholder="Enter Your Product ID">
                </div>
                <div class="form-group">
                  <label for="product_name">Product Name</label>
                  <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $products['product_name']?>" placeholder="Enter Your Product Name">
                </div>
                <div class="form-group">
                  <label for="revision">Revision</label>
                  <select class="form-control" id="revision" name="revision" required>
                    <option value="">Select Revision</option>
                    <option value="Rev A">Rev A</option>
                    <option value="Rev B">Rev B</option>
                    <option value="Rev C">Rev C</option>
                    <option value="Rev D">Rev D</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="manufacture_number">Manufacture Number</label>
                  <input type="text" class="form-control" id="manufacture_number" name="manufacture_number" value="<?php echo $products['manufacture_number']?>" placeholder="Enter Your Manufacture Number">
                </div>
                <div class="text-center">
                  <button type="submit" name="update" class="btn btn-primary">Update Products</button>
                </div>
              </form>
              
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php 
if(isset($_POST['update'])){
  $product_id=$_POST['product_id'];
  $product_name=$_POST['product_name'];
  $revision = $_POST['revision'];
  $manufacture_number=$_POST['manufacture_number'];
  $sql="update products set product_id = '$product_id' , product_name = '$product_name' ,  revision = '$revision' , manufacture_number = '$manufacture_number' where id = $id ";
  $result=$conn->query($sql);
  if($result==true){
    echo "<script>
    alert('Product Has Been Updated Successfully');
    window.location.href='show_product.php';
    </script>";
  }
}
?>
<?php include("../../includes/footer.php"); ?>
