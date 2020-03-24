<div class="release-container">

  <div class="row">
    <?php $staus = WWH_Orders_WareHouseStatus::get_instance()->get($order_id);?>
    <?php if ( $staus == 'released' ) : ?>
      <div class="col-sm-6 col-md-2">
        <form method="post" action="<?php echo get_home_url(); ?>">
          <input type="hidden" name="wwh_action" value="start-order">
          <input type="hidden" name="order_id" value="<?php echo $order_id;?>">
          <?php
          wp_nonce_field( WWH_Nonce_Nonces::get_instance()->setNonceField([
            'order_id'    =>  $order_id,
            'user_id'     =>  get_current_user_id(),
            'action_name' =>  'set-order-start-'
          ]), '_nonce' ); ?>
          <button type="submit" class="btn btn-primary">Start Order</button>
        </form>
      </div>
    <?php endif; ?>

    <div class="col-sm-6 col-md-2">
      <a class="btn btn-primary" href="<?php echo home_url(WWH_PAGE_URL . '/?action=dashboard');?>" role="button">
        Back
      </a>
    </div>

    <?php if ( $staus == 'working' ) : ?>
      <div class="col-sm-6 col-md-8">
        <p>
          <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Finish Order
          </a>
        </p>
        <div class="collapse" id="collapseExample">
          <div class="card card-body">
            <form method="post" action="<?php echo get_home_url(); ?>">
              <input type="hidden" name="wwh_action" value="finish-order">
              <input type="hidden" name="order_id" value="<?php echo $order_id;?>">
              <?php
              wp_nonce_field( WWH_Nonce_Nonces::get_instance()->setNonceField([
                'order_id'    =>  $order_id,
                'user_id'     =>  get_current_user_id(),
                'action_name' =>  'set-finish-order-'
              ]), '_nonce' ); ?>
              <div class="form-group">
                <label for="colli">Colli</label>
                <input type="text" class="form-control form-control-sm" id="colli" name="colli">
              </div>
              <div class="form-group">
                <label for="placement">Colli</label>
                <select name="placement" class="form-control form-control-sm" id="placement">
                  <option value="1">Building 1</option>
                  <option value="2">Building 2</option>
                  <option value="3">Building 3</option>
                  <option value="4">Building 4</option>
                  <option value="5">Building 5</option>
                  <option value="6">Building 6</option>
                  <option value="7">Building 7</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Release Now</button>
            </form>
          </div>
        </div>
      </div>
    <?php endif; ?>

  </div>


</div>
