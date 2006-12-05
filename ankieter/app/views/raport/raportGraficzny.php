<h1>Raport Tabelaryczny</h1> 




<?php echo $this->pool->nazwa ?>
<table align="center">
<?php 
	foreach ($this->questions as $row) {
		//echo $row->idPytanie.'">'.$row->kolejnosc.". &nbsp;$nbsp\t".$row->pytanie.'</option> \n';
		if ($row->idTypOdpowiedzi!=2) {
			//echo '<p><div style="text-align:center;" id="editPoolBox">'."\n";
			echo "<tr>";
			if (($this->gTypes[$row->idPytanie])==0) {
				echo "<td><img src='/images/raporty/".$row->idPytanie."V.png' style='display:block; '/></td>\n";
			}
			if (($this->gTypes[$row->idPytanie])==1) {
				echo "<td><img src='/images/raporty/".$row->idPytanie."H.png' style='display:block; '/></td>\n";
			}
			if (($this->gTypes[$row->idPytanie])==2) {
				if (!isset($this->wyjatki[$row->idPytanie])) {
					echo "<td><img src='/images/raporty/".$row->idPytanie."P.png' style='display:block; '/></td>\n";
				} else {
					echo "<td><div class='warning'>Nie udzielono żadnej odpowiedzi do pytania nr $row->kolejnosc.<br>Nie można wyswietlic wykresu kołowego.</div></td>\n";
				}
			}
			echo "</tr>\n";

		}		
	}
?>
</table>

