<?php WWH_View::get_instance()->public_partials( 'header.php' ); ?>

<div class="bootstrap-iso">

  <div class="container">
    <h1> Warehouse </h1>

    <?php WWH_View::get_instance()->public_partials( 'nav.php' ); ?>

    <?php if ( is_user_logged_in() ) : ?>
      <div class="container" id="search-container">
        <?php WWH_Orders_Search::get_instance()->show(); ?>
      </div>
    <?php endif; ?>

    <?php do_action('warehouse_data'); ?>

  </div>

</div>
<?php WWH_View::get_instance()->public_partials( 'footer.php', isset($data) ? $data:[] ); ?>
