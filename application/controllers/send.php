<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Send extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this -> load -> model("temp_model");
	}

	public function data($id, $temp) {
		$this -> temp_model -> inserttemp($id, $temp);
	}

}
