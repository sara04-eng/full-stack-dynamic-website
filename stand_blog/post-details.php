
<?php

require_once "config.php";


/*
|--------------------------------------------------------------------------
| Get Blog ID
|--------------------------------------------------------------------------
*/

$id = isset($_GET['id']) && is_numeric($_GET['id'])
    ? (int) $_GET['id']
    : 1;


/*
|--------------------------------------------------------------------------
| Get Blog Post
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
        description,
        created_at
    FROM blogs
    WHERE id = ?
    LIMIT 1
");

$stmt->execute([$id]);

$blog = $stmt->fetch(PDO::FETCH_ASSOC);


/*
|--------------------------------------------------------------------------
| Check If Blog Exists
|--------------------------------------------------------------------------
*/

if (!$blog) {
    die("Blog post not found.");
}


/*
|--------------------------------------------------------------------------
| Add Comment
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $guest_name = trim($_POST['name'] ?? '');
    $comment = trim($_POST['comment'] ?? '');


    /*
    |--------------------------------------------------------------------------
    | Validate Comment
    |--------------------------------------------------------------------------
    */

    if ($guest_name !== '' && $comment !== '') {


        /*
        |--------------------------------------------------------------------------
        | Insert Comment
        |--------------------------------------------------------------------------
        */

        $stmt = $pdo->prepare("
            INSERT INTO comments
                (
                    blog_id,
                    guest_name,
                    comment,
                    created_at
                )
            VALUES
                (
                    ?,
                    ?,
                    ?,
                    NOW()
                )
        ");


        $stmt->execute([
            $id,
            $guest_name,
            $comment
        ]);


        /*
        |--------------------------------------------------------------------------
        | Redirect To Comments
        |--------------------------------------------------------------------------
        */

        header(
            "Location: post-details.php?id=" . $id . "#comments"
        );

        exit;
    }
}


/*
|--------------------------------------------------------------------------
| Get Comments For This Blog
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
    SELECT
        id,
        blog_id,
        guest_name,
        comment,
        created_at
    FROM comments
    WHERE blog_id = ?
    ORDER BY created_at DESC
");

$stmt->execute([$id]);

$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);


/*
|--------------------------------------------------------------------------
| Count Comments
|--------------------------------------------------------------------------
*/

$commentsCount = count($comments);


/*
|--------------------------------------------------------------------------
| Format Blog Date
|--------------------------------------------------------------------------
*/

$blogDate = date(
    'F d, Y',
    strtotime($blog['publish_date'])
);

?>

<!DOCTYPE html>

<html lang="en">

