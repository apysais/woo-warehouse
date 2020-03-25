  <?php wp_footer(); ?>
  <?php
    $action = WWH_Dashboard_Index::get_instance()->getAction();
  ?>
  <script type="text/javascript" >
    var ajax_action;
    var app;
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

          var _order_html = $('.list-order .table');
          var _get_orders = jQuery.ajax({
              type: "POST",
              url: wwh.ajax_url,
              data: { action: ajax_action },
              async: false
          }).done( function(html) {
              _order_html.html( html );
              setTimeout( function(){
                get_orders_new(ajax_action);
              }, 10000);
          });

      }

      function get_orders_released(ajax_action) {

          var _order_html = $('.list-order .table');
          var _get_orders = jQuery.ajax({
              type: "POST",
              url: wwh.ajax_url,
              data: { action: ajax_action },
              async: false
          }).done( function(html) {
              _order_html.html( html );
              setTimeout( function(){
                get_orders_released(ajax_action);
              }, 10000);
          });

      }
      if ( typeof ajax_action !== 'undefined' ) {
        if ( ajax_action == 'get_dashboard_admin_order' ) {
          get_orders_new(ajax_action);
        } else if ( ajax_action == 'get_dashboard_warehouse_order' ) {
          get_orders_released(ajax_action);
        }
      }
  	});
	</script>
</body>
</html>
