<header>
    <?= $artist->fullname ?>
    <div class="actions">
        <a href="<?= url('/artist', $artist->id, 'update') ?>" data-modal><i class="fa fa-gear"></i></a>
        <a href="<?= url('/artist', $artist->id, 'delete') ?>" data-confirm="Etes-vous sûr de vouloir supprimer cet artiste ?"><i class="fa fa-times"></i></a>
    </div>
</header>

<ul id="album-list">

    <?php foreach($artist->albums() as $album): ?>

    <li data-url="<?= url('/album', $album->id) ?>">
        <img src="<?= self::asset($album->cover ?: 'public/img/no-cover.jpg') ?>" />
        <h2><?= $album->title ?></h2>
        <div class="year"><?= $album->date ?></div>
    </li>

    <?php endforeach; ?>

    <a href="<?= url('/album/create', $artist->id) ?>"  data-modal>
        <div class="add">
            <i class="fa fa-plus"></i>
        </div>
        <h2>Ajouter un album</h2>
    </a>

</ul>