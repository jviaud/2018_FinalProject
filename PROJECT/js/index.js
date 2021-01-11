$('document').ready(function(e) {
    var query = window.location.href;
    var vars = query.split("#");
    if (vars[1] == 'registerForm') {
        event.preventDefault();
        $('#registerAnchor').click();
    }
});
$('.tab a').on('click', function(e) {
    e.preventDefault();
    $(this).parent().addClass('active');
    $(this).parent().siblings().removeClass('active');
    var target = $(this).attr('href');
    $('#tab-content > div').not(target).hide();
    $(target).show();

});
