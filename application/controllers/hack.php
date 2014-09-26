<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Hack extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->load->library('email');
		
		$conf['protocol'] = 'smtp';
		$conf['smtp_host'] = 'tls://smtp.gmail.com';
		$conf['smtp_port'] = 587;
		$conf['smtp_user'] = 'cpr.itmaximo@gmail.com';
		$conf['smtp_pass'] = 'rtladmin';
		$conf['charset'] = 'utf-8';
		$conf['mailtype'] = 'text';
		$conf['newline'] = '\r\n';
		$conf['crlf'] = '\r\n';
		
		$this->email->initialize($conf);
		$this->email->from('cpr.itmaximo@gmail.com', 'CELO');
		$this->email->to('nattapon.wora@gmail.com');
		$this->email->subject('Hello');
		$this->email->message('Na Na Na Na Ma');
		$this->email->send();
		echo $this->email->print_debugger();
	}

}
