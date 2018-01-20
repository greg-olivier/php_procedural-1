
<div class="container-fluid">
    <br>
    <br>
    <?php if (isset($erreur)):
        if ($erreur != ""): ?>
            <div class="erreur">
                <?php echo $erreur ?>
            </div>
        <?php endif; ?>
    <?php endif ?>
    <br>
    <h1>Bonjour <?php echo $_SESSION['login']?></h1>
</div>
<br>
<br>
<h4>Restez informé et consultez nos derniers articles</h4>
<hr>
<div class="row">
<div class="card-deck">
    <?php foreach ($last_articles as $last_article) : ?>
    <div class="col-sm-4">
        <article>
            <div class="card">
                <?php if($last_article['thumbnail']!= NULL) : ?>
                    <img class="card-img-top" src="<?php echo THUMB. $last_article['thumbnail'] ?>" alt="<?php  htmlspecialchars($last_article['titre']);?>">
                <?php endif ?>
            </div>
            <div class="card-block">
                <h2 class="card-title"><?php echo $last_article['titre']; ?></h2>
                <p><?php echo extr($last_article['contenu']); ?></p>
                <a href="?page=magazine&action=detail&id=<?php echo $last_article['id'] ?>" class="btn btn-primary">En savoir +</a>
            </div>
            <div class="card-footer text-muted">
                Ajouté le <?php echo fr_date($last_article['date']); ?>
            </div>
        </article>
    </div>
    <?php endforeach ?>
    </div>
</div>
<br>
<br>
<h4>Découvrez nos nouveaux produits</h4>
<hr>
<div class="row">
<div class="card-deck">
    <?php foreach ($new_pdts as $new_pdt) : ?>
    <div class="col-sm-4">
        <article>
            <div class="card">
                <?php if($new_pdt['thumbnail']!= NULL) : ?>
                    <img class="card-img-top" src="<?php echo THUMB.  $new_pdt['thumbnail'] ?>" alt="<?php  htmlspecialchars( $new_pdt['titre']);?>">
                <?php endif ?>
            </div>
            <div class="card-block">
                <h2 class="card-title"><?php echo  $new_pdt['titre']; ?></h2>
                <h5><?php echo add_euro($new_pdt['prix']); ?></h5>
                <p><?php echo extr( $new_pdt['contenu']); ?></p>
                <a href="?page=magazine&action=detail&id=<?php echo  $new_pdt['id'] ?>" class="btn btn-primary">En savoir +</a>
            </div>
            <div class="card-footer text-muted">
                Ajouté le <?php echo fr_date( $new_pdt['date']); ?>
            </div>
        </article>
    </div>
    <?php endforeach ?>
</div>
</div>



