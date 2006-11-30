<div id="editPoolHead2"> 
<?php echo $this->queInfo["kolejnosc"].". ".$this->queInfo["pytanie"] ?>
</div>
<div id="editPoolBox">

	<table id="raportTable" cellspacing="0" cellpadding="0" border="0">
  		<tr ><th colspan="2">Typ odpowiedzi</th><td colspan="2"><?php echo $this->queInfo["nazwa_typu"];?></td></tr>  		
    	<?php
    		printf("<tr><th colspan='2'>Ilosc respondentów<br>która nie udzieliła odpowiedzi</th><td valign='middle'>%d</td><td valign='middle' align='right'>%6.2f %%</td></tr>", $this->fill["fill"]-$this->ilResp, $this->fill["fill"]?($this->fill["fill"]-$this->ilResp)*100/$this->fill["fill"]:0);
    	?>
    	<tr><th style="width:20px">Nr</th><th>Wariant odpowiedzi</th><th>ilość wskazań</th><th>%</th></tr>
   		<?php
   			if ($this->queInfo["nazwa_typu"]=="jednokrotne") {
   				$ilosc=0;
   				foreach($this->ansInfo as $kolejnosc => $ansInfo) $ilosc+=$ansInfo["ilosc"];
   			} else $ilosc=$this->fill["fill"];
   			foreach($this->ansInfo as $kolejnosc => $ansInfo)
   				printf("<tr><td>%d.</td><td>%s</td><td>%d</td><td align='right'>%6.2f %%</td></tr>\n", $kolejnosc, $ansInfo['opis'], $ansInfo['ilosc'], ($ilosc?($ansInfo["ilosc"]*100/$ilosc):"???"));
   		?>
  	</table>
  
</div>
<BR>
<HR>
<BR>
<BR>

