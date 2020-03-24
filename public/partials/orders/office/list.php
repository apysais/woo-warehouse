<h3><?php echo $title;?></h3>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Status</th>
      <th scope="col">Customer</th>
      <th scope="col">Items</th>
      <th scope="col">Total</th>
      <th scope="col">Actions</th>
      <th scope="col">Colli</th>
      <th scope="col">Placement</th>
    </tr>
  </thead>
  <tbody>
    <?php if ( $orders ) : ?>
      <?php foreach ( $orders->orders as $order ) : ?>
        <?php
          $order_id = $order->get_id();
        ?>
        <tr>
          <td scope="row"><?php echo $order_id; ?></td>
          <td><?php echo $order->get_status(); ?></td>
          <td><?php echo $order->get_billing_first_name() . $order->get_billing_last_name();?></td>
          <td><?php echo $order->get_item_count(); ?></td>
          <td><?php echo $order->get_formatted_order_total(); ?></td>
          <td>
            <?php if ( WWH_User_Check::get_instance()->is_admin() ) : ?>
              <?php
                $nonce_url_args = [
                  'order_id' => $order_id,
                  'action_url' => '?action=set-order&status=released&order-id='.$order_id
                ];
                $nonce_url = WWH_Nonce_Nonces::get_instance()->setReleaseOrderNonce($nonce_url_args);
              ?>
              <a href="<?php echo $nonce_url;?>" class="btn btn-primary">Details</a>
            <?php endif; ?>
            <?php
              $status_arg = [
                'order_id' => $order_id,
                'status' => WWH_Orders_WareHouseStatus::get_instance()->get( $order_id )
              ];

            ?>
            <?php WWH_Orders_StatusAction::get_instance()->showClickedStatus( $status_arg ); ?>
          </td>
          <td>
            <?php
              echo WWH_Orders_Meta::get_instance()->colli([
                'post_id' => $order_id,
                'action' => 'r',
                'single' => true
              ]);
            ?>
          </td>
          <td>
            <?php
              $placement = WWH_Orders_Meta::get_instance()->placement([
                'post_id' => $order_id,
                'action' => 'r',
                'single' => true
              ]);
              if ( $placement ) {
                echo 'Building ' . $placement;
              }
            ?>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>
<div class="pagination">
    <?php
        wwh_bootstrap_pagination($orders);
    ?>
</div>
