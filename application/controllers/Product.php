<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Product extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Product_model');
		$this->load->helper(array('form'));
	}

	function index()
	{
		$this->load->view('product_view');
	}
	
	function list_product()
	{
		$query_product = $this->Product_model->get_product();
		$output = new stdClass();
		$draw = $this->input->get('draw');
		$record_total = '';
		$recordsFiltered = '';
		$data = array();
		foreach ($query_product->result() as $key => $value)
		{
			/*
			 * $value = object(stdClass)#19 (6) { ["id"]=> string(1) "1" ["name"]=> string(5) "Heels" ["price"]=> string(7) "120.000" ["description"]=> string(6) "T.12cm" ["stock"]=> string(2) "12" ["size"]=> string(5) "36-40" }
			 */
			$param = new stdClass();
			$param->id = $value->id;
			$param->name = $value->name;
			$param->price = $value->price;
			$param->description = $value->description;
			$param->stock = $value->stock;
			$param->size = $value->size;
			$param->action = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person(\''.$param->id.'\')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person(\''.$param->id.'\')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
			$data[] = $param;
		}
		$query_product = $this->Product_model->total();
		foreach ($query_product->result() as $key => $value)
		{
			/*
			 * $value = object(stdClass)#19 (6) { ["id"]=> string(1) "1" ["name"]=> string(5) "Heels" ["price"]=> string(7) "120.000" ["description"]=> string(6) "T.12cm" ["stock"]=> string(2) "12" ["size"]=> string(5) "36-40" }
			 */
			$param = new stdClass();
			$param->total = $value->total;
			$record_total = $param->total;
		}
		$output->draw = $draw;
		$output->recordsTotal = $record_total;
		$output->recordsFiltered = $record_total;
		$output->data = $data;
		echo json_encode($output);
	}
	function renew_product()
	{
		$id = $this->input->get('id');
		$name = $this->input->get('name');
		$price = $this->input->get('price');
		$description = $this->input->get('description');
		$stock = $this->input->get('stock');
		$size = $this->input->get('size');
		$this->Product_model->update_product($id,$name,$price,$description,$stock,$size);
		echo json_encode(array('status'=>true));
	}
	
	function remove_product()
	{
		$id= $this->input->get('id');
        $result=$this->Product_model->delete_product($id);
		echo $result;
         //redirect(base_url("product/select"));    
         
    }
	
	function add_product()
	{
		$name = $this->input->post('name');
		$price = $this->input->post('price');
		$description = $this->input->post('description');
		$stock = $this->input->post('stock');
		$size = $this->input->post('size');
		$this->Product_model->add($id,$name,$price,$description,$stock,$size);
		echo json_encode(array('status'=>true));
	}
		
	function list_product_by_id()
	{
		$id=$this->input->get('id');
		$query_product = $this->Product_model->get_product($id);
		foreach ($query_product->result() as $key => $value)
		{
			/*
			 * $value = object(stdClass)#19 (6) { ["id"]=> string(1) "1" ["name"]=> string(5) "Heels" ["price"]=> string(7) "120.000" ["description"]=> string(6) "T.12cm" ["stock"]=> string(2) "12" ["size"]=> string(5) "36-40" }
			 */
			$param = new stdClass();
			$param->id = $value->id;
			$param->name = $value->name;
			$param->price = $value->price;
			$param->description = $value->description;
			$param->stock = $value->stock;
			$param->size = $value->size;
		}
		echo json_encode($param);
		
	}	
}
	

