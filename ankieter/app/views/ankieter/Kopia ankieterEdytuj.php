<div id="editPoolHead"> 
Ankieta: 
<?php echo $this->pool->nazwa ?>
</div>
<div id="editPoolBox">

<?php echo $this->pool->opis ?>
<p>
<a href="/ankieter/<?php echo $this->poolId; ?>">Edytuj pozostałe ankiety</a>
</p>
<input type="button" value="Slide Out" class="buttonBslideup" />
<input type="button" value="Slide In" class="buttonBslidedown" />
	<div class="contentToChange">
	<p class="fourthparagraph" style="margin:0">

t wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.
	</p>
	</div>
</div>
<div id="editPoolBox2">

<p>
<form action="/ankieter/dodajpytanie/ankieta/<?php echo $this->poolId; ?>" method="post">
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
<td><b></b></td>
<td><b>treść pytania</b></td>
<td><b>typ</b></td>
<td><b>odpowiedzi</b></td>
<td><b></b></td>
</tr>
<?php
$position=1;
foreach ($this->questions as $row) {
	echo '<tr>';
		echo '<td class=tab1>';
	if($position!=1){
		echo "<a href=/ankieter/przeniespytanie/do/gory/ankieta/$this->poolId/pytanie/$row->idPytanie><img src=/images/up.gif border=0 class=bla title=\"w górę\"></a>";
	}else{
		echo "<img src=/images/blank.png border=0 class=bla>";
	}
	if($position!=$this->questions->count()){
		echo "<a href=/ankieter/przeniespytanie/do/dolu/ankieta/$this->poolId/pytanie/$row->idPytanie><img src=/images/down.gif border=0 class=bla title=\"w dół\"></a>";
	}else{
		echo "<img src=/images/blank.png border=0 class=bla>";
	}
	
	echo '</td>';
	echo "<td class=tab2> " .
			"<div>".
			$row->pytanie."</div></td>";
	echo '<td class=tab3>'.$this->questionsVariants[$row->idTypOdpowiedzi].'</td>';
	echo "<td class=tab4><a href=/ankieter/odpowiedzi/ankieta/$this->poolId/pytanie/$row->idPytanie>edytuj</a></td>";
	echo "<td class=tab5>" .
			
			"<a href=/ankieter/usunpytanie/ankieta/$this->poolId/pytanie/$row->idPytanie><img src=/images/delete.png border=0 title=\"skasuj\"></a>" .
			"</td>";
			echo "<td class=tab5>" .
			"<img src=/images/table_edit.png border=0 title=\"edytuj\"> " .
			"</td>";
	echo '</tr>';
	$position++;
}
?>

</table>

<div id="html"></div>

 
 
<div>
<ul class="sortable" id="sort1">
<?php
$position = 1;
foreach ($this->questions as $row) {
?>
	<li class="sortableitem" id="<?php echo $row->kolejnosc; ?>">
	<div class="dupa">
	<img src=/images/delete.png border=0 title=\"skasuj\">
	</div>
	<?php echo $row->pytanie; ?>
	
	</li>
<?php	
	$position++;
}
?>	
</ul>
</div>


  
  




