<?php

class Main extends INSIGHT_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		echo 'main within standard app - overriding page module?';
	}
}