<?php

class Admin extends INSIGHT_Admin_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model('product_model', 'product');
	}
	
	public function index() {

		$this->load->view('admin/product/index.view.php', array(
			'products'	=> $this->product->retrieve()
		));
	}
	
	public function retrieve($format = 'table-row', $args = array()) {
		
		// Load all pages into a Recurisve Iterator.
		$page_iterator = new RecursiveArrayIterator($this->page->retrieve_nested());
		
		// Load an empty chunk if there are 0 rows.
		if($page_iterator->count() === 0) {
			return $this->load->view('admin/page/chunks/' . $format . '.empty.chunk.php');
		}
		
		// Iterate over children.
		iterator_apply($page_iterator, array($this, '_render'), array($page_iterator, 0, $format, $args));
	}


	public function create() {
		
		if($this->form_validation->run('admin-product-form')) {
			$product_id = $this->product->create();
			return redirect('admin/product');
		}
		
		$this->load->view('admin/product/create.view.php', array(
			'categories' 	=> $this->category->retrieve()
		));
	}


	public function update($product_id) {
		
		if($this->form_validation->run('admin-product-form')) {
			$this->product->update($product_id);
			return redirect('admin/product');
		}

		$this->load->view('admin/product/update.view.php', array(
			'categories' 	=> $this->category->retrieve(),
			'product' 		=> $this->product->retrieve_by_id($product_id)
		));
	}
	

	public function delete($product_id) {
		
		if(!$this->product->delete($product_id))
			show_error('Could not delete page.');
			
		return redirect('admin/product');
	}
	
	
	public function upload() {
		
		$upload = array(
			'upload_path'	=> 'uploads',
			'allowed_types'	=> 'pdf',
			'overwrite'		=> false,
			'encrypt_name'	=> false,
			'remove_spaces'	=> true
		);
		
		$success = true;
		$this->load->library('upload', $upload);
		if(!$this->upload->do_upload('upload')) {
			$success = false;
		}
		
		
		echo json_encode(array('files' => $_FILES, 'success' => $success, 'errs' => $this->upload->display_errors(), 'path' => '/uploads/example.pdf', 'data' => $this->upload->data()));
	}
	
}