<h2><?php echo $nb_items; ?> produits disponibles</h2>
<br>
<a href="?page=catalogue">Retour</a>
<br>
<div class="card-columns">
    <?php foreach ($all_products as $all_product) : ?>

        <div class="card mb-4">
            <?php if($all_product['thumbnail']!= NULL) : ?>
                <img class="card-img-top" src="<?php echo THUMB. $all_product['thumbnail'] ?>" alt="<?php  htmlspecialchars($all_product['titre']);?>">
            <?php endif ?>
            <div class="card-body">
                <h2 class="card-title"><?php echo $all_product['titre']; ?></h2>
                <h5><?php echo add_euro($all_product['prix']); ?></h5>
                <p><?php echo extr($all_product['contenu']); ?></p>
                <a href="?page=catalogue&action=detail&id=<?php echo $all_product['id'] ?>" class="btn btn-primary">En savoir +</a>
            </div>
            <div class="card-footer text-muted">
                Ajouté le <?php echo fr_date($all_product['date']); ?>
            </div>
        </div>

        <hr/>
    <?php endforeach ?>
</div>