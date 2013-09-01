<?php

App::uses('BaseAuthenticate', 'Controller/Component/Auth');

class SimpleAuthenticate extends BaseAuthenticate {
	public function authenticate(CakeRequest $request, CakeResponse $response) {
		$username = $request->data['username'];
		$pwd = $request->data['password'];

		if ($username == 'zd' && $pwd == '123412341234') {
			return array(
				'username' => $username,
			);
		}
		return false;
	}
}

