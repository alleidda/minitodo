<?php

require_once('includes/header.php');

?>

<div class="container">
  <form action="" method="post">
 <?php actions(); ?>
<table class="table table-light table-hover">
    <thead>            
<?php save(); ?>
</tbody>
</table>
<form id="myForm" method="post">
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <input name="task" type="text">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button name ="save" type="submit" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
        </div>
        </div>
        </form>
</form>

<!-- Button trigger modal -->
<button name = "show_modal" type="submit" class="btn btn-primary mx-4 mb-4" data-bs-toggle="modal" data-bs-target="#myModal">
  Add New Task
</button>

<!-- Modal -->
<?php /* save(); */ ?>
<form id="myForm" method="post">
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Task</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input name="task" type="text">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button name ="save" type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
</div>
</form>


<a class="mx-4 mt-4" href="index.php">Back</a>

</div>
<?php
require_once('includes/footer.php');
?>