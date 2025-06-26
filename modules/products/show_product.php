<?php
include("../../includes/header.php"); 
if(isset($_GET['id'])){
   $id=$_GET['id'];
   $sql="delete from products where id= $id";
   $result=$conn->query($sql);
   echo $result;
   
}

$sql="select * from products";
$result=$conn->query($sql);
?>


<div class="container-fluid page-body-wrapper">
   <?php include("../../includes/sidebar.php"); ?> <!-- Sidebar on the left -->

<div class="content-body">
  <div class="container-fluid ">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-responsive-sm text-dark table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>PRODUCT ID</th>
                  <th>PRODUCT NAME</th>
                  <th>REVISON</th>
                  <th>MANUFACTURE NUMBER</th>
                  <th>EDIT</th>
                  <th>DELETE</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if($result->num_rows >0){
                  while ($row=$result->fetch_assoc()){
                ?>
                <tr>
                  <th><?php echo $row['id'] ?></th>
                  <td><?php echo $row['product_id'] ?></td>
                  <td><?php echo $row['product_name'] ?></td>
                  <td><?php echo $row['revision'] ?></td>
                  <td><?php echo $row['manufacture_number'] ?></td>
                  <td><a href="edit_product.php?id=<?php echo $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a></td>
                  <td><a href="show_product.php?id=<?php echo $row['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a></td>
                </tr>
                <?php
                  }
                }
                ?>
              </tbody>
              </table>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>









<?php include("../../includes/footer.php"); ?>