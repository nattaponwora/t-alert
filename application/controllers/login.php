<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Login extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
		$this -> load -> model("login_model");
	}

	public function index($msg = NULL) {
			
		$data['msg'] = $msg;
		$this -> view -> section_view('login_view', $data);
	}

	public function process() {
		
		// Load the model
        // Validate the user can login
        $result = $this->login_model->validate();
        // Now we verify the result
        if(! $result){
	    	$msg = '<div style="vertical-align: middle; padding: 0; background-color: white" class="box"><font color=red>Invalid username or password.</font><br /></div>';
            $this->index($msg); 
        }else{
        	$cookie = array('name' => 'username_cookie', 
							'value' => 'username2', 
							'expire' => '86500',
							'path'   => '/',
			);
			
			$log_user = array('name' => 'log_cookie', 
							'value' => $result, 
							'expire' => '86500',
							'path'   => '/',
			);
			
			$this -> input -> set_cookie($cookie);
			$this -> input -> set_cookie($log_user);
            // If user did validate, 
            // Send them to members area
            redirect('temp');
        }        
	}	
		
	public function error_page() {
		$this -> view -> page_view('error_page');
	}

	public function logout() {
		delete_cookie("username_cookie");
		delete_cookie("log_cookie");
		redirect('/login/', 'refresh');
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
