<header>
    <?= $album->id ? 'Modifier ' . $album->title : 'Nouvel album' ?>
</header>

<form action="<?= $album->id ? url('/album', $album->id, 'update') : url('/album/create', $album->artist_id) ?>" method="post" id="album-form" enctype="multipart/form-data">

    <div class="line">
        Titre : <input type="text" name="title" value="<?= $album->title ?>" />
    </div>

    <div class="line">
        Date : <input type="text" name="date" value="<?= $album->date ?>" />
    </div>

    <div class="line">
        Genre : <input type="text" name="genre" value="<?= $album->genre ?>" />
    </div>

    <div class="line">
        Cover (upload) : <input type="file" name="cover_upload"/>
    </div>

    <div class="line">
        Cover (url) : <input type="text" name="cover_url" />
    </div>

    <div class="line">
        Autres informations :
        <textarea name="infos"><?= $album->infos ?></textarea>
    </div>

    <div class="sides">

        <?php $i = 0; foreach($tracklist as $side => $tracks): ?>
        <div class="line side" data-i="<?= $i ?>">
            <div class="sidelist">
                <a class="add" href="#"><i class="fa fa-plus"></i></a>
            </div>
            Side <input type="text" class="short" name="sides[<?= $i ?>][name]" value="<?= $side ?>" /> :
            <textarea name="sides[<?= $i++ ?>][tracks]" placeholder="Titre de la piste (3:10)"><?php foreach($tracks as $track) { echo $track->title, ' (', $track->duration, ')', "\n"; } ?></textarea>
        </div>
        <?php endforeach; ?>

    </div>

    <input type="hidden" name="artist_id" value="<?= $album->artist_id ?>"/>

    <footer>
        <button data-modal-close type="reset">Annuler</button>
        <button type="submit">Sauvegarder</button>
    </footer>

</form>

<script>
$(document).ready(function(){

    var labels = ['A1', 'A2', 'B1', 'B2', 'C1', 'C2', 'D1', 'D2', 'E1', 'E2', 'F1', 'F2', 'G1', 'G2', 'H1', 'H2',
                  'I1', 'I2', 'J1', 'J2', 'K1', 'K2', 'L1', 'L2', 'M1', 'M2', 'N1', 'N2', 'O1', 'O2', 'P1', 'P2'];

    var sample = '' +
        '<div class="line side" data-i="{i}">' +
        '   <div class="sidelist">' +
        '       <a class="remove" href="#"><i class="fa fa-minus"></i></a>' +
        '       <a class="add" href="#"><i class="fa fa-plus"></i></a>' +
        '   </div>' +
        '   Side <input type="text" class="short" name="sides[{i}][name]" value="{side}" /> :' +
        '   <textarea name="sides[{i}][tracks]" placeholder="Titre de la piste (3:10)"></textarea>' +
        '</div>';


    // add
    $('#album-form .sides').on('click', '.add', function(e){

        // get data
        var i = $('#album-form .sides .side').last().data('i') + 1;
        console.log(i);

        // append
        var html = sample.replace('{i}', i);
        html = html.replace('{side}', labels[i]);
        $('#album-form .sides').append(html);

        e.preventDefault();
        return false;
    })
    // remove
    .on('click', '.remove', function(e){
        $(this).parent().parent().remove();
        e.preventDefault();
        return false;
    });

});
</script>