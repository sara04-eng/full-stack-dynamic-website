<?php

include '../config.php';

/*
|--------------------------------------------------------------------------
| Get Contact Messages
|--------------------------------------------------------------------------
*/

$sql = "
    SELECT
        id,
        name,
        email,
        subject,
        message,
        created_at
    FROM contact_messages
    ORDER BY created_at DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$messages = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact Messages - Admin Dashboard</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

</head>

<body>

<div class="container-fluid py-4">

    <!-- Page Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">
                Contact Messages
            </h2>

            <p class="text-muted mb-0">
                Manage messages submitted through the contact form.
            </p>

        </div>

        <a href="index.php" class="btn btn-dark">

            <i class="fa fa-dashboard"></i>

            Dashboard

        </a>

    </div>


    <!-- Messages Table -->

    <div class="card shadow-sm">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                <i class="fa fa-envelope"></i>

                All Contact Messages

            </h5>

        </div>


        <div class="card-body">

            <?php if (isset($_GET['deleted'])): ?>

                <div class="alert alert-success">

                    Message deleted successfully.

                </div>

            <?php endif; ?>


            <?php if (count($messages) > 0): ?>

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-dark">

                            <tr>

                                <th>ID</th>

                                <th>Name</th>

                                <th>Email</th>

                                <th>Subject</th>

                                <th>Message</th>

                                <th>Date</th>

                                <th>Action</th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php foreach ($messages as $row): ?>

                                <tr>

                                    <!-- ID -->

                                    <td>

                                        <?= htmlspecialchars($row['id']) ?>

                                    </td>


                                    <!-- Name -->

                                    <td>

                                        <?= htmlspecialchars($row['name']) ?>

                                    </td>


                                    <!-- Email -->

                                    <td>

                                        <?= htmlspecialchars($row['email']) ?>

                                    </td>


                                    <!-- Subject -->

                                    <td>

                                        <?= htmlspecialchars($row['subject']) ?>

                                    </td>


                                    <!-- Message -->

                                    <td style="max-width: 400px;">

                                        <?= htmlspecialchars($row['message']) ?>

                                    </td>


                                    <!-- Date -->

                                    <td>

                                        <?= htmlspecialchars($row['created_at']) ?>

                                    </td>


                                    <!-- Delete -->

                                    <td>

                                        <a
                                            href="contact_message_delete.php?id=<?= $row['id'] ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this message?');"
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

                <div class="alert alert-info">

                    No contact messages found.

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>