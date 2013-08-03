<?php
class AdminapiController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->autoRender = false;
		$this->response->header('Content-Type: text/javascript');
	}

	public function afterFilter() {
		parent::afterFilter();
		$this->response->send();
		exit();
	}

	public function deleteHonour()
	{
		if ($this->request->is('post')) {
			$collection = $this->get_collection($this->db_name, $this->honour_collection);
			$id = $this->_get_argument('id');
			$res = $collection->remove(array('_id' => new MongoId($id)));
		}
	}

	public function uploadImage()
	{
		$file = $this->save_pic('Filedata');
		$info['file'] = $file;
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
			 header('Access-Control-Allow-Origin: *');
			$this->response->send();
			exit();
		}
		echo json_encode($file);
	}

	public function uploadImages()
	{
		$files = array();
		for ($i = 0; $i < count($_FILES['pics']['name']); $i++) {
			$filename = $_FILES['pics']['tmp_name'][$i];
			$type = $_FILES['pics']['type'][$i];
			$files[] = $this->save_file($filename, $type);
		}

		$info['files'] = $files;
		echo json_encode($info);
	}

	public function deleteImages()
	{
		$ids_str = $this->_get_argument('ids');
		$ids = explode(',', $ids_str);

		var_dump($ids);
		$grid = $this->get_grid_fs();
		foreach ($ids as $id) {
			$res = $grid->delete(new MongoId($id));
			var_dump($res);
		}
	}
}
