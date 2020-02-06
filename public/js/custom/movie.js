let fav_count = $('#nav__fav-count').data('fav-count');

$(document).ready(function () {
    $(document).on('click', '.movie__fav-icon', function () {

        // get the url from welcome file
        let url = $(this).data('url');
        // get the movieID to add the heart and remove it if repeated in many lists
        let movieId = $(this).data('movie-id');
        let isFavoured = $(this).hasClass('fw-900');

        toggleFavourite(url, movieId, isFavoured);
    });

    $(document).on('click', '#movie__fav-btn', function (e) {
        e.preventDefault();

        let url = $(this).find('.movie__fav-icon').data('url');
        let movieId = $(this).find('.movie__fav-icon').data('movie-id');
        let isFavoured = $(this).find('.movie__fav-icon').hasClass('fw-900');

        toggleFavourite(url, movieId, isFavoured);
    });


}); // end of document ready


function toggleFavourite(url, movieId, isFavoured)
{
    !isFavoured ? fav_count++ : fav_count--;

    fav_count > 9 ? $('#nav__fav-count').html('9+') : $('#nav__fav-count').html(fav_count);

    // if favoured add this class else remove it
    $('.movie-' + movieId).toggleClass('fw-900');

    if($('.movie-' + movieId).closest('.favourite').length) {
        console.log('here');
        $('.movie-' + movieId).closest('.movie').remove();
    }

    $.ajax({
        url: url,
        method: 'POST',
    });
}
