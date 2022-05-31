<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 /**
  * 
  */
 class M_Home extends CI_Model
 {
 	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
 	
 	public function getDataSensor()
 	{

 		$sql = "SELECT * FROM `tb_tampilan`ORDER BY id_tampilan DESC LIMIT 1";
 		return $this->db->query( $sql )->row();
 	}

 	public function InsertDate($DataInsert)
 	{

 		$this->db->insert('tb_tampilan', $DataInsert);
 		
 	}
 }

?>