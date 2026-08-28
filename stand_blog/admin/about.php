<?php

include '../config.php';

$message = '';
$error = '';

/* Get About Data */
try {

    $stmt = $pdo->prepare("SELECT * FROM about WHERE id = 1 LIMIT 1");
    $stmt->execute();

    $about = $stmt->fetch();

    if (!$about) {
        die("About data not found.");
    }

} catch (PDOException $e) {

    die("Error fetching About data: " . $e->getMessage());

}


/* Update About */
if (isset($_POST['update_about'])) {

    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    $items = [];

    for ($i = 1; $i <= 9; $i++) {

        $items[$i]['title'] = trim($_POST["item{$i}_title"]);
        $items[$i]['description'] = trim($_POST["item{$i}_description"]);

    }


    /* Keep Current Image */
    $image = $about['image'];


    /* Upload New Image */
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

        $upload_dir = "../assets/images/";

        $image_name = basename($_FILES['image']['name']);
        $image_tmp = $_FILES['image']['tmp_name'];

        $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp'];

        $extension = strtolower(
            pathinfo($image_name, PATHINFO_EXTENSION)
        );

        if (!in_array($extension, $allowed_extensions)) {

            $error = "Invalid image type.";

        } else {

            $new_image_name = time() . "_" . $image_name;

            if (move_uploaded_file(
                $image_tmp,
                $upload_dir . $new_image_name
            )) {

                $image = $new_image_name;

            } else {

                $error = "Failed to upload image.";

            }
        }
    }


    /* Update Database */
    if ($error === '') {

        try {

            $sql = "UPDATE about SET
                image = :image,
                title = :title,
                description = :description,
                item1_title = :item1_title,
                item1_description = :item1_description,
                item2_title = :item2_title,
                item2_description = :item2_description,
                item3_title = :item3_title,
                item3_description = :item3_description,
                item4_title = :item4_title,
                item4_description = :item4_description,
                item5_title = :item5_title,
                item5_description = :item5_description,
                item6_title = :item6_title,
                item6_description = :item6_description,
                item7_title = :item7_title,
                item7_description = :item7_description,
                item8_title = :item8_title,
                item8_description = :item8_description,
                item9_title = :item9_title,
                item9_description = :item9_description
                WHERE id = 1";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([

                ':image' => $image,

                ':title' => $title,

                ':description' => $description,

                ':item1_title' => $items[1]['title'],
                ':item1_description' => $items[1]['description'],

                ':item2_title' => $items[2]['title'],
                ':item2_description' => $items[2]['description'],

                ':item3_title' => $items[3]['title'],
                ':item3_description' => $items[3]['description'],

                ':item4_title' => $items[4]['title'],
                ':item4_description' => $items[4]['description'],

                ':item5_title' => $items[5]['title'],
                ':item5_description' => $items[5]['description'],

                ':item6_title' => $items[6]['title'],
                ':item6_description' => $items[6]['description'],

                ':item7_title' => $items[7]['title'],
                ':item7_description' => $items[7]['description'],

                ':item8_title' => $items[8]['title'],
                ':item8_description' => $items[8]['description'],

                ':item9_title' => $items[9]['title'],
                ':item9_description' => $items[9]['description']

            ]);


            $message = "About section updated successfully.";


            /* Reload About Data */

            $stmt = $pdo->prepare(
                "SELECT * FROM about WHERE id = 1 LIMIT 1"
            );

            $stmt->execute();

            $about = $stmt->fetch();


        } catch (PDOException $e) {

            $error = "Error updating About: " . $e->getMessage();

        }
    }
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Admin - About</title>


    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">


    <style>

        body {
            background: #f5f6fa;
        }

        .admin-container {
            max-width: 1100px;
            margin: 40px auto;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
        }

        .card-header {
            background: #ffffff;
            border-bottom: 1px solid #eee;
            padding: 20px;
        }

        .card-header h3 {
            margin: 0;
            font-weight: 600;
        }

        .form-label {
            font-weight: 500;
        }

        textarea {
            min-height: 120px;
        }

        .item-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .item-card h5 {
            margin-bottom: 20px;
            font-weight: 600;
        }

        .current-image {
            max-width: 250px;
            max-height: 180px;
            object-fit: cover;
            border-radius: 8px;
            margin-top: 10px;
        }

    </style>

</head>


<body>


<div class="admin-container">


    <!-- Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2>About Section</h2>

            <p class="text-muted mb-0">
                Manage the About section content
            </p>

        </div>


        <a href="index.php"
           class="btn btn-secondary">

            Back to Dashboard

        </a>

    </div>


    <!-- Success Message -->

    <?php if ($message != ''): ?>

        <div class="alert alert-success">

            <?php echo htmlspecialchars($message); ?>

        </div>

    <?php endif; ?>


    <!-- Error Message -->

    <?php if ($error != ''): ?>

        <div class="alert alert-danger">

            <?php echo htmlspecialchars($error); ?>

        </div>

    <?php endif; ?>


    <!-- About Form -->

    <div class="card">

        <div class="card-header">

            <h3>Edit About Section</h3>

        </div>


        <div class="card-body">


            <form
                method="POST"
                enctype="multipart/form-data"
            >


                <!-- Image -->

                <div class="mb-4">

                    <label class="form-label">
                        About Image
                    </label>

                    <input
                        type="file"
                        name="image"
                        class="form-control"
                        accept="image/*"
                    >


                    <?php if (!empty($about['image'])): ?>

                        <div>

                            <p class="mt-2 mb-1 text-muted">
                                Current Image:
                            </p>


                            <img
                                src="../assets/images/<?php echo htmlspecialchars($about['image']); ?>"
                                class="current-image"
                                alt="About Image"
                            >

                        </div>

                    <?php endif; ?>

                </div>


                <!-- Main Title -->

                <div class="mb-4">

                    <label class="form-label">
                        About Title
                    </label>


                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="<?php echo htmlspecialchars($about['title']); ?>"
                        required
                    >

                </div>


                <!-- Main Description -->

                <div class="mb-4">

                    <label class="form-label">
                        About Description
                    </label>


                    <textarea
                        name="description"
                        class="form-control"
                        required
                    ><?php echo htmlspecialchars($about['description']); ?></textarea>

                </div>


                <hr>


                <h4 class="mb-4">
                    About Items
                </h4>


                <!-- Items -->

                <?php for ($i = 1; $i <= 9; $i++): ?>

                    <div class="item-card">

                        <h5>
                            Item <?php echo $i; ?>
                        </h5>


                        <div class="mb-3">

                            <label class="form-label">

                                Item <?php echo $i; ?> Title

                            </label>


                            <input
                                type="text"
                                name="item<?php echo $i; ?>_title"
                                class="form-control"
                                value="<?php echo htmlspecialchars($about["item{$i}_title"]); ?>"
                                required
                            >

                        </div>


                        <div>

                            <label class="form-label">

                                Item <?php echo $i; ?> Description

                            </label>


                            <textarea
                                name="item<?php echo $i; ?>_description"
                                class="form-control"
                                required
                            ><?php echo htmlspecialchars($about["item{$i}_description"]); ?></textarea>

                        </div>

                    </div>

                <?php endfor; ?>


                <!-- Update Button -->

                <div class="text-end">

                    <button
                        type="submit"
                        name="update_about"
                        class="btn btn-primary btn-lg"
                    >

                        Update About

                    </button>

                </div>


            </form>

        </div>

    </div>

</div>


</body>

</html>