<div id="editPoolHead2"> 
<?php echo $this->queInfo["kolejnosc"].". ".stripslashes($this->queInfo["pytanie"]) ?>
</div>
<div id="editPoolBox">

<p>

	<table id="raportTable" class="pytanie" cellspacing="0" cellpadding="0" border="0">
  		<tr><th style="width:20px">Typ odpowiedzi</th><td><?php echo $this->queInfo["nazwa_typu"];?></td></tr>
    	<tr><th style="width:20px">Nr</th><th>Odpowiedź  respondenta</th></tr>
   		<?php
   			$ile=min($this->limit, $full=count($this->ansInfo));
   			for($i=0;$i<$ile;$i++)
   				echo "<tr><td>".($i+1).". </td><td>".$this->ansInfo[$i]."</td></tr>\n";
   		?>
  	</table>
  	<?php if(!$this->excel && $full>$this->limit) {
  		echo '<a href='."'/documents/raporty/OA_".$this->queId.".txt'>Zobacz pełną listę...</a>";
  	}
  	?>
</p>
</div>
<BR>
<HR>
<BR>
<br>
