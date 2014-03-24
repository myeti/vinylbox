<header><?= $artist->fullname ?></header>

<ul id="album-list">

    <?php foreach($artist->albums() as $album): ?>

    <li>
        <img src="<?= self::asset($album->cover) ?>" />
        <h2><?= $album->title ?></h2>
        <div class="year"><?= $album->date ?></div>
    </li>

    <?php endforeach; ?>

</ul>