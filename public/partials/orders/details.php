<h2>Order #<?php echo $order_id; ?></h2>

<?php
  $orders = wc_get_order( $order_id );
?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product</th>
      <th scope="col">Height</th>
      <th scope="col">Width</th>
      <th scope="col">Length</th>
      <th scope="col">STK</th>
    </tr>
  </thead>
  <tbody>
    <?php if ( $orders ) : ?>
      <?php foreach ( $orders->get_items() as $item ) : ?>
              <?php
                //$product = $item->get_product();
                //wwh_dd($item);
              ?>
              <tr>
                <th scope="row"><?php echo $item->get_product_id();?></th>
                <td>
                  <?php echo $item->get_name();?>
                  <?php
                    $formatted_meta_data = $item->get_formatted_meta_data();
                  ?>
                  <?php if ( $formatted_meta_data ) : ?>
                    <?php foreach( $formatted_meta_data as $data) : ?>
                          <td><?php echo $data->display_value;?></td>
                    <?php endforeach;?>
                  <?php else:?>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  <?php endif;?>
                </td>

              </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>

<div class="container">
  <?php WWH_Orders_Release::get_instance()->show(['order_id'=>$order_id]); ?>
  <?php WWH_Orders_Release::get_instance()->showReleased(['order_id'=>$order_id]); ?>
</div>

<div class="container">
  <?php WWH_Orders_Release::get_instance()->showNotes(['order_id'=>$order_id]); ?>
</div>

<div class="container">
  <?php WWH_Orders_CustomerInfo::get_instance()->show(); ?>
</div>
