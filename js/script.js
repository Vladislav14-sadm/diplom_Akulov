//показать пароль
$('body').on('click', '.password-control', function(){
	if ($('#password-input').attr('type') == 'password'){
		$(this).html('Скрыть пароль');
		$('#password-input').attr('type', 'text');
	} else {
		$(this).html('Показать пароль');
		$('#password-input').attr('type', 'password');
	}
	return false;
}); 

/*переход в форме вход/регистрация
$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});*/

