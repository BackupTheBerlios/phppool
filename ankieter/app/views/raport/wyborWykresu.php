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
					$addRadio1=' checked="checked" '; $addRadio2=' '; $addRadio3=' ';
			break;
			case 1: $addBarV=' checked="checked" '; $addBarH=' '; $addPie=' disabled="disabled" ';
					$addRadio1=' checked="checked" '; $addRadio2=' '; $addRadio3=' ';
			break;
			case 2: $addBarV=' disabled="disabled" '; $addBarH='  disabled="disabled"  '; $addPie=' disabled="disabled" ';
					$addRadio1=' disabled="disabled" '; $addRadio2='  disabled="disabled" '; $addRadio3=' disabled="disabled" ';
			break;
		}
		echo "<tr><td>".$row->kolejnosc.". </td><td style='text-align:left;'>".$row->pytanie."</td><td><img src='/images/imans".$row->idTypOdpowiedzi.".gif' align='center' valign='center'></td>";
		echo 	'<td><input type="checkbox" name="ID'.$row->idPytanie.'[]" value="0" '.$addBarV.'></td>';
		echo 	'<td><input type="checkbox" name="ID'.$row->idPytanie.'[]" value="1" '.$addBarH.'></td>';
		echo 	'<td><input type="checkbox" name="ID'.$row->idPytanie.'[]" value="2" '.$addPie.'></td>';
		
	/*	echo 	'<td><input type="radio" name="'.$row->idPytanie.'" value="0" '.$addRadio1.' ></td>';
		echo 	'<td><input type="radio" name="'.$row->idPytanie.'" value="1" '.$addRadio2.' ></td>';
		echo 	'<td><input type="radio" name="'.$row->idPytanie.'" value="2" '.$addRadio3.' ></td>';
	*/
		echo "</tr>\n";
	}

	?>
	</table>
	<div align="right">
	Wybierz rozdzielczość: 
	<select name="roz_id">
		<option value="0">400x300 px</option>
		<option value="1">640x480 px</option>
		<option value="2">800x600 px</option>
		<option value="3">1024x768 px</option>
	</select>
	</div>
	<br>
	<br>
<?php echo $this->formSubmit('send','Generuj raport'); ?> 
</form>

</div>
