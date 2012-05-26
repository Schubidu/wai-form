<?php
class LangWriter{
	private $xml = false;
	private $file = "";
	private $lang = "";
	public $value = array();
	public function __construct($file, $lang=""){
		$this->xml = simplexml_load_file($file);
		$this->file = $file; 
		$this->lang = $lang;
		$this->value = $this->getLangArray();
	}
	private function getLangXML(){
		if($this->lang =="") return $this->xml->lang[0]->children();
		foreach($this->xml->lang as $langCont){
			if($langCont['type'] == $this->lang){
				return $langCont->children(); 
			}
		}
	}
	private function getLangArray(){
		$retArray = array();
		foreach($this->getLangXML() as $item){
			$retArray[$item['name'].''] = $item.'';
		}
		return $retArray;
	}
}
?>