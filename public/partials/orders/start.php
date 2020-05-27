<div class="jumbotron">
  <div class="release-container">
    <div class="row">
      <?php $status = WWH_Orders_WareHouseStatus::get_instance()->get($order_id);?>

      <?php if ( isset($_GET['action']) && sanitize_text_field($_GET['action']) == 'set-order' ) : ?>
        <div class="col-sm-6 col-md-2">
          <a class="btn btn-primary" href="<?php echo home_url(WWH_PAGE_URL . '/?action=dashboard');?>" role="button">
            Back
          </a>
        </div>
      <?php endif; ?>

      <?php if ( $status == 'released' ) : ?>
        <div class="col-sm-6 col-md-2">
          <?php WWH_StatusButtonHtml::get_instance()->startOrder($order_id); ?>
        </div>
      <?php endif; ?>

      <?php if ( $status == 'working' || wwh_is_admin() ) : ?>
        <div class="col-sm-6 col-md-8">
          <p>
            <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
              Finish Order
            </a>
          </p>
          <div class="collapse" id="collapseExample">
            <div class="card card-body">
              <?php WWH_StatusButtonHtml::get_instance()->finishOrder($order_id); ?>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
