<?php
class Pytania extends Zend_Db_Table{
	protected $_primary = 'id_pytanie';
	public function findAllWithAnkietaId($id)
	{
		$db = $this->getAdapter();
		$where = $db->quoteInto("id_ankieta= ?", $id);
		$order = 'kolejnosc';
		return $this->fetchAll($where, $order);
	}
}
?>
