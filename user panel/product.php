<?php
include("header.php");
?>

<!-- Main -->
<div id="main">
  <div class="inner">
    <h1>Products</h1>

    <div class="image main">
      <img src="images/product banner.jpg" class="img-fluid" alt="" />
    </div>
<br>
<br>
    <!-- Products -->
    <section class="tiles">
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

                        <th>PRODUCT NAME</th>
                        <th>REVISON</th>
                        <th>MANUFACTURE NUMBER</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "select * from products order by id asc limit 8";
                      $result = $conn->query($sql);
                      while ($row = mysqli_fetch_assoc($result)) {

                      ?>
                        <tr>
                          <th><?php echo $row['id'] ?></th>
                          <td><?php echo $row['product_name'] ?></td>
                          <td><?php echo $row['revision'] ?></td>
                          <td><?php echo $row['manufacture_number'] ?></td>
                        <?php
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

    </section>
  </div>
</div>



<?php
include("footer.php");
?>