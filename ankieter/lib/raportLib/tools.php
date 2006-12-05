<?php
	function SaveToFile($path, $dane) {
		$plik=fopen($_SERVER["DOCUMENT_ROOT"]."/".$path,'w');
		$i=0;
		foreach($dane as $biezacy) {
   			$linia="".++$i.".\t".$biezacy."\n\r";
			fwrite($plik, $linia);
		}
		fclose($plik);
		return 0;
	}
?>
