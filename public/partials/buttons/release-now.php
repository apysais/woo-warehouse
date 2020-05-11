<form method="post" action="<?php echo home_url(WWH_PAGE_URL); ?>">
  <input type="hidden" name="wwh_action" value="release-order">
  <input type="hidden" name="order_id" value="<?php echo $order_id;?>">
  <input type="hidden" name="redirect" value="<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'dashboard';?>">
  <?php wp_nonce_field( WWH_Nonce_Nonces::get_instance()->setNonceField(['order_id'=>$order_id]), '_nonce' ); ?>
  <div class="form-group">
    <label for="messageTextArea">Comment to Warehouse</label>
    <textarea class="form-control" id="messageTextArea" name="messageTextArea" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="importantCheckbox">Important</label>
    <input type="checkbox" id="importantCheckbox" name="importantCheckbox" value="1">
  </div>
  <button type="submit" class="btn btn-primary"><?php echo $label;?></button>
</form>
