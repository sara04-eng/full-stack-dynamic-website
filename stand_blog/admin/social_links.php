<?php

include '../config.php';

/*
|--------------------------------------------------------------------------
| Get All Social Links
|--------------------------------------------------------------------------
*/

$stmt = $pdo->query("
    SELECT *
    FROM social_links
    ORDER BY id ASC
");

$socialLinks = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Social Links - Admin</title>


    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>


<body>

<div class="container mt-5">


    <!-- ==================== HEADER ==================== -->

   <!-- ==================== HEADER ==================== -->

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2>
            Social Links
        </h2>

        <p class="text-muted mb-0">
            Manage social media links.
        </p>

    </div>


    <div class="d-flex gap-2">

        <!-- Add Social Link -->

        <a
            href="social_link_form.php"
            class="btn btn-primary"
        >

            <i class="fa fa-plus"></i>

            Add Social Link

        </a>


        <!-- Dashboard -->

        <a
            href="index.php"
            class="btn btn-dark"
        >

            <i class="fa fa-dashboard"></i>

            Dashboard

        </a>

    </div>

</div>


    <!-- ==================== MESSAGES ==================== -->

    <?php if (isset($_GET['success'])): ?>

        <div class="alert alert-success">

            Social link saved successfully.

        </div>

    <?php endif; ?>


    <?php if (isset($_GET['deleted'])): ?>

        <div class="alert alert-success">

            Social link deleted successfully.

        </div>

    <?php endif; ?>


    <?php if (isset($_GET['error']) && $_GET['error'] === 'notfound'): ?>

        <div class="alert alert-danger">

            Social link not found.

        </div>

    <?php endif; ?>


    <!-- ==================== SOCIAL LINKS TABLE ==================== -->

    <div class="card">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover">


                    <!-- TABLE HEADER -->

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Platform</th>

                            <th>URL</th>

                            <th>Actions</th>

                        </tr>

                    </thead>


                    <!-- TABLE BODY -->

                    <tbody>


                    <?php if (count($socialLinks) > 0): ?>


                        <?php foreach ($socialLinks as $link): ?>

                            <tr>


                                <!-- ID -->

                                <td>

                                    <?= (int) $link['id'] ?>

                                </td>


                                <!-- PLATFORM -->

                                <td>

                                    <?= htmlspecialchars($link['platform']) ?>

                                </td>


                                <!-- URL -->

                                <td>

                                    <a
                                        href="<?= htmlspecialchars($link['url']) ?>"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >

                                        <?= htmlspecialchars($link['url']) ?>

                                    </a>

                                </td>


                                <!-- ACTIONS -->

                                <td>


                                    <!-- EDIT -->

                                    <a
                                        href="social_link_form.php?id=<?= (int) $link['id'] ?>"
                                        class="btn btn-sm btn-warning"
                                    >

                                        Edit

                                    </a>


                                    <!-- DELETE -->

                                    <a
                                        href="social_link_delete.php?id=<?= (int) $link['id'] ?>"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this social link?');"
                                    >

                                        Delete

                                    </a>


                                </td>


                            </tr>

                        <?php endforeach; ?>


                    <?php else: ?>


                        <!-- NO DATA -->

                        <tr>

                            <td
                                colspan="4"
                                class="text-center"
                            >

                                No social links found.

                            </td>

                        </tr>


                    <?php endif; ?>


                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


<!-- Bootstrap JavaScript -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>