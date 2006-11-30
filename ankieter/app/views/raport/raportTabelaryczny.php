<h1> Statystyki ogólne</h1> 
<p>Informacje zbiorcze o ankiecie.</p>


<div id="editPoolHead"> 
<?php echo $this->pool->nazwa ?>
</div>
<div id="editPoolBox">

<?php echo $this->pool->opis ?>

</div>
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
<!--
<div id="editPoolBox">
<form action="/raport/tabelaryczny/ankieta/<?php echo $this->pollId; ?>" method="post">
	<p>Wybierz pytanie z listy</p> 
	
	<Select name="pytanie_id" class="select">
		<?php
		foreach ($this->questions as $row) {
			echo '<option value="'.$row->idPytanie.'">'.$row->kolejnosc.". &nbsp;$nbsp\t".$row->pytanie.'</option> \n';
		}
		?>
	</Select>
	<?php echo $this->formSubmit('send','Pokaz statystyki'); ?>
</form>

</div>
-->

<BR><BR>
<h1> Statystyki szczegółowe</h1> 
<p>Informacje o danym pytaniu z ankiety.</p>
