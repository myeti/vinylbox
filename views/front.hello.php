<?php self::layout('views/layout'); ?>

<div class="overlay">
    <div class="modal"></div>
</div>

<section id="artists">

    <header>
        <a href="<?= url('/') ?>"> VinylB<i class="fa fa-play-circle"></i>x</a>
    </header>

    <ul id="artist-list">

        <?php foreach($artists as $artist): ?>
        <li data-url="<?= url('/artist', $artist->id) ?>"><?= $artist->fullname ?></li>
        <?php endforeach; ?>

    </ul>

</section>

<section id="albums" data-base="<?= url('/artist') ?>/{id}">
    <header>
        <div class="actions">
            <a data-modal href="<?= url('/artist/create') ?>"><i class="fa fa-plus"></i> ajouter artiste</a>
        </div>
    </header>
</section>

<section id="details" data-base="<?= url('/album') ?>/{id}"></section>