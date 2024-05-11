<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Registration form handling
    $IdUser = 0; // Initialize IdUser variable
    $FullName = $_POST['fullName'];
    $Email = $_POST['email'];
    $Password1 = $_POST['password1'];
    $Password2 = $_POST['password2'];

    if ($Password1 != "" && $Password2 != "") {
        if ($Password1 != $Password2) {
            // Display error message within the HTML form
            echo '<span style="color: red;">Passwords Do Not Match</span>';
        } else {
            // Increment user ID
            $csvUser = 'User.csv';
            $delimiter = ",";
            $fileHandle = fopen($csvUser, 'r');
            fgetcsv($fileHandle, 1000, $delimiter);
            while (($row = fgetcsv($fileHandle, 1000, $delimiter)) !== false) {
                $IdUser = $row[0];
            }
            $IdUser++;
            fclose($fileHandle);

            // Save user data to CSV file
            $newUser = array($IdUser, $FullName, $Email, $Password1);
            $fileHandle = fopen($csvUser, 'a');
            if ($fileHandle !== false) {
                fputcsv($fileHandle, $newUser);
                fclose($fileHandle);
            }

            // Handle preferences form submission
            $gender = $_POST['gender'];
            $favoriteColor = $_POST['favorite_color'];
            $clothesType = $_POST['clothes_type'];

            // Open the CSV file in append mode
            $csvFile = 'preferences.csv';
            $file = fopen($csvFile, 'a');

            // Prepare data to be written to the CSV file
            $userData = [$gender, $favoriteColor, $clothesType];

            // Write the user data to the CSV file
            fputcsv($file, $userData);

            // Close the file
            fclose($file);

            // Redirect to account page after registration
            header('Location: account.php');
            exit;
        }
    }
}
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
  <script src="scripts.js"></script>
  <title>e-com</title>
</head>
<body class="bodyLogin">
    <form class="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div><a class="navbar-brand" href="index.php"><img src="images/Logo 5.png"><br>TrendyClothes</a></div>
        <div>Full Name:<br><input name="fullName" type="text"></div>  
        <div>Email:<br><input name="email" type="text"></div>
        <div>Password:<br> <input name="password1" type="password"></div>
        <div>Confirm Password:<br> <input name="password2" type="password"></div>
      </form>
    <h1 class="mt-5 mb-3 preferences-title">Select Your Preferences</h1>
    <div class="mb-3">
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
    <input type="text" id="selectedPreferences" name="selectedPreferences" class="form-control mb-3" readonly>
    <button type="button" class="btn" id="savePreferencesBtn" onclick="redirect()">Sign Up</button>
    <script>
function redirect() {
    window.location.href = "account.php";
}
</script>
</body>
</html>
