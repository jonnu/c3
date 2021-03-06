<?php

class Image_Model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function retrieve_by_id($image_id) {
		
		$this->db->select('i.*');
		$this->db->from('image i');
		$this->db->select('t.image_id as image_thumbnail_id');
		$this->db->select('t.image_path as image_thumbnail_path');
		$this->db->join('image t', 't.image_parent_id = i.image_id', 'left');
		$this->db->where('i.image_id', $image_id);
		$image_result = $this->db->get();
		
		if($image_result->num_rows() !== 1) {
			return false;
		}
		
		return $image_result->row(0, 'Image_Object');
	}
	
	
	public function delete($image_id, $unlink = true) {
		
		if(!$image = $this->retrieve_by_id($image_id)) {
			return false;
		}
		
		// Delete Image & any thumbnails.
		$this->db->from('image');
		$this->db->where('image_id', $image_id);
		$this->db->or_where('image_parent_id', $image_id);
		$this->db->delete();
		
		// Remove any resource links.
		$this->db->from('image_link');
		$this->db->where('link_image_id', $image_id);
		$this->db->delete();
		
		// Remove the physical file(s)?
		$message = 'but the physical files were kept';
		if($unlink) {
			unlink($image->path(true));
			unlink($image->thumbnail(true));
			$message = 'and physical files removed';
		}
		
		$this->session->set_flashdata('admin/message', 'Image & thumbnails removed (' . $message . ').');
		return true;
	}
}

class Image_Object {
	
	public function id() {
		return $this->image_id;
	}
	
	public function type() {
		return $this->image_type;
	}
	
	public function name() {
		return $this->image_name;
	}
	
	public function size() {
		return $this->image_size;
	}
	
	public function path($absolute = false) {
		return $absolute ? realpath(FCPATH . $this->path(false)) : $this->image_path;
	}
	
	public function alt() {
		return $this->image_alt;
	}
	
	public function width() {
		return $this->image_width;
	}
	
	public function height() {
		return $this->image_height;
	}
	
	public function dimensions() {
		return array($this->width(), $this->height());
	}
	
	public function thumbnail($absolute = false) {
		
		if(!$this->has_thumbnail() || $this->is_thumbnail())
			return false;
			
		return $absolute ? realpath(FCPATH . $this->thumbnail(false)) : $this->image_thumbnail_path;
	}
	
	public function has_thumbnail() {
		return isset($this->image_thumbnail_id) && is_numeric($this->image_thumbnail_id);
	}
	
	public function is_thumbnail() {
		return !is_null($this->image_parent_id) && $this->type() == 'THUMBNAIL';
	}
	
	public function html() {
		//$this->image_thumbnail_path; //$this->image_path;
		
		if($this->has_thumbnail()) {
			$image = sprintf('<img src="%s" alt="%s">', $this->image_thumbnail_path, $this->alt());
			$image = sprintf('<a href="%2$s" class="image-lightbox" title="%3$s">%1$s</a>', $image, $this->image_path, $this->alt());
		}
		else {
			$image = sprintf('<img src="%s" alt="%s">', $this->path(), $this->alt());
		}
		
		return $image;
	}
}