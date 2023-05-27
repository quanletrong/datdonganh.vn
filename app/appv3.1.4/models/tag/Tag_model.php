<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tag_model extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    function get_info($type_assign)
    {
        $data = [];
        $iconn = $this->db->conn_id;
        $sql = "SELECT A.* 
        FROM tbl_tag as A
        INNER JOIN tbl_tag_assign as B ON A.id_tag = B.id_tag AND B.type_assign = ? ";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            // $stmt->bindParam(':id_commune', $id_commune, PDO::PARAM_STR);
            if ($stmt->execute([$type_assign])) {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $data;
    }

    function get_list($type_assign)
    {
        $data = [];
        $iconn = $this->db->conn_id;
        $sql = "SELECT B.*
        FROM tbl_tag_assign as A 
        INNER JOIN tbl_tag as B ON A.id_tag = B.id_tag  AND B.status = 1 
        WHERE A.type_assign = ? ORDER BY B.id_tag DESC";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            // $stmt->bindParam(':id_commune', $id_commune, PDO::PARAM_STR);
            if ($stmt->execute([$type_assign])) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data[$row['id_tag']] = $row;
                }
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $data;
    }
}
