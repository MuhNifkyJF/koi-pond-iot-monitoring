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

		return $this->db
			->order_by('id_tampilan', 'DESC')
			->limit(1)
			->get('tb_tampilan')
			->row();
 	}

 	public function InsertDate($DataInsert)
 	{

		return $this->db->insert('tb_tampilan', $DataInsert);
 	}
 }

?>
