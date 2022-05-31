<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 /**
  * 
  */

  class M_History extends CI_Model{


  public function GET_ALL()
  {

       // $this->db->select('*');
       // $this->db->from('tb_tampilan');
       // $this->db->order_by('id_tampilan','desc');
       // $query = $this->db->get();
       // return $query;

    $this->db->order_by('id_tampilan', 'DESC');
  	return $this->db->get('tb_tampilan')->result();
  	
    
    }

  }

 ?>