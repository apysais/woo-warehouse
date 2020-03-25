<div class="jumbotron">
  <div class="release-container">
      <p>
        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
          Release
        </a>
      </p>
      <div class="collapse" id="collapseExample">
        <div class="card card-body">
          <form method="post" action="<?php echo get_home_url(); ?>">
            <input type="hidden" name="wwh_action" value="release-order">
            <input type="hidden" name="order_id" value="<?php echo $order_id;?>">
            <?php wp_nonce_field( WWH_Nonce_Nonces::get_instance()->setNonceField(['order_id'=>$order_id]), '_nonce' ); ?>
            <div class="form-group">
              <label for="messageTextArea">Comment to Warehouse</label>
              <textarea class="form-control" id="messageTextArea" name="messageTextArea" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Release Now</button>
          </form>
        </div>
      </div>
  </div>
</div>
