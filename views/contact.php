<?php
  /** @var $this \app\core\View */

  $this->title = "Contact";
?>
<h1>
  Contact
</h1>
<form method="post">
  <div class="mb-3">
    <label class="form-label">Subject</label>
    <input type="text" name="subject" class="form-control">
  </div>
  <div class="mb-3">
    <label for="bodyText" class="form-label">body</label>
    <input type="text" name="body" class="form-control" id="bodyText">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>