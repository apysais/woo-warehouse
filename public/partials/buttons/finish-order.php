<form method="post" action="<?php echo home_url(WWH_PAGE_URL); ?>">
  <input type="hidden" name="wwh_action" value="finish-order">
  <input type="hidden" name="order_id" value="<?php echo $order_id;?>">
  <input type="hidden" name="redirect" value="<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'dashboard';?>">
  <?php
  wp_nonce_field( WWH_Nonce_Nonces::get_instance()->setNonceField([
    'order_id'    =>  $order_id,
    'user_id'     =>  get_current_user_id(),
    'action_name' =>  'set-finish-order-'
  ]), '_nonce' ); ?>
  <?php if ( wwh_is_warehouse() ) : ?>
    <div class="form-group">
      <label for="colli">Colli</label>
      <input type="text" class="form-control form-control-sm" id="colli" name="colli">
    </div>
    <div class="form-group">
      <label for="placement">Placement</label>
      <?php $placements = wwh_placement(); ?>
      <select name="placement" class="form-control form-control-sm" id="placement">
        <?php foreach( $placements as $k_placement => $v_placement) : ?>
            <option value="<?php echo $k_placement;?>"><?php echo $v_placement;?></option>
        <?php endforeach; ?>
        </select>
    </div>
  <?php endif; ?>
  <button type="submit" class="btn btn-primary"><?php echo $label;?></button>
</form>
