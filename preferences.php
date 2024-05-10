<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $IdUser;
   $FullName=$_POST['fullName'];
   $Email=$_POST['email'];
   $Password1=$_POST['password1'];
   $Password2=$_POST['password2'];
  
   if($Password1 !=""&& $Password2!=""){
    if($Password1!=$Password2){

echo'<script>alert("Passwords Do Not Match")</script>';


    }
    else{

      echo'<script>alert("'.$FullName.'")</script>';
      $IdUser;
      $csvUser='User.csv';
      $delimiter=",";
      $fileHandle = fopen($csvUser, 'r');
      
    
      fgetcsv($fileHandle, 1000, $delimiter);
      while (($row = fgetcsv($fileHandle, 1000, $delimiter)) !== false) {
        
      
        $IdUser=$row[0];}
        
        $IdUser++;
      
  }
     
     
      $newUser= array($IdUser,$FullName, $Email,$Password1);
      $fileHandle = fopen($csvUser, 'a');
      if ($fileHandle !== false) {
    
    fputcsv($fileHandle, $newUser);


    fclose($fileHandle);



    }}}
  
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
    <script src="scripts.js"></script>
    <link rel="stylesheet" href="styles.css">
  <title>e-com</title>
</head>
<body class="bodyLogin" id="bodyPreferences">

  <div class="container">
    <h1 class="mt-5 mb-3 preferences-title">Select Your Preferences</h1>
    <div class="mb-3">
      <!-- Add more preference buttons as needed -->
      <button type="button" class="btn btn-outline preference-button" data-preference="preference1">Male</button>
      <button type="button" class="btn btn-outline preference-button" data-preference="preference2">Female</button>
      <button type="button" class="btn btn-outline preference-button" data-preference="preference3">Child</button>
      <button type="button" class="btn btn-outline preference-button" data-preference="preference4">Blue</button>
      <button type="button" class="btn btn-outline preference-button" data-preference="preference5">Red</button>
      <button type="button" class="btn btn-outline preference-button" data-preference="preference6">Green</button>
      <button type="button" class="btn btn-outline preference-button" data-preference="preference7">Hoodie</button>
      <button type="button" class="btn btn-outline preference-button" data-preference="preference8">Pants</button>
      <button type="button" class="btn btn-outline preference-button" data-preference="preference9">Shorts</button>
      <button type="button" class="btn btn-outline preference-button" data-preference="preference10">Sneakers</button>
      <button type="button" class="btn btn-outline preference-button" data-preference="preference11">Sweatshirt</button>
      <button type="button" class="btn btn-outline preference-button" data-preference="preference12">T-shirt</button>
    </div>
    <input type="text" id="selectedPreferences" class="form-control mb-3" readonly>
    <button type="button" class="btn" id="savePreferencesBtn">Save Preferences</button>
  </div>

</body>
</html>