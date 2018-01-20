
<article>
    <a href="?page=magazine">Retour</a>
    <header>
        <h1>
            <?php echo $current_article['titre']; ?>
        </h1>

        Le <?php echo fr_date_time($current_article['date']); ?>, par <?php echo $current_article['login_auteur']; ?>
    </header>

    <hr>

    <?php echo $current_article['contenu']; ?>
<br>
<!--    <div class="thumbnail" style="height:200px;width:200px">-->
        <div class="img-fluid" style="height:200px;width:200px;">
   <?php if($current_article['image']!= NULL) : ?>
        <img class="float-left" src="<?php echo IMAGE. $current_article['image']; ?>" alt="<?php echo htmlspecialchars($current_article['titre']);?>">
    <?php endif ?>
        </div>
    </div>


</article>