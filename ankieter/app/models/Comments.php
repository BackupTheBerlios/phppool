<?php
class Comments extends Zend_Db_Table
{
	public function findAllArticleComments($articleId)
	{
		$db = $this->getAdapter();
		$where = $db->quoteInto("article_id = ?", $articleId);
		return $this->fetchAll($where);
	}
}
?>
