<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class World extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->database();
		$this->load->model('World_model', 'dm');

        header('Access-Control-Allow-Origin: *'); //--for cors error-----
    }
	public function index()
	{		
		$this->load->view('World/index');
	} 
    public function worldList()
    {     
        // POST data
        $postData = $this->input->post();
   
        // Get data
        $data = $this->dm->getCitiesData($postData);   
        echo json_encode($data);
     }
    
}
