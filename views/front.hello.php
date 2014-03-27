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
        Collection de <?= OWNER ?>
    </header>

    <div id="hello">

        <h2>Actuellement dans votre collection :</h2>
        <ul>
            <li><?= $c_artists ?> artiste(s)</li>
            <li><?= $c_albums ?> album(s)</li>
            <li><?= $c_tracks ?> piste(s)</li>
        </ul>

        <a href="<?= url('/artist/create') ?>" data-modal><i class="fa fa-plus"></i> Ajouter un artiste</a>
        
    </div>

</section>

<section id="details" data-base="<?= url('/album') ?>/{id}"></section>