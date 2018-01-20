<?php if (isset($erreur)):
    if ($erreur != ""): ?>
        <div class="alert alert-danger">
            <?php echo $erreur ?>
        </div>
    <?php else : ?>
        <div class="alert alert-info">
            <p>Formulaire enregistré</p>
        </div>
    <?php endif; ?>

<?php endif ?>

<form method="post">
    <div class="radio-inline">
        <div class="radio-inline">
            <label>
                <input type="radio" class="form-control" name="civil" value="mr">Mr</label>
            <label>
                <input type="radio" class="form-control" name="civil" value="mme">Mme</label>
        </div>
    </div>

    <div class="form-group">
        <label for="nom">Votre nom</label>
        <input type="text" class="form-control" name="nom" placeholder="Entrez votre nom">
        <label for="email">Votre email</label>
        <input type="email" class="form-control" name="email" placeholder="Entrez votre email">
    </div>
    <div class="form-group">
        <label for="objet">Objet :</label>
        <SELECT name="objet" class="form-control" size="1">
            <OPTION>
            <OPTION>Réclamation
            <OPTION>Support technique
            <OPTION>Autres
        </SELECT>
    </div>
    <div class="form-group">
        <label for="message">Message :</label>
        <textarea type="text" class="form-control" rows="5" name="message"></textarea>
    </div>
    <div class="form-group">
        Centres d'intérêt :
        <div class="checkbox-inline">
            <label><input type="checkbox" name="interest-sport" value="sport"> Sport</label>
        </div>
        <div class="checkbox-inline">
            <label><input type="checkbox" name="interest-music" value="musique"> Musique</label>
        </div>
        <div class="checkbox-inline">
            <label><input type="checkbox" name="interest-info" value="informatique"> Informatique</label>
        </div>
    </div>
    <button type="reset" class="btn btn-default">Reset</button>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>