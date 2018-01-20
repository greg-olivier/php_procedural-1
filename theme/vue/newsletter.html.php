<?php if (isset($erreur)):
    if ($erreur != ""): ?>
        <div class="alert alert-danger">
            <?php echo $erreur ?>
        </div>
    <?php else : ?>
        <div class="alert alert-info">
            <p>Votre email a bien été enregistré</p>
        </div>
    <?php endif; ?>

<?php endif ?>