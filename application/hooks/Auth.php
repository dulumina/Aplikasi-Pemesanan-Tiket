<?php

class Auth
{

	public function check()
	{
		
		$CI = &get_instance();
		$CI->load->library('acl');
		$CI->load->helper('url');
		$CI->load->config('acl');
		$rule = $CI->config->item('acl');
		$path = $CI->uri->segment(1);
		$group = null;
		
		if($CI->session->userdata('logged_in')) {
			$group = $CI->session->userdata('logged_in')['level'];
		};
		
		if(in_array($path, array_keys($rule))){
			$this->checkRule($rule, $path, $group);
		} else {
			return true;
		}

	}

	private function checkRule($rule, $path, $group = null)
	{
		if(isset($group)) {
			if($rule[$path][$group]) {
				return true;
			}
		} 
		redirect('HomeUser/lihat');

	}

}
