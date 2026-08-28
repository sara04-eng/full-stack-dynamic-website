
<?php

require_once "config.php";

/*
|--------------------------------------------------------------------------
| Get Blog Posts From Database
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
    SELECT
        id,
        image,
        title,
        subtitle,
        blogger_name,
        publish_date,
        description
    FROM blogs
    ORDER BY publish_date DESC
");

$stmt->execute();

$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">

  <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta name="description"
        content="Clever Mind POB ICT">

  <meta name="author"
        content="Clever Mind POB ICT">

  <link
    href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
    rel="stylesheet">

  <title>Clever Mind POB ICT</title>


  <!-- Bootstrap core CSS -->

  <link
    href="vendor/bootstrap/css/bootstrap.min.css"
    rel="stylesheet">


  <!-- Additional CSS Files -->

  <link
    rel="stylesheet"
    href="assets/css/fontawesome.css">

  <link
    rel="stylesheet"
    href="assets/css/templatemo-stand-blog.css">

  <link
    rel="stylesheet"
    href="assets/css/owl.css">

</head>


<body>


  <!-- ***** Preloader Start ***** -->

  <div id="preloader">

    <div class="jumper">

      <div></div>

      <div></div>

      <div></div>

    </div>

  </div>

  <!-- ***** Preloader End ***** -->


  <!-- ==================== HEADER ==================== -->

  <header>

    <nav class="navbar navbar-expand-lg">

      <div class="container">


        <!-- Clever Mind POB -->

        <a class="navbar-brand"
           href="index.php">

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
          aria-label="Toggle navigation">

          <span class="navbar-toggler-icon"></span>

        </button>


        <!-- Navigation Menu -->

        <div
          class="collapse navbar-collapse"
          id="navbarResponsive">

          <ul class="navbar-nav ml-auto">


            <!-- Home -->

            <li class="nav-item active">

              <a class="nav-link"
                 href="index.php">

                Home

                <span class="sr-only">
                  (current)
                </span>

              </a>

            </li>


            <!-- About Us -->

            <li class="nav-item">

              <a class="nav-link"
                 href="about.php">

                About Us

              </a>

            </li>


            <!-- Grid Blog -->

            <li class="nav-item">

              <a class="nav-link"
                 href="blog.php">

                Grid Blog

              </a>

            </li>


            <!-- Inner Blog -->

            <li class="nav-item">

              <a class="nav-link"
                 href="post-details.php">

                Inner Blog

              </a>

            </li>


            <!-- Contact Us -->

            <li class="nav-item">

              <a class="nav-link"
                 href="contact.php">

                Contact Us

              </a>

            </li>


          </ul>

        </div>

      </div>

    </nav>

  </header>


  <!-- ==================== HOME SLIDER ==================== -->

  <div class="main-banner header-text">

    <div class="container-fluid">

      <div class="owl-banner owl-carousel">


        <!-- SLIDE 1 -->

        <div class="item">

          <img
            src="assets/images/banner-item-01.jpg"
            alt="">

          <div class="item-content">

            <div class="main-content">

              <div class="meta-category">

                <span>
                  Technology
                </span>

              </div>

              <a href="post-details.php">

                <h4>
                  Clever Mind POB ICT
                </h4>

              </a>

              <ul class="post-info">

                <li>
                  <a href="#">
                    Admin
                  </a>
                </li>

                <li>
                  <a href="#">
                    August 28, 2026
                  </a>
                </li>

                <li>
                  <a href="#">
                    0 Comments
                  </a>
                </li>

              </ul>

            </div>

          </div>

        </div>


        <!-- SLIDE 2 -->

        <div class="item">

          <img
            src="assets/images/banner-item-02.jpg"
            alt="">

          <div class="item-content">

            <div class="main-content">

              <div class="meta-category">

                <span>
                  Web Development
                </span>

              </div>

              <a href="post-details.php">

                <h4>
                  Web Development &amp; Technology
                </h4>

              </a>

              <ul class="post-info">

                <li>
                  <a href="#">
                    Admin
                  </a>
                </li>

                <li>
                  <a href="#">
                    August 28, 2026
                  </a>
                </li>

                <li>
                  <a href="#">
                    0 Comments
                  </a>
                </li>

              </ul>

            </div>

          </div>

        </div>


        <!-- SLIDE 3 -->

        <div class="item">

          <img
            src="assets/images/banner-item-03.jpg"
            alt="">

          <div class="item-content">

            <div class="main-content">

              <div class="meta-category">

                <span>
                  Software Engineering
                </span>

              </div>

              <a href="post-details.php">

                <h4>
                  Software Engineering Insights
                </h4>

              </a>

              <ul class="post-info">

                <li>
                  <a href="#">
                    Admin
                  </a>
                </li>

                <li>
                  <a href="#">
                    August 28, 2026
                  </a>
                </li>

                <li>
                  <a href="#">
                    0 Comments
                  </a>
                </li>

              </ul>

            </div>

          </div>

        </div>


        <!-- SLIDE 4 -->

        <div class="item">

          <img
            src="assets/images/banner-item-04.jpg"
            alt="">

          <div class="item-content">

            <div class="main-content">

              <div class="meta-category">

                <span>
                  Training
                </span>

              </div>

              <a href="post-details.php">

                <h4>
                  Training &amp; Learning
                </h4>

              </a>

              <ul class="post-info">

                <li>
                  <a href="#">
                    Admin
                  </a>
                </li>

                <li>
                  <a href="#">
                    August 28, 2026
                  </a>
                </li>

                <li>
                  <a href="#">
                    0 Comments
                  </a>
                </li>

              </ul>

            </div>

          </div>

        </div>


        <!-- SLIDE 5 -->

        <div class="item">

          <img
            src="assets/images/banner-item-05.jpg"
            alt="">

          <div class="item-content">

            <div class="main-content">

              <div class="meta-category">

                <span>
                  Innovation
                </span>

              </div>

              <a href="post-details.php">

                <h4>
                  Innovation &amp; Digital Solutions
                </h4>

              </a>

              <ul class="post-info">

                <li>
                  <a href="#">
                    Admin
                  </a>
                </li>

                <li>
                  <a href="#">
                    August 28, 2026
                  </a>
                </li>

                <li>
                  <a href="#">
                    0 Comments
                  </a>
                </li>

              </ul>

            </div>

          </div>

        </div>


        <!-- SLIDE 6 -->

        <div class="item">

          <img
            src="assets/images/banner-item-06.jpg"
            alt="">

          <div class="item-content">

            <div class="main-content">

              <div class="meta-category">

                <span>
                  ICT
                </span>

              </div>

              <a href="post-details.php">

                <h4>
                  Clever Mind POB ICT News
                </h4>

              </a>

              <ul class="post-info">

                <li>
                  <a href="#">
                    Admin
                  </a>
                </li>

                <li>
                  <a href="#">
                    August 28, 2026
                  </a>
                </li>

                <li>
                  <a href="#">
                    0 Comments
                  </a>
                </li>

              </ul>

            </div>

          </div>

        </div>


      </div>

    </div>

  </div>


  <!-- ==================== END SLIDER ==================== -->


  <!-- ==================== HOME BLOG POSTS ==================== -->

  <section class="blog-posts">

    <div class="container">

      <div class="row">


        <!-- Blog Content -->

        <div class="col-lg-12">

          <div class="all-blog-posts">

            <div class="row">


              <?php if (!empty($blogs)): ?>


                <?php foreach ($blogs as $blog): ?>


                  <!-- ==================== BLOG POST ==================== -->

                  <div class="col-lg-12">

                    <div class="blog-post">


                      <!-- Blog Image -->

                      <div class="blog-thumb">

                        <?php if (!empty($blog['image'])): ?>

                          <img
                            src="assets/images/<?php echo htmlspecialchars($blog['image']); ?>"
                            alt="<?php echo htmlspecialchars($blog['title']); ?>">

                        <?php else: ?>

                          <img
                            src="assets/images/blog-post-01.jpg"
                            alt="<?php echo htmlspecialchars($blog['title']); ?>">

                        <?php endif; ?>

                      </div>


                      <!-- Blog Content -->

                      <div class="down-content">


                        <!-- Subtitle -->

                        <span>

                          <?php
                          echo htmlspecialchars(
                              $blog['subtitle']
                          );
                          ?>

                        </span>


                        <!-- Title -->

                        <a
                          href="post-details.php?id=<?php echo (int)$blog['id']; ?>">

                          <h4>

                            <?php
                            echo htmlspecialchars(
                                $blog['title']
                            );
                            ?>

                          </h4>

                        </a>


                        <!-- Blogger / Date / Comments -->

                        <ul class="post-info">


                          <!-- Blogger -->

                          <li>

                            <a href="#">

                              <?php
                              echo htmlspecialchars(
                                  $blog['blogger_name']
                              );
                              ?>

                            </a>

                          </li>


                          <!-- Publish Date -->

                          <li>

                            <a href="#">

                              <?php

                              echo date(
                                  'F d, Y',
                                  strtotime(
                                      $blog['publish_date']
                                  )
                              );

                              ?>

                            </a>

                          </li>


                          <!-- Comments -->

                          <li>

                            <a href="#">

                              0 Comments

                            </a>

                          </li>


                        </ul>


                        <!-- Description -->

                        <p>

                          <?php

                          echo htmlspecialchars(
                              $blog['description']
                          );

                          ?>

                        </p>


                        <!-- Share -->

                        <div class="post-options">

                          <div class="row">

                            <div class="col-12">

                              <ul class="post-share">


                                <li>

                                  <i class="fa fa-share-alt"></i>

                                </li>


                                <!-- Facebook -->

                                <li>

                                  <a
                                    href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://localhost/Task%2026/stand_blog/post-details.php?id=' . $blog['id']); ?>"
                                    target="_blank">

                                    Facebook

                                  </a>

                                </li>


                                <!-- Instagram -->

                                <li>

                                  <a
                                    href="https://www.instagram.com/clevermindpob/"
                                    target="_blank">

                                    Instagram

                                  </a>

                                </li>


                              </ul>

                            </div>

                          </div>

                        </div>


                      </div>

                    </div>

                  </div>

                  <!-- ==================== END BLOG POST ==================== -->


                <?php endforeach; ?>


              <?php else: ?>


                <!-- No Blogs -->

                <div class="col-lg-12">

                  <div class="alert alert-info">

                    No blog posts available.

                  </div>

                </div>


              <?php endif; ?>


            </div>

          </div>

        </div>


      </div>

    </div>

  </section>


  <!-- ==================== END BLOG POSTS ==================== -->


  <!-- ==================== FOOTER ==================== -->

  <footer>

    <div class="container">

      <div class="row">


        <!-- Social Media -->

        <div class="col-lg-12">

          <ul class="social-icons">


            <!-- Instagram -->

            <li>

              <a
                href="https://www.instagram.com/clevermindpob/"
                target="_blank">

                Instagram

              </a>

            </li>


            <!-- Twitter -->

            <li>

              <a
                href="https://twitter.com/search?q=cleverMindICT"
                target="_blank">

                Twitter

              </a>

            </li>


            <!-- Facebook -->

            <li>

              <a
                href="https://www.facebook.com/ClevermindICT/"
                target="_blank">

                Facebook

              </a>

            </li>


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

  </footer>


  <!-- ==================== END FOOTER ==================== -->


  <!-- Bootstrap core JavaScript -->

  <script
    src="vendor/jquery/jquery.min.js">
  </script>

  <script
    src="vendor/bootstrap/js/bootstrap.bundle.min.js">
  </script>


  <!-- Additional Scripts -->

  <script
    src="assets/js/custom.js">
  </script>

  <script
    src="assets/js/owl.js">
  </script>

  <script
    src="assets/js/slick.js">
  </script>

  <script
    src="assets/js/isotope.js">
  </script>

  <script
    src="assets/js/accordions.js">
  </script>


</body>

</html>

