<h1>Bienvenue sur le site</h1>
<br>
<div class="row">
    <div class="card-deck">
        <?php foreach ($last_articles as $last_article) : ?>
            <div class="col-sm-4">
                <article>
                    <div class="card">
                        <?php if ($last_article['thumbnail'] != NULL) : ?>
                            <img class="card-img-top" src="<?php echo THUMB . $last_article['thumbnail'] ?>"
                                 alt="<?php htmlspecialchars($last_article['titre']); ?>">
                        <?php endif ?>
                    </div>
                    <div class="card-block">
                        <h2 class="card-title"><?php echo $last_article['titre']; ?></h2>
                        <p class="card-text"><?php echo extr($last_article['contenu']); ?></p>
                        <a href="?page=magazine&action=detail&id=<?php echo $last_article['id'] ?>"
                           class="btn btn-primary">En savoir +</a>
                    </div>
                    <div class="card-footer text-muted">
                        Ajouté le <?php echo fr_date($last_article['date']); ?>,
                        par <?php echo $last_article['login_auteur']; ?>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="pagination">
<nav>
        <ul class="pagination">
    <?php for ($i = 1; $i <= $nombreDePages; $i++) :
        if ($i == $pageActuelle) :?>
            <li class="page-item active"><a class="page-link" href="#"><?php echo $i ?><span class="sr-only">(current)</span></a></li>
        <?php else: ?>
            <li class="page-item"><?php echo ' <a class="page-link" href="?page=accueil&p=' . $i . '">' . $i . '</a> '; ?></li>
     <?php endif ?>
    <?php endfor ?>
        </ul>
</nav>
</div>
