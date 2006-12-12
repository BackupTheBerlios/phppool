<style type="text/css">
  .tabelka {position: relative; left: 140px; top: 0px; border-collapse: collapse; }
  td {  border-bottom: 1px solid #ebebe4;  font-size: 14; padding: 1px 38px;}
  thead td, tfoot td { background-color: #ebebe4;}
  thead td { border-bottom: 1px solid #c0c0c0; border-top: 2px solid #c0c0c0; padding: 10px 45px;  font-size: 17;}
  tfoot td { border-top: 2px solid #c0c0c0; border-bottom: 1px solid #c0c0c0 }
  tfoot td a { display: block; padding: 2px 2px; border: 1px outset; float: left; border: 1px solid #c0c0c0; 	background-color: #ffffff; color: #000000; text-decoration: none; margin-right: 2px }
</style>

    <div class="tabelka">
   	<table>
	    <thead>
	        <tr>
		  <td>Lp.</td>
		  <td>e-mail</td>
		  <td>usuń</td>
		<?php $num = $this->escape($this->offset); ?>
		</tr>
	   </thead>     
     <?php foreach($this->respondent as $rows) : ?>
		<tr>
			<td><?php echo ++$num; ?></td>
			<td><?php echo $this->escape($rows->eMail);?></td>
			<td> 
   <a href="/respondenci/usun/id/<?php echo $this->escape($rows->idRespondent);?>/page/<?php echo $this->escape($this->page);?>">  					<img src=/images/delete.png border=0 title="usuń"> </a></td>	
		</tr>
    <?php endforeach; ?>
      <tfoot>
    <tr>
      <td colspan="4">
    		<span style="float: left; margin-top: 2px">strona <?php echo $this->escape($this->page);?>/<?php 			echo $this->escape($this->subpage);?></span>
        	<span style="float: right">
	  <a href="/respondenci/edytuj/page/1" title="Pierwsza strona">&laquo;&laquo;</a>
          
		<?php if( 1 < $this->escape($this->page)) { ?>
	<a href="<?php echo '/respondenci/edytuj/page/'.$this->escape($this->page - 1);?>" title="Poprzednia strona">&laquo;</a>
		<?php } ?>

       		<?php if($this->escape($this->subpage) > $this->escape($this->page)) { ?>   
	<a href="<?php echo '/respondenci/edytuj/page/'.$this->escape($this->page + 1);?>" title="Następna strona">&raquo;</a>
		<?php } ?>
          
	<a href="<?php echo '/respondenci/edytuj/page/'.$this->escape($this->subpage);?>" title="Ostatnia strona">&raquo;&raquo;</a>
        
	</span>
      </td>
    </tr>
  </tfoot>   

	</table>
	<br />
   </div>
<br />
<br />