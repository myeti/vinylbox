$(document).ready(function(){

    /**
     * Components
     */
    var albumsPanel = $('section#albums');
    var detailsPanel = $('section#details');
    var overlay = $('.overlay');
    var modal = $('.modal');

    /**
     * Open album list
     */
    $('#artist-list').on('click', 'li', function(){
        var url = $(this).data('url');
        albumsPanel.load(url);
    });

    /**
     * Open details
     */
    $('#albums').on('click', '#album-list li', function(){
        var url = $(this).data('url');
        detailsPanel.load(url);
    });

    /**
     * Auto open
     */
    var hash = window.location.hash.substr(2);
    hash = hash.split('/');

    if(hash[0]) {
        var albums_url = albumsPanel.data('base').replace('{id}', hash[0]);
        albumsPanel.load(albums_url);
    }

    if(hash[1]) {
        var details_url = detailsPanel.data('base').replace('{id}', hash[1]);
        detailsPanel.load(details_url);
    }

    /**
     * Manage modal
     */
    $('section').on('click', 'a[data-modal]', function(e){

        // get url
        var url = $(this).attr('href');

        // load content
        modal.load(url, function(){
            overlay.fadeIn(300);
        });

        e.preventDefault();
        return false;
    });

    modal.on('click', 'button[data-modal-close]', function(){
        overlay.fadeOut(300, function(){
            modal.empty();
        });
    });


    /**
     * Confirm delete
     */
    $(document).on('click', 'a[data-confirm]', function(e){
        return confirm($(this).data('confirm'));
    });

});