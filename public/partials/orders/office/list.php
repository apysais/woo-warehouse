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
          <td>Action</td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>
