<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class World_model extends CI_Model {

   function getCitiesData($postData=null){

     $response = array();

     ## Read value
     $draw = $postData['draw'];
     $start = $postData['start'];
     $rowperpage = $postData['length']; // Rows display per page
     $columnIndex = $postData['order'][0]['column']; // Column index
     $columnName = $postData['columns'][$columnIndex]['data']; // Column name
     $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
     $searchValue = $postData['search']['value']; // Search value

     ## Search 
     $searchQuery = "";
     if($searchValue != ''){
        //$searchQuery = " (first_name like '%".$searchValue."%' or last_name like '%".$searchValue."%' or username like'%".$searchValue."%' or city like'%".$searchValue."%' or department like'%".$searchValue."%') ";
        $searchQuery = " (c.name like '%".$searchValue."%') ";
    }

     $table = "cities c left join states s on s.id = c.state_id ";

     ## Total number of records without filtering
     $this->db->select('count(c.id) as allcount');
     $records = $this->db->get($table)->result();
     $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
     
     $this->db->select('count(c.id) as allcount');
     if($searchQuery != '')
     {
        $this->db->where($searchQuery);
     }
        
     $records = $this->db->get($table)->result();
     $totalRecordwithFilter = $records[0]->allcount;
        
     ## Fetch records
     $this->db->select('c.name as city_name,s.name as state_name');
     if($searchQuery != '')
     {
        $this->db->where($searchQuery);
     }        
     $this->db->order_by($columnName, $columnSortOrder);
     $this->db->limit($rowperpage, $start);
     $records = $this->db->get($table)->result();

     $data = array();

     foreach($records as $record ){

        $data[] = array( 
           "city_name"=>$record->city_name,
           "state_name"=>$record->state_name,
           //"first_name"=>$record->first_name,
           //"last_name"=>$record->last_name,
           //"city"=>$record->city,
           //"department"=>$record->department,
           //"gender"=>$record->gender
        ); 
     }

     ## Total number of record with filtering
     //$totalRecordwithFilter = count($data);

     ## Response
     $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
     );

     return $response; 
   }

}