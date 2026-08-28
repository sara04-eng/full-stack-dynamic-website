<?php

require_once "config.php";

/*
|--------------------------------------------------------------------------
| Get Blog Posts
|--------------------------------------------------------------------------
*/

$stmt = $pdo->query("
    SELECT *
    FROM blogs
    ORDER BY publish_date DESC, id DESC
");

$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">

<meta name="viewport"
     content="width=device-width, initial-scale=1, shrink-to-fit=no">

<meta name="description"
     content="Clever Mind POB ICT Grid Blog">

<meta name="author"
     content="Clever Mind POB ICT">

  <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,300i,500,500i,700,700i,900,900i&display=swap"
        rel="stylesheet">

  <title>Clever Mind POB - Grid Blog</title>

  <!-- Bootstrap core CSS -->

  <link href="vendor/bootstrap/css/bootstrap.min.css"
        rel="stylesheet">

  <!-- Additional CSS Files -->

  <link rel="stylesheet"
        href="assets/css/fontawesome.css">

  <link rel="stylesheet"
        href="assets/css/templatemo-stand-blog.css">

  <link rel="stylesheet"
        href="assets/css/owl.css">

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


    <!-- Logo -->

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

        <li class="nav-item">

          <a class="nav-link"
             href="index.php">

            Home

          </a>

        </li>


        <!-- About -->

        <li class="nav-item">

          <a class="nav-link"
             href="about.php">

            About Us

          </a>

        </li>


        <!-- Grid Blog -->

        <li class="nav-item active">

          <a class="nav-link"
             href="blog.php">

            Grid Blog

            <span class="sr-only">
              (current)
            </span>

          </a>

        </li>


        <!-- Inner Blog -->

        <li class="nav-item">

          <a class="nav-link"
             href="post-details.php">

            Inner Blog

          </a>

        </li>


        <!-- Contact -->

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
```

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
            Grid Blog
          </h4>

          <h2>
            Our Latest Blog Posts
          </h2>

        </div>

      </div>

    </div>

  </div>

</section>
```

  </div>

  <!-- ================= GRID BLOG ================= -->

  <section class="blog-posts grid-system">

```
<div class="container">

  <div class="row">

    <div class="col-lg-12">

      <div class="all-blog-posts">

        <div class="row">


          <?php if (!empty($blogs)): ?>


            <?php foreach ($blogs as $blog): ?>


              <!-- ================= BLOG ================= -->

              <div class="col-lg-4 col-md-6">

                <div class="blog-post">


                  <!-- Blog Image -->

                  <div class="blog-thumb">

                    <img
                      src="assets/images/<?php echo htmlspecialchars($blog['image']); ?>"
                      alt="<?php echo htmlspecialchars($blog['title']); ?>">

                  </div>


                  <!-- Blog Content -->

                  <div class="down-content">


                    <!-- Subtitle -->

                    <span>

                      <?php
                      echo htmlspecialchars($blog['subtitle']);
                      ?>

                    </span>


                    <!-- Title -->

                    <a
                      href="post-details.php?id=<?php echo (int)$blog['id']; ?>">

                      <h4>

                        <?php
                        echo htmlspecialchars($blog['title']);
                        ?>

                      </h4>

                    </a>


                    <!-- Blog Information -->

                    <ul class="post-info">


                      <!-- Blogger -->

                      <li>

                        <a href="#">

                          <?php
                          echo htmlspecialchars($blog['blogger_name']);
                          ?>

                        </a>

                      </li>


                      <!-- Publish Date -->

                      <li>

                        <a href="#">

                          <?php
                          echo date(
                              'F d, Y',
                              strtotime($blog['publish_date'])
                          );
                          ?>

                        </a>

                      </li>


                      <!-- Comments -->

                      <li>

                        <a
                          href="post-details.php?id=<?php echo (int)$blog['id']; ?>#comments">

                          <?php

                          try {

                              $commentStmt = $pdo->prepare("
                                  SELECT COUNT(*)
                                  FROM comments
                                  WHERE blog_id = ?
                              ");

                              $commentStmt->execute([
                                  $blog['id']
                              ]);

                              $commentCount =
                                  $commentStmt->fetchColumn();

                          } catch (PDOException $e) {

                              $commentCount = 0;

                          }

                          echo (int)$commentCount;

                          ?>

                          Comments

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


                  </div>

                </div>

              </div>


            <?php endforeach; ?>


          <?php else: ?>


            <!-- No Blogs -->

            <div class="col-lg-12">

              <div class="blog-post">

                <div class="down-content">

                  <h4>
                    No Blog Posts Found
                  </h4>

                  <p>
                    There are currently no blog posts available.
                  </p>

                </div>

              </div>

            </div>


          <?php endif; ?>


          <!-- ================= PAGINATION ================= -->

          <div class="col-lg-12">

            <ul class="page-numbers">

              <li class="active">

                <a href="#">
                  1
                </a>

              </li>

              <li>

                <a href="#">
                  2
                </a>

              </li>

              <li>

                <a href="#">
                  3
                </a>

              </li>

              <li>

                <a href="#">

                  <i class="fa fa-angle-double-right"></i>

                </a>

              </li>

            </ul>

          </div>


        </div>

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


        <li>

          <a
            href="https://www.instagram.com/clevermindpob/"
            target="_blank">

            Instagram

          </a>

        </li>


        <li>

          <a
            href="https://twitter.com/search?q=cleverMindICT"
            target="_blank">

            Twitter

          </a>

        </li>


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

</body>

</html>
