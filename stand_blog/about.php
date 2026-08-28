<?php

// Database connection
require_once 'config.php';

// Get About Us data
$stmt = $pdo->prepare("SELECT * FROM about LIMIT 1");
$stmt->execute();

$about = $stmt->fetch(PDO::FETCH_ASSOC);

// If no data exists
if (!$about) {
    die("About Us information is not available.");
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta name="description" content="Clever Mind POB ICT - About Us">
  <meta name="author" content="Clever Mind POB ICT">

  <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap"
        rel="stylesheet">

  <title><?php echo htmlspecialchars($about['title']); ?> - Clever Mind POB</title>

  <!-- Bootstrap core CSS -->

  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Additional CSS Files -->

  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-stand-blog.css">
  <link rel="stylesheet" href="assets/css/owl.css">

</head>

<body>

  <!-- ***** Preloader Start ***** -->

  <div id="preloader">

```
<div class="jumper">
  <div></div>
  <div></div>
  <div></div>
</div>
```

  </div>

  <!-- ***** Preloader End ***** -->

  <!-- ==================== Header ==================== -->

  <header>

```
<nav class="navbar navbar-expand-lg">

  <div class="container">

    <!-- Clever Mind POB -->

    <a class="navbar-brand" href="index.php">

      <h2>
        Clever Mind POB<em>.</em>
      </h2>

    </a>


    <!-- Mobile Menu Button -->

    <button class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarResponsive"
            aria-controls="navbarResponsive"
            aria-expanded="false"
            aria-label="Toggle navigation">

      <span class="navbar-toggler-icon"></span>

    </button>


    <!-- Navigation Menu -->

    <div class="collapse navbar-collapse" id="navbarResponsive">

      <ul class="navbar-nav ml-auto">

        <!-- Home -->

        <li class="nav-item">

          <a class="nav-link" href="index.php">
            Home
          </a>

        </li>


        <!-- About Us -->

        <li class="nav-item active">

          <a class="nav-link" href="about.php">

            About Us

            <span class="sr-only">
              (current)
            </span>

          </a>

        </li>


        <!-- Grid Blog -->

        <li class="nav-item">

          <a class="nav-link" href="blog.php">
            Grid Blog
          </a>

        </li>


        <!-- Inner Blog -->

        <li class="nav-item">

          <a class="nav-link" href="post-details.php">
            Inner Blog
          </a>

        </li>


        <!-- Contact Us -->

        <li class="nav-item">

          <a class="nav-link" href="contact.php">
            Contact Us
          </a>

        </li>

      </ul>

    </div>

  </div>

</nav>
```

  </header>

  <!-- ==================== Page Heading ==================== -->

  <div class="heading-page header-text">

```
<section class="page-heading">

  <div class="container">

    <div class="row">

      <div class="col-lg-12">

        <div class="text-content">

          <h4>
            About Us
          </h4>

          <h2>
            <?php echo htmlspecialchars($about['title']); ?>
          </h2>

        </div>

      </div>

    </div>

  </div>

</section>
```

  </div>

  <!-- ==================== About Us ==================== -->

  <section class="about-us">

```
<div class="container">


  <!-- ==================== Main About Section ==================== -->

  <div class="row">

    <div class="col-lg-12">

      <!-- About Image -->

      <img
        src="assets/images/<?php echo htmlspecialchars($about['image']); ?>"
        alt="<?php echo htmlspecialchars($about['title']); ?>">


      <!-- Main About Description -->

      <p>

        <?php
        echo nl2br(htmlspecialchars($about['description']));
        ?>

      </p>

    </div>

  </div>


  <!-- ==================== About Items 1-2 ==================== -->

  <div class="row">


    <!-- Item 1 -->

    <div class="col-lg-6">

      <h4>
        <?php echo htmlspecialchars($about['item1_title']); ?>
      </h4>

      <p>

        <?php
        echo nl2br(htmlspecialchars($about['item1_description']));
        ?>

      </p>

    </div>


    <!-- Item 2 -->

    <div class="col-lg-6">

      <h4>
        <?php echo htmlspecialchars($about['item2_title']); ?>
      </h4>

      <p>

        <?php
        echo nl2br(htmlspecialchars($about['item2_description']));
        ?>

      </p>

    </div>

  </div>


  <!-- ==================== About Items 3-5 ==================== -->

  <div class="row">


    <!-- Item 3 -->

    <div class="col-lg-4 col-md-6">

      <h4>
        <?php echo htmlspecialchars($about['item3_title']); ?>
      </h4>

      <p>

        <?php
        echo nl2br(htmlspecialchars($about['item3_description']));
        ?>

      </p>

    </div>


    <!-- Item 4 -->

    <div class="col-lg-4 col-md-6">

      <h4>
        <?php echo htmlspecialchars($about['item4_title']); ?>
      </h4>

      <p>

        <?php
        echo nl2br(htmlspecialchars($about['item4_description']));
        ?>

      </p>

    </div>


    <!-- Item 5 -->

    <div class="col-lg-4">

      <h4>
        <?php echo htmlspecialchars($about['item5_title']); ?>
      </h4>

      <p>

        <?php
        echo nl2br(htmlspecialchars($about['item5_description']));
        ?>

      </p>

    </div>

  </div>


  <!-- ==================== About Items 6-9 ==================== -->

  <div class="row">


    <!-- Item 6 -->

    <div class="col-lg-3 col-md-6">

      <h4>
        <?php echo htmlspecialchars($about['item6_title']); ?>
      </h4>

      <p>

        <?php
        echo nl2br(htmlspecialchars($about['item6_description']));
        ?>

      </p>

    </div>


    <!-- Item 7 -->

    <div class="col-lg-3 col-md-6">

      <h4>
        <?php echo htmlspecialchars($about['item7_title']); ?>
      </h4>

      <p>

        <?php
        echo nl2br(htmlspecialchars($about['item7_description']));
        ?>

      </p>

    </div>


    <!-- Item 8 -->

    <div class="col-lg-3 col-md-6">

      <h4>
        <?php echo htmlspecialchars($about['item8_title']); ?>
      </h4>

      <p>

        <?php
        echo nl2br(htmlspecialchars($about['item8_description']));
        ?>

      </p>

    </div>


    <!-- Item 9 -->

    <div class="col-lg-3 col-md-6">

      <h4>
        <?php echo htmlspecialchars($about['item9_title']); ?>
      </h4>

      <p>

        <?php
        echo nl2br(htmlspecialchars($about['item9_description']));
        ?>

      </p>

    </div>

  </div>


  <!-- ==================== Social Media ==================== -->

  <div class="row">

    <div class="col-lg-12">

      <ul class="social-icons">


        <!-- Instagram -->

        <li>

          <a
            href="https://www.instagram.com/clevermindpob/"
            target="_blank"
            rel="noopener noreferrer">

            <i class="fa fa-instagram"></i>

          </a>

        </li>


        <!-- Twitter -->

        <li>

          <a
            href="https://twitter.com/search?q=cleverMindICT"
            target="_blank"
            rel="noopener noreferrer">

            <i class="fa fa-twitter"></i>

          </a>

        </li>


        <!-- Facebook -->

        <li>

          <a
            href="https://www.facebook.com/ClevermindICT/"
            target="_blank"
            rel="noopener noreferrer">

            <i class="fa fa-facebook"></i>

          </a>

        </li>


      </ul>

    </div>

  </div>


</div>
```

  </section>

  <!-- ==================== Footer ==================== -->

  <footer>

```
<div class="container">

  <div class="row">


    <!-- Footer Social Media -->

    <div class="col-lg-12">

      <ul class="social-icons">


        <!-- Instagram -->

        <li>

          <a
            href="https://www.instagram.com/clevermindpob/"
            target="_blank"
            rel="noopener noreferrer">

            Instagram

          </a>

        </li>


        <!-- Twitter -->

        <li>

          <a
            href="https://twitter.com/search?q=cleverMindICT"
            target="_blank"
            rel="noopener noreferrer">

            Twitter

          </a>

        </li>


        <!-- Facebook -->

        <li>

          <a
            href="https://www.facebook.com/ClevermindICT/"
            target="_blank"
            rel="noopener noreferrer">

            Facebook

          </a>

        </li>


      </ul>

    </div>


    <!-- Copyright -->

    <div class="col-lg-12">

      <div class="copyright-text">

        <p>
          Copyright 2026. Clever Mind POB ICT
        </p>

      </div>

    </div>


  </div>

</div>
```

  </footer>

  <!-- ==================== Bootstrap JavaScript ==================== -->

  <script src="vendor/jquery/jquery.min.js"></script>

  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- ==================== Additional Scripts ==================== -->

  <script src="assets/js/custom.js"></script>

  <script src="assets/js/owl.js"></script>

  <script src="assets/js/slick.js"></script>

  <script src="assets/js/isotope.js"></script>

  <script src="assets/js/accordions.js"></script>

  <script>

    var cleared = [];

    cleared[0] = cleared[1] = cleared[2] = 0;

    function clearField(t) {

      if (!cleared[t.id]) {

        cleared[t.id] = 1;

        t.value = '';

        t.style.color = '#fff';

      }

    }

  </script>

</body>

</html>
