  <?php //wp_footer(); ?>
  <?php

  ?>
  <?php
    $action = WWH_Dashboard_Index::get_instance()->getAction();
  ?>
  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
  <script type="text/javascript" >
    var ajax_action;
    var app;
    var wwh = {
      "ajax_url" : "<?php echo admin_url( 'admin-ajax.php' );?>"
    }
    <?php if ( $action == 'dashboard' ) : ?>
      <?php if ( WWH_User_Check::get_instance()->is_warehouse() ) : ?>
        ajax_action = 'get_dashboard_warehouse_order';
      <?php endif; ?>
      <?php if ( WWH_User_Check::get_instance()->is_admin() ) : ?>
        ajax_action = 'get_dashboard_admin_order';
      <?php endif; ?>
    <?php endif; ?>
  	jQuery(document).ready(function($) {
      function get_orders_new(ajax_action) {

          var _order_html = $('.list-order-new .table');
          var _get_orders = jQuery.ajax({
              type: "POST",
              url: wwh.ajax_url,
              data: {
                action: ajax_action,
                order_status: 'new'
              },
              async: false
          }).done( function(html) {
              _order_html.html( html );
              setTimeout( function(){
                get_orders_new(ajax_action);
              }, 10000);
          });

      }

      function get_orders_released(ajax_action) {

          var _order_html = $('.list-order-released .table');
          var _get_orders = jQuery.ajax({
              type: "POST",
              url: wwh.ajax_url,
              data: {
                action: ajax_action,
                order_status: 'released'
              },
              async: false
          }).done( function(html) {
              _order_html.html( html );
              setTimeout( function(){
                get_orders_released(ajax_action);
              }, 10000);
          });

      }

      function get_orders_working(ajax_action) {

          var _order_html = $('.list-order-working .table');
          var _get_orders = jQuery.ajax({
              type: "POST",
              url: wwh.ajax_url,
              data: {
                action: ajax_action,
                order_status: 'working'
              },
              async: false
          }).done( function(html) {
              _order_html.html( html );
              setTimeout( function(){
                get_orders_working(ajax_action);
              }, 10000);
          });

      }

      function get_orders_ready(ajax_action) {

          var _order_html = $('.list-order-done .table');
          var _get_orders = jQuery.ajax({
              type: "POST",
              url: wwh.ajax_url,
              data: {
                action: ajax_action,
                order_status: 'done'
              },
              async: false
          }).done( function(html) {
              _order_html.html( html );
              setTimeout( function(){
                get_orders_ready(ajax_action);
              }, 10000);
          });

      }

      if ( typeof ajax_action !== 'undefined' ) {
        if ( ajax_action == 'get_dashboard_admin_order' ) {
          get_orders_new(ajax_action);
          get_orders_released(ajax_action);
          get_orders_working(ajax_action);
          get_orders_ready(ajax_action);
        } else if ( ajax_action == 'get_dashboard_warehouse_order' ) {
          get_orders_released(ajax_action);
          get_orders_working(ajax_action);
        }
      }
  	});
	</script>
</body>
</html>
