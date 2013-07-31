<?php
class AdminController extends AppController {


	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'admin';
	}

	public function index()
	{
	}

	public function honour()
	{
		$collection = $this->getCollection($this->db_name, $this->honour_collection);
		$years = $collection->distinct('year');
		$honours = array();
		foreach ($years as $year) {
			$cur_year = $collection->find(array('year' => $year));
			$honours[$year] = $cur_year;
		}
		$this->set('honours', $honours);
		$this->set('years', $years);
	}
}
