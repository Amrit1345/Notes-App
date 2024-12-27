<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Notes</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.0.0/ckeditor5.css" crossorigin>

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">

  <script src="https://cdn.ckeditor.com/ckeditor5/44.0.0/ckeditor5.umd.js" crossorigin></script>
</head>

<body>

  <div class="page" style="margin-top:40px;">

    <div class="container notes shadow p-3 mb-5 bg-body-tertiary rounded">

      <form action="../update/<?= $note->id ?>" method="POST">

        <input type="text" class="mb-3 form-control" id="title" name="title" placeholder="Title" value="<?= $note->title ?>" required>
        <input type="text" class="mb-3 form-control" id="desc" name="desc" placeholder="Description" value="<?= $note->desc ?>" required>
        <textarea id="editor" name="content" required><?= $note->content ?></textarea>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
          <button class="btn btn-dark" type="submit" id="add_note" style="margin-top: 15px; margin-bottom: 0px">
            Update</button>
        </div>
      </form>

    </div>

  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


  <script src="<?php echo base_url(); ?>assets/js/script.js"></script>
</body>

</html>

