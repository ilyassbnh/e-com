<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['userName']) && !empty($_SESSION['userName'])) {
  // If logged in, redirect to the account page
  header('Location: account.php');
  exit; // Stop execution after redirection
}

// Check if the registration form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Process user registration
  // (Add your registration logic here, similar to the code you provided)
  $IdUser;
  $FullName = $_POST['fullName'];
  $Email = $_POST['email'];
  $Password1 = $_POST['password1'];
  $Password2 = $_POST['password2'];

  if ($Password1 != "" && $Password2 != "") {
    if ($Password1 != $Password2) {
      echo '<script>alert("Passwords Do Not Match")</script>';
    } else {
      // Registration successful, perform necessary actions
      $IdUser;
      $csvUser = 'User.csv';
      $delimiter = ",";
      $fileHandle = fopen($csvUser, 'r');
      fgetcsv($fileHandle, 1000, $delimiter);
      while (($row = fgetcsv($fileHandle, 1000, $delimiter)) !== false) {
        $IdUser = $row[0];
      }
      $IdUser++;
      $newUser = array($IdUser, $FullName, $Email, $Password1);
      $fileHandle = fopen($csvUser, 'a');
      if ($fileHandle !== false) {
        fputcsv($fileHandle, $newUser);
        fclose($fileHandle);
      }
    }
  }

  // Process user preferences
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

  // Redirect to the account page after registration
  header('Location: account.php');
  exit; // Stop execution after redirection
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="styles.css">
  <script src="https://kit.fontawesome.com/f124013f63.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="scripts.js"></script>
  <title>e-com</title>
</head>

<body>
  <nav id="navbar-example2" class="navbar  bg-body-tertiary px-3 mb-3">
    <a class="navbar-brand" href="#"><img src="images/Logo 5.png">TrendyClothes</a>
    <ul class="nav nav-pills">
      <li class="nav-item ">
        <a class="nav-link" href="#scrollspyHeading1">Shop</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#scrollspyHeading2">Gallery</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#scrollspyHeading3">Trending Product</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#scrollspyHeading4">Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#scrollspyHeading5">New Products</a>
      </li>
      <!--<li class="nav-item">
        <a class="nav-link" href="panel.php">Panel</a>
      </li>-->
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>

      <form class="d-flex" role="search" action="#" method="POST">
      <div class="input-group">
        <input name="searchInput"class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
 
      </div>

        </div>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
          <span class="input-group-text"><i class="fas fa-filter" data-bs-toggle="modal-body" data-bs-target="#exampleModal" style="color: white"></i></span>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-focus="false">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Filtering</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label for="colorFilter" class="form-label">Color:</label>
                  <select name="colorFilter"class="form-select" id="colorFilter">
                    <option value="red" style="color: red;">&#x25A0; Red</option>
                    <option value="blue" style="color: blue;">&#x25A0; Blue</option>
                    <option value="green" style="color: green;">&#x25A0; Green</option>
                    <option value="gray" style="color: gray;">&#x25A0; Gray</option>
                    <option value="black" style="color: black;">&#x25A0; Black</option>
                    <option value="white" style="color: white; background-color: gray;">&#x25A0; White</option>
                  </select>
                </div>



                <div class="mb-3">
                  <label for="sizeFilter" class="form-label">Size:</label>
                  <select name="sizeFilter"class="form-select" id="sizeFilter">
                    <option selected>Select Size</option>
                    <option value="XXS">XXS</option>
                    <option value="XS">XS</option>
                    <option value="S">S</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label for="priceFilter" class="form-label">Price Range:</label>
                  <input type="range" class="form-range" id="priceFilter" min="0" max="1000" step="1">
                  <div id="priceDisplay">0 MAD</div>
                </div>

              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>


        <button class="btn btn-outline" type="submit">Search </button>
      </form>
    </ul>
  </nav>
  <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">
