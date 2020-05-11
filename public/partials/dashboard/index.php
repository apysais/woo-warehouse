<?php WWH_View::get_instance()->public_partials( 'header.php' ); ?>

<div class="bootstrap-iso">

  <div class="container">
    <h1> Warehouse </h1>

    <?php WWH_View::get_instance()->public_partials( 'nav.php' ); ?>

    <?php do_action('warehouse_data'); ?>

  </div>

</div>
<?php WWH_View::get_instance()->public_partials( 'footer.php', isset($data) ? $data:[] ); ?>
