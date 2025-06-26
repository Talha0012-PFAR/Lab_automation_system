<?php 


session_start();
include("../includes/conn.php");
if(isset($_POST['submit'])){
  $username=$_POST['username'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $sql="select * from users where username = '$username' and email = '$email' and password = '$password'";
  $result=$conn->query($sql);
  
  if($result->num_rows >0){
    
    echo"<script>
    alert('Login is Successful')
     
    </script>";

    echo"<script>
    setTimeout(()=>{
    window.location.href='../dashboard.php';
    },3000)
     
    </script>";
    exit;
  }else{
  echo"<script>
    alert('Login Failed')
     
    </script>";
  
  }
  
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Lab Automation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body, html {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    .bg-overlay {
      background: url('../assets/images/pexels-pixabay-459728.jpg') no-repeat center center fixed;
      background-size: cover;
      position: absolute;
      height: 100%;
      width: 100%;
      z-index: -1;
      opacity: 0.4;
    }

    .form-wrapper {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card {
      background-color: rgba(255, 255, 255, 0.95);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      border-radius: 1rem;
      padding: 2rem;
    }

    .card-title {
      font-weight: bold;
    }
  </style>
</head>
<body>

  <div class="bg-overlay"></div> <!-- background image layer -->

  <div class="container form-wrapper">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title text-center mb-4">Login</h4>
          <form method="POST" action="">
            <div class="form-group mb-3">
              <label for="username">Username</label>
              <input type="text" name="username" class="form-control" placeholder="Enter Your Name" required>
            </div>
            <div class="form-group mb-3">
              <label for="email">Email</label>
              <input type="email" name="email" class="form-control" placeholder="Enter Your Email" required>
            </div>
            <div class="form-group mb-4">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" placeholder="Enter Your Password" required>
            </div>
            <div class="d-grid">
              <button type="submit" name="submit" class="btn btn-primary">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
