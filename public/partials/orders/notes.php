<div class="jumbotron">
  <div class="release-notes-container">

    <h5>Notes</h5>

    <div class="row">
      <div class="col-sm-12 col-md-6">
        <h5>Internal</h5>
        <ul class="list-group list-group-flush">
        <?php if ( $notes ) : ?>
          <?php foreach( $notes as $key => $note ) : ?>
              <li class="list-group-item">
                <?php echo wpautop( wptexturize( wp_kses_post(  $note->content ) ) ); ?>
                <small  class="text-muted">
                <?php
                  echo 'Added on, ' . $note->date_created->format('F d, Y h:i A');
                ?>
                </small>
              </li>
          <?php endforeach; ?>
        <?php endif; ?>
        </ul>
      </div>
      <div class="col-sm-12 col-md-6">
        <h5>Customer</h5>
        <ul class="list-group list-group-flush">
        <?php if ( $customer_note ) : ?>
              <li class="list-group-item">
                <?php echo wpautop( wptexturize( wp_kses_post(  $customer_note ) ) ); ?>
              </li>
        <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>
</div>
