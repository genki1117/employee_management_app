<?php if ($message = get_message()) { ?>
    <div class="alert alert-primary" role="alert">
        <?= h($message); ?>
    </div>
<?php } ?>