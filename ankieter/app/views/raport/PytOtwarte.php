

<div id="editPoolHead2"> 
<?php echo $this->queInfo["pytanie"] ?>
</div>
<div id="editPoolBox">

<p>

	<table id="raportTable" class="pytanie" cellspacing="0" cellpadding="0" border="0">
  		<tr><th>Typ odpowiedzi</th><td><?php echo $this->queInfo["nazwa_typu"];?></td></tr>
    	<tr><th width="0">Nr</th><th>Odpowiedź  respondenta</th></tr>
   		<?php
   			$i=0;
   			foreach($this->ansInfo as $ansInfo)
   				echo "<tr><td>".++$i.". </td><td>".$ansInfo['odpowiedz']."</td></tr>\n";
   		?>
  	</table>
  
</p>
</div>
<BR><BR>
