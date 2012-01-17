<?php

class Page extends INSIGHT_HMVC_Controller {
	
	public function __construct() {
		
		parent::__construct();
		
		$this->load->model('page_model', 'page');
	}
	
	
	/**
	 * index
	 *
	 * @return void
	 */
	public function index() {

		// Check to see if this page exists.
		if(!$page = $this->page->load($this->uri->uri_string())) {
			return $this->_404();
		}
		
		// Protected page?
		// @TODO Permissions module?
		
		// Select template.
		// @TODO This needs to come from the metadata.
		$page_template = $page->slug() == '/' ? 'home' : 'inner';
		
		// Dispatch page data to the required template.
		$this->output($page_template, array('page' => $page));
	}


	/**
	 * output
	 *
	 * @param string $template 
	 * @param array $data 
	 * @return void
	 */
	public function output($template, $data = array()) {
		$this->load->view('templates/' . $template . '.template.view.php', $data);
	}


	/**
	 * _404
	 *
	 * Method to run upon a route not matching any
	 * page within the system.
	 * 
	 * @access public
	 * @return void
	 */
	public function _404() {

		// Send out a 404 header.
		$this->output->set_status_header('404');

		// Load the 404 view.
		$this->load->view('common/errors/404.view.php', array(
			'request'	=> $this->uri->uri_string()
		));
	}
}