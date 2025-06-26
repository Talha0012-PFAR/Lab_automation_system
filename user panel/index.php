<?php

include("header.php");
?>

<!-- Main -->
<div id="main">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="images/electric 1.jpg" height="450px" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="images/electric 2.avif" height="450px" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="images/electric 3.avif" height="450px" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <br>
  <br>

  <div class="inner">
    <!-- About Us -->
    <header id="inner">
      <h1>Test Your Electrical Products with Confidence!</h1>
      <p>We provide certified, accurate, and efficient product testing services for manufacturers. Whether you're launching a new appliance or validating an existing one, our lab ensures your product meets the highest standards. Join us to streamline your testing and reporting process — trusted by industry leaders.</p>
    </header>

    <br>

    <h2 class="h2">Featured Tests</h2>

    <!-- Tests -->
    <section class="tiles">
      <?php
      $sql = "select * from test_types order by id asc limit 6";
      $result = $conn->query($sql);
      while ($row = mysqli_fetch_assoc($result)) {

      ?>

        <article class="style1">
          <span class="image">
            <img src="images/continuety.jpg" height="300px" alt="" />
          </span>
          <a href="#">
            <h2><?php echo $row['test_name'] ?></h2>

           

            <p><?php echo $row['description'] ?> </p>
          </a>
        </article>
      <?php
      }
      ?>

    </section>

  

    <br>

    <h2 class="h2">Companies Feedback</h2>
     
    <div class="row">
      <div class="col-sm-6 text-center">
        <img src="images/testonomial 1.png" alt="ElectroPak Logo" class="rounded-circle mb-3" style="width: 80px; height: 80px; object-fit: cover;">
        <p class="m-n"><em>"Since integrating the Lab Automation System into our workflow, our testing and reporting process has become 3x faster. The ability to track product tests and generate reports instantly has been a game-changer."</em></p>

        <p><strong> – Asad Khan, QA Manager, ElectroPak Industries</strong></p>
        <p><strong> - Electrical Appliances Manufacturer</strong></p> 
      </div>
      
      <div class="col-sm-6 text-center">
        <img src="images/testonomial 2.png" alt="BrightLux Logo" class="rounded-circle mb-3" style="width: 80px; height: 80px; object-fit: cover;">
        <p class="m-n"><em>"Managing different test types like voltage, resistance, and insulation used to be a manual nightmare. With this system, our team can add, track, and analyze all tests seamlessly."</em></p>

        <p><strong>– Rabia Ahmed, Technical Director, BrightLux Lighting</strong> </p>
        <p><strong> – LED Lighting Manufacturer</strong></p>
      </div>
    </div>

    <p class="text-center"><a href="feedback.php">Read More &nbsp;<i class="fa fa-long-arrow-right"></i></a></p>

    

   

    


  </div>
</div>

<?php
include("footer.php");
?>