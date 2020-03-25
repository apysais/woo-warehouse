<div class="jumbotron">
  <h5>Customer info</h5>
  <div class="row">
    <div class="col-sm-12 col-md-6">
      <h5>The Payer</h5>
      <address>
        <p><?php echo $order->get_formatted_billing_address(); ?></p>
        <p>E-mailadresse : <?php echo $order->get_billing_email(); ?></p>
        <p>Telefon : <?php echo $order->get_billing_phone(); ?></p>
      </address>
    </div>
    <div class="col-sm-12 col-md-6">
      <h5>Delivery Address</h5>
      <address>
        <p><?php echo $order->get_formatted_shipping_address(); ?></p>
      </address>
    </div>
  </div>
</div>
