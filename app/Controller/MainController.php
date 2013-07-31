<?php
class MainController extends AppController {
	public function index()
	{
		$this->set('body_class', 'zds-index');
		// code...
	}

	public function signup()
	{
		$this->set('body_class', 'zds-signup');

	}

	public function honour()
	{
		$this->set('body_class', 'zds-honour');
	}

	public function video()
	{
		$this->set('body_class', 'zds-video');
	}

}
