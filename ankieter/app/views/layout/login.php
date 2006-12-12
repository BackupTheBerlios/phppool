<div id="bluebox">
	<div id="bluebox_body">
	
	<?php
	$user = Zend::registry('user');
	if($user->getUserId()==0){
	?>
	<form action="/index/login" method="post">
	<label for="input_login">LOGIN</label>
	<div>
	<input type="text" class="input_classic" id="input_login" name="input_login">
	</div>
	<label for="input_haslo">HASŁO</label>
	<div>
	<input type="text" class="input_classic" id="input_haslo" name="input_haslo">
	</div>
	<input type="submit" value="zaloguj się" id="input_submit">
	</form>
	<?php
	} else {
		echo 'Zalogowany jako <b>'.$user->getLogin().'</b> ';
		echo '<a href="/index/logout">wygoluj się</a>';
	}
	?>
	
	
	
	</div>
	<div id="bluebox_bottom"></div>
</div>
