<?php if ( $this->Session->check( 'Message.error' ) ): ?>
<?php
    $message = $this->Session->read( 'Message.error' );
    $this->Session->del( 'error' );
?>
    <div class="alert-message error">
      <a class="close" href="#">×</a>
      <p><?php echo $message['message'] ?></p>
    </div>
<?php endif; ?>
<?php if ( $this->Session->check( 'Message.success' ) ): ?>
<?php
    $message = $this->Session->read( 'Message.success' );
    $this->Session->del( 'success' );
?>
    <div class="alert-message success">
      <a class="close" href="#">×</a>
      <p><?php echo $message['message'] ?></p>
    </div>
<?php endif; ?>
<?php if ( $this->Session->check( 'Message.warning' ) ): ?>
<?php
    $message = $this->Session->read( 'Message.warning' );
    $this->Session->del( 'warning' );
?>
    <div class="alert-message warning">
      <a class="close" href="#">×</a>
      <p><?php echo $message['message'] ?></p>
    </div>
<?php endif; ?>
<?php if ( $this->Session->check( 'Message.info' ) ): ?>
<?php
    $message = $this->Session->read( 'Message.info' );
    $this->Session->del( 'info' );
?>
    <div class="alert-message info">
      <a class="close" href="#">×</a>
      <p><?php echo $message['message'] ?></p>
    </div>
<?php endif; ?>
