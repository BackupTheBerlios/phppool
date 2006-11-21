<div id="editPoolHead"> 
Ankieta: <?php echo $this->pool->nazwa ?>
</div>
<div id="editPoolBox">

<b>Pytanie:</b>
<?php echo $this->question->pytanie; ?>

<p>
<b>Typ:</b>
<?php echo $this->questionsVariants[$this->question->idTypOdpowiedzi]; ?>

</p>
<p>
<a href="/ankieter/edytuj/ankieta/<?php echo $this->poolId; ?>">Edytuj pozostałe pytania</a>
</p>

</div>


<div>
<div id="move">
<table id="editTable" cellspacing="0" cellpadding="0" border="0" class="move">
<tr class="center">
<td><b></b></td>
<td><b>wariant odpowiedzi</b></td>
<td><b></b></td>
</tr>
<?php

$position=1;
foreach ($this->variants as $row) {
	echo '<tr>';
			echo '<td class=tab1>';
	if($position!=1){
		echo "<a href=/ankieter/przeniesodpowiedz/do/gory/ankieta/$this->poolId/pytanie/$row->idPytanie/odpowiedz/$row->idWariantOdpowiedzi><img src=/images/up.gif border=0 class=bla title=\"w dół\"></a>";
	}else{
		echo "<img src=/images/blank.png border=0 class=bla>";
	}
	if($position!=$this->variants->count()){
		echo "<a href=/ankieter/przeniesodpowiedz/do/dolu/ankieta/$this->poolId/pytanie/$row->idPytanie/odpowiedz/$row->idWariantOdpowiedzi><img src=/images/down.gif border=0 class=bla title=\"w dół\"></a>";
	}else{
		echo "<img src=/images/blank.png border=0 class=bla>";
	}
	
	echo '</td>';
	echo '<td>';
	echo $row->opis;	
	
	echo '</td>';
	echo '<td class="tab5">';
	echo "<a href=/ankieter/usunodpowiedz/ankieta/$this->poolId/pytanie/$row->idPytanie/odpowiedz/$row->idWariantOdpowiedzi><img src=/images/delete.png border=0 title=\"skasuj\"></a>";	
	echo '</td>';
	echo '</tr>';
	$position++;
}
?>

</table>
</div>

 <div id="editPoolBox2">

<p>
<form action="/ankieter/dodajodpowiedz/ankieta/<?php echo $this->poolId; ?>/pytanie/<?php echo $this->questionId; ?>" method="post">
	<label for="pytanie_tresc">Treść odpowiedzi</label>	
	<?php echo $this->formText('odpowiedz_tresc', null, array('id'=>'ankieta_opis', 'class'=>'input_classic')); ?>

<?php echo $this->formSubmit('send','Dodaj wariant odpowiedzi'); ?> 
</form>
</p>
</div>
  
  


</div>
