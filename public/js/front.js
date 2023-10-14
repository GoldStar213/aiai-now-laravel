/* javascriptのコードを記載 */
$(function() {
    $('#shl-search-form-category-select').on('change', function() {
        var selected_txt = $('#shl-search-form-category-select option:selected').text();
        $(this).parent().find('.shl-search-form-category-ttl').text(selected_txt);
    });

    $('.btn-login').on('click', function() {
        $('#login-modal').fadeIn(300);
    });

    $('#login-modal-box-close').on('click', function() {
        $('#login-modal').fadeOut(100);
    });

    $('.btn-contact').on('click', function() {
        $('#contact-modal').fadeIn(300);
    });

    $('#contact-modal-box-close').on('click', function() {
        $('#contact-modal').fadeOut(100);
    });

    $('#menu-item-link-category').on('click', function() {
        $('#nav-category').toggleClass('active');
        return false;
    });

    $('.nav-category-close').on('click', function() {
        $('#nav-category').removeClass('active');
        return false;
    });

    $('.nav-region-close').on('click', function() {
        $('#nav-region').removeClass('active');
        return false;
    });
});