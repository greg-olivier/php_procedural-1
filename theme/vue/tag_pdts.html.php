<a href="?page=catalogue">Retour</a>
<br>
<h1>#tag :  <?php echo $tag_pdts[0]['nom']; ?></h1>
<br>

<div class="card-columns">
    <?php foreach ($tag_pdts as $tag_pdt) : ?>
<article>
        <div class="card mb-4">
            <?php if($tag_pdt['thumbnail']!= NULL) : ?>
                <img class="card-img-top" src="<?php echo THUMB. $tag_pdt['thumbnail'] ?>" alt="<?php  htmlspecialchars($tag_pdt['titre']);?>">
            <?php endif ?>
            <div class="card-body">
                <h2 class="card-title"><?php echo $tag_pdt['titre']; ?></h2>
                <h5><?php echo add_euro($tag_pdt['prix']); ?></h5>
                <p><?php echo extr($tag_pdt['contenu']); ?></p>
                <a href="?page=catalogue&action=detail&id=<?php echo $tag_pdt['id'] ?>" class="btn btn-primary">En savoir +</a>
            </div>
            <div class="card-footer text-muted">
                Ajouté le <?php echo fr_date($tag_pdt['date']); ?>
            </div>
        </div>
    </article>
        <hr/>
    <?php endforeach ?>
</div>
