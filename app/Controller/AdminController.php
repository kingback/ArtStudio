<?php
class AdminController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'admin';
	}

	public function index()
	{
	}

	public function addHonour()
	{
		if ($this->request->is('post')) {
			$collection = $this->get_collection($this->db_name, $this->honour_collection);
			$name = $this->_get_argument('name');
			$school = $this->_get_argument('school');
			$year = $this->_get_argument('year');
			// add a record
			$document = array('name' => $name, 'school' => $school, 'year' => $year);
			$collection->insert($document);
		} 
		$this->redirect('/admin/honour');
	}

	public function deleteHonour()
	{
		if ($this->request->is('post')) {
			$collection = $this->get_collection($this->db_name, $this->honour_collection);
			$id = $this->_get_argument('id');
			$res = $collection->remove(array('_id' => new MongoId($id)));
		}
		$this->redirect('/admin/honour');
	}

	public function honour()
	{
		$collection = $this->get_collection($this->db_name, $this->honour_collection);
		$honours = $collection->find()->sort(array('year' => 1));
		$this->set('honours', $honours);
	}
}
