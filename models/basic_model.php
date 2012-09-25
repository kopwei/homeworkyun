<?php
require_once '../dbc.php';

class CBasicModel
{
	protected $id;

	public function __construct($id)
	{
		$this->id = $id;
	}

	public abstract function read_data_from_db();

}