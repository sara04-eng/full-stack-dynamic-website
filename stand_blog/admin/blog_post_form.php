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

$post = [
    'image' => '',
    'title' => '',
    'subtitle' => '',
    'blogger_name' => '',
    'publish_date' => '',
    'description' => ''
];


/*
|--------------------------------------------------------------------------
| Get Existing Blog Post for Edit
|--------------------------------------------------------------------------
*/

if ($isEdit) {

    $stmt = $pdo->prepare("
        SELECT
            id,
            image,
            title,
            subtitle,
            blogger_name,
            publish_date,
            description
        FROM blogs
        WHERE id = ?
    ");

    $stmt->execute([$id]);

    $existingPost = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$existingPost) {

        die("Blog post not found.");

    }

    $post = $existingPost;
}


/*
|--------------------------------------------------------------------------
| Add / Update Blog Post
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /*
    |--------------------------------------------------------------------------
    | Get Form Data
    |--------------------------------------------------------------------------
    */

    $title = trim($_POST['title'] ?? '');

    $subtitle = trim($_POST['subtitle'] ?? '');

    $blogger_name = trim($_POST['blogger_name'] ?? '');

    $publish_date = trim($_POST['publish_date'] ?? '');

    $description = trim($_POST['description'] ?? '');

    $image = trim($_POST['image'] ?? '');


    /*
    |--------------------------------------------------------------------------
    | Basic Validation
    |--------------------------------------------------------------------------
    */

    if (
        $title === '' ||
        $subtitle === '' ||
        $blogger_name === '' ||
        $publish_date === '' ||
        $description === ''
    ) {

        $error = "Please fill in all required fields.";

    } else {

        /*
        |--------------------------------------------------------------------------
        | UPDATE EXISTING BLOG POST
        |--------------------------------------------------------------------------
        */

        if ($isEdit) {

            $stmt = $pdo->prepare("
                UPDATE blogs
                SET
                    image = ?,
                    title = ?,
                    subtitle = ?,
                    blogger_name = ?,
                    publish_date = ?,
                    description = ?
                WHERE id = ?
            ");

            $stmt->execute([
                $image,
                $title,
                $subtitle,
                $blogger_name,
                $publish_date,
                $description,
                $id
            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | INSERT NEW BLOG POST
        |--------------------------------------------------------------------------
        */

        else {

            $stmt = $pdo->prepare("
                INSERT INTO blogs
                (
                    image,
                    title,
                    subtitle,
                    blogger_name,
                    publish_date,
                    description
                )
                VALUES (?, ?, ?, ?, ?, ?)
            ");

            $stmt->execute([
                $image,
                $title,
                $subtitle,
                $blogger_name,
                $publish_date,
                $description
            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | Redirect to posts.php
        |--------------------------------------------------------------------------
        */

        header("Location: posts.php?success=1");

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | Keep Entered Values After Validation Error
    |--------------------------------------------------------------------------
    */

    $post['image'] = $image;

    $post['title'] = $title;

    $post['subtitle'] = $subtitle;

    $post['blogger_name'] = $blogger_name;

    $post['publish_date'] = $publish_date;

    $post['description'] = $description;
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
        <?= $isEdit ? 'Edit Blog Post' : 'Add Blog Post' ?>
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


<div class="container-fluid py-4">


    <!-- ==================== PAGE HEADER ==================== -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">

                <i class="fa fa-newspaper"></i>

                <?= $isEdit ? 'Edit Blog Post' : 'Add Blog Post' ?>

            </h2>

            <p class="text-muted mb-0">

                <?= $isEdit
                    ? 'Update the selected blog post.'
                    : 'Create a new blog post.'
                ?>

            </p>

        </div>


        <!-- Back to Posts -->

        <a
            href="posts.php"
            class="btn btn-dark"
        >

            <i class="fa fa-arrow-left"></i>

            Back to Blog Posts

        </a>

    </div>


    <!-- ==================== FORM CARD ==================== -->

    <div class="card shadow-sm">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                <i class="fa fa-edit"></i>

                Blog Post Information

            </h5>

        </div>


        <div class="card-body">


            <!-- ==================== ERROR ==================== -->

            <?php if (isset($error)): ?>

                <div class="alert alert-danger">

                    <i class="fa fa-exclamation-circle"></i>

                    <?= htmlspecialchars($error) ?>

                </div>

            <?php endif; ?>


            <!-- ==================== FORM ==================== -->

            <form
                method="POST"
                action=""
            >

                <div class="row">


                    <!-- ==================== IMAGE ==================== -->

                    <div class="col-md-12 mb-3">

                        <label
                            for="image"
                            class="form-label"
                        >

                            Blog Image

                        </label>


                        <input
                            type="text"
                            name="image"
                            id="image"
                            class="form-control"
                            placeholder="Example: blog-thumb-01.jpg"
                            value="<?= htmlspecialchars($post['image']) ?>"
                        >


                        <small class="text-muted">

                            Enter the image file name located in
                            <strong>assets/images</strong>.

                        </small>

                    </div>


                    <!-- ==================== TITLE ==================== -->

                    <div class="col-md-6 mb-3">

                        <label
                            for="title"
                            class="form-label"
                        >

                            Title

                            <span class="text-danger">*</span>

                        </label>


                        <input
                            type="text"
                            name="title"
                            id="title"
                            class="form-control"
                            placeholder="Enter blog title"
                            value="<?= htmlspecialchars($post['title']) ?>"
                            required
                        >

                    </div>


                    <!-- ==================== SUBTITLE ==================== -->

                    <div class="col-md-6 mb-3">

                        <label
                            for="subtitle"
                            class="form-label"
                        >

                            Subtitle

                            <span class="text-danger">*</span>

                        </label>


                        <input
                            type="text"
                            name="subtitle"
                            id="subtitle"
                            class="form-control"
                            placeholder="Enter blog subtitle"
                            value="<?= htmlspecialchars($post['subtitle']) ?>"
                            required
                        >

                    </div>


                    <!-- ==================== BLOGGER ==================== -->

                    <div class="col-md-6 mb-3">

                        <label
                            for="blogger_name"
                            class="form-label"
                        >

                            Blogger Name

                            <span class="text-danger">*</span>

                        </label>


                        <input
                            type="text"
                            name="blogger_name"
                            id="blogger_name"
                            class="form-control"
                            placeholder="Enter blogger name"
                            value="<?= htmlspecialchars($post['blogger_name']) ?>"
                            required
                        >

                    </div>


                    <!-- ==================== PUBLISH DATE ==================== -->

                    <div class="col-md-6 mb-3">

                        <label
                            for="publish_date"
                            class="form-label"
                        >

                            Publish Date

                            <span class="text-danger">*</span>

                        </label>


                        <input
                            type="date"
                            name="publish_date"
                            id="publish_date"
                            class="form-control"
                            value="<?= htmlspecialchars($post['publish_date']) ?>"
                            required
                        >

                    </div>


                    <!-- ==================== DESCRIPTION ==================== -->

                    <div class="col-md-12 mb-3">

                        <label
                            for="description"
                            class="form-label"
                        >

                            Description

                            <span class="text-danger">*</span>

                        </label>


                        <textarea
                            name="description"
                            id="description"
                            rows="7"
                            class="form-control"
                            placeholder="Enter blog description"
                            required
                        ><?= htmlspecialchars($post['description']) ?></textarea>

                    </div>


                    <!-- ==================== BUTTONS ==================== -->

                    <div class="col-md-12">


                        <!-- SAVE -->

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >

                            <i class="fa fa-save"></i>

                            <?= $isEdit
                                ? 'Update Blog Post'
                                : 'Add Blog Post'
                            ?>

                        </button>


                        <!-- CANCEL -->

                        <a
                            href="posts.php"
                            class="btn btn-secondary"
                        >

                            <i class="fa fa-times"></i>

                            Cancel

                        </a>


                    </div>


                </div>

            </form>

        </div>

    </div>

</div>


<!-- Bootstrap JavaScript -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>