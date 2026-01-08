<?php
require_once('../template/header.php');

?>
<div class="row justify-content-center">
  <div class="col-md-4">

    <form action="admin_verify.php" method="POST">

      <div class="mb-3">
        <label>Email address</label>
        <input type="email" name="email" class="form-control">
      </div>

      <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control">
      </div>

      <button type="submit" name="submit" class="btn btn-primary">Login</button>

    </form>

  </div>
</div>