<section class="disappear">

    <!-- First heading -->
    <h4 id="scrollspyHeading1">First heading</h4>
    <div id="carouselExampleCaptions" class="carousel slide">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="row">
            <div class="col-md-6">
              <img src="images/Cartoon Bear Baby Romper with Hat.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="col-md-6" style="color: black;">
              <h5>summer sales</h5>
              <h2>You wanna a bear for your baby ?</h2>
              <p> Lorem ipsum dolor adipisicing elit. Aperiam tempore doloremque iste? Quis quasi officia facere soluta
                sapiente quae, corporis saepe minima dolorem </p>
              <h4>20% OFF</h4>
            </div>
          </div>
        </div>
        <div class="carousel-item ">
          <div class="row">
            <div class="col-md-6">
              <img src="images/Camiseta Casual Masculina - Ice Cool - Azul Escuro _ 4G.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="col-md-6" style="color: black;">
              <h5>summer sales</h5>
              <h2>You wanna a Camiseta ?</h2>
              <p> Lorem ipsum dolor adipisicing elit. Aperiam tempore doloremque iste? Quis quasi officia facere soluta
                sapiente quae, corporis saepe minima dolorem </p>
              <h4>20% OFF</h4>
            </div>
          </div>
        </div>
        <div class="carousel-item ">
          <div class="row">
            <div class="col-md-6">
              <img src="images/Solid Color Men's Women's Hoodie Jacket Fashion Street Casual Sets Autumn Winter Fleece Sportswear + Pants 2024Multicolor Suit green11-L.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="col-md-6" style="color: black;">
              <h5>summer sales</h5>
              <h2>You wanna a Hoodie Jacket ?</h2>
              <p> Lorem ipsum dolor adipisicing elit. Aperiam tempore doloremque iste? Quis quasi officia facere soluta
                sapiente quae, corporis saepe minima dolorem </p>
              <h4>20% OFF</h4>
            </div>
          </div>
        </div>
        <!-- Repeat the above structure for other carousel items -->
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>



    <!-- Second heading -->
    <div class="second-heading" id="scrollspyHeading2">
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h1 class="card-title">01</h1>
          <h6 class="card-subtitle mb-2 text-body-secondary">LOCAL MARKET & ARTISANS</h6>
          <p class="card-text">Sed ac interdum sapien, et sagittis dui. Nunc fringilla mattis dolor.</p>
        </div>
      </div>
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h1 class="card-title">02</h1>
          <h6 class="card-subtitle mb-2 text-body-secondary">FREE LOCAL SHIPPING</h6>
          <p class="card-text">Sed ac interdum sapien, et sagittis dui. Nunc fringilla mattis dolor.</p>
        </div>
      </div>
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h1 class="card-title">03</h1>
          <h6 class="card-subtitle mb-2 text-body-secondary">MONEY BACK GUARANTEE</h6>
          <p class="card-text">Sed ac interdum sapien, et sagittis dui. Nunc fringilla mattis dolor.</p>
        </div>
      </div>
    </div>


    <!-- TRENDING PRODUCTS -->
    <h4 id="scrollspyHeading3">TRENDING PRODUCTS</h4>
    <div class="trend-prod">
      <div class="card" style="width: 18rem;">
        <img src="images/2024 Men's Casual Pants Loose Waffle Plaid Pants Young Men Spring Autumn Seasons Sweatpants Casual Sweatpants 4XL 80-90kg-Espresso.jpeg" class="card-img-top" alt="...">
        <div class="card-body">
          <p class="card-text">name of the element</p>
          <p class="card-text">price</p>
        </div>
      </div>
      <div class="card" style="width: 18rem;">
        <img src="images/Camiseta Casual Masculina - Ice Cool - Azul Escuro _ 4G.jpeg" class="card-img-top" alt="...">
        <div class="card-body">
          <p class="card-text">name of the element</p>
          <p class="card-text">price</p>
        </div>
      </div>
      <div class="card" style="width: 18rem;">
        <img src="images/Cartoon Bear Baby Romper with Hat.jpeg" class="card-img-top" alt="...">
        <div class="card-body">
          <p class="card-text">name of the element</p>
          <p class="card-text">price</p>
        </div>
      </div>
      <div class="card" style="width: 18rem;">
        <img src="images/Solid Color Men's Women's Hoodie Jacket Fashion Street Casual Sets Autumn Winter Fleece Sportswear + Pants 2024Multicolor Suit green11-L.jpeg" class="card-img-top" alt="...">
        <div class="card-body">
          <p class="card-text">name of the element</p>
          <p class="card-text">price</p>
        </div>
      </div>
    </div>



    <!-- Fourth heading -->
    <div class="fourth-heading">
      <h1 id="scrollspyHeading4">blog</h1>
      <button type="button" class="btn btn-outline-secondary">Browse All</button>
      <div class="feartured-items">
        <div class="left-feartured">
          <h3>FEATURED ITEMS</h3>
          <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Provident rerum!</p>
          <img src="images/Camiseta Casual Masculina - Ice Cool - Azul Escuro _ 4G.jpeg" alt="hoodies image">
        </div>
        <div class="right-reartured">
          <img src="images/Solid Color Men's Women's Hoodie Jacket Fashion Street Casual Sets Autumn Winter Fleece Sportswear + Pants 2024Multicolor Suit green11-L.jpeg" alt="hoodies image">
          <img src="images/Cartoon Bear Baby Romper with Hat.jpeg" alt="hoodies image">
        </div>
      </div>
    </div>


    <!-- new product -->
    <h1 id="scrollspyHeading5">New Products</h1>
    <div class="new-product">

      <?php $filename = 'Book.csv';
      $delimiter = ',';
      if (($handle = fopen($filename, 'r')) !== false) {
        fgetcsv($handle, 1000, $delimiter);
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
          echo '<div class="cardNP" style="width: 18rem;">
            <img src="' . $row[6] . '" class="card-img-top" alt="...">
            <div class="card-body">
              <p class="card-text">' . $row[2] . '</p> 
              <p class="card-text">' . $row[5] . ' MAD</p>
            </div>
          </div>';
        }
        fclose($handle);
      }


      ?>


    </div>



    <div class="happyCustomers">
      <h1>HAPPY CUSTOMERS</h1>
      <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam aliquam, felis in consectetur rutrum, lectus urna
        malesuada ligula, eget pulvinar dui leo at eros."</p>
      <h2>DAN VIRGILLITO</h2>
      <h3>BLOGGER</h3>

    </div>
    <div class="ourBlog">
      <div>
        <h1>OUR BLOG</h1>
      </div>
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="images/worldIsBetter.svg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">NUNC VOLUTPAT VENENATIS</h5>
          <p class="card-text">Nulla a odio sed magna congue condimentum. Pellentesque convallis enim nec libero vulputate, et rhoncus urna
            placerat. Phasellus mattis, diam vel vehicula facilisis</p>

        </div>
      </div>
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="images/eyeHoody.svg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">VESTIBULUM NISL FELIS</h5>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc aliquam justo et nibh venenatis aliquet. Morbi
            mollis mollis pellentesque. Aenean vitae erat velit</p>

        </div>
      </div>
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="images/imDelight.svg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">PROIN EU AUGUE EFFICITUR</h5>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc aliquam justo et nibh venenatis aliquet. Morbi
            mollis mollis pellentesque. Aenean vitae erat velit.</p>

        </div>
      </div>


    </div>

    <!-- news -->
    <h1 id="scrollspyHeading5">stay up to date</h1>
    <div class="news">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Name" aria-label="Username" aria-describedby="basic-addon1">
        <input type="text" class="form-control" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1">
        <button type="button" class="btn btn-outline-secondary">Subscribe</button>
      </div>




    </div>

  </div>
  <script src="https://kit.fontawesome.com/f124013f63.js" crossorigin="anonymous"></script>
