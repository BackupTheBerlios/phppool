 <script type="text/javascript">//<![CDATA[
function serialize(s)
{
	serial = $.SortSerialize(s);
	
	$.post("/ankieter/ajaxswapanswer",{
  		name: serial.hash,
  		pool: 1
	});
}
        //]]></script>
<div id="editPoolHead"> 
<a href="/ankieter/">Ankiety</a> / 
<a href="/ankieter/edytuj/ankieta/<?php echo $this->poolId; ?>"><?php echo $this->pool->nazwa ?></a> / 
<?php echo $this->question->pytanie; ?>
</div>
<div id="editPoolBox">





<b>Typ:</b>
<?php echo $this->questionsVariants[$this->question->idTypOdpowiedzi]; ?>




</div>
 <div id="editPoolBox2">


<form action="/ankieter/dodajodpowiedz/ankieta/<?php echo $this->poolId; ?>/pytanie/<?php echo $this->questionId; ?>" method="post">
	<label for="pytanie_tresc">Treść odpowiedzi</label>	
	<?php echo $this->formText('odpowiedz_tresc', null, array('id'=>'ankieta_opis', 'class'=>'input_classic')); ?>

<?php echo $this->formSubmit('send','Dodaj wariant odpowiedzi'); ?> 
</form>

</div>
  
  


</div>



<div>
<ul class="sortable" id="sort2">
<?php
$position = 1;
foreach ($this->variants as $row) {
?>
	<li class="sortableitem" id="<?php echo $row->idWariantOdpowiedzi; ?>">
	
	<div class="dupa">

	<a href=/ankieter/usunodpowiedz/ankieta/<?php echo $this->poolId; ?>/pytanie/<?php echo $row->idPytanie; ?>/odpowiedz/<?php echo $row->idWariantOdpowiedzi; ?>>
	<img src=/images/delete_new.png border=0 title="usun odpowiedz"></a>
	</div>
	<?php echo $row->opis; ?>
	
	</li>
<?php	
	$position++;
}
?>	
</ul>
</div>

