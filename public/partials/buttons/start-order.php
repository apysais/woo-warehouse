<form method="post" action="<?php echo home_url(WWH_PAGE_URL); ?>">
  <input type="hidden" name="wwh_action" value="start-order">
  <input type="hidden" name="order_id" value="<?php echo $order_id;?>">
  <input type="hidden" name="redirect" value="<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'dashboard';?>">
  <?php
  wp_nonce_field( WWH_Nonce_Nonces::get_instance()->setNonceField([
    'order_id'    =>  $order_id,
    'user_id'     =>  get_current_user_id(),
    'action_name' =>  'set-order-start-'
  ]), '_nonce' ); ?>
  <button type="submit" class="btn btn-primary"><?php echo $label;?></button>
</form>
