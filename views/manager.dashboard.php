<?php self::layout('views/layout'); ?>

<section id="artists">

    <header>
        Vinyle<strong>Box</strong>
    </header>

    <ul id="artist-list">

        <?php foreach($artists as $artist): ?>
        <li>
            <a href="#">
                <?= $artist->fullname ?> <aside><i class="fa fa-gear"></i></aside>
            </a>
        </li>
        <?php endforeach; ?>

    </ul>

</section>

<section id="albums"></section>

<section id="details"></section>