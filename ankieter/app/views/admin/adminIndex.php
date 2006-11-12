
<p>


<h1>Utwórz konto ankietera</h1> 
Naszą misją i celem nadrzędnym jest wspieranie organizacji naszych klientów w osiągnięciu efektów biznesowych poprzez zdobywanie informacji i wiedzy dzięki zastosowaniu naszego systemu badań online.

Dzięki współpracy z naszymi partnerami strategicznymi nieustannie doskonalimy.

</p>
<p>
<div class="header">
	<form action="/raport/graficzny" method="post" enctype="text/plain">
	<label for="ankieta_opis">Login</label>
	<div>
	<?php echo $this->formText('ankieta_opis', null, array('id'=>'ankieta_opis', 'class'=>'input_classic')); ?>
	</div>
	<label for="ankieta_opis">Hasło</label>
	<div>
	<?php echo $this->formText('ankieta_opis', null, array('id'=>'ankieta_opis', 'class'=>'input_classic')); ?>
	</div>
	</select>
	<?php echo $this->formSubmit('send','Dodaj ankietera'); ?> 
	</form>
</div>	
</p>
<p>
<h1>Usuń konto ankietera</h1> 
Dzięki partnerstwu z firmą MaDoNET jesteśmy w stanie utrzymywać nasz serwis CBI na najwyższym poziomie przez 24h. Partnerstwo to jest gwarantem iż usługi świadczone poprze nasz serwis badań online będą zawsze na najwyższym poziomie a nasi klienci nie muszą martwić się o awarie sprzętu czy oprogramowania.
</p>
<p class="header">
	<form action="/raport/graficzny" method="post" enctype="text/plain">
	<label for="ankieta_opis">Login:</label>
	<select>
	
	</select>
	<?php echo $this->formSubmit('send','Usun respondenta'); ?> 
	</form>
</p>