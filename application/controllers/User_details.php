<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_details extends CI_Controller {

	function __construct() 
	{
        parent::__construct();
        $this->load->database();
		$this->load->model('Global_model', 'gm');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));      
        header('Access-Control-Allow-Origin: *'); //--for cors error-----
    }
	public function index()
	{

		 $args = array(
                'countOrResult' => 'array',
                'sTable' => 'user_details',
                'limit' => 500,
                //'offset' =>'10',
                'sorting' => 'user_id asc',
                //'showQuery' => true,                
            );

		 $user_data = $this->gm->getTablelist($args);
		 //pre($user_data);
		 $data['users'] = $user_data;
		 $data['title'] = "Create Employee";		     
	    $this->load->view('user_details/list',$data);		   		
	}
	public function test_copy()
	{
		$file_name_new = "pic_".rand(11111,99999).".jpg";
		$destination = "upload/test/".$file_name_new;
		$source = FCPATH."upload/test.jpg";
		if( !copy($source, $destination) ) {  
		    //echo "File can't be copied! \n";  
		}  
		else {  
		    //echo "File has been copied! \n";  
		}  
	}	
	public function ajax_update()
	{
		//pre($_POST);die;
		if(isset($_POST['id']))
		{
			$id = $_POST['id'];
			$data['status'] = 0;
			$result = $this->db->where('user_id',$id)->update('user_details',$data);

			$this->test_copy();
			if($result)
			{			
				echo "ok";			
			}	
		}
				
	}	
}
