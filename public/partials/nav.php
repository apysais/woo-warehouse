<?php
  $action = isset($_GET['action']) ? $_GET['action'] : 'dashboard';

?>
<?php if ( is_user_logged_in() ) : ?>
<nav class="navbar navbar-expand-lg navbar-dark  bg-dark ">
  <a class="navbar-brand" href="#">APP</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item <?php echo ($action == 'dashboard') ? 'active':'';?>">
        <a class="nav-link" href="<?php echo home_url( WWH_PAGE_URL . '/?action=dashboard' );?>">Dashboard <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?php echo ($action == 'orders-local') ? 'active':'';?>">
        <a class="nav-link" href="<?php echo home_url( WWH_PAGE_URL . '/?action=orders-local' );?>">Local</a>
      </li>
      <li class="nav-item <?php echo ($action == 'orders-ready') ? 'active':'';?>">
        <a class="nav-link" href="<?php echo home_url( WWH_PAGE_URL . '/?action=orders-ready' );?>">Ready</a>
      </li>
      <li class="nav-item <?php echo ($action == 'orders') ? 'active':'';?>">
        <a class="nav-link" href="<?php echo home_url( WWH_PAGE_URL . '/?action=orders' );?>">Orders</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo wp_logout_url( WWH_PAGE_URL . '/?action=dashboard' );?>">Logout</a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="?action=customers">Customers</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?action=products">Products</a>
      </li> -->
    </ul>
  </div>
</nav>
<?php endif; ?>
