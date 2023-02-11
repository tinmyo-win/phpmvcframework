
<h1>
  Register
  
</h1>
<?php $form = \app\core\form\Form::begin('', 'post') ?>
<div class="row">
  <div class="col">
    <?php echo $form->field($model, 'firstname') ?>
  </div>
  <div class="col">
    <?php echo $form->field($model, 'lastname') ?>
  </div>
</div>

<?php echo $form->field($model, 'email') ?>
<?php echo $form->field($model, 'password')->passwordField() ?>
<?php echo $form->field($model, 'passwordConfirm')->passwordField() ?>
<button type="submit" class="btn btn-primary">Login</button>

<?php \app\core\form\Form::end() ?>

<!-- <form method="post">
  <div class="mb-3">
    <label class="form-label">First Name</label>
    <input type="text" name="firstname" value="< 
        class="form-control
    <div class="invalid-feedback">

    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">Last Name</label>
    <input type="text" name="lastname" class="form-control">
  </div>
  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="text" name="email" class="form-control">
  </div>
  <div class="mb-3">
    <label for="bodyText" class="form-label">Password</label>
    <input type="passwrod" name="password" class="form-control" id="password">
  </div>
  <div class="mb-3">
    <label for="bodyText" class="form-label">Password Confirm</label>
    <input type="passwrod" name="passwordConfirm" class="form-control" id="confirmPassword">
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form> -->