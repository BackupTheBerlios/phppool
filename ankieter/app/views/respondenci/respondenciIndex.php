<p>
<h1> Dodaj pojędynczego respondenta</h1> 
Dzięki współpracy z naszymi partnerami strategicznymi nieustannie doskonalimy nasz serwis CBI po to aby oferować naszym klientom najwyższej jakości produkt skierowany do badań ankietowych w internecie. Wszystko dla wielowymiarowych korzyści i satysfakcji naszych klientów</p>
</p>
<p>
<div class="header3">
	<form action="/respondenci/dodaj" method="post">
	<label for="ankieta_opis">Email:</label>
	
	<?php echo $this->formText('email', null, array('id'=>'ankieta_opis', 'class'=>'input_classic')); ?>
	
	</select>
	<?php echo $this->formSubmit('send','Dodaj respondenta'); ?> 
	</form>
</div>

<h1>Import adresów email z pliku</h1> 
Naszą misją i celem nadrzędnym jest wspieranie organizacji naszych klientów w osiągnięciu efektów biznesowych poprzez zdobywanie informacji i wiedzy dzięki zastosowaniu naszego systemu badań online.

Dzięki współpracy z naszymi partnerami strategicznymi nieustannie doskonalimy nasz serwis CBI po to aby oferować naszym klientom najwyższej jakości produkt skierowany do badań ankietowych w internecie. 

Wszystko dla wielowymiarowych korzyści i satysfakcji naszych klientów
</p>
<p class="header3">
	<form action="/raport/graficzny" method="post" enctype="text/plain">
	<label for="ankieta_opis">Plik:</label>
	
	<?php echo $this->formFile('ankieta_opis', null, array('id'=>'ankieta_opis', 'class'=>'input_classic')); ?>
	
	</select>
	<?php echo $this->formSubmit('send','Import plik'); ?> 
	</form>
</p>
<p>
<h1>Usuń respondenta</h1> 
Dzięki partnerstwu z firmą MaDoNET jesteśmy w stanie utrzymywać nasz serwis CBI na najwyższym poziomie przez 24h. Partnerstwo to jest gwarantem iż usługi świadczone poprze nasz serwis badań online będą zawsze na najwyższym poziomie a nasi klienci nie muszą martwić się o awarie sprzętu czy oprogramowania.
</p>
<p class="header3">
	<form action="/raport/graficzny" method="post" enctype="text/plain">
	<label for="ankieta_opis">Email:</label>
	
	<?php echo $this->formText('ankieta_opis', null, array('id'=>'ankieta_opis', 'class'=>'input_classic')); ?>
	
	</select>
	<?php echo $this->formSubmit('send','Usun respondenta'); ?> 
	</form>
</p>