<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use app\controllers\CategoryController;
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 2) {
    header('Location: login');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add wiki</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.tiny.cloud/1/k5wu5iubgom98npjv1612l28685z6zxa8348t42bnvfq28w2/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
    <!-- <form method="post" action="addwiki">
        <input type="file" name="imagewiki" id="imagewiki">
        <input type="text">
        <textarea>
        Welcome to TinyMCE!
        </textarea>
    </form> -->

<form action="addwiki" method="post" enctype="multipart/form-data" class="mt-4">
    <div class="mb-3">
        <label for="image" class="form-label">Image:</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">Title:</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Title">
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content:</label>
        <textarea class="form-control" id="content" name="content" placeholder="Content"></textarea>
    </div>
    <div class="mb-3">
        <label for="category" class="form-label">Category:</label>
        <select id="category" name="categorie_id" >
            <?php foreach ($Categories as $cat) { ?>
                <option value="<?= $cat['id'] ?>" ><?= $cat['name'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="tag" class="form-label">Tag:</label>
        <select id="tag" name="tag_id[]" multiple>
            <?php foreach ($tags as $tag) { ?>
                <option value="<?= $tag['id'] ?>" ><?= $tag['name'] ?></option>
            <?php } ?>
        </select>
    </div>

    <!-- Other fields and tags inputs go here -->
    <div>
        <button type="submit" name="add" class="btn btn-primary">Submit</button>
    </div>
</form>





    <script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
    });
    </script>
</body>
</html>