<?php
require_once 'basic_model.php'

class CSelectQuestion extends CBasicModel
{
	const SINGLE_SELECT = 1;
	const MULTI_SELECT = 2;

	public $title;
	public $type;

	public function __construct($id)
	{
		parent::__construct($id);
	}

	public function read_data_from_db()
	{
		//TODO:
	}	

}