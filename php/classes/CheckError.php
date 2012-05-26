<?php
class CheckError{
	private $errorArray = array();
	private $hasPost = false;
	public function __construct(){
		$this->hasPost = ($_POST);
	}
	public function isFilled($field, $fieldName, $errorMessage){
		if($this->hasPost && isset($_POST[$field]) && $_POST[$field] == ''){
			$this->errorArray[$field] = array('name' => $fieldName, 'message' => $errorMessage);
			return false;
		};
		return true;
	}
	public function getMessage($field){
		return $this->errorArray[$field]['message'];
	}
	public function isChecked($field, $fieldName, $errorMessage){
		if($this->hasPost && isset($_POST[$field])){
			$this->errorArray[$field] = array('name' => $fieldName, 'message' => $errorMessage);
			return false;
		};
		return true;
	}
	public function hasError($fieldName = ''){
		if(!$this->hasPost) return false;
		if($fieldName != ''){
			return array_key_exists($fieldName, $this->errorArray);
		}
		return (count($this->errorArray)>0);
	}
	public function getFieldNamesWithErrors(){
		return array_keys($this->errorArray);
	}
	public function getFieldName($field){
		if(is_string($field) && array_key_exists($field, $this->errorArray)) {
			return $this->errorArray[$field]['name'];
		} elseif (is_int($field) && array_key_exists($field, $this->getFieldNamesWithErrors())) {
			$fields = $this->getFieldNamesWithErrors();
			return $fields[$field];
		}
	}
}
?>