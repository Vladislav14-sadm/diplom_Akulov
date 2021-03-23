<div class="password">
	<input type="password" id="password-input" placeholder="Введите пароль" name="password" value="123456">
	<a href="#" class="password-control">Показать пароль</a>
</div>
<style type="text/css">
.password {
	width: 300px;
	margin: 0 auto;
	padding: 15px;
}
#password-input {
	width: 100%;
	padding: 5px 0;
	height: 30px;
	line-height: 40px;
	text-indent: 10px;
	margin: 0 0 15px 0;
	border-radius: 5px;
	border: 1px solid #999;
	font-size: 18px;
}
</style>

<script src="https://snipp.ru/cdn/jquery/2.1.1/jquery.min.js"></script>
<script>
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
</script>