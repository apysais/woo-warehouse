<div class="jumbotron">
  <div class="release-container">
      <p>
        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
          Release
        </a>
      </p>
      <div class="collapse" id="collapseExample">
        <div class="card card-body">
          <?php WWH_StatusButtonHtml::get_instance()->releaseOrder($order_id); ?>
        </div>
      </div>
      <?php if ( wwh_is_admin() ) : ?>
        <div class="finish">
          <?php WWH_StatusButtonHtml::get_instance()->finishOrder($order_id); ?>
        </div>
      <?php endif; ?>
  </div>

</div>
