<h3><?php echo $title;?></h3>

<div class="list-order-<?php echo $order_status;?>">
  <table class="table" id="orderList">
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
        <?php foreach ( $orders as $order ) : ?>
          <?php
            $order_id = $order->get_id();
          ?>
          <tr>
            <td scope="row">
              <a  class="accordion-toggle collapsed expand-button"
                  data-toggle="collapse"
                  href="#collapseList-<?php echo $order_id;?>"
                  data-target="#collapseList-<?php echo $order_id;?>"
                  aria-expanded="true"
                  aria-controls="collapseList-<?php echo $order_id;?>" >
                  <?php echo $order_id; ?>
                  <span class="expand-button"></span>
              </a>
              <?php wwh_shipping_icon($order); ?>
              <?php wwh_important_icon($order_id); ?>
            </td>
            <td><?php echo $order->get_status(); ?></td>
            <td><?php echo $order->get_billing_first_name() .' '. $order->get_billing_last_name();?></td>
            <td><?php echo $order->get_item_count(); ?></td>
            <td>
              <?php if ( wwh_is_admin() ) : ?>
                <?php echo $order->get_formatted_order_total(); ?>
              <?php endif; ?>
            </td>
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
                  'status' => WWH_Orders_WareHouseStatus::get_instance()->get( $order_id ),
                  'woo_status' => $order->get_status()
                ];
                WWH_Orders_StatusAction::get_instance()->showClickedStatus( $status_arg );
              ?>
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
                  echo wwh_placement($placement);
                }
              ?>
            </td>
          </tr>
          <tr class="hide-table-padding">
            <td colspan="8">
              <div id="collapseList-<?php echo $order_id;?>" class="collapse" data-parentx="orderList" style="border: 2px dotted;">
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <?php WWH_Orders_Order::get_instance()->getItemsOrder($order); ?>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <?php WWH_Orders_Release::get_instance()->show(['order_id'=>$order_id]); ?>
                    <?php WWH_Orders_Release::get_instance()->showReleased(['order_id'=>$order_id]); ?>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>
