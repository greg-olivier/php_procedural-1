<div class="jumbotron text-center">


    <h1> Inscription</h1>
    <?php if (isset($erreur)):
        if ($erreur != ""): ?>
            <div class="erreur">
                <?php echo $erreur ?>
            </div>
        <?php endif; ?>
    <?php endif ?>

    <div class="form-con">
    <form method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="login" placeholder="Choisissez un login ...">
            <input type="password" class="form-control" name="pass" placeholder="... et un mot de passe">
        </div>

        <input type="hidden" name="token" value="<?php echo $token ?>">
        <button type="submit" class="btn btn-primary" name="OK" value="OK">Envoyer</button>
    </form>
    </div>

</div>

