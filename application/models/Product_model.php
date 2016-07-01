<?php

class Product_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function get_product($id = '')
	{

		$sql = "SELECT * FROM list_product WHERE TRUE";
		if ($id != '')
		{
			$sql.=' AND id=' . $id;
		}

		$query_result = $this->db->query($sql);
		return $query_result;
	}

	public function total()
	{
		$sql = "SELECT COUNT(*) as total FROM list_product";
		$query_result = $this->db->query($sql);
		return $query_result;
	}

	public function delete_product($id = '')
	{
		$sql = "delete FROM list_product where id='$id'";
		$query_result = $this->db->query($sql);
		return $query_result;
	}

	public function add($id = '', $name = '', $price = '', $description = '', $stock = '', $size = '')
	{
		$sql = "INSERT INTO list_product (id, name, price, description, stock, size)
				VALUES ('$id','$name','$price','$description','$stock','$size')";
		$query_result = $this->db->query($sql);
		return $query_result;
	}
	public function update_product($id = '', $name = '', $price = '', $description = '', $stock = '', $size = '')
	{
		$sql = "UPDATE list_product
			SET name='$name', price='$price', description='$description', stock='$stock', size='$size'
				where id='$id'";
		$query_result = $this->db->query($sql);
		return $query_result;
	}

}