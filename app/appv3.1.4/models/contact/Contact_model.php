<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
	}

    function add_thong_tin_dang_ky($fullname, $phone, $email, $content)
    {
        
        $id = 0;
        $iconn = $this->db->conn_id;
        $sql = "INSERT INTO tbl_contact (fullname, email, phonenumber, content, create_time, ip_address, `status`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            $param = [$fullname, $phone, $email, $content , date('Y-m-d H:i:s'), ip_address(), 0];

            if ($stmt->execute($param)) {
                $id = $iconn->lastInsertId();
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $id;
    }
}