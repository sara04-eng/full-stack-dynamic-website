
<?php

include '../config.php';

/*
|--------------------------------------------------------------------------
| Get all comments
|--------------------------------------------------------------------------
*/

$sql = "
    SELECT
        comments.id,
        comments.blog_id,
        comments.guest_name,
        comments.comment,
        comments.created_at,
        blogs.title AS blog_title
    FROM comments
    LEFT JOIN blogs ON comments.blog_id = blogs.id
    ORDER BY comments.created_at DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Comments - Admin Dashboard</title>


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

                <i class="fa fa-comments"></i>

                Comments

            </h2>


            <p class="text-muted mb-0">

                Manage comments submitted on blog posts.

            </p>

        </div>


        <div class="d-flex gap-2">


            <!-- ADD COMMENT -->

            <a
                href="comment_form.php"
                class="btn btn-primary"
            >

                <i class="fa fa-plus"></i>

                Add Comment

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


    <!-- ==================== COMMENTS CARD ==================== -->

    <div class="card shadow-sm">


        <div class="card-header bg-white">

            <h5 class="mb-0">

                <i class="fa fa-comments"></i>

                All Comments

            </h5>

        </div>


        <div class="card-body">


            <!-- ==================== SUCCESS MESSAGES ==================== -->


            <?php if (isset($_GET['deleted'])): ?>

                <div class="alert alert-success">

                    <i class="fa fa-check-circle"></i>

                    Comment deleted successfully.

                </div>

            <?php endif; ?>


            <?php if (isset($_GET['success'])): ?>

                <div class="alert alert-success">

                    <i class="fa fa-check-circle"></i>

                    Comment saved successfully.

                </div>

            <?php endif; ?>


            <?php if (isset($_GET['error']) && $_GET['error'] === 'notfound'): ?>

                <div class="alert alert-danger">

                    <i class="fa fa-exclamation-circle"></i>

                    Comment not found.

                </div>

            <?php endif; ?>


            <!-- ==================== COMMENTS TABLE ==================== -->


            <?php if (count($comments) > 0): ?>


                <div class="table-responsive">


                    <table
                        class="table table-bordered table-hover align-middle"
                    >


                        <!-- TABLE HEADER -->

                        <thead class="table-dark">

                            <tr>

                                <th>ID</th>

                                <th>Blog</th>

                                <th>Guest Name</th>

                                <th>Comment</th>

                                <th>Date</th>

                                <th>Actions</th>

                            </tr>

                        </thead>


                        <!-- TABLE BODY -->

                        <tbody>


                        <?php foreach ($comments as $row): ?>


                            <tr>


                                <!-- ID -->

                                <td>

                                    <?= (int) $row['id'] ?>

                                </td>


                                <!-- BLOG -->

                                <td>

                                    <?php if (!empty($row['blog_title'])): ?>

                                        <?= htmlspecialchars($row['blog_title']) ?>

                                    <?php else: ?>

                                        Blog #<?= (int) $row['blog_id'] ?>

                                    <?php endif; ?>

                                </td>


                                <!-- GUEST NAME -->

                                <td>

                                    <?= htmlspecialchars($row['guest_name']) ?>

                                </td>


                                <!-- COMMENT -->

                                <td style="max-width: 400px;">

                                    <?= htmlspecialchars($row['comment']) ?>

                                </td>


                                <!-- DATE -->

                                <td>

                                    <?= htmlspecialchars($row['created_at']) ?>

                                </td>


                                <!-- ==================== ACTIONS ==================== -->

                                <td style="min-width: 190px;">


                                    <!-- EDIT -->

                                    <a
                                        href="comment_form.php?id=<?= (int) $row['id'] ?>"
                                        class="btn btn-warning btn-sm"
                                    >

                                        <i class="fa fa-edit"></i>

                                        Edit

                                    </a>


                                    <!-- DELETE -->

                                    <a
                                        href="comment_delete.php?id=<?= (int) $row['id'] ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this comment?');"
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


                <!-- NO COMMENTS -->

                <div class="alert alert-info">

                    <i class="fa fa-info-circle"></i>

                    No comments found.

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

