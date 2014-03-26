<header>
    <?= $album->title ?>
    <div class="actions">
        <a href="<?= url('/album', $album->id, 'update') ?>" data-modal><i class="fa fa-gear"></i></a>
        <a href="<?= url('/album', $album->id, 'delete') ?>" data-confirm="Etes-vous sûr de vouloir supprimer cet album ?"><i class="fa fa-times"></i></a>
    </div>
</header>

<div class="infos">

    <?php if($album->cover): ?>
    <img src="<?= self::asset($album->cover) ?>" />
    <?php endif; ?>

    <div class="line">
        <span class="label">Genre :</span> <?= $album->genre ?>
    </div>
    <div class="line">
        <span class="label">Date :</span> <?= $album->date ?>
    </div>
</div>

<ul class="sides">

    <?php foreach($album->tracks() as $side => $tracks): ?>

    <li>
        <h3>Side <?= $side ?></h3>
        <ol class="tracks">

            <?php foreach($tracks as $track): ?>
            <li><aside><?= $track->duration ?></aside> <?= $track->title ?></li>
            <?php endforeach; ?>

        </ol>
    </li>

    <?php endforeach; ?>

</ul>