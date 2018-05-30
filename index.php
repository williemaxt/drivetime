<?php
include_once 'connection.php';
$sql  = 'SELECT * FROM home';
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drive Time</title>
    <link rel="stylesheet" href="css/main.css">
  </head>
  <body>
    <!--Navigation menu-->
    <header>
        <div id="burger" class="burger-nav">
            <div></div>
            <div></div>
            <div></div>
        </div>
      <nav id="navbar">
          <h3 id="logoName">Prodrivetime</h3>
        <ul>
          <li><a>Home</a></li>
          <li><a href="clientRegister.php">Clients</a></li>
          <li><a href="driverRegister.php">Drivers</a></li>
          <li><a href="info.php">Info</a></li>
          <li><a href="chooseAccess.php">Login</a></li>
        </ul>
      </nav>
    </header>
    <!--Divider between the navigation and image-->
    <div style="width:100%; height:5px; background:#ffffff;"></div>

    <div id="imgHome"class="imgHeader">
      <div class="imgText">
        <h1><?php echo $row["title"];?></h1>
        <p><?php echo $row["sub_paragraph"];?></p>
        <a href="info.php"><button class="button" name="button">Learn More</button></a>
      </div>

    </div>
    <!--Divider between the navigation and image-->
    <div style="width:100%; height:5px; background:#ffffff;"></div>

<div id="homeBar" class="bar">
  <ul>
    <li><p>Drive Today! >></p></li>
    <li><a href="driverRegister.php"><button class="transparent-button">Sign Up</button></a></li>
  </ul>
</div>
    <!--Wrapper for properly formating content-->
<div class="wrapper">
  <main>
    <ul class="iconUl">
      <li><img src="images/id-card.svg">
      <h1><?php echo $row["text1"];?></h1>
      <p><?php echo $row["textarea1"];?></p>
    </li>

    <li><img src="images/shipped.svg">
    <h1><?php echo $row["textarea3"];?></h1>
    <p><?php echo $row["textareatext"];?></p>
  </li>

  <li><img src="images/signing-the-contract.svg">
  <h1><?php echo $row["textareatext1"];?></h1>
  <p><?php echo $row["textareatext2"];?></p>
</li>

<li><img src="images/payment-method.svg">
<h1><?php echo $row["textareatext3"];?></h1>
<p><?php echo $row["name22"];?></p>
</li>
    </ul>
  </main>

  <aside class="aside">
    <h1>We Would Love To Hear From You!</h1>
    <img src="images/worker.jpg" alt="">
    <h1>Contact Us!</h1>
    <input type="text" name="" placeholder="Name">
    <input type="text" name="" placeholder="Email">
    <input type="text" name="" placeholder="000-000-0000">
    <textarea name="name" rows="8" cols="80"></textarea>
    <button class="button" name="button">Submit</button>
  </aside>
</div> <!--End of the wrapper-->
<div id="secondBar" class="bar">
  <ul>
    <li><section>
      <img src="images/worker.jpg" alt="">
      <h1><?php echo $row["name23"];?></h1>
      <p><?php echo $row["name24"];?></p>
    </section></li>

    <li><section>
      <img src="images/worker.jpg" alt="">
      <h1><?php echo $row["name25"];?></h1>
      <p><?php echo $row["name26"];?></p>
    </section></li>

    <li><section>
      <img src="images/worker.jpg" alt="">
      <h1><?php echo $row["name27"];?></h1>
      <p><?php echo $row["comment1"];?></p>
    </section></li>
  </ul>
</div>
<div id="testimonies" class="wrapper"><!--Wrapper for the rest of the page-->
<h3 class="prompt">This Is What People Say About Us</h3>
<ul id="reviews">
  <li>
    <img src="images/man-user.svg" alt="">
    <h1><?php echo $row["comment2"];?></h1>
    <p>"<?php echo $row["comment3"];?>"</p>
  </li>
  <li>
    <img src="images/man-user.svg" alt="">
    <h1><?php echo $row["comment4"];?></h1>
    <p>"<?php echo $row["comment5"];?>"</p>
  </li>
  <li>
    <img src="images/man-user.svg" alt="">
    <h1><?php echo $row["comment6"];?></h1>
    <p>"<?php echo $row["comment7"];?>"</p>
  </li>
</ul>
</div><!--End of the second wrapper-->
<div id="homeBar" class="bar">
  <ul>
    <li><p>Hire Today! >></p></li>
    <li><a href="clientRegister.php"><button class="transparent-button">Sign up</button></a></li>
  </ul>
</div>
<!--Divider between the navigation and image-->
<div style="width:100%; height:5px; background:#ffffff;"></div>
<div id="imgHomeBottom"class="imgHeader">
  <div class="imgText">
    <h1>See How We Work</h1>
    <p>Check Out These Examples</p>
    <button class="button" name="button">See Pictures</button>
  </div>
</div>

<footer>
  <div class="wrapper">
    <ul>
      <li>
        <h1><?php echo $row["footer1"];?></h1>
        <p><?php echo $row["footer2"];?></p>
      </li>
      <li>
        <h1><?php echo $row["footer3"];?></h1>
        <?php echo $row["footer4"];?>
      </li>
      <li>
        <h1><?php echo $row["footer5"];?></h1>
        <?php echo $row["footer6"];?>
      </li>
      <li>
        <h1><?php echo $row["footer7"];?></h1>
        <?php echo $row["footer8"];?>
      </li>
    </ul>
  </div>
<div class="footerBottom">
 <p>&copy; Drive Time 2018. All Rights Reserved. Developed By 611 Solutions, LLC</p>
</div>
</footer>
  </body>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="js/index.js"></script>
</html>
