<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatable extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->database();
		$this->load->model('Datatable_model', 'dm');

        header('Access-Control-Allow-Origin: *'); //--for cors error-----
    }
	public function index()
	{		
		$this->load->view('Datatable/index');
	}
    public function empList(){
     
     // POST data
     $postData = $this->input->post();

     // Get data
     $data = $this->dm->getEmployees($postData);

     echo json_encode($data);
  }
	
	public function getDatatableAjax()
    {   
        //pre($_POST);die;      
        
        $total_all_rows = $this->um->getRowCount();
        //echo $total_all_rows;die;
        $columns = array(
            1 => 'u.id',
            2 => 'full_name',
            3 => 'mobile_no',
            4 => 'email',
            5 => 'country',
            6 => 'state',
            7 => 'city',
            8 => 'created_date',
        );
        $where = "WHERE 1=1 ";

        if(isset($_POST['search']['value']))
        {
            if(!empty($_POST['search']['value'])){
            $where = "WHERE ";
            $search_value = $_POST['search']['value'];
            $where .= " full_name like '%".$search_value."%'";
            $where .= " OR mobile_no like '%".$search_value."%'";
            $where .= " OR email like '%".$search_value."%'";
            $where .= " OR country like '%".$search_value."%'";
            $where .= " OR state like '%".$search_value."%'";
            $where .= " OR city like '%".$search_value."%'";

            //$where .= " OR birth_date like '%".date('Y-m-d',strtotime($search_value))."%'";          
            $args['where'] = $where;
            }
        }

        //--------------------------------------

     

        if(isset($_POST['daterange']) && !empty($_POST['daterange']) && empty($_POST['search']['value']))
        {
            $datarange = explode("-", $_POST['daterange']);
            //pre($datarange);
            $from = date('Y-m-d', strtotime($datarange[0]));
            $to = date('Y-m-d', strtotime($datarange[1]));
            //$where  .=" AND DATE(created_date) BETWEEN '".$from."' AND  '".$to."' ";
            $where  =" WHERE DATE(created_date) BETWEEN '".$from."' AND  '".$to."' ";
        }

        //---------convert comma separeted ids into array------

        $ids = array();

        if(isset($_POST['ids']))
        {
            $ids = explode (",", $_POST['ids']); 
        }  
       
        //--------------------------------------

        //pre($_POST['order']);die;

        $order_clause = "order by ";
        if(isset($_POST['order']))
        {
            $column_name = $_POST['order'][0]['column'];
            $order = $_POST['order'][0]['dir'];            
            $args['sorting'] = " ".$columns[$column_name]." ".$order." ";
            $order_clause .= " ".$columns[$column_name]." ".$order." ";
        }
        else
        {           
            $args['sorting'] = "id asc";
            $order_clause .= "u.id desc";
        }

        if($_POST['length'] != -1)
        {
            $start = $_POST['start'];
            $length = $_POST['length'];
            $args['limit'] = $length;
            $args['offset'] = $start;
            $limit = $length;
            $offset = $start;
        }       

        $sql = "select u.*,l.* ,u.id as user_id from user u left join location l on l.id=u.loc_id ".$where." ".$order_clause." limit ".$limit." OFFSET ".$offset;
        
        //echo $sql;
        $result = $this->db->query($sql);
        
        $count_rows = $result->num_rows();
        //echo "count is ".$count_rows;die;
        if($result->num_rows() > 0)
        {
            $result = $result->result_array();
            //print_r($result);die;
        

        $list = $result;  
        //print_r($list);die;
        //$count_rows = count($result);
       
       
        $data = array();
        foreach($list as $row)
        {            
            $sub_array = array();

            $checked_att = "";

            if(in_array($row['user_id'],$ids))
            {
                $checked_att = "checked";
            }

            $sub_array[] = '<input type="checkbox" class="myCheckBoxGroup" data-id="'.$row['user_id'].'" '.$checked_att.'>';
            $sub_array[] = $row['user_id'];
            $sub_array[] = $row['full_name'];
            $sub_array[] = $row['mobile_no'];
            $sub_array[] = $row['email'];
            $sub_array[] = $row['country'];
            $sub_array[] = $row['state'];
            $sub_array[] = $row['city'];
            $sub_array[] = date('d-M-Y',strtotime($row['created_date']));
            $file_name = $row['file_name'];
            if(empty($row['file_name']))
            {
                $file_name = 'no_image.jpg';
            } 
            $sub_array[] = '<img src="'.base_url().'upload/profile_pic/'.$file_name.'" class="" alt="" height="100" width="100">';   
            $sub_array[] = '<a href="'.base_url().'/User/edit_user/'.$row['user_id'].'" data-id="'.$row['user_id'].'"  class="btn btn-info btn-sm editbtn" >Edit</a> <button data-id="'.$row['user_id'].'"  class="btn btn-danger btn-sm deleteBtn" >Delete</button>';
            $data[] = $sub_array;
        }

        $output = array(
            'draw'=> intval($_POST['draw']),
            'iTotalRecords' =>intval(count($data)) ,
            'iTotalDisplayRecords'=> intval($total_all_rows),
            'data'=>$data,
            'sql' => $sql,
        );
        echo  json_encode($output);
        }
        else
        {
            $output = array(
                'draw'=> intval($_POST['draw']),
                'recordsTotal' =>0 ,
                'recordsFiltered'=>  0,
                'data'=> array(),
                'sql' => $sql,
            );
            echo  json_encode($output);
        }   
    }
    
}
