<?php
class MainController extends AppController {
	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'zd';
	}

	public function index()
	{
		$this->set('body_class', 'zds-index');
		$this->set('page', 1);
		// code...
	}

	public function signup()
	{
		$this->set('body_class', 'zds-signup');
		$this->set('page', 8);

	}

	public function honour()
	{
		$this->set('body_class', 'zds-honour');
		$this->set('page', 3);
		$collection = $this->get_collection($this->db_name, $this->honour_collection);
		$years = $collection->distinct('year');
		rsort($years);
		$honours = array();
		foreach ($years as $year) {
			$cur_year = $collection->find(array('year' => $year));
			$honours[$year] = $cur_year;
		}
		$this->set('honours', $honours);
		$this->set('years', $years);
	}

	public function video()
	{
		$this->set('body_class', 'zds-video');
		$this->set('page', 3);
	}

}
