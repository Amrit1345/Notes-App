<!doctype html> 
<html lang="en">

<head>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.css" />
  
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">

  <style>
    .search-container {
        margin-bottom: 10px;
    }

    #search-box {
        /* width: calc(100% - 80px); */
        height: 25px;
        width: 180px;
        padding: 10px;
        margin-right: 10px;
        border: 1px solid #ccc;
        border-radius: 10px;
    }

    input[type="submit"] {
        /* padding: 10px 15px; */
        background-color:rgb(7, 7, 7);
        height: 25px;
        width: 80px;
        color: white;
        border: none;
        border-radius: 15px;
        cursor: pointer;
        margin-right: 60px;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }
  </style>

</head>

<body>

    <!-- Flashdata Alert -->

    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success alert-dismissible fade show" style="margin-top:56px;"  role="alert">
          <?= $this->session->flashdata('success'); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('update')): ?>
      <div class="alert alert-success alert-dismissible fade show" style="margin-top:56px;"  role="alert">
          <?= $this->session->flashdata('update'); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('delete')): ?>
      <div class="alert alert-success alert-dismissible fade show" style="margin-top:56px;"  role="alert">
          <?= $this->session->flashdata('delete'); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>


  <div class="page" style="margin-top:40px;">

    <div class="container notes shadow p-3 mb-5 bg-body-tertiary rounded">

      <form action="<?= base_url('notes/add') ?>" method="POST">

        <input type="text" class="mb-3 form-control" id="title" name="title" placeholder="Title" required>
        <input type="text" class="mb-3 form-control" id="desc" name="desc" placeholder="Description" required>
        <textarea id="editor" name="content" data-parsley-required="true"></textarea>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
          <button class="btn btn-dark" type="submit" id="add_note" style="margin-top: 15px; margin-bottom: 0px">
            <span id="plus">＋</span> Add Note</button>
        </div>
      </form>

    </div>


    <div class="btns container p-3 mb-5" style="display: flex; ">

      <div>
        <h4>Your Notes</h4>
      </div>

      <form action="<?= base_url('notes/search_notes') ?>" method="GET">
        <div class="search-container">
          <input type="text" name="q" id="search-box" placeholder="Search notes..." value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
          <input type="submit" value="Search">
        </div>
      </form>

      <div style="display: flex; gap: 5px;" id="toggle">

        <div id="grid"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
            class="bi bi-grid-3x3-gap-fill" viewBox="0 0 16 16">
            <path
              d="M1 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zM1 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zM1 12a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1z" />
          </svg>
        </div>

        <div><label class="switch" id="toggle-btn">
            <input type="checkbox" checked>
            <span class="slider round"></span>
          </label>
        </div>

        <div id="list"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
            class="bi bi-list-ul" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
              d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
          </svg>
        </div>

      </div>
    </div>

  </div>

    <div class="grid-container container p-3 mb-5 bg-body-tertiary rounded" id="grid-view">
        <!-- List Notes -->
        <?php foreach ($notes as $note): ?>
            <div class="note" data-id="<?= $note->id ?>" style="cursor: pointer;">
                <h3><?= $note->title ?></h3>
                <h6><?= $note->desc ?></h6>
                            <!-- <p><?= substr($note->content, 0, 50) ?>...</p> Show only a preview -->
                            <!-- <p><?= word_limiter($note->content,7) ?></p> -->
                            <!-- <a href="notes/view/<?= $note->id ?>"><img src="<?php echo base_url();?>assets/images/show.svg " alt=show_image"></a> Link to the full view -->
                <a href="notes/edit/<?= $note->id ?>"><img src="<?php echo base_url();?>assets/images/edit.svg " alt=edit_image"></a>
                            <!-- <a href="notes/delete/<?= $note->id ?>"><img src="<?php echo base_url();?>assets/images/trash.svg " alt=trash_image"></a> -->
                <a href="javascript:void(0);" onclick="confirmDelete('<?= base_url('notes/delete/' . $note->id) ?>')">
                  <img src="<?php echo base_url();?>assets/images/trash.svg" alt="trash_image">
                </a>
            </div>
        <?php endforeach; ?>
    </div> 
  
    <script>
      function searchNotes() {
          let query = document.getElementById('search-box').value;
          fetch(`<?= base_url('notes/search_notes?q=') ?>${query}`)
              .then(response => response.text())
              .then(data => {
                  document.getElementById('notes-container').innerHTML = data;
              })
              .catch(error => console.error('Error fetching notes:', error));
      }
    </script>  

  <script>
      document.addEventListener('DOMContentLoaded', () => {
      const toggle = document.querySelector('#toggle-btn input');
      const gridContainer = document.getElementById('grid-view'); 
      const grid = document.getElementById('grid'); 
      const list = document.getElementById('list'); 

      toggle.addEventListener('change', function () {
        if (this.checked) {
          gridContainer.style.gridTemplateColumns = '32% 32% 32%';
          list.classList.add("text-secondary");
          grid.classList.remove("text-secondary");
        } else {
          gridContainer.style.gridTemplateColumns = '100%';
          grid.classList.add("text-secondary");
          list.classList.remove("text-secondary");
        }
      });
    });
  </script>  

  <script>
    document.addEventListener('DOMContentLoaded', function() {
    const notes = document.querySelectorAll('.note');

      notes.forEach(note => {
          note.addEventListener('click', function(event) {
              if (!event.target.closest('a') || event.target.closest('a').getAttribute('href') !== 'javascript:void(0);') {
                  const noteId = note.getAttribute('data-id');
                  window.location.href = `${baseUrl}notes/edit/${noteId}`;
              }
          });
      });
    });

    function confirmDelete(url) {

        if (confirm("Are you sure you want to delete this note?")) {
            window.location.href = url;
        } else {
            return false;
        }
    }

    const baseUrl = '<?php echo base_url(); ?>';
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <script src="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.umd.js"></script>

  <script src="<?php echo base_url(); ?>assets/js/script.js"></script>
</body>

</html>
