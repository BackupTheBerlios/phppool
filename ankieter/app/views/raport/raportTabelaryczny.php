<h1>Raport Tabelaryczny</h1> 




<?php echo $this->pool->nazwa ?>


<div id="editPoolBox2">
	
  <table id="raportTable" cellspacing="0" cellpadding="0" border="0">
    <tr><th>Ankieter			</th><td colspan="3"><?php echo $this->info["login"]; ?></td></tr>
    <tr><th>Stan				</th><td colspan="3"><?php echo $this->info["status"]; ?></td></tr>
    <tr><th>Ilosc wypełnień		</th><td colspan="3"><?php echo $this->fill["fill"]; ?></td></tr>    
    <tr><th>Czas trwania ankiety</th><td colspan="3"><?php echo $this->info["czas"]; ?> dni</td></tr>
    <tr><th>Data zakończenia	</th><td colspan="3"><?php echo $this->info["data"]; ?></td></tr>
    <tr><th rowspan=2>Ilość pytań</th><th>jednokrotne</th><th>wielokrotne</th><th>otwarte</th></tr>
    <tr align="center">			<td><?php echo $this->ques[$this->qV['jednokrotne']]; ?></td><td><?php echo $this->ques[$this->qV['wielokrotne']]; ?></td><td><?php echo $this->ques[$this->qV['otwarte']]; ?></td></tr>
  </table>
  
</div>
<br><br>



