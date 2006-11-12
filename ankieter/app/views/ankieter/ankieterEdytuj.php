<div id="editPoolHead"> 
<?php echo $this->pool->nazwa ?>
</div>
<div id="editPoolBox">

<?php echo $this->pool->opis ?>

</div>
<div id="editPoolBox2">

<p>
<form action="/ankieter/dodajpytanie/ankieta/<?php echo $this->pollId; ?>" method="post">
	<label for="pytanie_tresc">Treść pytania</label>	
	<?php echo $this->formText('pytanie_tresc', null, array('id'=>'ankieta_opis', 'class'=>'input_classic')); ?>
	<label for="pytanie_typ">Typ odpowiedzi</label>	
	<select name="pytanie_typ">
	<?php
	foreach ($this->questionsVariants as $key =>$value) {
		echo '<option value="'.$key.'">'.$value.'</option>'."\n\t";
	}
	?>
	</select>


<?php echo $this->formSubmit('send','Dodaj pytanie'); ?> 
</form>
</p>
</div>
<div>
<table id="editTable" cellspacing="0" cellpadding="0" border="0">
<tr class="center">
<td><b>treść pytania</b></td>
<td><b>typ odpowiedzi</b></td>

<td><b>Opcje</b></td></tr>
<?php

foreach ($this->questions as $row) {
	echo '<tr>';
	echo "<td><a href=/ankieter/edytuj/ankieta/$this->pollId/pytanie/$row->idPytanie>".$row->pytanie.'</a></td>';
	echo '<td class="center">'.$this->questionsVariants[$row->idTypOdpowiedzi].'</td>';
	echo '<td class="miniMenu">';
	if($row->kolejnosc!=1){
		echo "<a href=/ankieter/przenies/do/gory/ankieta/$this->pollId/pytanie/$row->idPytanie><img src=/images/up.gif border=0 class=bla title=\"w górę\"></a>";
	}
	if($row->kolejnosc!=$this->questions->count()){
		echo "<a href=/ankieter/przenies/do/dolu/ankieta/$this->pollId/pytanie/$row->idPytanie><img src=/images/down.gif border=0 class=bla title=\"w dół\"></a>";
	}
	echo "<a href=/ankieter/edytuj/ankieta/$this->pollId/pytanie/$row->idPytanie><img src=/images/table_edit.png border=0 title=\"edytuj\"></a>";
	echo "<a href=/ankieter/usunpytanie/ankieta/$this->pollId/pytanie/$row->idPytanie><img src=/images/delete.png border=0 title=\"skasuj\"></a>";
	echo '</td>';
	echo '</tr>';
}
?>

</table>


 
  
  


</div>
