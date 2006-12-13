
<p>


<h1>Utwórz konto ankietera</h1> 
Naszą misją i celem nadrzędnym jest wspieranie organizacji naszych klientów w osiągnięciu efektów biznesowych poprzez zdobywanie informacji i wiedzy dzięki zastosowaniu naszego systemu badań online.

Dzięki współpracy z naszymi partnerami strategicznymi nieustannie doskonalimy.

</p>
<p>
<div class="header">
	<form action="/admin/dodajAnkietera" method="post" >
	<label for="ankieter_login">Login</label>
	<div>
	<?php echo $this->formText('ankieter_login', null, array('id'=>'ankieter_login', 'class'=>'input_classic')); ?>
	</div>
	<label for="ankiter_haslo">Hasło</label>
	<div>
	<?php echo $this->formPassword('ankieter_haslo', null, array('id'=>'ankieter_haslo', 'class'=>'input_classic')); ?>
	</div>
	
	<?php echo $this->formSubmit('send','Dodaj ankietera',array('id'=>'input_submit')); ?>
	</form>
</div>


<?php
if(	$this->validationError){
?>
<div class="warning">
<?php echo $this->validationError;
?>
</div>
<?php
}
?>

	
</p>
<p>
<h1>Usuń konto ankietera</h1> 
Dzięki partnerstwu z firmą MaDoNET jesteśmy w stanie utrzymywać nasz serwis CBI na najwyższym poziomie przez 24h. Partnerstwo to jest gwarantem iż usługi świadczone poprze nasz serwis badań online będą zawsze na najwyższym poziomie a nasi klienci nie muszą martwić się o awarie sprzętu czy oprogramowania.
</p>
<p class="header">
	<form action="/admin/usunankietera" method="post" >
	<label for="ankieter_login">Login:</label>
	
	<select name="ankieter_id">
	<?php
	foreach ($this->poll as $row) {
		echo '<option value="'.$row->idUzytkownik.'">'.$row->login.'</option>'."\n\t";
	}
	?>
	</select>
	
	<?php echo $this->formSubmit('send','Usun ankietera'); ?> 
	</form>
	

</p>