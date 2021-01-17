// сортировка
$(document).ready(function (){
    var tdColumn = $('.table_account_header').data('column');
    var tdSort = $('.table_account_header').data('sort');
    $('td#column_'+tdColumn).addClass(tdSort);
});

// вывод сообщения об ошибке
if (document.getElementById('error').dataset.content) {
    alert(document.getElementById('error').dataset.content)
}

// отображения полей меню входа в аккаунт
var buttonLogin = document.querySelector('.butLogin');
buttonLogin.addEventListener('click', function () {
    var div = document.querySelector('.loginForm');
    div.classList.toggle('active');
});

