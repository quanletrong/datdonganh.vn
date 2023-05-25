<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bds_model extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }


    function get_info($id_bds)
    {
        $data = [];
        $iconn = $this->db->conn_id;
        $sql = " SELECT A.*, B.name as commune_name, C.name as street_name FROM tbl_bds as A  
            LEFT JOIN tbl_commune_ward as B 
            ON A.id_commune_ward = B.id_commune_ward  
            LEFT JOIN tbl_street as C 
            ON A.id_street = C.id_street
            WHERE A.id_bds = ?";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute([$id_bds])) {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $data;
    }
    
    function get_all_tag_by($type, $id_bds)
    {
        $data = [];
        $iconn = $this->db->conn_id;
        $sql = " SELECT A.*  FROM tbl_tag as A  
            LEFT JOIN tbl_tag_assign as B ON A.id_tag = B.id_tag 
            WHERE A.status = 1 AND B.type_assign = ? AND B.id_assign = ?";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute([$type, $id_bds])) {
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $data;
    }


    function get_list_by_top($is_vip, $limit, $offset)
    {
        $data = [];
        $iconn = $this->db->conn_id;
        
        $where = "WHERE A.status = 1";
        
        if ($is_vip)  $where                        .= "AND A.is_vip > 0 ";

        $sql = "
            SELECT A.*, B.username, C.name as street, D.name as commune  FROM tbl_bds as A  
            LEFT JOIN tbl_user as B ON A.id_user = B.id_user 
            LEFT JOIN tbl_street as C ON A.id_street = C.id_street 
            LEFT JOIN tbl_commune_ward as D ON A.id_commune_ward = D.id_commune_ward 
            WHERE A.status = 1 
            ORDER BY A.id_bds DESC 
            LIMIT $limit OFFSET $offset";

            // var_dump($sql);die;
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                // echo json_encode($stmt, true);die;
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                        $row['image_path'] = '';
     
                        if($row['images'] != ""){
                            $arr_img = json_decode($row['images'], true);
                            
                            $img_first = array_shift($arr_img);

                            
                            $year = date('Y', strtotime($row['create_time']));
                            $month = date('m', strtotime($row['create_time']));
                            $row['image_path'] = ROOT_DOMAIN . PUBLIC_UPLOAD_PATH . $year . '/' . $month . '/' . $img_first;
                        }
                        $data[$row['id_bds']] = $row;
                    }
                }
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $data;
    }
    
    function get_num_bds_by_commune_ward($limit)
    {
        $data = [];
        $iconn = $this->db->conn_id;
        

        $sql = "
             SELECT A.*, count(B.id_bds) as num_bds  FROM tbl_commune_ward as A  
            LEFT JOIN tbl_bds as B ON A.id_commune_ward = B.id_commune_ward 
            WHERE A.status = 1 GROUP BY A.id_commune_ward HAVING num_bds > 0 ORDER BY num_bds DESC
                LIMIT $limit;
            ";

        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                // echo json_encode($stmt, true);die;
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  
                        $year = date('Y', strtotime($row['create_time']));
                        $month = date('m', strtotime($row['create_time']));
                        $row['image_path'] = ROOT_DOMAIN . PUBLIC_UPLOAD_PATH . $year . '/' . $month . '/' . $row['image'];
                        
                        $data[] = $row;
                    }
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
