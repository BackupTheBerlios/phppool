<div id="editPoolBox">
<h1>RAPORT</h1>
<p>
Ankieta: <?php echo $this->pool->nazwa; ?>
</p>
<p>
Opis: <?php echo $this->pool->opis; ?>
</p>
<p>
Ilość oddanych głosów: <?php echo $this->numberOfFill; ?> 
	
	
</p>
</div>
<?php
$typOdpowiedzi = array(
	'jednokrotnego wyboru',
	'wieloktrotnego wyboru',
	'otwarte'
);
foreach ($this->questions as $row){
	echo '<h2>';
	echo 'Pytanie: '.$row->pytanie;
	echo '</h2>';
	echo '<div class=move>';

	echo '<p>';
	echo 'Pytanie '.$typOdpowiedzi[$row->idTypOdpowiedzi];
	echo '</p>';
	?>
	<table border=1  class=raport>
		<tr>
	<td>
	odpowiedz
	</td>
	<td>
	ilosc glosow
	</td>
	<td class=raportRight>
	udział procentowy
	</td>
		</tr>
	<?php
	foreach ($this->variantsForQuestion[$row->idPytanie] as $rowNext) {
		echo '<tr>';
		echo '<td class=raportLeft>';
		echo $rowNext->opis;
		echo '</td>';
		echo '<td class=raportMiddle>';
		echo $this->numberOfvotesPerVariant[$rowNext->idWariantOdpowiedzi] ? $this->numberOfvotesPerVariant[$rowNext->idWariantOdpowiedzi]: '0';
		echo '</td>';
		echo '<td class=raportRight>';
		echo round( ($this->numberOfvotesPerVariant[$rowNext->idWariantOdpowiedzi]/ $this->numberOfFillPerQuestion[$row->idPytanie])*100);
		echo ' %</td>';
		echo '</tr>';
	}
	?>
	</table>
	<?php
	echo '</div>';
}
?>


  