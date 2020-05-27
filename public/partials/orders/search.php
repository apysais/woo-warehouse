<form name="search-order" action="<?php echo home_url(WWH_PAGE_URL); ?>" method="GET" class="float-right">
  <input type="hidden" name="action" value="search-orders">
  <div class="form-row">
    <div class="col">
      <input type="text" class="form-control" name="search-orders" value="<?php echo $search_orders;?>" placeholder="Search Order" style="width:300px;">
    </div>
    <div class="col">
      <button type="submit" class="btn btn-primary">Search</button>
    </div>
  </div>
</form>
