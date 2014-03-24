<header><?= $album->title ?></header>

<div class="infos">
    <img src="<?= self::asset($album->cover) ?>" />
    <div class="line"><?= $album->genre ?></div>
    <div class="line"><?= $album->date ?></div>
</div>

<ul class="sides">

    <?php foreach($album->tracks as $side => $tracks): ?>

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