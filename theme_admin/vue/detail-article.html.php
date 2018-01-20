
<article>
    <button class="btn" onclick="location.href='?page=admin'">Retour</button>
    <button class="btn btn-default dropdown-toggle" type="button" id="action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        Actions
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="action">
        <li><a href="?page=admin&action=edit&id=<?php echo $id; ?>">Modifier</a></li>
        <li><a href="#" onClick="ConfirmMessage()" >Supprimer</a></li>
    </ul>

    <header>
        <h1>
            <?php echo  $current_article['titre']; ?>
        </h1>

        Le <?php echo fr_date_time( $current_article['date']); ?>
    </header>

    <hr>

    <?php echo  $current_article['contenu']; ?>
<br>
<!--    <div class="thumbnail" style="height:200px;width:200px">-->
        <div class="img-fluid" style="height:200px;width:200px;">
   <?php if($current_article['image']!= NULL) : ?>
        <img class="float-left" src="<?php echo IMAGE. $current_article['image']; ?>" alt="<?php echo htmlspecialchars($current_article['titre']);?>">
    <?php endif ?>
        </div>
    </div>


</article>

<script type="text/javascript">
    function ConfirmMessage() {
        if (confirm("Etes-vous sûr de vouloir supprimer cet article ?")) {
            // Clic sur OK
            document.location.href="?page=admin&action=delete&id=<?php echo $id ?>";
        } else {
            document.location.href="?page=admin&action=detail&id=<?php echo $id ?>";
        }
    }
</script>