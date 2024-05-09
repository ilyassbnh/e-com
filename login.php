<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
   $Email=$_POST['email'];
   $Password=$_POST['password'];
   
  
   if($Password !=""&& $Email!=""){
    


    

      
     
     
      
      $csvUser='User.csv';
      $delimiter=",";
      $fileHandle = fopen($csvUser, 'r');
      
    
      fgetcsv($fileHandle, 1000, $delimiter);
      while (($row = fgetcsv($fileHandle, 1000, $delimiter)) !== false) {
        if($row[2]==$Email&&$row[3]==$Password ){

        session_start();
        $_SESSION['userName']=$row[1];
       }
        else{


          echo'<script>alert("Wrong Email Or Password")</script>';
        }
        
      }
      header('Location:account.php');
      fclose($fileHandle);
      
  }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    }
  
    ?>


<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    integrity="sha512-LhPpY25LLe0GFG9xg3zAVt+aTZw2t7fI2w9lD5ydvfym1VxDz5wZPgeWz4wVWU6s8yCD9OPcPKwMgaUOjhX6bw=="
    crossorigin="anonymous" />
  <title>e-com</title>
</head>
<body class="bodyLogin">

    <form class="login"action="#" method="POST">
      <div><a class="navbar-brand" href="index.php"><img src="images/Logo 5.png"><br>TrendyClothes</a></div>
    <div>Login:<br>  
    <input name="email" type="text"></div>
    <div>Password:<br> <input name="password" type="text"></div>
    <div><input type="submit" > </div>
    <div><a href="signup.php">signup</a></div>
    </form>
</body>
</html>