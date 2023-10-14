/* javascriptのコードを記載 */
$(function() {
    $('.hamburger').click(function() {
        $(this).toggleClass('active');
 
        if ($(this).hasClass('active')) {
            $('.global-nav').addClass('active');
            $('.global-nav-bg').addClass('active');
        } else {
            $('.global-nav').removeClass('active');
            $('.global-nav-bg').removeClass('active');
        }
    });

    $('.global-nav-bg').click(function() {
        $(this).removeClass('active');
        $('.hamburger').removeClass('active');
        $('.global-nav').removeClass('active');
    });
});