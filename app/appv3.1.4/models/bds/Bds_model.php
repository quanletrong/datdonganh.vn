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


    function get_list_by_top($is_vip, $id_commune_ward, $limit, $offset)
    {
        $data = [];
        $iconn = $this->db->conn_id;
        
        $where = "WHERE A.status = 1 ";
        
        if ($is_vip)  $where                        .= "AND A.is_vip > 0 ";
        if ($id_commune_ward > 0)  $where           .= "AND A.id_commune_ward = $id_commune_ward ";


        $sql = "SELECT A.*, B.username, B.phonenumber, C.name as street, D.name as commune  FROM tbl_bds as A  
            LEFT JOIN tbl_user as B ON A.id_user = B.id_user 
            LEFT JOIN tbl_street as C ON A.id_street = C.id_street 
            LEFT JOIN tbl_commune_ward as D ON A.id_commune_ward = D.id_commune_ward 
            $where
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

                        // tiền + đơn vị tiền
                        if($row['price_total']  < PRICE_ONE_BILLION) {
                            $row['price_unit'] = PRICE_UNIT_TRIEU; 
                            $row['price_view'] = $row['price_total']/PRICE_ONE_MILLION;
                        } else {
                            $row['price_unit'] = PRICE_UNIT_TY; 
                            $row['price_view'] = $row['price_total']/PRICE_ONE_BILLION;
                        }
                        // end tiền + đơn vị tiền

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

    function get_list_vip_home($limit, $offset)
    {
        $data = [];
        $iconn = $this->db->conn_id;
        
        $sql = "SELECT A.*, B.username, B.phonenumber, C.name as street, D.name as commune  FROM tbl_bds as A  
                LEFT JOIN tbl_user as B ON A.id_user = B.id_user 
                LEFT JOIN tbl_street as C ON A.id_street = C.id_street 
                LEFT JOIN tbl_commune_ward as D ON A.id_commune_ward = D.id_commune_ward 
                WHERE A.status = 1 AND A.is_home_vip = 1 AND A.is_vip = 1
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

                        // tiền + đơn vị tiền
                        if($row['price_total']  < PRICE_ONE_BILLION) {
                            $row['price_unit'] = PRICE_UNIT_TRIEU; 
                            $row['price_view'] = $row['price_total']/PRICE_ONE_MILLION;
                        } else {
                            $row['price_unit'] = PRICE_UNIT_TY; 
                            $row['price_view'] = $row['price_total']/PRICE_ONE_BILLION;
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
    
    function get_num_bds_by_commune_ward()
    {
        $data = [];
        $iconn = $this->db->conn_id;
        

        $sql = "
             SELECT A.*, count(B.id_bds) as num_bds  FROM tbl_commune_ward as A  
            LEFT JOIN tbl_bds as B ON A.id_commune_ward = B.id_commune_ward AND B.status = 1
            WHERE A.status = 1 GROUP BY A.id_commune_ward ORDER BY num_bds DESC;
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
                        
                        $data[$row['id_commune_ward']] = $row;
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

    function get_num_bds_by_street()
    {
        $data = [];
        $iconn = $this->db->conn_id;
        

        $sql = "
             SELECT A.*, count(B.id_bds) as num_bds  FROM tbl_street as A  
            LEFT JOIN tbl_bds as B ON A.id_street = B.id_street AND B.status = 1
            WHERE A.status = 1 GROUP BY A.id_street ORDER BY num_bds DESC;
            ";

        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                // echo json_encode($stmt, true);die;
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $data[$row['id_street']] = $row;
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

    function get_list($category, $id_commune_ward, $id_street, $id_project, $id_user, $status, $type, $title, $f_price, $t_price, $price_type, $f_acreage, $t_acreage, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $is_vip,$is_home_vip, $f_expired, $t_expired, $f_create, $t_create, $orderby, $sort, $limit, $offset)
    {
        $data = [];
        $iconn = $this->db->conn_id;

        $where = "WHERE 1=1 ";
        if ($title != '') $where           .= "AND A.title LIKE ? ";
        if ($category != '') $where        .= "AND A.category = $category ";
        if ($id_commune_ward != '') $where .= "AND A.id_commune_ward = $id_commune_ward ";
        if ($id_street != '') $where       .= "AND A.id_street = $id_street ";
        if ($id_project != '') $where      .= "AND A.id_project = $id_project ";
        if ($id_user != '') $where         .= "AND A.id_user = $id_user ";
        if ($status != '')  $where         .= "AND A.status = $status ";
        if ($type != '')  $where           .= "AND A.type = $type ";

        if($price_type == PRICE_TYPE_TOTAL) {
            if ($f_price != '' && $t_price == '') $where .= "AND A.price_total >= $f_price ";
            if ($f_price == '' && $t_price != '') $where .= "AND A.price_total <= $t_price ";
            if ($f_price != '' && $t_price != '') $where .= "AND A.price_total BETWEEN $f_price AND $t_price ";
        }
        
        if($price_type == PRICE_TYPE_M2) {
            if ($f_price != '' && $t_price == '') $where .= "AND A.price_m2 >= $f_price ";
            if ($f_price == '' && $t_price != '') $where .= "AND A.price_m2 <= $t_price ";
            if ($f_price != '' && $t_price != '') $where .= "AND A.price_m2 BETWEEN $f_price AND $t_price ";
        }
        
        if ($f_acreage != '' && $t_acreage == '') $where .= "AND A.acreage >= $f_acreage ";
        if ($f_acreage == '' && $t_acreage != '') $where .= "AND A.acreage <= $t_acreage ";
        if ($f_acreage != '' && $t_acreage != '') $where .= "AND A.acreage BETWEEN $f_acreage AND $t_acreage ";

        if ($direction != '')  $where                     .= "AND A.direction = $direction ";
        if ($floor != '')  $where                         .= "AND A.floor = $floor ";
        if ($toilet != '')  $where                        .= "AND A.toilet = $toilet ";
        if ($bedroom != '')  $where                       .= "AND A.bedroom = $bedroom ";
        if ($noithat != '')  $where                       .= "AND A.noithat = $noithat ";
        if ($road_surface != '')  $where                  .= "AND A.road_surface = $road_surface ";
        if ($juridical != '')  $where                     .= "AND A.juridical = $juridical ";
        if ($is_vip != '')  $where                        .= "AND A.is_vip = $is_vip ";
        if ($is_home_vip != '')  $where                   .= "AND A.is_home_vip = $is_home_vip ";
        if ($f_expired != '' && $t_expired != '')  $where .= "AND A.expired BETWEEN '$f_expired' AND '$t_expired' ";

        if ($f_create != '' && $t_create == '')  $where   .= "AND A.create_time >='$f_create' ";
        if ($f_create == '' && $t_create != '')  $where   .= "AND A.create_time <= '$t_create' ";
        if ($f_create != '' && $t_create != '')  $where   .= "AND A.create_time BETWEEN '$f_create' AND '$t_create' ";

        $sql = "
            SELECT A.*, B.username, B.fullname, C.name as street, D.name as commune  FROM tbl_bds as A  
            LEFT JOIN tbl_user as B ON A.id_user = B.id_user 
            LEFT JOIN tbl_street as C ON A.id_street = C.id_street 
            LEFT JOIN tbl_commune_ward as D ON A.id_commune_ward = D.id_commune_ward 
            $where
            ORDER BY A.$orderby $sort, A.id_bds DESC, A.status DESC 
            LIMIT $limit OFFSET $offset";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            // $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            if ($stmt->execute(["%$title%"])) {
                // echo json_encode($stmt, true);die;
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $list_img = json_decode($row['images'], true);
                        $yearFolder = date('Y', strtotime($row['create_time']));
                        $monthFolder = date('m', strtotime($row['create_time']));

                        // lấy ảnh đầu tiên
                        $first_img = @array_pop(array_reverse($list_img));
                        $row['main_img'] = get_path_image($row['create_time'], $first_img);

                        // danh sach anh
                        foreach($list_img as $image_name) {
                            $row['list_img'][] = get_path_image($row['create_time'], $image_name);
                        }
                        $row['year'] = $yearFolder;
                        $row['month'] = $monthFolder;

                        // tiền + đơn vị tiền
                        if($row['price_total']  < PRICE_ONE_BILLION) {
                            $row['price_unit'] = PRICE_UNIT_TRIEU; 
                            $row['price_view'] = $row['price_total']/PRICE_ONE_MILLION;
                        } else {
                            $row['price_unit'] = PRICE_UNIT_TY; 
                            $row['price_view'] = $row['price_total']/PRICE_ONE_BILLION;
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
    
}
