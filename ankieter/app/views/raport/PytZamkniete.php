
<div id="editPoolHead2"> 
<?php echo $this->queInfo["pytanie"] ?>
</div>
<div id="editPoolBox">

<p>

	<table id="raportTable" class="pytanie" cellspacing="0" cellpadding="0" border="0">
  		<tr><th colspan="2">Typ odpowiedzi</th><td colspan="2"><?php echo $this->queInfo["nazwa_typu"];?></td></tr>
    	<tr><th width="0">Nr</th><th>Wariant odpowiedzi</th><th>ilość zaznaczeń</th><th>%</th></tr>
   		<?php
   			$suma=0;
   			foreach($this->ansInfo as $kolejnosc => $ansInfo) $suma+=$ansInfo["ilosc"];
   			foreach($this->ansInfo as $kolejnosc => $ansInfo)
   				echo "<tr><td>".$kolejnosc.". </td><td>".$ansInfo['opis']."</td><td>".$ansInfo['ilosc']."</td><td>".(round($ansInfo["ilosc"]*100/$suma))."% </td></tr>\n";
   		?>
  	</table>
  
</p>
</div>
<BR><BR>

