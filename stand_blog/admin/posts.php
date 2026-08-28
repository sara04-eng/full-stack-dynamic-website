
<?php

include '../config.php';

/*
|--------------------------------------------------------------------------
| Get All Blog Posts
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
    ORDER BY publish_date DESC
");

$stmt->execute();

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Blog Posts - Admin Dashboard</title>


    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- Font Awesome -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

</head>


<body>


<div class="container-fluid py-4">


    <!-- ==================== PAGE HEADER ==================== -->

    <div class="d-flex justify-content-between align-items-center mb-4">


        <div>

            <h2 class="mb-1">
                Blog Posts
            </h2>

            <p class="text-muted mb-0">
                Manage all blog posts.
            </p>

        </div>


        <div class="d-flex gap-2">


            <!-- ADD BLOG POST -->

            <a
                href="blog_post_form.php"
                class="btn btn-primary"
            >

                <i class="fa fa-plus"></i>

                Add Blog Post

            </a>


            <!-- DASHBOARD -->

            <a
                href="index.php"
                class="btn btn-dark"
            >

                <i class="fa fa-dashboard"></i>

                Dashboard

            </a>


        </div>

    </div>


    <!-- ==================== BLOG POSTS CARD ==================== -->

    <div class="card shadow-sm">


        <div class="card-header bg-white">

            <h5 class="mb-0">

                <i class="fa fa-newspaper"></i>

                All Blog Posts

            </h5>

        </div>


        <div class="card-body">


            <!-- ==================== SUCCESS ==================== -->

            <?php if (isset($_GET['deleted'])): ?>

                <div class="alert alert-success">

                    <i class="fa fa-check-circle"></i>

                    Blog post deleted successfully.

                </div>

            <?php endif; ?>


            <?php if (isset($_GET['success'])): ?>

                <div class="alert alert-success">

                    <i class="fa fa-check-circle"></i>

                    Blog post saved successfully.

                </div>

            <?php endif; ?>


            <!-- ==================== ERROR ==================== -->

            <?php if (isset($_GET['error']) && $_GET['error'] === 'notfound'): ?>

                <div class="alert alert-danger">

                    <i class="fa fa-exclamation-circle"></i>

                    Blog post not found.

                </div>

            <?php endif; ?>


            <!-- ==================== BLOG TABLE ==================== -->

            <?php if (!empty($posts)): ?>


                <div class="table-responsive">


                    <table
                        class="table table-bordered table-hover align-middle"
                    >


                        <!-- TABLE HEADER -->

                        <thead class="table-dark">

                            <tr>

                                <th>ID</th>

                                <th>Image</th>

                                <th>Title</th>

                                <th>Subtitle</th>

                                <th>Blogger</th>

                                <th>Publish Date</th>

                                <th>Description</th>

                                <th>Actions</th>

                            </tr>

                        </thead>


                        <!-- TABLE BODY -->

                        <tbody>


                        <?php foreach ($posts as $post): ?>


                            <tr>


                                <!-- ID -->

                                <td>

                                    <?= (int) $post['id'] ?>

                                </td>


                                <!-- IMAGE -->

                                <td>


                                    <?php if (!empty($post['image'])): ?>


                                        <img
                                            src="../assets/images/<?= htmlspecialchars($post['image']) ?>"
                                            alt="<?= htmlspecialchars($post['title']) ?>"
                                            width="100"
                                            height="70"
                                            style="object-fit: cover;"
                                        >


                                    <?php else: ?>


                                        <span class="text-muted">

                                            No Image

                                        </span>


                                    <?php endif; ?>


                                </td>


                                <!-- TITLE -->

                                <td>

                                    <strong>

                                        <?= htmlspecialchars($post['title']) ?>

                                    </strong>

                                </td>


                                <!-- SUBTITLE -->

                                <td>

                                    <?= htmlspecialchars($post['subtitle']) ?>

                                </td>


                                <!-- BLOGGER -->

                                <td>

                                    <?= htmlspecialchars($post['blogger_name']) ?>

                                </td>


                                <!-- PUBLISH DATE -->

                                <td>

                                    <?= htmlspecialchars($post['publish_date']) ?>

                                </td>


                                <!-- DESCRIPTION -->

                                <td style="max-width: 350px;">

                                    <?= htmlspecialchars($post['description']) ?>

                                </td>


                                <!-- ==================== ACTIONS ==================== -->

                                <td style="min-width: 190px;">


                                    <!-- EDIT -->

                                    <a
                                        href="blog_post_form.php?id=<?= (int) $post['id'] ?>"
                                        class="btn btn-sm btn-warning"
                                    >

                                        <i class="fa fa-edit"></i>

                                        Edit

                                    </a>


                                    <!-- DELETE -->

                                    <a
                                        href="blog_post_delete.php?id=<?= (int) $post['id'] ?>"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this blog post?');"
                                    >

                                        <i class="fa fa-trash"></i>

                                        Delete

                                    </a>


                                </td>


                            </tr>


                        <?php endforeach; ?>


                        </tbody>


                    </table>


                </div>


            <?php else: ?>


                <!-- NO POSTS -->

                <div class="alert alert-info">

                    <i class="fa fa-info-circle"></i>

                    No blog posts found.

                </div>


            <?php endif; ?>


        </div>

    </div>

</div>


<!-- Bootstrap JavaScript -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>

