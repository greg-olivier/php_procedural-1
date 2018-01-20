<h1>Magazine de batman</h1>
<br>
<div class="row">
<div class="card-group">
<?php foreach ($last_articles as $last_article) : ?>
    <div class="col-sm-4">
<article>
    <div class="card mb-4">
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
