<?php
class FileException extends Exception{}
/**
* File
*
* Klasa  dostarcza podstawowe mechanizmy zarządzania plikami,
* takie jak wczytywanie, zapisywanie, upload, ściąganie
* W celu lepszego zabezpieczenia katalog z plikami upload/download
* powinien znajdować się poza strefą widoczna dla użytkowników
* @example 	$file = new Hamster_File();
			$file->setDir('./download/');
			$file->setFileName('index.html');
			echo $file->getFileContent();
			$file->downloadFile();		
* @autor Hubert marzec
* @package Hamster
* @todo zabezpieczenie przed uploadem niebezpiecznych plików(zawierających kod php)
*/

class Hamster_File{
    /**
     * Przecowuje nazwę pliku
     * 
     * @var string
     */
    private $sFileName;
    /**
     * Przechowuje ścieżkę to katalogu
     * 
     * @var string
     */
	private $sDir = './'; 
	/**
	  * Zwraca zawartość pliku w postaci ciągu znaków
	  * 
	  * @return string
	  */
	public function getFileContent()
	{
	    if(is_readable($this->getFilePath()) == false) {
       	    throw new  FileException ('Podany plik nie istnieje');
		}
		return file_get_contents($this->getFilePath());
	}
	/**
	  * Zapisuje dane do pliku (nadpisuje istniejący plik)
	  * 
	  * @return void
	  */
	public function putFileContent($data)
	{

		if (is_writable($this->getFilePath()) == false) {
            throw new  FileException ('Nie można zapisać pliku');
		}
	    $f=fopen($this->getFilePath(), 'w');
        fwrite($f, $data);
        fclose($f);
	}
	/**
	  * Wysyła do przeglądarki odpowiednie nagłówki i powoduje
	  * ściąganie danego pliku
	  * 
	  * @return void
	  */
	public function downloadFile()
	{
		if(file_exists($this->getFilePath()) == false) {
       	    throw new  FileException ('Podany plik nie istnieje');
		}
		$ext = explode('.', $this->sFileName);
		$extension = $ext[count($ext)-1];
		switch(strtolower($extension)) {
       	    case 'txt': $type = 'text/plain'; break;
       		case "pdf": $type = 'application/pdf'; break;
            case "exe": $type = 'application/octet-stream'; break;
            case "zip": $type = 'application/zip'; break;
            case "doc": $type = 'application/msword'; break;
            case "xls": $type = 'application/vnd.ms-excel'; break;
            case "ppt": $type = 'application/vnd.ms-powerpoint'; break;
            case "gif": $type = 'image/gif'; break;
            case "png": $type = 'image/png'; break;
            case "jpg": $type = 'image/jpg'; break;
            case "jpeg": $type = 'image/jpg'; break;
            case "html": $type = 'text/html'; break;
            default: $type = 'application/force-download';
		}
		header("Pragma: public"); // required
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false); // required for certain browsers 
		header("Content-Transfer-Encoding: binary");
		header("Content-Type: " . $type);
		header("Content-Length: " . filesize($this->sFilePath));
		header("Content-Disposition: attachment; filename=\"" . $this->sFileName . "\";" );
	}
	/**
	  * Kopiuje dany plik do bieżącego katalogu, jeśli dany plik już istnieje
	  * zostaje nadpisany
	  *
	  * @param array $uploadFile postaci $_FILES['nazwa_pola_formualrza']
	  * @param string $newFileName kiedy chcemy nadać inną nazwe pliku niż nazwa pliku uplodowanego
	  */
	public function uploadFile($uploadedFile, $newFileName = null)
	{
		if (isset($uploadedFile) == false OR $uploadedFile['error'] == UPLOAD_ERR_NO_FILE) {
        	throw new  FileException ('Brak zdefiniowanego pliku');
        }
		if ($uploadedFile['error'] != UPLOAD_ERR_OK) {
        	throw new  FileException ('Wystąpił błąd podczas przesyłania pliku');
		}
		if ($newFileName) {
			$pathToFile = $this->sDir.$newFileName;
			$this->sFileName = $newFileName;
		} else {
			$pathToFile = $this->sDir.$uploadedFile['name'];
			$this->sFileName = $uploadedFile['name'];
		}
		move_uploaded_file($uploadedFile['tmp_name'], $pathToFile);
	}
	/**
	  * Kasuje dany plik
	  * 
	  * @return bool
	  */
	public function deleteFile()
	{
		$result = @unlink($this->getFilePath());

		if ($result == false) {
        	throw new  FileException ('Nie można skasować danego pliku');
		} else {
        	return true;
		}
	}
	/**
	  * Sprawdza czy istnieje dany plik
	  * 
	  * @return bool
	  */
	public function isFileExists()
	{
		if (file_exists($this->getFilePath())) {
			return true;
		}
		return false;	
	}
	/**
	  * Ustawia ścieżke katalogu
	  * 
	  * @param string $dir
	  */
	public function setDir($dir)
	{
	    $this->sDir = $dir;
		
	}
	/**
	  * Ustawia nazwe pliku
	  * 
	  * @param string $fileName
	  */
	public function setFileName($fileName)
	{
		$this->sFileName = $fileName;
		
	}
	/**
	 * Zwraca pełną ścieżkę do pliku
	 */
	public function getFilePath() 
	{
		return $this->sDir.'/'.$this->sFileName;
	}
	/**
	 * Ustawia pełną ścieżkę do pliku
	 * 
	 * @param string $path
	 * @todo dostajemy /root/ziomale/laska.jpg i dzielimy na sDir i sFileName
	 */
	public function setFilePath($path)
	{
		
	}
}
?>