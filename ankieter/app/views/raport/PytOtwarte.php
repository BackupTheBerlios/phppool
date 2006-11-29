<div id="editPoolHead2"> 
<?php echo $this->queInfo["kolejnosc"].". ".$this->queInfo["pytanie"] ?>
</div>
<div id="editPoolBox">

<p>

	<table id="raportTable" class="pytanie" cellspacing="0" cellpadding="0" border="0">
  		<tr><th style="width:20px">Typ odpowiedzi</th><td><?php echo $this->queInfo["nazwa_typu"];?></td></tr>
    	<tr><th style="width:20px">Nr</th><th>Odpowiedź  respondenta</th></tr>
   		<?php
   			$i=0;
   			foreach($this->ansInfo as $ansInfo)
   				echo "<tr><td>".++$i.". </td><td>".$ansInfo."</td></tr>\n";
   		?>
  	</table>
  
</p>
</div>
<BR>
<HR>
<BR>
<br>
