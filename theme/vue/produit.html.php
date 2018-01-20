
<article>
    <a href="?page=catalogue&action=categorie&cat=<?php echo $current_products[0]['id_cat']; ?>">Retour</a>
    <header>
        <h1>
            <?php echo $current_products[0]['titre']; ?>
        </h1>

        <i>catégorie : <?php echo $current_products[0]['nom']; ?>, ajouté le <?php echo fr_date($current_products[0]['date']); ?></i><br>
<h6>
<?php foreach ($current_products as $current_product) : ?>
      <a href="?page=catalogue&action=list-tag&tag=<?php echo $current_product['id_tag'] ?>"><span class="badge badge-primary">
              <?php echo $current_product['tagname']; ?></span>
</a>
<?php endforeach ?>
</h6>
        <br>
        <?php echo add_euro($current_products[0]['prix']); ?>
    </header>

    <hr>

    <?php echo $current_products[0]['contenu']; ?>
    <br>
    <!--    <div class="thumbnail" style="height:200px;width:200px">-->
    <div class="img-fluid" style="height:200px;width:200px;">
        <?php if($current_products[0]['image']!= NULL) : ?>
            <img class="float-left" src="<?php echo IMAGE. $current_products[0]['image']; ?>" alt="<?php echo htmlspecialchars($current_products[0]['titre']);?>">
        <?php endif ?>
    </div>
    </div>


</article>