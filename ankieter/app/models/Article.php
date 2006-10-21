<?php
class Article extends Zend_Db_Table
{
   public function findAllWithDateAndTitle($year, $month=null, $day=null, $title=null)
   {
       
		$db = $this->getAdapter();
	   
		$where = $db->quoteInto("DATE_FORMAT( date, '%Y' )= ?", $year);
		if(!empty($month))
		{
			$where.= $db->quoteInto(" AND DATE_FORMAT( date, '%m' )= ?", $month);
			
		}
		if(!empty($day))
		{
			$where.= $db->quoteInto(" AND DATE_FORMAT( date, '%d' )= ?", $day);
			
		}
		if(!empty($title))
		{
			$where.= $db->quoteInto(" AND title = ?", strtr ( $title, '-', ' ' ));
			
		}
		$order = 'date DESC';
		
		$result = $this->fetchAll($where, $order);
		
		return $result;
   }
}
?>