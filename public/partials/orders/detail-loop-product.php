<ul class="list-unstyled" style="padding:10px;">
  <?php $num = 1; ?>
  <?php foreach ( $orders->get_items() as $item ): ?>
    <?php $formatted_meta_data = $item->get_formatted_meta_data(); ?>
    <?php //wwh_dd($formatted_meta_data); ?>
    <li><?php echo $num.' - '.$item->get_name();?></li>
    <?php if ( $formatted_meta_data ) : ?>
      <li>
        <ul class="list-unstyled">
          <small class="text-muted">Attributes</small>
          <?php foreach( $formatted_meta_data as $data) : ?>
                <div class="attribute-products-item">
                  <p><?php echo $data->display_key . ' : ' . wp_strip_all_tags($data->display_value);?></p>
                </div>
          <?php endforeach;?>
        </ul>
      </li>
    <?php endif; ?>
    <li>STK : <?php echo $item->get_quantity(); ?></li>
    <?php $num++; ?>
  <?php endforeach; ?>
</ul>
