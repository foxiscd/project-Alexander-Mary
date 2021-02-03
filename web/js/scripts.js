// сортировка
$(document).ready(function () {
    //Menu-photo toggle
    $(document).on('click', function (e) {
        if ((e.target).closest('.picture-button')) {
            var idPicture = $(e.target).closest('.picture-button').data('id');
            var menus = $('.mini-menu-update');
            $.each(menus, function () {
                if ($(this).data('picture') == idPicture) {
                    $(this).toggleClass('active');
                }
            });
        } else if ($('.mini-menu-update').hasClass('active')) {
            $('.mini-menu-update').removeClass('active');
        }
    });

    //add change button
    $('textarea,input,select').on('change', function () {
        var button = $(this).closest('form').find('button.hidden');
        button.addClass('active');
    });

    // add save button
    $('.items input').on('change', function () {
        if ($(this).data('card') == undefined) {
            $('#account_button').addClass('active');
        } else {
            $('#account_button' + $(this).data('card')).addClass('active');
        }
    });
    $('.items textarea').on('change', function () {
        if ($(this).data('card') == undefined) {
            $('#account_button').addClass('active');
        } else {
            $('#account_button' + $(this).data('card')).addClass('active');
        }
    });


    var tdColumn = $('.table_account_header').data('column');
    var tdSort = $('.table_account_header').data('sort');
    $('td#column_' + tdColumn).addClass(tdSort);

    //auto height textarea
    $('body')
        .on('focus.textarea', 'textarea', function (e) {
            baseH = this.scrollHeight;
        })
        .on('click', 'textarea', function (e) {
            if (baseH < this.scrollHeight) {
                $(this).height(0).height(this.scrollHeight);
            } else {
                $(this).height(0).height(baseH);
            }
        });
});

// get message error
if (document.getElementById('error').dataset.content) {
    alert(document.getElementById('error').dataset.content)
}

// add mini-menu with login form
var buttonLogin = document.querySelector('.butLogin');
buttonLogin.addEventListener('click', function () {
    var div = document.querySelector('.loginForm');
    div.classList.toggle('active');
});

