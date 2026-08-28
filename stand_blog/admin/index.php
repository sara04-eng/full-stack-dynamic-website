<?php

require_once "../config.php";

/*
|--------------------------------------------------------------------------
| Dashboard Statistics
|--------------------------------------------------------------------------
*/

// Total Blog Posts
$stmt = $pdo->query("SELECT COUNT(*) FROM blogs");
$totalBlogs = $stmt->fetchColumn();

// Total Comments
$stmt = $pdo->query("SELECT COUNT(*) FROM comments");
$totalComments = $stmt->fetchColumn();

// Total Contact Messages
$stmt = $pdo->query("SELECT COUNT(*) FROM contact_messages");
$totalMessages = $stmt->fetchColumn();

// About Records
$stmt = $pdo->query("SELECT COUNT(*) FROM about");
$totalAbout = $stmt->fetchColumn();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Clever Mind POB ICT - Admin Dashboard</title>

    <!-- Bootstrap -->
    <link
        href="../vendor/bootstrap/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="../assets/css/fontawesome.css"
    >

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            color: #333;
        }

        /* ================= SIDEBAR ================= */

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #ffffff;
            border-right: 1px solid #e5e5e5;
            padding-top: 20px;
        }

        .logo {
            text-align: center;
            padding: 15px;
            margin-bottom: 20px;
        }

        .logo h3 {
            margin: 0;
            font-size: 21px;
            font-weight: bold;
        }

        .logo em {
            color: #f48840;
            font-style: normal;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin-bottom: 5px;
        }

        .sidebar-menu li a {
            display: block;
            padding: 13px 25px;
            color: #555;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar-menu li a:hover,
        .sidebar-menu li.active a {
            background: #f48840;
            color: #ffffff;
        }

        .sidebar-menu li a i {
            width: 25px;
        }

        /* ================= MAIN CONTENT ================= */

        .main-content {
            margin-left: 250px;
            padding: 30px;
        }

        /* ================= TOPBAR ================= */

        .topbar {
            background: #ffffff;
            padding: 20px 25px;
            margin-bottom: 30px;
            border-radius: 8px;
            border: 1px solid #eeeeee;
        }

        .topbar h2 {
            margin: 0 0 5px;
            font-size: 25px;
            font-weight: 600;
        }

        .topbar p {
            margin: 0;
            color: #777;
        }

        /* ================= STATISTICS ================= */

        .stat-card {
            background: #ffffff;
            padding: 25px;
            margin-bottom: 25px;
            border-radius: 8px;
            border: 1px solid #eeeeee;
            transition: 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .stat-icon {
            font-size: 25px;
            margin-bottom: 15px;
            color: #f48840;
        }

        .stat-card h6 {
            margin-bottom: 10px;
            color: #777;
            font-size: 14px;
        }

        .stat-card h2 {
            margin: 0;
            font-size: 30px;
            font-weight: bold;
        }

        /* ================= QUICK LINKS ================= */

        .dashboard-section {
            background: #ffffff;
            padding: 25px;
            border-radius: 8px;
            border: 1px solid #eeeeee;
            margin-top: 5px;
        }

        .dashboard-section h4 {
            margin-bottom: 20px;
            font-weight: 600;
        }

        .quick-link {
            display: inline-block;
            padding: 12px 20px;
            margin-right: 10px;
            margin-bottom: 10px;
            background: #f48840;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }

        .quick-link:hover {
            color: #ffffff;
            text-decoration: none;
            opacity: 0.9;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 768px) {

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }

        }

    </style>

</head>

<body>


<!-- =====================================================
     SIDEBAR
===================================================== -->

<div class="sidebar">

    <div class="logo">

        <h3>
            Clever Mind POB<em>.</em>
        </h3>

    </div>


    <ul class="sidebar-menu">

        <!-- Dashboard -->

        <li class="active">

            <a href="index.php">

                <i class="fa fa-dashboard"></i>

                Dashboard

            </a>

        </li>


        <!-- Blogs -->

        <li>

           <a href="posts.php">

                <i class="fa fa-file-text"></i>

                Blogs

            </a>

        </li>


        <!-- About -->

        <li>

            <a href="about.php">

                <i class="fa fa-info-circle"></i>

                About

            </a>

        </li>


        <!-- Comments -->

        <li>

            <a href="comments.php">

                <i class="fa fa-comments"></i>

                Comments

            </a>

        </li>


        <!-- Contact Messages -->

        <li>

            <a href="contact_messages.php">

                <i class="fa fa-envelope"></i>

                Contact Messages

            </a>

        </li>


        <!-- Contact Information -->

        <li>

            <a href="contact_info.php">

                <i class="fa fa-phone"></i>

                Contact Information

            </a>

        </li>


        <!-- Social Links -->

        <li>

            <a href="social_links.php">

                <i class="fa fa-share-alt"></i>

                Social Links

            </a>

        </li>


        <!-- View Website -->

        <li>

            <a
                href="../index.php"
                target="_blank"
            >

                <i class="fa fa-globe"></i>

                View Website

            </a>

        </li>

    </ul>

</div>


<!-- =====================================================
     MAIN CONTENT
===================================================== -->

<div class="main-content">


    <!-- ================= TOPBAR ================= -->

    <div class="topbar">

        <h2>
            Admin Dashboard
        </h2>

        <p>
            Welcome to Clever Mind POB ICT Admin Panel
        </p>

    </div>


    <!-- ================= STATISTICS ================= -->

    <div class="row">


        <!-- Blogs -->

        <div class="col-lg-3 col-md-6">

            <div class="stat-card">

                <div class="stat-icon">

                    <i class="fa fa-file-text"></i>

                </div>

                <h6>
                    Total Blogs
                </h6>

                <h2>
                    <?php echo $totalBlogs; ?>
                </h2>

            </div>

        </div>


        <!-- Comments -->

        <div class="col-lg-3 col-md-6">

            <div class="stat-card">

                <div class="stat-icon">

                    <i class="fa fa-comments"></i>

                </div>

                <h6>
                    Total Comments
                </h6>

                <h2>
                    <?php echo $totalComments; ?>
                </h2>

            </div>

        </div>


        <!-- Messages -->

        <div class="col-lg-3 col-md-6">

            <div class="stat-card">

                <div class="stat-icon">

                    <i class="fa fa-envelope"></i>

                </div>

                <h6>
                    Contact Messages
                </h6>

                <h2>
                    <?php echo $totalMessages; ?>
                </h2>

            </div>

        </div>


        <!-- About -->

        <div class="col-lg-3 col-md-6">

            <div class="stat-card">

                <div class="stat-icon">

                    <i class="fa fa-info-circle"></i>

                </div>

                <h6>
                    About Content
                </h6>

                <h2>
                    <?php echo $totalAbout; ?>
                </h2>

            </div>

        </div>


    </div>


    <!-- ================= QUICK LINKS ================= -->

    <div class="dashboard-section">

        <h4>
            Quick Management
        </h4>

        <p>
            Use the links below to manage the website content.
        </p>


        <a
    href="posts.php"
    class="quick-link"
>
    Manage Blogs
</a>


        <a
            href="comments.php"
            class="quick-link"
        >
            Manage Comments
        </a>


        <a
            href="contact_messages.php"
            class="quick-link"
        >
            View Messages
        </a>


        <a
            href="about.php"
            class="quick-link"
        >
            Manage About
        </a>

    </div>


</div>


<!-- =====================================================
     JAVASCRIPT
===================================================== -->

<script src="../vendor/jquery/jquery.min.js"></script>

<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>