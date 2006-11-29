<div id="editPoolHead"> 
<a href="/raport/">Raport</a> / 
<?php echo $this->pool->nazwa ?>

</div>
<div id="editPoolBox">

<?php echo $this->pool->opis ?>


</div>
<br/><br/>
<form action="/raport/graficzny/ankieta/<?php echo $this->pollId; ?>" method="post">
	<div id="editPoolHead2"> 
	Wybór do każdego pytania rodzaju generowangego wykresu
</div>
<div id="editPoolBox">
	<table id="raportTable" style="width:100%;text-align:center;">
	<tr><th rowspan="2" style="width:20px">Lp</th><th rowspan="2" style="width:100%;">Pytanie</th><th rowspan="2">Typ odpowiedzi</th><th colspan="3">Typ generowanego wykresu</th></tr>
	<tr><th>Slupkowy<br>pionowy</th><th>Słupkowy<br>poziomy</th><th>Kołowy</th></tr>
	<?php
	foreach ($this->questions as $row) {
		switch ($row->idTypOdpowiedzi) {
			case 0: $addBarV=' checked="checked" '; $addBarH=' '; $addPie=' ';  
			break;
			case 1: $addBarV=' checked="checked" '; $addBarH=' '; $addPie=' disabled="disabled" ';
			break;
			case 2: $addBarV=' disabled="disabled" '; $addBarH='  disabled="disabled"  '; $addPie=' disabled="disabled" ';
			break;
		}
		echo "<tr><td>".$row->kolejnosc.". </td><td style='text-align:left;'>".$row->pytanie."</td><td>".$row->idTypOdpowiedzi."</td>";
		echo 	'<td><input type="radio" name="'.$row->idPytanie.'" value="0" '.$addBarV.'></td>';
		echo 	'<td><input type="radio" name="'.$row->idPytanie.'" value="1" '.$addBarH.'></td>';
		echo 	'<td><input type="radio" name="'.$row->idPytanie.'" value="2" '.$addPie.'></td>';
		echo "</tr>\n";
	}

	?>
	</table>
<?php echo $this->formSubmit('send','Generuj raport'); ?> 
</form>

</div>


 
<!-- 
<div>
<ul class="sortable" id="sort1">
<?php
$position = 1;
foreach ($this->questions as $row) {
?>
	<li class="sortableitem" id="<?php echo $row->idPytanie; ?>">
	
	<div class="dupa">
	<a href=/ankieter/odpowiedzi/ankieta/<?php echo $this->poolId; ?>/pytanie/<?php echo $row->idPytanie; ?>>
	<img src=/images/edit.png border=0 title="dodaj odpowiedzi" style="margin-right:5px;">
	</a>
	<a href=/ankieter/usunpytanie/ankieta/<?php echo $this->poolId; ?>/pytanie/<?php echo $row->idPytanie; ?>>
	<img src=/images/delete_new.png border=0 title="usun pytanie"></a>
	</div>
	<?php echo $row->pytanie; ?>
	
	</li>
<?php	
	$position++;
}
?>	
</ul>
</div>

-->