</body>

</section>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$text=$_POST['searchInput'];


if($_POST['sizeFilter']!="" && isset($_POST['sizeFilter'])){
$size=$_POST['sizeFilter'];


}
else{

  $size="";
}
if($_POST['colorFilter']!="" && isset($_POST['colorFilter'])){

  echo'<script>'.$_POST['colorFilter'].'</script>';
  $color=$_POST['colorFilter'];
  
  
  }
  else{
  
    $color="";
  }


$file = 'Book.csv';
$delimite= ',';
if (($manage= fopen($file, 'r')) !== false) {
  fgetcsv($manage, 1000, $delimite);
  echo'<script>document.querySelector(".disappear").style.display="none";</script>';
  while (($row = fgetcsv($manage, 1000, $delimite)) !== false) {

    
    if($text==$row[2]&&$size==$row[3]&&$color==$row[4]){
    
     echo '<div class="cardNP" style="width: 18rem;">
     <img src="' . $row[6] . '" class="card-img-top" alt="...">
     <div class="card-body">
       <p class="card-text">' . $row[2] . '</p> 
       <p class="card-text">' . $row[5] . ' MAD</p>
       <p class="card-text">' . $row[3] . '</p>
       <p class="card-text">' . $row[4] . '</p>
     </div>
   </div>';
     }

     
     
     
  }
  
  
 
  fclose($manage);
  
}}

?>
<!-- footer -->
<footer>
  <div class="ftr-left">
    <h5>HELP & INFORMATION</h5>
    <p>Help</p>
    <p>Order</p>
    <p>Delivery & returns</p>
  </div>
  <div class="ftr-middle">
    <h5>About TrendyClothes</h5>
    <p>About Us</p>
    <p>Careers at TrendyClothes</p>
    <p>© 2024 TrendyClothes</p>
  </div>
  <div class="ftr-right">
    <h5>FOLLOW US</h5>
    <p>Facebook</p>
    <p>Instagram</p>
    <p>Twitter</p>
  </div>
</footer>
</body>

</html>