<head>


    <!-- =========================================================
         META
    ========================================================== -->

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    >

    <meta
        name="description"
        content="<?= htmlspecialchars($blog['description']) ?>"
    >

    <meta
        name="author"
        content="Clever Mind POB ICT"
    >


    <!-- =========================================================
         GOOGLE FONT
    ========================================================== -->

    <link
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap"
        rel="stylesheet"
    >


    <!-- =========================================================
         PAGE TITLE
    ========================================================== -->

    <title>

        <?= htmlspecialchars($blog['title']) ?>

        - Clever Mind POB

    </title>


    <!-- =========================================================
         BOOTSTRAP CSS
    ========================================================== -->

    <link
        href="vendor/bootstrap/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- =========================================================
         ADDITIONAL CSS
    ========================================================== -->

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


    <!-- =========================================================
         PRELOADER
    ========================================================== -->

    <div id="preloader">

        <div class="jumper">

            <div></div>

            <div></div>

            <div></div>

        </div>

    </div>


    <!-- =========================================================
         HEADER
    ========================================================== -->

    <header>

        <nav class="navbar navbar-expand-lg">

            <div class="container">


                <!-- =================================================
                     LOGO
                ================================================== -->

                <a
                    class="navbar-brand"
                    href="index.php"
                >

                    <h2>

                        Clever Mind POB<em>.</em>

                    </h2>

                </a>


                <!-- =================================================
                     MOBILE MENU BUTTON
                ================================================== -->

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


                <!-- =================================================
                     NAVIGATION
                ================================================== -->

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

                        <li class="nav-item active">

                            <a
                                class="nav-link"
                                href="post-details.php?id=<?= $blog['id'] ?>"
                            >

                                Inner Blog

                                <span class="sr-only">

                                    (current)

                                </span>

                            </a>

                        </li>


                        <!-- Contact Us -->

                        <li class="nav-item">

                            <a
                                class="nav-link"
                                href="contact.php"
                            >

                                Contact Us

                            </a>

                        </li>


                    </ul>

                </div>

            </div>

        </nav>

    </header>


    <!-- =========================================================
         PAGE HEADING
    ========================================================== -->

    <div class="heading-page header-text">

        <section class="page-heading">

            <div class="container">

                <div class="row">

                    <div class="col-lg-12">

                        <div class="text-content">


                            <h4>

                                <?= htmlspecialchars($blog['subtitle']) ?>

                            </h4>


                            <h2>

                                Blog Details

                            </h2>


                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>


    <!-- =========================================================
         BLOG POST
    ========================================================== -->

    <section class="blog-posts grid-system">

        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <div class="all-blog-posts">

                        <div class="row">


                            <!-- =================================================
                                 BLOG CONTENT
                            ================================================== -->

                            <div class="col-lg-12">

                                <div class="blog-post">


                                    <!-- =================================================
                                         BLOG IMAGE
                                    ================================================== -->

                                    <div class="blog-thumb">

                                        <?php if (!empty($blog['image'])): ?>

                                            <img
                                                src="assets/images/<?= htmlspecialchars($blog['image']) ?>"
                                                alt="<?= htmlspecialchars($blog['title']) ?>"
                                            >

                                        <?php endif; ?>

                                    </div>


                                    <!-- =================================================
                                         BLOG CONTENT
                                    ================================================== -->

                                    <div class="down-content">


                                        <!-- Category / Subtitle -->

                                        <span>

                                            <?= htmlspecialchars($blog['subtitle']) ?>

                                        </span>


                                        <!-- Blog Title -->

                                        <h4>

                                            <?= htmlspecialchars($blog['title']) ?>

                                        </h4>


                                        <!-- =================================================
                                             BLOG INFORMATION
                                        ================================================== -->

                                        <ul class="post-info">


                                            <!-- Blogger -->

                                            <li>

                                                <a href="#">

                                                    <?= htmlspecialchars(
                                                        $blog['blogger_name']
                                                    ) ?>

                                                </a>

                                            </li>


                                            <!-- Publish Date -->

                                            <li>

                                                <a href="#">

                                                    <?= htmlspecialchars(
                                                        $blogDate
                                                    ) ?>

                                                </a>

                                            </li>


                                            <!-- Comments -->

                                            <li>

                                                <a href="#comments">

                                                    <?= $commentsCount ?>

                                                    Comments

                                                </a>

                                            </li>


                                        </ul>


                                        <!-- =================================================
                                             BLOG DESCRIPTION
                                        ================================================== -->

                                        <p>

                                            <?= nl2br(
                                                htmlspecialchars(
                                                    $blog['description']
                                                )
                                            ) ?>

                                        </p>


                                        <!-- =================================================
                                             SHARE
                                        ================================================== -->

                                        <div class="post-options">

                                            <div class="row">

                                                <div class="col-lg-12">

                                                    <ul class="post-share">


                                                        <!-- Share Icon -->

                                                        <li>

                                                            <i class="fa fa-share-alt"></i>

                                                        </li>


                                                        <!-- Facebook -->

                                                        <li>

                                                            <a
                                                                href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode('http://localhost/Task 26/stand_blog/post-details.php?id=' . $blog['id']) ?>"
                                                                target="_blank"
                                                                rel="noopener noreferrer"
                                                            >

                                                                Facebook

                                                            </a>

                                                        </li>


                                                        <!-- Instagram -->

                                                        <li>

                                                            <a
                                                                href="https://www.instagram.com/clevermindpob/"
                                                                target="_blank"
                                                                rel="noopener noreferrer"
                                                            >

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


                            <!-- =================================================
                                 COMMENTS SECTION
                            ================================================== -->

                            <div
                                class="col-lg-12"
                                id="comments"
                            >

                                <div class="sidebar-item comments">


                                    <!-- Comments Heading -->

                                    <div class="sidebar-heading">

                                        <h2>

                                            <?= $commentsCount ?>

                                            Comments

                                        </h2>

                                    </div>


                                    <!-- Comments Content -->

                                    <div class="content">


                                        <?php if ($commentsCount > 0): ?>


                                            <ul>


                                                <?php foreach ($comments as $row): ?>


                                                    <li>

                                                        <div class="right-content">


                                                            <!-- Guest Name -->

                                                            <h4>

                                                                <?= htmlspecialchars(
                                                                    $row['guest_name']
                                                                ) ?>


                                                                <!-- Comment Date -->

                                                                <span>

                                                                    <?= date(
                                                                        'F d, Y',
                                                                        strtotime(
                                                                            $row['created_at']
                                                                        )
                                                                    ) ?>

                                                                </span>

                                                            </h4>


                                                            <!-- Comment -->

                                                            <p>

                                                                <?= nl2br(
                                                                    htmlspecialchars(
                                                                        $row['comment']
                                                                    )
                                                                ) ?>

                                                            </p>


                                                        </div>

                                                    </li>


                                                <?php endforeach; ?>


                                            </ul>


                                        <?php else: ?>


                                            <!-- No Comments -->

                                            <p>

                                                No comments yet.

                                                Be the first to leave a comment.

                                            </p>


                                        <?php endif; ?>


                                    </div>

                                </div>

                            </div>


                            <!-- =================================================
                                 ADD COMMENT
                            ================================================== -->

                            <div class="col-lg-12">

                                <div class="sidebar-item submit-comment">


                                    <!-- Form Heading -->

                                    <div class="sidebar-heading">

                                        <h2>

                                            Write a Comment

                                        </h2>

                                    </div>


                                    <!-- Form -->

                                    <div class="content">

                                        <form
                                            id="comment"
                                            action="post-details.php?id=<?= $blog['id'] ?>"
                                            method="post"
                                        >


                                            <div class="row">


                                                <!-- =================================================
                                                     GUEST NAME
                                                ================================================== -->

                                                <div
                                                    class="col-md-12 col-sm-12"
                                                >

                                                    <fieldset>

                                                        <input
                                                            name="name"
                                                            type="text"
                                                            id="name"
                                                            placeholder="Your name"
                                                            maxlength="100"
                                                            required
                                                        >

                                                    </fieldset>

                                                </div>


                                                <!-- =================================================
                                                     COMMENT
                                                ================================================== -->

                                                <div class="col-lg-12">

                                                    <fieldset>

                                                        <textarea
                                                            name="comment"
                                                            rows="6"
                                                            id="comment-text"
                                                            placeholder="Write your comment"
                                                            required
                                                        ></textarea>

                                                    </fieldset>

                                                </div>


                                                <!-- =================================================
                                                     SUBMIT
                                                ================================================== -->

                                                <div class="col-lg-12">

                                                    <fieldset>

                                                        <button
                                                            type="submit"
                                                            id="form-submit"
                                                            class="main-button"
                                                        >

                                                            Submit Comment

                                                        </button>

                                                    </fieldset>

                                                </div>


                                            </div>

                                        </form>

                                    </div>


                                </div>

                            </div>


                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================================================
         FOOTER
    ========================================================== -->

    <footer>

        <div class="container">

            <div class="row">


                <!-- =================================================
                     SOCIAL MEDIA
                ================================================== -->

                <div class="col-lg-12">

                    <ul class="social-icons">


                        <!-- Instagram -->

                        <li>

                            <a
                                href="https://www.instagram.com/clevermindpob/"
                                target="_blank"
                                rel="noopener noreferrer"
                            >

                                Instagram

                            </a>

                        </li>


                        <!-- Twitter -->

                        <li>

                            <a
                                href="https://twitter.com/search?q=cleverMindICT"
                                target="_blank"
                                rel="noopener noreferrer"
                            >

                                Twitter

                            </a>

                        </li>


                        <!-- Facebook -->

                        <li>

                            <a
                                href="https://www.facebook.com/ClevermindICT/"
                                target="_blank"
                                rel="noopener noreferrer"
                            >

                                Facebook

                            </a>

                        </li>


                    </ul>

                </div>


                <!-- =================================================
                     COPYRIGHT
                ================================================== -->

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


    <!-- =========================================================
         JAVASCRIPT
    ========================================================== -->

    <script
        src="vendor/jquery/jquery.min.js"
    ></script>


    <script
        src="vendor/bootstrap/js/bootstrap.bundle.min.js"
    ></script>


    <script
        src="assets/js/custom.js"
    ></script>


    <script
        src="assets/js/owl.js"
    ></script>


    <script
        src="assets/js/slick.js"
    ></script>


    <script
        src="assets/js/isotope.js"
    ></script>


    <script
        src="assets/js/accordions.js"
    ></script>


</body>

</html>

