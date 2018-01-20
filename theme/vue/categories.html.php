<h1>Catégories</h1>
<br>
<a href="?page=catalogue&action=allproducts">Liste de tous les produits</a>
<br>
<br>
<?php foreach ($all_categories as $all_category) :
    if ($all_category['nb']===0) : continue; else : ?>
        <a href="?page=catalogue&action=categorie&cat=<?php echo $all_category['id_cat'] ?>">
                <h3>
                    <?php echo $all_category['titre']; ?>
                </h3>
            <p>Nombre de produits :<?php echo $all_category['nb']; ?></p>
        </a>
    <?php endif; ?>
    <br/>
<?php endforeach ?>