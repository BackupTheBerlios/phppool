<div id="editPoolHead"> 
<a href="/raport/">Raport</a> /
<a href="/raport/wyborWykresu/ankieta/<?php echo $this->pollId; ?>">Typ Wykresów</a> / 
<?php echo $this->pool->nazwa; ?>
</div>
<br>
<h1>Raport Graficzny</h1>
<div id="main_box">    

        
	<div id="container-1">	
		<ul class="anchors">
			<li><a href="#section-0">Początek</a></li>
			<?php
				$max = count($this->selected);
				//$max=5;
				for($i=0;$i<$max;$i++){
					echo '<li><a href=#section-'.$this->selected[$i].'>'.$this->selected[$i].'</a></li>';	
				}
			?>
	
		</ul>	
	<div id="section-0" class="fragment">
	<h3>Instrukcja</h3>
	<p>
		Aby zobaczyć wykres(y) do poszczególnych pytań ankiety, należy kliknąć<br>
		na numer zakładki znajdującej się powyżej, odpowiadającej numerowi pytania 
		z ankiety 
	</p>
	</div>
	
	<?php 
	$counter=0;
	foreach ($this->questions as $row) {
		if ($row->idTypOdpowiedzi!=2) {
			$counter++;
	?>
			<div id="section-<?php echo $row->kolejnosc?>" class="fragment">
			<table align="center">
	<?php
			if (!empty($this->gTypes[$row->idPytanie]) && in_array(0,$this->gTypes[$row->idPytanie])) {
					echo "<tr><td><img src='/images/raporty/".$row->idPytanie."V.png' style='display:block; '/></td></tr>\n";
			}
			if (!empty($this->gTypes[$row->idPytanie]) && in_array(1,$this->gTypes[$row->idPytanie])) {
				echo "<tr><td><img src='/images/raporty/".$row->idPytanie."H.png' style='display:block; '/></td></tr>\n";
			}
			if (!empty($this->gTypes[$row->idPytanie]) && in_array(2,$this->gTypes[$row->idPytanie])) {
				if (!isset($this->wyjatki[$row->idPytanie])) {
					echo "</tr><td><img src='/images/raporty/".$row->idPytanie."P.png' style='display:block; '/></td></tr>\n";
				} else {
					echo "</tr><td><div class='warning'>Nie udzielono żadnej odpowiedzi do pytania nr $row->kolejnosc.<br>Nie można wyswietlic wykresu kołowego.</div></td></tr>\n";
				}
			}
			echo "</table>";
			echo "</div>";
		}		
	}
	?>
	
	

</div>


