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
    
    function get_user_info_by_phone($phonenumber) {
        $data = array();
        $iconn = $this->db->conn_id;
        $sql = "SELECT * FROM tbl_user WHERE phonenumber = :phonenumber";
        $stmt = $iconn->prepare($sql);
        if($stmt)
        {
            $stmt->bindParam(':phonenumber', $phonenumber, PDO::PARAM_STR);

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
    
    function get_user_info_by_uname($uname) {
        $data = array();
        $iconn = $this->db->conn_id;
        $sql = "SELECT * FROM tbl_user WHERE username = :uname";
        $stmt = $iconn->prepare($sql);
        if($stmt)
        {
            $stmt->bindParam(':uname', $uname, PDO::PARAM_STR);

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

    function edit($fullname, $email, $phonenumber, $avatar, $id_user)
    {
        $execute = false;
        $iconn = $this->db->conn_id;
        $sql = "UPDATE tbl_user SET fullname =?, email =?, phonenumber =?, avatar =? WHERE id_user =? ;";

        $stmt = $iconn->prepare($sql);
        if ($stmt) {

            if ($stmt->execute([$fullname, $email, $phonenumber, $avatar, $id_user])) {
                $execute = true;
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $execute;
    }

    function edit_password($password, $id_user)
    {
        $execute = false;
        $iconn = $this->db->conn_id;
        $sql = "UPDATE tbl_user SET password =? WHERE id_user =? ;";

        $stmt = $iconn->prepare($sql);
        if ($stmt) {

            if ($stmt->execute([$password, $id_user])) {
                $execute = true;
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $execute;
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