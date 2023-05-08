<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commune_model extends CI_Model
{	
	public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    function add($name, $type, $image, $id_user) {
        $execute = false;
        $iconn = $this->db->conn_id;
        $sql = "INSERT INTO tbl_commune_ward (name, type, image, id_user) VALUES (:name, :type, :image, :id_user)";
        $stmt = $iconn->prepare($sql);
        if($stmt)
        {
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':type', $type, PDO::PARAM_INT);
            $stmt->bindParam(':image', $image, PDO::PARAM_STR);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);

            if($stmt->execute())
            {
                $execute = true;
            } else {
                var_dump($stmt->errorInfo());die;
            }
        }
        $stmt->closeCursor();
        return $execute;
    }

    function get_list() {
        $data = [];
        $iconn = $this->db->conn_id;
        $sql = "SELECT * FROM tbl_commune_ward as A LEFT JOIN tbl_user as B ON A.id_user = B.id_user";
        $stmt = $iconn->prepare($sql);
        if($stmt)
        {
            if($stmt->execute())
            {
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                var_dump($stmt->errorInfo());die;
            }
        }
        $stmt->closeCursor();
        return $data;
    }
}