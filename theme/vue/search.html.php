<?php if (isset($erreur)) : ?>
            <?php echo $erreur; ?>
<?php else : ?>

    <h2><?php echo $results_search[1]['nb']; ?> résultat(s) correspondant à la recherche
        "<?php echo $results_search[1]['search']; ?>"</h2>
    <br>
        <div class="card-columns">
            <?php foreach ($results_search[0] as $result_search) : ?>
            <?php if (isset($result_search['tart'])) : ?>
                <a href="?page=magazine&action=detail&id=<?php echo $result_search['id'] ?>">
                    <div class="card mb-4">
                        <?php if (($result_search['image'] != NULL)) : ?>
                            <img class="card-img-top" src="<?php echo THUMB . ($result_search['thumbnail']); ?>"
                                 alt="<?php htmlspecialchars(($result_search['tart'])); ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <p>#magazine</p>
                            <h2 class="card-title"><?php echo $result_search['tart']; ?></h2>
                            <p><?php echo extr(($result_search['contenu'])); ?></p>
                            <a href="?page=magazine&action=detail&id=<?php echo($result_search['id']); ?>"
                               class="btn btn-primary">En savoir +</a>
                        </div>
                        <div class="card-footer text-muted">
                            Ajouté le <?php echo fr_date(($result_search['date'])); ?>
                        </div>
                    </div>
                </a>
                <?php elseif (isset($result_search['tpr'])): ?>
                <a href="?page=catalogue&action=detail&id=<?php echo $result_search['id'] ?>">
                    <div class="card mb-4">
                        <?php if (($result_search['thumbnail'] != NULL)) : ?>
                            <img class="card-img-top" src="<?php echo THUMB . ($result_search['thumbnail']); ?>"
                                 alt="<?php htmlspecialchars(($result_search['tpr'])); ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <p>#catalogue</p>
                            <h2 class="card-title"><?php echo $result_search['tpr']; ?></h2>
                            <p><?php echo extr(($result_search['contenu'])); ?></p>
                            <a href="?page=catalogue&action=detail&id=<?php echo($result_search['id']); ?>"
                               class="btn btn-primary">En savoir +</a>
                        </div>
                        <div class="card-footer text-muted">
                            Ajouté le <?php echo fr_date(($result_search['date'])); ?>
                        </div>
                    </div>
                </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>


