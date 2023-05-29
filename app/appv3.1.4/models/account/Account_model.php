<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
	}

    function get_user_info_by_email($email) {
        $data = array();
        $iconn = $this->db->conn_id;
        $sql = "SELECT * FROM tbl_user WHERE email = :email";
        $stmt = $iconn->prepare($sql);
        if($stmt)
        {
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            if($stmt->execute())
            {
                if($stmt->rowCount() > 0)
                {
                    $data = $stmt->fetch(PDO::FETCH_ASSOC);
                }
                $stmt->closeCursor();
            } else {
                // var_dump($stmt->errorInfo());die;
            }
        }
        $stmt->closeCursor();
        return $data;
    }
    
    function get_user_info_by_uid($uid) {
        $data = array();
        $iconn = $this->db->conn_id;
        $sql = "SELECT * FROM tbl_user WHERE id_user = :uid";
        $stmt = $iconn->prepare($sql);
        if($stmt)
        {
            $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);

            if($stmt->execute())
            {
                if($stmt->rowCount() > 0)
                {
                    $data = $stmt->fetch(PDO::FETCH_ASSOC);
                }
                $stmt->closeCursor();
            } else {
                // var_dump($stmt->errorInfo());die;
            }
        }
        $stmt->closeCursor();
        return $data;
    }
    
    
    
    function add($uname, $pass, $fullname, $email, $phone, $avatar, $role, $status, $uid_creare = 0)
    {
        $id = 0;
        $iconn = $this->db->conn_id;
        $sql = "INSERT INTO tbl_user (username, password, fullname, email, phonenumber, avatar, role, status, id_user_create, create_time, update_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            $param = [$uname, $pass, $fullname, $email, $phone, $avatar, $role, $status, $uid_creare , date('Y-m-d H:i:s'), ""];

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