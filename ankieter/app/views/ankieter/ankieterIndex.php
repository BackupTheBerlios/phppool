<p>

<h1>Stwórz nową ankiete</h1> 

MARECO Polska Ośrodek Badania Opinni Pubicznej i Rynku jako jedyny w Polsce jest członkiem Gallup International Association - międzynarodowej organizacji zrzeszającej firmy badawcze z ponad 50 krajów świata. Dzięki parterstwu z MARECO jesteśmy w stanie oferować najbardziej merytorycznie zaawansowane wsparcie przy tworzeniu badań ankietowych dla naszych klientów.
</p>
<p>
<div class="form_blue">
	<form action="/ankieter/nowa" method="post">
	<label for="ankieta_nazwa">Nazwa ankiety</label>	
	<div>
	<?php echo $this->formText('ankieta_nazwa', null, array('id'=>'ankieta_nazwa', 'class'=>'input_classic')); ?>
	</div>
	<label for="ankieta_opis">Opis ankiety</label>
	<div>
	<?php echo $this->formText('ankieta_opis', null, array('id'=>'ankieta_opis', 'class'=>'input_classic')); ?>
	</div>  
	<?php echo $this->formSubmit('send','Stwórz ankiete', array('id'=>'input_submit')); ?> 
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



<h1>Edytuj istniejącą ankiete</h1> 

Zapraszamy do zapoznania się z przykładami badań ankietowych online dostępnych w naszym serwisie. 
Udostępniliśmy sześć demonstracyjnych ankiet, które dostępne są zawsze w kolumnie po lewej stronie ekranu. 
Przypominamy, iż ankiety demonstracyjne służą jedynie jako przykład możliwości systemu CBI e-ankieta.pl.
 Nie są to kompletne badania ankietowe a jedynie skromny wycinek kilku pytań dla zobrazowania mechanizmu i
  jego możliwości.
</p>
<p class="header">
	<form action="/ankieter/edytuj" method="post">
	Wybierz ankiete:
	<select name="ankieta_id">
	<?php
	foreach ($this->poll as $row) {
		echo '<option value="'.$row->idAnkieta.'">'.$row->nazwa.'</option>'."\n\t";
	}
	?>
	</select>
	<?php echo $this->formSubmit('send','Edytuj ankietę'); ?> 
	</form>
</p>
<p>
<h1>Skasuj istniejącą ankiete</h1> 
Po lewej stronie ekranu. 
Przypominamy, iż ankiety demonstracyjne służą jedynie jako przykład możliwości systemu CBI e-ankieta.pl.
 Nie są to kompletne badania ankietowe a jedynie skromny wycinek kilku pytań dla zobrazowania mechanizmu i
  jego możliwości.
</p>
<p class="header">
	<form action="/ankieter/usun" method="post">
	Wybierz ankiete:
	<select name="ankieta_id">
	<?php
	foreach ($this->poll as $row) {
		echo '<option value="'.$row->idAnkieta.'">'.$row->nazwa.'</option>'."\n\t";
	}
	?>
	</select>
	<?php echo $this->formSubmit('send','Skasuj ankietę'); ?> 
	</form>
</p>