<?php

include '../config.php';


/*
|--------------------------------------------------------------------------
| Get Contact Information
|--------------------------------------------------------------------------
*/

$stmt = $pdo->query("
    SELECT *
    FROM contact_info
    ORDER BY id ASC
");

$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Contact Information - Admin Dashboard</title>


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

<div class="container py-5">


    <!-- ==================== HEADER ==================== -->

    <div class="d-flex justify-content-between align-items-center mb-4">


        <div>

            <h2 class="mb-1">

                <i class="fa fa-address-book"></i>

                Contact Information

            </h2>


            <p class="text-muted mb-0">

                Manage the contact information displayed on the website.

            </p>

        </div>


        <div class="d-flex gap-2">


            <!-- ADD -->

            <a
                href="contact_info_form.php"
                class="btn btn-primary"
            >

                <i class="fa fa-plus"></i>

                Add Contact

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


    <!-- ==================== SUCCESS MESSAGES ==================== -->


    <?php if (isset($_GET['success'])): ?>

        <div class="alert alert-success">

            <i class="fa fa-check-circle"></i>

            Contact information saved successfully.

        </div>

    <?php endif; ?>


    <?php if (isset($_GET['deleted'])): ?>

        <div class="alert alert-success">

            <i class="fa fa-check-circle"></i>

            Contact information deleted successfully.

        </div>

    <?php endif; ?>


    <?php if (isset($_GET['error']) && $_GET['error'] === 'notfound'): ?>

        <div class="alert alert-danger">

            <i class="fa fa-exclamation-circle"></i>

            Contact information not found.

        </div>

    <?php endif; ?>


    <!-- ==================== CONTACT INFORMATION ==================== -->

    <div class="card shadow-sm">


        <div class="card-header bg-white">

            <h5 class="mb-0">

                <i class="fa fa-address-book"></i>

                All Contact Information

            </h5>

        </div>


        <div class="card-body">


            <?php if (count($contacts) > 0): ?>


                <div class="table-responsive">


                    <table class="table table-bordered table-hover align-middle">


                        <!-- TABLE HEADER -->

                        <thead class="table-dark">

                            <tr>

                                <th>ID</th>

                                <th>Phone</th>

                                <th>Email</th>

                                <th>Address</th>

                                <th>Actions</th>

                            </tr>

                        </thead>


                        <!-- TABLE BODY -->

                        <tbody>


                        <?php foreach ($contacts as $contact): ?>


                            <tr>


                                <!-- ID -->

                                <td>

                                    <?= (int) $contact['id'] ?>

                                </td>


                                <!-- PHONE -->

                                <td>

                                    <?= htmlspecialchars($contact['phone']) ?>

                                </td>


                                <!-- EMAIL -->

                                <td>

                                    <?= htmlspecialchars($contact['email']) ?>

                                </td>


                                <!-- ADDRESS -->

                                <td>

                                    <?= htmlspecialchars($contact['address']) ?>

                                </td>


                                <!-- ACTIONS -->

                                <td style="min-width: 180px;">


                                    <!-- EDIT -->

                                    <a
                                        href="contact_info_form.php?id=<?= (int) $contact['id'] ?>"
                                        class="btn btn-sm btn-warning"
                                    >

                                        <i class="fa fa-edit"></i>

                                        Edit

                                    </a>


                                    <!-- DELETE -->

                                    <a
                                        href="contact_info_delete.php?id=<?= (int) $contact['id'] ?>"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this contact information?');"
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


                <!-- NO DATA -->

                <div class="alert alert-info">

                    <i class="fa fa-info-circle"></i>

                    No contact information found.

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