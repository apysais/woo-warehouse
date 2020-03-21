<h3><?php echo $title;?></h3>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Status</th>
      <th scope="col">Customer ID</th>
      <th scope="col">Items</th>
      <th scope="col">Total</th>
      <th scope="col">Actions</th>
      <th scope="col">Colli</th>
      <th scope="col">Placement</th>
    </tr>
  </thead>
  <tbody>
    <?php if ( $orders ) : ?>
      <?php foreach ( $orders as $order ) : ?>
        <tr>
          <td scope="row"><?php echo $order->get_id(); ?></td>
          <td><?php echo $order->get_status(); ?></td>
          <td><?php echo $order->get_customer_id(); ?></td>
          <td><?php echo $order->get_item_count(); ?></td>
          <td><?php echo $order->get_formatted_order_total(); ?></td>
          <td>
            <a href="#" class="btn btn-primary">Details</a>
            <?php
              $status_arg = [
                'status' => WWH_Orders_WareHouseStatus::get_instance()->get( $order->get_id() )
              ];
              WWH_Orders_StatusAction::get_instance()->show($status_arg);
            ?>
          </td>
          <td>Colli</td>
          <td>Placement</td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>
