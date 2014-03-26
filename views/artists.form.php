<header>
    <?= $artist->id ? 'Modifier ' . $artist->fullname : 'Nouvel artiste' ?>
</header>

<form action="<?= $artist->id ? url('/artist', $artist->id, 'update') : url('/artist/create') ?>" method="POST">

    <div class="line">
        Nom d'artiste : <input type="text" name="fullname" value="<?= $artist->fullname ?>" />
    </div>

    <div class="line">
        Nom : <input type="text" name="lastname" value="<?= $artist->lastname ?>" />
    </div>

    <div class="line">
        Prénom : <input type="text" name="firstname" value="<?= $artist->firstname ?>" />
    </div>

    <div class="line">
        Pays : <input type="text" name="country" value="<?= $artist->country ?>" />
    </div>

    <footer>
        <button data-modal-close type="reset">Annuler</button>
        <button type="submit">Sauvegarder</button>
    </footer>

</form>