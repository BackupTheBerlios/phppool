 <script type="text/javascript">//<![CDATA[
function serialize(s)
{
	serial = $.SortSerialize(s);

	$.post("/ankieter/ajaxswap",{
  		hash: serial.hash
	});
}
        //]]></script>

<div id="editPoolHead"> 
<a href="/ankieter/">Ankiety</a> / 
<?php echo $this->pool->nazwa ?>

</div>
<div id="editPoolBox">

<?php echo $this->pool->opis ?>
<br>



</div>

<h1 class="edit" id="header_1">Foo</h1>
<h2 class="edit" id="header_2">Bar</h2>
<div class="edit_area" id="paragraph_1">Lorem ipsum</div>
<div id="editPoolBox2">
<script type="text/javascript">
$(document).ready(function() {
    $(".edit").editable("http://www.example.com/save.php", { 
        indicator : "Saving...",
        type : 'text'
    });
    $(".edit_area").editable("http://www.example.com/save.php", { 
        indicator : "<img src='img/indicator.gif'>",
        type : 'textarea'
    });
});
</script>
<form action="/ankieter/dodajpytanie/ankieta/<?php echo $this->poolId; ?>" method="post">
	<label for="pytanie_tresc">Treść pytania</label>	
	<?php echo $this->formText('pytanie_tresc', null, array('id'=>'ankieta_opis', 'class'=>'d')); ?>
	<label for="pytanie_typ">Typ odpowiedzi</label>	
	<select name="pytanie_typ">
	<?php
	foreach ($this->questionsVariants as $key =>$value) {
		echo '<option value="'.$key.'">'.$value.'</option>'."\n\t";
	}
	?>
	</select>


<?php echo $this->formSubmit('send','Dodaj pytanie'); ?> 
</form>

</div>


 
 
<div>
<ul class="sortable" id="sort1">
<?php
$position = 1;
foreach ($this->questions as $row) {
?>
	<li class="sortableitem" id="<?php echo $row->idPytanie; ?>">
	
	<div class="dupa">
	<a href=/ankieter/odpowiedzi/ankieta/<?php echo $this->poolId; ?>/pytanie/<?php echo $row->idPytanie; ?>>
	<img src=/images/edit.png border=0 title="dodaj odpowiedzi" style="margin-right:5px;">
	</a>
	<a href=/ankieter/usunpytanie/ankieta/<?php echo $this->poolId; ?>/pytanie/<?php echo $row->idPytanie; ?>>
	<img src=/images/delete_new.png border=0 title="usun pytanie"></a>
	</div>
	<?php echo $row->pytanie; ?>
	
	</li>
<?php	
	$position++;
}
?>	
</ul>
</div>


  
  




