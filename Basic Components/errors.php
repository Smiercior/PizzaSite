<?php if(count($errors) > 0 ): ?>
    <?php foreach($errors as $error): ?>
        <span class="text-danger"> <?= $error ?> </span>
    <?php endforeach; ?>
<?php endif; ?>