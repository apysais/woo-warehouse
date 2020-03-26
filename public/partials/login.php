<div class="login-container">
  <form name="loginform" id="loginform" action="<?php echo wp_login_url($redirect);?>" method="post">
    <div class="form-group row">
      <label for="user_login" class="col-sm-2 col-form-label">Username</label>
      <div class="col-sm-10">
    		<input type="text" name="log" id="user_login" class="form-control input" value="" size="20">
      </div>
    </div>

    <div class="form-group row">
      <label for="user_pass" class="col-sm-2 col-form-label">Password</label>
      <div class="col-sm-10">
        <input type="password" name="pwd" id="user_pass" class="input form-control" value="" size="20">
      </div>
    </div>

    <div class="form-group row">
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" name="rememberme" type="checkbox" id="rememberme" value="forever">
          <label class="form-check-label" for="gridCheck1">
            Remember Me
          </label>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-10">
        <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-primary button button-primary" value="Log In">
        <input type="hidden" name="redirect_to" value="<?php echo home_url('warehouse/?action=dashboard');?>">
      </div>
    </div>
  </form>
</div>
