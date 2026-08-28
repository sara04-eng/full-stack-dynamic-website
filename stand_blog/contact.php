<?php

require_once "config.php";

/*
|--------------------------------------------------------------------------
| Contact Form
|--------------------------------------------------------------------------
*/

$successMessage = "";
$errorMessage = "";


/*
|--------------------------------------------------------------------------
| Handle Contact Form Submission
|--------------------------------------------------------------------------
*/

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $subject = trim($_POST["subject"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if ($name === "" || $email === "" || $subject === "" || $message === "") {

        $errorMessage = "Please fill in all fields.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $errorMessage = "Please enter a valid email address.";

    } else {

        try {

            $stmt = $pdo->prepare("
                INSERT INTO contact_messages
                (name, email, subject, message)
                VALUES (?, ?, ?, ?)
            ");

            $stmt->execute([
                $name,
                $email,
                $subject,
                $message
            ]);

            $successMessage = "Your message has been sent successfully.";

        } catch (PDOException $e) {

            $errorMessage = "Something went wrong. Please try again.";

        }
    }
}


/*
|--------------------------------------------------------------------------
| Get Contact Information
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
    SELECT phone, email, address
    FROM contact_info
    LIMIT 1
");

$stmt->execute();

$contactInfo = $stmt->fetch();


/*
|--------------------------------------------------------------------------
| Default Contact Information
|--------------------------------------------------------------------------
*/

$phone = $contactInfo["phone"] ?? "";
$email = $contactInfo["email"] ?? "";
$address = $contactInfo["address"] ?? "";


/*
|--------------------------------------------------------------------------
| Get Social Links
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
    SELECT platform, url
    FROM social_links
    ORDER BY id ASC
");

$stmt->execute();

$socialLinks = $stmt->fetchAll();

?>

<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1, shrink-to-fit=no"

>

<meta
name="description"
content="Contact Clever Mind POB ICT"

>

<meta
name="author"
content="Clever Mind POB ICT"

>

  <link
    href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap"
    rel="stylesheet"
  >

  <title>Clever Mind POB - Contact Us</title>

  <!-- Bootstrap core CSS -->

  <link
    href="vendor/bootstrap/css/bootstrap.min.css"
    rel="stylesheet"
  >

  <!-- Additional CSS Files -->

  <link
    rel="stylesheet"
    href="assets/css/fontawesome.css"
  >

  <link
    rel="stylesheet"
    href="assets/css/templatemo-stand-blog.css"
  >

  <link
    rel="stylesheet"
    href="assets/css/owl.css"
  >

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

  <!-- ================= HEADER ================= -->

  <header>

```
<nav class="navbar navbar-expand-lg">

  <div class="container">


    <!-- Clever Mind POB Logo / Name -->

    <a
      class="navbar-brand"
      href="index.php"
    >

      <h2>
        Clever Mind POB<em>.</em>
      </h2>

    </a>


    <!-- Mobile Menu Button -->

    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarResponsive"
      aria-controls="navbarResponsive"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >

      <span class="navbar-toggler-icon"></span>

    </button>


    <!-- Navigation Menu -->

    <div
      class="collapse navbar-collapse"
      id="navbarResponsive"
    >

      <ul class="navbar-nav ml-auto">


        <!-- Home -->

        <li class="nav-item">

          <a
            class="nav-link"
            href="index.php"
          >
            Home
          </a>

        </li>


        <!-- About Us -->

        <li class="nav-item">

          <a
            class="nav-link"
            href="about.php"
          >
            About Us
          </a>

        </li>


        <!-- Grid Blog -->

        <li class="nav-item">

          <a
            class="nav-link"
            href="blog.php"
          >
            Grid Blog
          </a>

        </li>


        <!-- Inner Blog -->

        <li class="nav-item">

          <a
            class="nav-link"
            href="post-details.php"
          >
            Inner Blog
          </a>

        </li>


        <!-- Contact Us -->

        <li class="nav-item active">

          <a
            class="nav-link"
            href="contact.php"
          >

            Contact Us

            <span class="sr-only">
              (current)
            </span>

          </a>

        </li>


      </ul>

    </div>

  </div>

</nav>


  </header>

  <!-- ================= PAGE HEADING ================= -->

  <div class="heading-page header-text">

```
<section class="page-heading">

  <div class="container">

    <div class="row">

      <div class="col-lg-12">

        <div class="text-content">

          <h4>
            Contact Us
          </h4>

          <h2>
            Get In Touch With Us
          </h2>

        </div>

      </div>

    </div>

  </div>

</section>
```

  </div>

  <!-- ================= CONTACT SECTION ================= -->

  <section class="contact-us">

```
<div class="container">

  <div class="row">


    <!-- ================= CONTACT FORM ================= -->

    <div class="col-lg-12">

      <div class="down-contact">

        <div class="row">


          <div class="col-lg-8">

            <div class="sidebar-item contact-form">


              <div class="sidebar-heading">

                <h2>
                  Send Us a Message
                </h2>

              </div>


              <div class="content">


                <!-- Success Message -->

                <?php if ($successMessage !== ""): ?>

                  <div class="alert alert-success">

                    <?= htmlspecialchars($successMessage) ?>

                  </div>

                <?php endif; ?>


                <!-- Error Message -->

                <?php if ($errorMessage !== ""): ?>

                  <div class="alert alert-danger">

                    <?= htmlspecialchars($errorMessage) ?>

                  </div>

                <?php endif; ?>


                <!-- Contact Form -->

                <form
                  id="contact"
                  action="contact.php"
                  method="post"
                >


                  <div class="row">


                    <!-- Name -->

                    <div class="col-md-6 col-sm-12">

                      <fieldset>

                        <input
                          name="name"
                          type="text"
                          id="name"
                          placeholder="Your Name"
                          value="<?= htmlspecialchars($_POST["name"] ?? "") ?>"
                          required
                        >

                      </fieldset>

                    </div>


                    <!-- Email -->

                    <div class="col-md-6 col-sm-12">

                      <fieldset>

                        <input
                          name="email"
                          type="email"
                          id="email"
                          placeholder="Your Email"
                          value="<?= htmlspecialchars($_POST["email"] ?? "") ?>"
                          required
                        >

                      </fieldset>

                    </div>


                    <!-- Subject -->

                    <div class="col-md-12 col-sm-12">

                      <fieldset>

                        <input
                          name="subject"
                          type="text"
                          id="subject"
                          placeholder="Subject"
                          value="<?= htmlspecialchars($_POST["subject"] ?? "") ?>"
                          required
                        >

                      </fieldset>

                    </div>


                    <!-- Message -->

                    <div class="col-lg-12">

                      <fieldset>

                        <textarea
                          name="message"
                          rows="6"
                          id="message"
                          placeholder="Your Message"
                          required
                        ><?= htmlspecialchars($_POST["message"] ?? "") ?></textarea>

                      </fieldset>

                    </div>


                    <!-- Submit -->

                    <div class="col-lg-12">

                      <fieldset>

                        <button
                          type="submit"
                          id="form-submit"
                          class="main-button"
                        >

                          Send Message

                        </button>

                      </fieldset>

                    </div>


                  </div>


                </form>


              </div>

            </div>

          </div>


          <!-- ================= CONTACT INFORMATION ================= -->

          <div class="col-lg-4">

            <div class="sidebar-item contact-information">


              <div class="sidebar-heading">

                <h2>
                  Contact Information
                </h2>

              </div>


              <div class="content">

                <ul>


                  <!-- Phone -->

                  <li>

                    <h5>

                      <?= htmlspecialchars($phone) ?>

                    </h5>

                    <span>
                      PHONE NUMBER
                    </span>

                  </li>


                  <!-- Email -->

                  <li>

                    <h5>

                      <?= htmlspecialchars($email) ?>

                    </h5>

                    <span>
                      EMAIL ADDRESS
                    </span>

                  </li>


                  <!-- Address -->

                  <li>

                    <h5>

                      <?= nl2br(htmlspecialchars($address)) ?>

                    </h5>

                    <span>
                      ADDRESS
                    </span>

                  </li>


                </ul>

              </div>

            </div>

          </div>


        </div>

      </div>

    </div>


    <!-- ================= GPS MAP ================= -->

    <div class="col-lg-12">

      <div id="map">


        <iframe
          src="https://www.google.com/maps?q=KHBP%20Amman%20Jordan&output=embed"
          width="100%"
          height="450px"
          frameborder="0"
          style="border:0"
          allowfullscreen
        >
        </iframe>


      </div>

    </div>


  </div>

</div>
```

  </section>

  <!-- ================= FOOTER ================= -->

  <footer>

```
<div class="container">

  <div class="row">


    <!-- Social Media -->

    <div class="col-lg-12">

      <ul class="social-icons">


        <?php foreach ($socialLinks as $social): ?>

          <li>

            <a
              href="<?= htmlspecialchars($social["url"]) ?>"
              target="_blank"
              rel="noopener noreferrer"
            >

              <?= htmlspecialchars($social["platform"]) ?>

            </a>

          </li>

        <?php endforeach; ?>


      </ul>

    </div>


    <!-- Copyright -->

    <div class="col-lg-12">

      <div class="copyright-text">

        <p>
          Copyright 2021. Clever Mind POB ICT
        </p>

      </div>

    </div>


  </div>

</div>
```

  </footer>

  <!-- ================= JAVASCRIPT ================= -->

  <script src="vendor/jquery/jquery.min.js"></script>

  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

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
