<?php require_once('includes/header.php')?>

<!-- Button trigger modal -->
<button name = "modal_new_todo" type="submit" class="btn btn-primary my-3 mx-3" data-bs-toggle="modal" data-bs-target="#myModal">
  New Todo
</button>

<!-- Modal -->
<?php new_todo(); ?>
<form id="myForm" method="post">
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input name="title_todo" type="text">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button name ="save" type="submit" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>
</div>
</form>

<?php require_once('includes/footer.php')?>
