<div class="release-notes-container">
  <h3>Notes</h3>
  <ul class="list-unstyled">
  <?php if ( $notes ) : ?>
    <?php foreach( $notes as $key => $note ) : ?>
        <li><?php echo wpautop( wptexturize( wp_kses_post(  $note->content ) ) ); ?></li>
    <?php endforeach; ?>
  <?php endif; ?>
  </ul>
</div>
