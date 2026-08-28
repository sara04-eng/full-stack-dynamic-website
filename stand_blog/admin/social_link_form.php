<?php

include '../config.php';

/*
|--------------------------------------------------------------------------
| Check if Editing
|--------------------------------------------------------------------------
*/

$isEdit = isset($_GET['id']) && is_numeric($_GET['id']);

$id = $isEdit ? (int) $_GET['id'] : 0;


/*
|--------------------------------------------------------------------------
| Default Values
|--------------------------------------------------------------------------
*/

$platform = '';
$url = '';

$error = '';


/*
|--------------------------------------------------------------------------
| Get Existing Social Link
|--------------------------------------------------------------------------
*/

if ($isEdit) {

    $stmt = $pdo->prepare("
        SELECT *
        FROM social_links
        WHERE id = ?
    ");

    $stmt->execute([$id]);

    $socialLink = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$socialLink) {

        header("Location: social_links.php");

        exit;
    }

    $platform = $socialLink['platform'];
    $url = $socialLink['url'];
}


/*
|--------------------------------------------------------------------------
| Add / Update
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $platform = trim($_POST['platform'] ?? '');

    $url = trim($_POST['url'] ?? '');


    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */

    if ($platform === '' || $url === '') {

        $error = "Please fill in all fields.";

    } elseif (!filter_var($url, FILTER_VALIDATE_URL)) {

        $error = "Please enter a valid URL.";

    } else {


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        if ($isEdit) {

            $stmt = $pdo->prepare("
                UPDATE social_links
                SET
                    platform = ?,
                    url = ?
                WHERE id = ?
            ");

            $stmt->execute([
                $platform,
                $url,
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
                INSERT INTO social_links
                (
                    platform,
                    url
                )
                VALUES (?, ?)
            ");

            $stmt->execute([
                $platform,
                $url
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        header("Location: social_links.php?success=1");

        exit;
    }
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
        <?= $isEdit ? 'Edit Social Link' : 'Add Social Link' ?>
        - Admin
    </title>


    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>


<body>

<div class="container mt-5">


    <!-- Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>

            <?= $isEdit ? 'Edit Social Link' : 'Add Social Link' ?>

        </h2>


        <a
            href="social_links.php"
            class="btn btn-secondary"
        >

            Back

        </a>

    </div>


    <!-- Form -->

    <div class="card">

        <div class="card-body">


            <?php if ($error !== ''): ?>

                <div class="alert alert-danger">

                    <?= htmlspecialchars($error) ?>

                </div>

            <?php endif; ?>


            <form method="POST">


                <!-- Platform -->

                <div class="mb-3">

                    <label
                        for="platform"
                        class="form-label"
                    >

                        Platform

                    </label>


                    <input
                        type="text"
                        name="platform"
                        id="platform"
                        class="form-control"
                        placeholder="Example: Facebook"
                        value="<?= htmlspecialchars($platform) ?>"
                        required
                    >

                </div>


                <!-- URL -->

                <div class="mb-3">

                    <label
                        for="url"
                        class="form-label"
                    >

                        URL

                    </label>


                    <input
                        type="url"
                        name="url"
                        id="url"
                        class="form-control"
                        placeholder="https://example.com"
                        value="<?= htmlspecialchars($url) ?>"
                        required
                    >

                </div>


                <!-- Buttons -->

                <button
                    type="submit"
                    class="btn btn-primary"
                >

                    <?= $isEdit ? 'Update Social Link' : 'Add Social Link' ?>

                </button>


                <a
                    href="social_links.php"
                    class="btn btn-secondary"
                >

                    Cancel

                </a>


            </form>

        </div>

    </div>

</div>

</body>

</html>