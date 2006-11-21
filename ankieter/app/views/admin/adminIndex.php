
<p>


<h1>Utwórz konto ankietera</h1> 
Nasz¹ misj¹ i celem nadrzêdnym jest wspieranie organizacji naszych klientów w osi¹gniêciu efektów biznesowych poprzez zdobywanie informacji i wiedzy dziêki zastosowaniu naszego systemu badañ online.

Dziêki wspó³pracy z naszymi partnerami strategicznymi nieustannie doskonalimy.

</p>
<p>
<div class="header">
	<form action="/raport/graficzny" method="post" enctype="text/plain">
	<label for="ankieter_login">Login</label>
	<div>
	<?php echo $this->formText('ankieter_login', null, array('id'=>'ankieter_login', 'class'=>'input_classic')); ?>
	</div>
	<label for="ankiter_haslo">Has³o</label>
	<div>
	<?php echo $this->formText('ankieter_haslo', null, array('id'=>'ankieter_haslo', 'class'=>'input_classic')); ?>
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
<h1>Usuñ konto ankietera</h1> 
Dziêki partnerstwu z firm¹ MaDoNET jesteœmy w stanie utrzymywaæ nasz serwis CBI na najwy¿szym poziomie przez 24h. Partnerstwo to jest gwarantem i¿ us³ugi œwiadczone poprze nasz serwis badañ online bêd¹ zawsze na najwy¿szym poziomie a nasi klienci nie musz¹ martwiæ siê o awarie sprzêtu czy oprogramowania.
</p>
<p class="header">
	<form action="/raport/graficzny" method="post" enctype="text/plain">
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