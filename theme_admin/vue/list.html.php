<a class="btn btn-primary" href="?page=admin&action=add">Ajouter un article</a>
<br>
<br>
<h2>Vous avez <?php echo $nb_items_nopub; ?> article(s) non  publié(s)</h2>
<br>
<div class="card-columns">
<?php foreach ($all_articles_nopub as $all_article_nopub) : ?>
    <a href="?page=admin&action=detail&id=<?php echo $all_article_nopub['id'] ?>">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title"><?php echo $all_article_nopub['titre']; ?></h2>
                   <p><?php echo extr($all_article_nopub['contenu']); ?></p>
                </div>
            </div>
    </a>
<?php endforeach ?>
</div>
<br>
<br>
<h2>Vous avez <?php echo $nb_items_pub; ?> article(s) publié(s)</h2>
<hr>
<div class="card-columns">
    <?php foreach ($all_articles_pub as $all_article_pub) : ?>
        <a href="?page=admin&action=detail&id=<?php echo $all_article_pub['id'] ?>">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title"><?php echo $all_article_pub['titre']; ?></h2>
                    <p><?php echo extr($all_article_pub['contenu']); ?></p>
                </div>
            </div>
        </a>
    <?php endforeach ?>
</div>
