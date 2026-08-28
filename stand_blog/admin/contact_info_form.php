<?php

include '../config.php';

/*
|--------------------------------------------------------------------------
| Check if Editing
|--------------------------------------------------------------------------
*/

$isEdit = isset($_GET['id']) && is_numeric($_GET['id']);

$id = $isEdit ? (int) $_GET['id'] : null;


/*
|--------------------------------------------------------------------------
| Default Values
|--------------------------------------------------------------------------
*/

$contact = [
    'phone' => '',
    'email' => '',
    'address' => ''
];


/*
|--------------------------------------------------------------------------
| Get Existing Contact Information
|--------------------------------------------------------------------------
*/

if ($isEdit) {

    $stmt = $pdo->prepare("
        SELECT
            id,
            phone,
            email,
            address
        FROM contact_info
        WHERE id = ?
    ");

    $stmt->execute([$id]);

    $existingContact = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$existingContact) {

        die("Contact information not found.");

    }

    $contact = $existingContact;
}


/*
|--------------------------------------------------------------------------
| Add / Update Contact Information
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $phone = trim($_POST['phone'] ?? '');

    $email = trim($_POST['email'] ?? '');

    $address = trim($_POST['address'] ?? '');


    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */

    if (
        $phone === '' ||
        $email === '' ||
        $address === ''
    ) {

        $error = "Please fill in all required fields.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Please enter a valid email address.";

    } else {


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        if ($isEdit) {

            $stmt = $pdo->prepare("
                UPDATE contact_info
                SET
                    phone = ?,
                    email = ?,
                    address = ?
                WHERE id = ?
            ");

            $stmt->execute([
                $phone,
                $email,
                $address,
                $id
            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | INSERT
        |--------------------------------------------------------------------------
        */

        else {

            $stmt = $pdo->prepare("
                INSERT INTO contact_info
                (
                    phone,
                    email,
                    address
                )
                VALUES (?, ?, ?)
            ");

            $stmt->execute([
                $phone,
                $email,
                $address
            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        header("Location: contact_info.php?success=1");

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | Keep Entered Values
    |--------------------------------------------------------------------------
    */

    $contact['phone'] = $phone;

    $contact['email'] = $email;

    $contact['address'] = $address;
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        <?= $isEdit ? 'Edit Contact Information' : 'Add Contact Information' ?>
        - Admin Dashboard
    </title>


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

                <?= $isEdit
                    ? 'Edit Contact Information'
                    : 'Add Contact Information'
                ?>

            </h2>


            <p class="text-muted mb-0">

                <?= $isEdit
                    ? 'Update the contact information.'
                    : 'Add contact information to the website.'
                ?>

            </p>

        </div>


        <!-- Dashboard -->

        <a
            href="index.php"
            class="btn btn-dark"
        >

            <i class="fa fa-dashboard"></i>

            Dashboard

        </a>

    </div>


    <!-- ==================== FORM CARD ==================== -->

    <div class="card shadow-sm">


        <div class="card-header bg-white">

            <h5 class="mb-0">

                <i class="fa fa-address-book"></i>

                Contact Information

            </h5>

        </div>


        <div class="card-body">


            <!-- Error -->

            <?php if (isset($error)): ?>

                <div class="alert alert-danger">

                    <i class="fa fa-exclamation-circle"></i>

                    <?= htmlspecialchars($error) ?>

                </div>

            <?php endif; ?>


            <!-- ==================== FORM ==================== -->

            <form method="POST">


                <!-- Phone -->

                <div class="mb-3">

                    <label
                        for="phone"
                        class="form-label"
                    >

                        Phone

                        <span class="text-danger">*</span>

                    </label>


                    <input
                        type="text"
                        name="phone"
                        id="phone"
                        class="form-control"
                        placeholder="Enter phone number"
                        value="<?= htmlspecialchars($contact['phone']) ?>"
                        required
                    >

                </div>


                <!-- Email -->

                <div class="mb-3">

                    <label
                        for="email"
                        class="form-label"
                    >

                        Email

                        <span class="text-danger">*</span>

                    </label>


                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control"
                        placeholder="Enter email address"
                        value="<?= htmlspecialchars($contact['email']) ?>"
                        required
                    >

                </div>


                <!-- Address -->

                <div class="mb-3">

                    <label
                        for="address"
                        class="form-label"
                    >

                        Address

                        <span class="text-danger">*</span>

                    </label>


                    <textarea
                        name="address"
                        id="address"
                        rows="4"
                        class="form-control"
                        placeholder="Enter address"
                        required
                    ><?= htmlspecialchars($contact['address']) ?></textarea>

                </div>


                <!-- Buttons -->

                <button
                    type="submit"
                    class="btn btn-primary"
                >

                    <i class="fa fa-save"></i>

                    <?= $isEdit
                        ? 'Update Contact Information'
                        : 'Add Contact Information'
                    ?>

                </button>


                <a
                    href="contact_info.php"
                    class="btn btn-secondary"
                >

                    <i class="fa fa-times"></i>

                    Cancel

                </a>


            </form>

        </div>

    </div>

</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>