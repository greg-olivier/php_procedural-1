<a href="?page=catalogue">Retour</a>
<br>
<h1><?php echo $nb_items; ?> produit(s) dans la categorie <?php echo $category_products[0]['nom']; ?></h1>
<br>
<div class="card-columns">
<?php foreach ($category_products as $category_product) : ?>

            <div class="card mb-4">
                <?php if($category_product['thumbnail']!= NULL) : ?>
                    <img class="card-img-top" src="<?php echo THUMB. $category_product['thumbnail'] ?>" alt="<?php  htmlspecialchars($category_product['titre']);?>">
                <?php endif ?>
                <div class="card-body">
                    <h2 class="card-title"><?php echo $category_product['titre']; ?></h2>
                    <h5><?php echo add_euro($category_product['prix']); ?></h5>
                   <p><?php echo extr($category_product['contenu']); ?></p>
                    <a href="?page=catalogue&action=detail&id=<?php echo $category_product['id'] ?>" class="btn btn-primary">En savoir +</a>
                </div>
                <div class="card-footer text-muted">
                    Ajouté le <?php echo fr_date($category_product['date']); ?>
                </div>
            </div>

<?php endforeach ?>
</div>
