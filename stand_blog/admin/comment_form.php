
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

$commentData = [
    'blog_id' => '',
    'guest_name' => '',
    'comment' => ''
];


/*
|--------------------------------------------------------------------------
| Get All Blogs
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare("
    SELECT
        id,
        title
    FROM blogs
    ORDER BY title ASC
");

$stmt->execute();

$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);


/*
|--------------------------------------------------------------------------
| Get Existing Comment for Edit
|--------------------------------------------------------------------------
*/

if ($isEdit) {

    $stmt = $pdo->prepare("
        SELECT
            id,
            blog_id,
            guest_name,
            comment
        FROM comments
        WHERE id = ?
    ");

    $stmt->execute([$id]);

    $existingComment = $stmt->fetch(PDO::FETCH_ASSOC);


    /*
    |--------------------------------------------------------------------------
    | Comment Not Found
    |--------------------------------------------------------------------------
    */

    if (!$existingComment) {

        header("Location: comments.php?error=notfound");

        exit;
    }


    $commentData = $existingComment;
}


/*
|--------------------------------------------------------------------------
| Add / Update Comment
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    /*
    |--------------------------------------------------------------------------
    | Get Form Data
    |--------------------------------------------------------------------------
    */

    $blog_id = isset($_POST['blog_id']) && is_numeric($_POST['blog_id'])
        ? (int) $_POST['blog_id']
        : 0;

    $guest_name = trim($_POST['guest_name'] ?? '');

    $comment = trim($_POST['comment'] ?? '');


    /*
    |--------------------------------------------------------------------------
    | Basic Validation
    |--------------------------------------------------------------------------
    */

    if (
        $blog_id <= 0 ||
        $guest_name === '' ||
        $comment === ''
    ) {

        $error = "Please fill in all required fields.";

    } else {


        /*
        |--------------------------------------------------------------------------
        | Check Blog Exists
        |--------------------------------------------------------------------------
        */

        $stmt = $pdo->prepare("
            SELECT id
            FROM blogs
            WHERE id = ?
        ");

        $stmt->execute([$blog_id]);

        $blogExists = $stmt->fetch(PDO::FETCH_ASSOC);


        if (!$blogExists) {

            $error = "Selected blog post does not exist.";

        } else {


            /*
            |--------------------------------------------------------------------------
            | UPDATE COMMENT
            |--------------------------------------------------------------------------
            */

            if ($isEdit) {

                $stmt = $pdo->prepare("
                    UPDATE comments
                    SET
                        blog_id = ?,
                        guest_name = ?,
                        comment = ?
                    WHERE id = ?
                ");

                $stmt->execute([
                    $blog_id,
                    $guest_name,
                    $comment,
                    $id
                ]);

            }


            /*
            |--------------------------------------------------------------------------
            | INSERT COMMENT
            |--------------------------------------------------------------------------
            */

            else {

                $stmt = $pdo->prepare("
                    INSERT INTO comments
                    (
                        blog_id,
                        guest_name,
                        comment,
                        created_at
                    )
                    VALUES (?, ?, ?, NOW())
                ");

                $stmt->execute([
                    $blog_id,
                    $guest_name,
                    $comment
                ]);

            }


            /*
            |--------------------------------------------------------------------------
            | Redirect
            |--------------------------------------------------------------------------
            */

            header("Location: comments.php?success=1");

            exit;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Keep Entered Values After Error
    |--------------------------------------------------------------------------
    */

    $commentData['blog_id'] = $blog_id;

    $commentData['guest_name'] = $guest_name;

    $commentData['comment'] = $comment;
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

        <?= $isEdit ? 'Edit Comment' : 'Add Comment' ?>

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

                <i class="fa fa-comments"></i>

                <?= $isEdit ? 'Edit Comment' : 'Add Comment' ?>

            </h2>


            <p class="text-muted mb-0">

                <?= $isEdit
                    ? 'Update the selected comment.'
                    : 'Add a new comment to a blog post.'
                ?>

            </p>

        </div>


        <!-- Back to Comments -->

        <a
            href="comments.php"
            class="btn btn-dark"
        >

            <i class="fa fa-arrow-left"></i>

            Back to Comments

        </a>

    </div>


    <!-- ==================== FORM CARD ==================== -->

    <div class="card shadow-sm">


        <div class="card-header bg-white">

            <h5 class="mb-0">

                <i class="fa fa-edit"></i>

                Comment Information

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


                    <!-- ==================== BLOG ==================== -->

                    <div class="col-md-12 mb-3">


                        <label
                            for="blog_id"
                            class="form-label"
                        >

                            Blog Post

                            <span class="text-danger">*</span>

                        </label>


                        <select
                            name="blog_id"
                            id="blog_id"
                            class="form-select"
                            required
                        >


                            <option value="">

                                Select Blog Post

                            </option>


                            <?php foreach ($blogs as $blog): ?>


                                <option
                                    value="<?= (int) $blog['id'] ?>"
                                    <?= ((int) $commentData['blog_id'] === (int) $blog['id'])
                                        ? 'selected'
                                        : ''
                                    ?>
                                >

                                    <?= htmlspecialchars($blog['title']) ?>

                                </option>


                            <?php endforeach; ?>


                        </select>


                    </div>


                    <!-- ==================== GUEST NAME ==================== -->

                    <div class="col-md-12 mb-3">


                        <label
                            for="guest_name"
                            class="form-label"
                        >

                            Guest Name

                            <span class="text-danger">*</span>

                        </label>


                        <input
                            type="text"
                            name="guest_name"
                            id="guest_name"
                            class="form-control"
                            placeholder="Enter guest name"
                            value="<?= htmlspecialchars($commentData['guest_name']) ?>"
                            required
                        >


                    </div>


                    <!-- ==================== COMMENT ==================== -->

                    <div class="col-md-12 mb-3">


                        <label
                            for="comment"
                            class="form-label"
                        >

                            Comment

                            <span class="text-danger">*</span>

                        </label>


                        <textarea
                            name="comment"
                            id="comment"
                            rows="7"
                            class="form-control"
                            placeholder="Enter comment"
                            required
                        ><?= htmlspecialchars($commentData['comment']) ?></textarea>


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
                                ? 'Update Comment'
                                : 'Add Comment'
                            ?>

                        </button>


                        <!-- CANCEL -->

                        <a
                            href="comments.php"
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

