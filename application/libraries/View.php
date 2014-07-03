<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_View {
	protected $CI;

	public function __construct($rules = array())
	{
		$this->CI =& get_instance();
	}

	public function page_view($view_url, $data=null)
	{
		$this->CI->load->view('header');
		
		$this->CI->load->view('menu');
		
		if( $data == null ){
			$this->CI->load->view($view_url);
		}else{
			$this->CI->load->view($view_url, $data);
		}
		$this->CI->load->view('footer');
	}
	
	public function section_view($view_url, $data=null)
	{
		$this->CI->load->view('header');
		
		if( $data == null ){
			$this->CI->load->view($view_url);
		}else{
			$this->CI->load->view($view_url, $data);
		}
		$this->CI->load->view('footer');
	}
	
	public function p( $array ){
		echo "<pre>";
		print_r($array);
		echo "</pre>";
	}
}
// END Form View Class

/* End of file View.php */
/* Location: ./application/libraries/View.php */
