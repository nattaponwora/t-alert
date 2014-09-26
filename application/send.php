<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Send extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this -> load -> model("temp_model");
	}

	public function data() {
		$this -> temp_model -> test();
		$id = $_GET['id'];
		$temp = $_GET['temp'];
		$this -> temp_model -> inserttemp($id, $temp);
		
	}
	
	public function data_ci($id, $temp) {
		$this -> temp_model -> inserttemp($id, $temp);
	}
	
	public function test(){
		echo 'here';
		$this -> temp_model -> test();
	}

}
