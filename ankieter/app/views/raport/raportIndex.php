<p>
<h1> Raport graficzny</h1> 
Istnieje wiele zastosowań badań ankietowych, sond, kwestionariuszy czy formularzy ocen w sferze biznesowej jak i w działalności non-profit czy działalności akademickiej.
Poniżej zamieszczamy krótką listę z przykładami możliwych zastosowań z różnych dziedzin dla których właśnie nasze propozycje rozwiązań realizacji badań ankietowych wydają się być wartościowe i przydatne.</p>
</p>
<p class="header2">
	<form action="/raport/graficzny" method="post" >
	Wybierz ankiete:
	<select name="form_ankieta">
	<?php
	foreach ($this->polls as $row) {
		echo '<option value="'.$row->idAnkieta.'">'.$row->nazwa.'</option>';
	}
	?>
	</select>
	<?php echo $this->formSubmit('send','Generuj raport graficzny'); ?> 
	</form>
</p>
<p>
<h1> Raport tabelaryczny</h1> 
Naszą misją i celem nadrzędnym jest wspieranie organizacji naszych klientów w osiągnięciu efektów biznesowych poprzez zdobywanie informacji i wiedzy dzięki zastosowaniu naszego systemu badań online.

Dzięki współpracy z naszymi partnerami strategicznymi nieustannie doskonalimy nasz serwis CBI po to aby oferować naszym klientom najwyższej jakości produkt skierowany do badań ankietowych w internecie. 

Wszystko dla wielowymiarowych korzyści i satysfakcji naszych klientów
</p>
<p class="header2">
	<form action="/raport/tabelaryczny" method="post">
	Wybierz ankiete:
	<select name="form_ankieta">
	<?php
	foreach ($this->polls as $row) {
		echo '<option value="'.$row->idAnkieta.'">'.$row->nazwa.'</option>';
	}
	?>
	</select>
	<?php echo $this->formSubmit('send','Generuj raport tabelaryczny'); ?> 
	</form>
</p>
<p>
<h1> Export danych do exela</h1> 
Dzięki partnerstwu z firmą MaDoNET jesteśmy w stanie utrzymywać nasz serwis CBI na najwyższym poziomie przez 24h. Partnerstwo to jest gwarantem iż usługi świadczone poprze nasz serwis badań online będą zawsze na najwyższym poziomie a nasi klienci nie muszą martwić się o awarie sprzętu czy oprogramowania.
</p>
<p  class="header2">
	<form action="/raport/export" method="post" enctype="text/plain">
	Wybierz ankiete:
	<select name="form_ankieta">
	<?php
	foreach ($this->polls as $row) {
		echo '<option value="'.$row->idAnkieta.'">'.$row->nazwa.'</option>';
	}
	?>
	</select>
	<?php echo $this->formSubmit('send','Export danych do exela'); ?> 
	</form>
</p>