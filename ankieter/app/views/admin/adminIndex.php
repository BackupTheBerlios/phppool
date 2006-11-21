
<p>


<h1>Utw�rz konto ankietera</h1> 
Nasz� misj� i celem nadrz�dnym jest wspieranie organizacji naszych klient�w w osi�gni�ciu efekt�w biznesowych poprzez zdobywanie informacji i wiedzy dzi�ki zastosowaniu naszego systemu bada� online.

Dzi�ki wsp�pracy z naszymi partnerami strategicznymi nieustannie doskonalimy.

</p>
<p>
<div class="header">
	<form action="/admin/dodajAnkietera" method="post" >
	<label for="ankieter_login">Login</label>
	<div>
	<?php echo $this->formText('ankieter_login', null, array('id'=>'ankieter_login', 'class'=>'input_classic')); ?>
	</div>
	<label for="ankiter_haslo">Has�o</label>
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
<h1>Usu� konto ankietera</h1> 
Dzi�ki partnerstwu z firm� MaDoNET jeste�my w stanie utrzymywa� nasz serwis CBI na najwy�szym poziomie przez 24h. Partnerstwo to jest gwarantem i� us�ugi �wiadczone poprze nasz serwis bada� online b�d� zawsze na najwy�szym poziomie a nasi klienci nie musz� martwi� si� o awarie sprz�tu czy oprogramowania.
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