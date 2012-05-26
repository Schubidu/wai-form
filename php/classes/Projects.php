<?php
class Projects{
	private $xml = false;
	private $file = "";
	private $lang = "";
	public $value = array();
	public $project = array();
	public function __construct($file, $lang=""){
		$this->xml = simplexml_load_file($file);
		$this->file = $file; 
		$this->lang = $lang;
		$this->project = $this->getProjectArray();
	}
	private function getLangXML($project){
		if($this->lang =="") return $project->lang[0]->children();
		foreach($project->lang as $langCont){
			if($langCont['type'] == $this->lang){
				return $langCont->children(); 
			}
		}
	}
	private function getLangArray($project){
		$retArray = array();
		foreach($this->getLangXML($project) as $item){
			$retArray[$item['name'].''] = $item.'';
		}
		return $retArray;
	}
	private function getProjectArray(){
		foreach($this->xml->project as $project){
			$retArray[$project['name'].''] = $this->getLangArray($project);
		}
		return $retArray;
	}
}
?>