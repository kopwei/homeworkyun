<?php
require_once 'basic_model.php'

class CUser extends CBasicModel
{
	const GENDER_UNKNOWN = 0;
	const GENDER_MALE = 1;
	const GENDER_FEMALE = 2;
	
	private $name;
	private $surveyIdArray;
	private $gender;

	public function __construct($id)
	{
		parent::__construct($id);
		$this->surveyIdArray = array();
	}

	public function read_data_from_db()
	{
		//TODO:
		$resource = mysql_query("select * from users where id = $this->id ", $link);
		$row = mysql_fetch_assoc($resource)
		$this->name = $row['user_name'];
		$this->gender = $row['gender'];

		$resource = mysql_query("select id from survery_paper where author_id = $this->id");
		while ($row = mysql_fetch_assoc($resource)
		{
			$this->surveyIdArray[] = $row['id'];
		}

	}	

}