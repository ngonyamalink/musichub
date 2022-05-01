/*  search-box-active   */
$(document).ready(function () {
    var submitIcon = $('.searchbox-icon');
    var inputBox = $('.searchbox-input');
    var searchBox = $('.searchbox');
    var isOpen = false;
    submitIcon.click(function () {
        if (isOpen == false) {
            searchBox.addClass('searchbox-open');
            inputBox.focus();
            isOpen = true;
        } else {
            searchBox.removeClass('searchbox-open');
            inputBox.focusout();
            isOpen = false;
        }
    });

    /*   Sticky-Menu-Active   */
    function sticky_relocate() {
        var window_top = $(window).scrollTop();
        var div_top = $('.menu-sticky').offset().top;
        if (window_top > div_top) {
            $('.mainmenu-area').addClass('stick');
        } else {
            $('.mainmenu-area').removeClass('stick');
        }
    }

    $(function () {
        $(window).scroll(sticky_relocate);
        sticky_relocate();
    });

    /*  Responsive-menu Deactive  */
    $('.mainmenu ul.nav.navbar-nav li a').on('click', function () {
        $('.navbar-collapse').removeClass('in');
    });
});

function buttonUp() {
    var inputVal = $('.searchbox-input').val();
    inputVal = $.trim(inputVal).length;
    if (inputVal !== 0) {
        $('.searchbox-icon').css('display', 'none');
    } else {
        $('.searchbox-input').val('');
        $('.searchbox-icon').css('display', 'block');
    }
}