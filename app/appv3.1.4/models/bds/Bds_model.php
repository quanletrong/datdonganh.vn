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
        $sql = " SELECT A.*, B.name as commune_name, C.name as street_name, D.avatar as avatar FROM tbl_bds as A  
            LEFT JOIN tbl_commune_ward as B ON A.id_commune_ward = B.id_commune_ward  
            LEFT JOIN tbl_street as C ON A.id_street = C.id_street
            LEFT JOIN tbl_user as D ON A.id_user = D.id_user
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


    function get_list_by_top($is_vip, $is_home_vip, $id_commune_ward, $limit, $offset)
    {
        $data = [];
        $iconn = $this->db->conn_id;
        $current_time = date('Y-m-d H:i:s'); // thời gian hiện tại

        $where = "WHERE A.status = 1 ";

        if ($is_vip !== '')  $where          .= "AND A.is_vip = $is_vip ";
        if ($is_home_vip !== '')  $where     .= "AND A.is_home_vip = $is_home_vip ";
        if ($id_commune_ward !== '')  $where .= "AND A.id_commune_ward = $id_commune_ward ";

        $where .= " AND A.create_time_set <= '$current_time' ";

        $sql = "SELECT A.*, B.username, B.phonenumber, C.name as street, D.name as commune  FROM tbl_bds as A  
            LEFT JOIN tbl_user as B ON A.id_user = B.id_user 
            LEFT JOIN tbl_street as C ON A.id_street = C.id_street 
            LEFT JOIN tbl_commune_ward as D ON A.id_commune_ward = D.id_commune_ward 
            $where
            ORDER BY A.create_time_set DESC
            LIMIT $limit OFFSET $offset";

        // var_dump($sql);die;
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                // echo json_encode($stmt, true);die;
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                        $row['image_path'] = '';

                        if ($row['images'] != "") {
                            $arr_img = json_decode($row['images'], true);

                            $img_first = array_shift($arr_img);


                            $year = date('Y', strtotime($row['create_time']));
                            $month = date('m', strtotime($row['create_time']));
                            $row['image_path'] = ROOT_DOMAIN . PUBLIC_UPLOAD_PATH . $year . '/' . $month . '/' . $img_first;
                        }

                        // tiền + đơn vị tiền
                        if ($row['price_total']  < PRICE_ONE_BILLION) {
                            $row['price_unit'] = PRICE_UNIT_TRIEU;
                            $row['price_view'] = $row['price_total'] / PRICE_ONE_MILLION;
                        } else {
                            $row['price_unit'] = PRICE_UNIT_TY;
                            $row['price_view'] = $row['price_total'] / PRICE_ONE_BILLION;
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
        $current_time = date('Y-m-d H:i:s'); // thời gian hiện tại

        $sql = "SELECT A.*, B.username, B.phonenumber, C.name as street, D.name as commune  FROM tbl_bds as A  
                LEFT JOIN tbl_user as B ON A.id_user = B.id_user 
                LEFT JOIN tbl_street as C ON A.id_street = C.id_street 
                LEFT JOIN tbl_commune_ward as D ON A.id_commune_ward = D.id_commune_ward 
                WHERE A.status = 1 AND A.is_home_vip = 1 AND A.is_vip = 1 AND A.create_time_set <= '$current_time' 
                ORDER BY A.create_time_set DESC
                LIMIT $limit OFFSET $offset";

        // var_dump($sql);die;
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                // echo json_encode($stmt, true);die;
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                        $row['image_path'] = '';

                        if ($row['images'] != "") {
                            $arr_img = json_decode($row['images'], true);

                            $img_first = array_shift($arr_img);


                            $year = date('Y', strtotime($row['create_time']));
                            $month = date('m', strtotime($row['create_time']));
                            $row['image_path'] = ROOT_DOMAIN . PUBLIC_UPLOAD_PATH . $year . '/' . $month . '/' . $img_first;
                        }

                        // tiền + đơn vị tiền
                        if ($row['price_total']  < PRICE_ONE_BILLION) {
                            $row['price_unit'] = PRICE_UNIT_TRIEU;
                            $row['price_view'] = $row['price_total'] / PRICE_ONE_MILLION;
                        } else {
                            $row['price_unit'] = PRICE_UNIT_TY;
                            $row['price_view'] = $row['price_total'] / PRICE_ONE_BILLION;
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

    
    function get_list_vip_home_v2($limit, $offset)
    {
        $data = [];
        $iconn = $this->db->conn_id;
        $current_time = date('Y-m-d H:i:s'); // thời gian hiện tại
        $ADMIN = ADMIN;

        $sql = 
        "SELECT * 
        FROM tbl_bds 
        WHERE 
            id_user in (SELECT id_user FROM tbl_user WHERE role = $ADMIN) 
            AND is_vip = 1 
            ORDER BY create_time_set DESC 
            LIMIT $limit OFFSET $offset";

        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                // echo json_encode($stmt, true);die;
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                        $row['image_path'] = '';

                        if ($row['images'] != "") {
                            $arr_img = json_decode($row['images'], true);

                            $img_first = array_shift($arr_img);


                            $year = date('Y', strtotime($row['create_time']));
                            $month = date('m', strtotime($row['create_time']));
                            $row['image_path'] = ROOT_DOMAIN . PUBLIC_UPLOAD_PATH . $year . '/' . $month . '/' . $img_first;
                        }

                        // tiền + đơn vị tiền
                        if ($row['price_total']  < PRICE_ONE_BILLION) {
                            $row['price_unit'] = PRICE_UNIT_TRIEU;
                            $row['price_view'] = $row['price_total'] / PRICE_ONE_MILLION;
                        } else {
                            $row['price_unit'] = PRICE_UNIT_TY;
                            $row['price_view'] = $row['price_total'] / PRICE_ONE_BILLION;
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
        $current_time = date('Y-m-d H:i:s'); // thời gian hiện tại

        $sql = "SELECT A.*, count(B.id_bds) as num_bds  FROM tbl_commune_ward as A  
            LEFT JOIN tbl_bds as B ON A.id_commune_ward = B.id_commune_ward AND B.status = 1 AND B.create_time_set <= '$current_time' 
            WHERE A.status = 1 
            GROUP BY A.id_commune_ward 
            ORDER BY A.name ASC;
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
        $current_time = date('Y-m-d H:i:s'); // thời gian hiện tại

        $sql = "SELECT A.*, count(B.id_bds) as num_bds  FROM tbl_street as A  
            LEFT JOIN tbl_bds as B ON A.id_street = B.id_street AND B.status = 1 
            WHERE A.status = 1 AND B.create_time_set <= '$current_time' 
            GROUP BY A.id_street 
            ORDER BY name ASC ;";

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

    function get_num_bds_by_contact_name($contact_name)
    {
        $num_bds = 0;
        $iconn = $this->db->conn_id;
        $current_time = date('Y-m-d H:i:s'); // thời gian hiện tại

        $sql = "SELECT count(*) as num_bds  FROM tbl_bds as A
            WHERE A.status = 1 AND A.create_time_set <= '$current_time' AND A.contactname LIKE ? ";

        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute([$contact_name])) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $num_bds = $row['num_bds'];
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $num_bds;
    }

    function get_total_bds_active()
    {
        $current_time = date('Y-m-d H:i:s'); // thời gian hiện tại
        $total = 0;
        $iconn = $this->db->conn_id;
        $sql = " SELECT count(*) as total FROM tbl_bds WHERE status = 1 AND create_time_set <= '$current_time' ";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $total = $row['total'];
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $total;
    }

    function get_list($category, $id_commune_ward, $id_street, $id_project, $id_user, $status, $type, $title, $f_price, $t_price, $price_type, $f_acreage, $t_acreage, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $moi_gioi, $is_vip, $is_home_vip, $f_expired, $t_expired, $f_create, $t_create, $orderby, $sort, $limit, $offset, $tag)
    {
        $data['list'] = [];
        $data['total'] = 0;
        $iconn = $this->db->conn_id;

        $current_time = date('Y-m-d H:i:s'); // thời gian hiện tại

        $PARAMS_LIST = [];
        $PARAMS_TOTAL = [];
        $WHERE = "WHERE 1=1 AND A.create_time_set <= '$current_time'";

        if ($title != '') {
            $WHERE .= "AND A.title LIKE ? ";
            $PARAMS_LIST[] = "%$title%";
            $PARAMS_TOTAL[] = "%$title%";
        }

        if ($moi_gioi != '') {
            $WHERE .= "AND A.contactname = ? ";
            $PARAMS_LIST[] = $moi_gioi;
            $PARAMS_TOTAL[] = $moi_gioi;
        }

        if ($category != '') $WHERE        .= "AND A.category = $category ";
        if ($id_commune_ward != '') $WHERE .= "AND A.id_commune_ward IN ($id_commune_ward) ";
        if ($id_street != '') $WHERE       .= "AND A.id_street = $id_street ";
        if ($id_project != '') $WHERE      .= "AND A.id_project = $id_project ";
        if ($id_user != '') $WHERE         .= "AND A.id_user = $id_user ";
        if ($status != '')  $WHERE         .= "AND A.status = $status ";
        if ($type != '')  $WHERE           .= "AND A.type = $type ";

        if ($price_type == PRICE_TYPE_TOTAL) {
            if ($f_price != '' && $t_price == '') $WHERE .= "AND A.price_total >= $f_price ";
            if ($f_price == '' && $t_price != '') $WHERE .= "AND A.price_total <= $t_price ";
            if ($f_price != '' && $t_price != '') $WHERE .= "AND A.price_total BETWEEN $f_price AND $t_price ";
        }

        if ($price_type == PRICE_TYPE_M2) {
            if ($f_price != '' && $t_price == '') $WHERE .= "AND A.price_m2 >= $f_price ";
            if ($f_price == '' && $t_price != '') $WHERE .= "AND A.price_m2 <= $t_price ";
            if ($f_price != '' && $t_price != '') $WHERE .= "AND A.price_m2 BETWEEN $f_price AND $t_price ";
        }

        if ($f_acreage != '' && $t_acreage == '') $WHERE .= "AND A.acreage >= $f_acreage ";
        if ($f_acreage == '' && $t_acreage != '') $WHERE .= "AND A.acreage <= $t_acreage ";
        if ($f_acreage != '' && $t_acreage != '') $WHERE .= "AND A.acreage BETWEEN $f_acreage AND $t_acreage ";

        if ($direction != '')  $WHERE                     .= "AND A.direction = $direction ";
        if ($floor != '')  $WHERE                         .= "AND A.floor = $floor ";
        if ($toilet != '')  $WHERE                        .= "AND A.toilet = $toilet ";
        if ($bedroom != '')  $WHERE                       .= "AND A.bedroom = $bedroom ";
        if ($noithat != '')  $WHERE                       .= "AND A.noithat = $noithat ";
        if ($road_surface != '')  $WHERE                  .= "AND A.road_surface = $road_surface ";
        if ($juridical != '')  $WHERE                     .= "AND A.juridical = $juridical ";
        if ($is_vip != '')  $WHERE                        .= "AND A.is_vip = $is_vip ";
        if ($is_home_vip != '')  $WHERE                   .= "AND A.is_home_vip = $is_home_vip ";
        if ($f_expired != '' && $t_expired != '')  $WHERE .= "AND A.expired BETWEEN '$f_expired' AND '$t_expired' ";

        if ($f_create != '' && $t_create == '')  $WHERE   .= "AND A.create_time >='$f_create' ";
        if ($f_create == '' && $t_create != '')  $WHERE   .= "AND A.create_time <= '$t_create' ";
        if ($f_create != '' && $t_create != '')  $WHERE   .= "AND A.create_time BETWEEN '$f_create' AND '$t_create' ";

        if ($tag != '') $WHERE .= "AND A.id_bds IN (SELECT tbl_tag_assign.id_assign FROM tbl_tag_assign WHERE tbl_tag_assign.id_tag = $tag AND tbl_tag_assign.type_assign = " . TAG_BDS . " )";

        $LIMIT = "LIMIT $limit OFFSET $offset";

        $sql_list =
            "SELECT A.*, B.username, B.fullname, C.name as street, D.name as commune  
                FROM tbl_bds as A  
                LEFT JOIN tbl_user as B ON A.id_user = B.id_user 
                LEFT JOIN tbl_street as C ON A.id_street = C.id_street 
                LEFT JOIN tbl_commune_ward as D ON A.id_commune_ward = D.id_commune_ward 
            $WHERE
            ORDER BY A.$orderby $sort , A.create_time_set DESC, A.status DESC 
            $LIMIT ;";

        $sql_total = " SELECT count(*) as total  FROM tbl_bds as A  $WHERE ;";

        $sql = $sql_list . $sql_total;
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            // $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            if ($stmt->execute(array_merge($PARAMS_LIST, $PARAMS_TOTAL))) {
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
                        foreach ($list_img as $image_name) {
                            $row['list_img'][] = get_path_image($row['create_time'], $image_name);
                        }
                        $row['year'] = $yearFolder;
                        $row['month'] = $monthFolder;

                        // tiền + đơn vị tiền
                        if ($row['price_total']  < PRICE_ONE_BILLION) {
                            $row['price_unit'] = PRICE_UNIT_TRIEU;
                            $row['price_view'] = $row['price_total'] / PRICE_ONE_MILLION;
                        } else {
                            $row['price_unit'] = PRICE_UNIT_TY;
                            $row['price_view'] = $row['price_total'] / PRICE_ONE_BILLION;
                        }

                        $data['list'][$row['id_bds']] = $row;
                    }
                }

                if ($stmt->nextRowSet()) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $data['total'] = $row['total'];
                }
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $data;
    }

    function get_num_bds_by_price()
    {
        $data = [];
        $iconn = $this->db->conn_id;

        $cf_bds = $this->config->item('bds');
        $price_list = $cf_bds['price_list'];
        $current_time = date('Y-m-d H:i:s'); // thời gian hiện tại

        $sql = "";
        foreach ($price_list as $price) {
            $from = @intval($price['from'] * PRICE_ONE_BILLION);
            $to = @intval($price['to'] * PRICE_ONE_BILLION);
            if ($from > 0 && $to > 0) {
                $sql .= " SELECT count(*) as total  FROM tbl_bds as A WHERE A.status = 1 AND create_time_set <= '$current_time' AND A.price_total BETWEEN $from AND $to ; ";
            } else if ($from == 0) {
                $sql .= " SELECT count(*) as total FROM tbl_bds as A WHERE A.status = 1 AND create_time_set <= '$current_time' AND A.price_total <= $to ; ";
            } else {
                $sql .= " SELECT count(*) as total FROM tbl_bds as A WHERE A.status = 1 AND create_time_set <= '$current_time' AND A.price_total >= $from ; ";
            }
        }

        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                foreach ($price_list as $key => $price) {
                    $price_key = $price['from'] . '-' . $price['to'];
                    if ($key == 0) {
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $data[$price_key] = $row['total'];
                    } else {
                        if ($stmt->nextRowSet()) {
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            $data[$price_key] = $row['total'];
                        }
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

    function get_num_bds_by_acreage()
    {
        $data = [];
        $iconn = $this->db->conn_id;

        $cf_bds = $this->config->item('bds');
        $acreage_list = $cf_bds['acreage_list'];
        $current_time = date('Y-m-d H:i:s'); // thời gian hiện tại

        $sql = "";
        foreach ($acreage_list as $acreage) {
            $from = @intval($acreage['from']);
            $to = @intval($acreage['to']);
            if ($from > 0 && $to > 0) {
                $sql .= " SELECT count(*) as total  FROM tbl_bds as A WHERE A.status = 1 AND create_time_set <= '$current_time' AND A.acreage BETWEEN $from AND $to ; ";
            } else if ($from == 0) {
                $sql .= " SELECT count(*) as total FROM tbl_bds as A WHERE A.status = 1 AND create_time_set <= '$current_time' AND A.acreage <= $to ; ";
            } else {
                $sql .= " SELECT count(*) as total FROM tbl_bds as A WHERE A.status = 1 AND create_time_set <= '$current_time' AND A.acreage >= $from ; ";
            }
        }

        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                foreach ($acreage_list as $key => $acreage) {
                    $acreage_key = $acreage['from'] . '-' . $acreage['to'];
                    if ($key == 0) {
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $data[$acreage_key] = $row['total'];
                    } else {
                        if ($stmt->nextRowSet()) {
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            $data[$acreage_key] = $row['total'];
                        }
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


    function get_all_favorite_bds_by_user($uid)
    {
        $data = [];
        $data['ids'] = [];
        $data['list'] = [];
        $iconn = $this->db->conn_id;
        $sql = " SELECT A.*, B.username, B.fullname, C.name as street, D.name as commune  FROM tbl_bds as A 
            LEFT JOIN tbl_user as B ON A.id_user = B.id_user 
            LEFT JOIN tbl_street as C ON A.id_street = C.id_street 
            LEFT JOIN tbl_commune_ward as D ON A.id_commune_ward = D.id_commune_ward 
            LEFT JOIN tbl_save_bds as E ON A.id_bds = E.id_bds WHERE E.id_user = ? AND A.status = 1";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute([$uid])) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    $data['ids'][] = $row['id_bds'];

                    $list_img = json_decode($row['images'], true);
                    $yearFolder = date('Y', strtotime($row['create_time']));
                    $monthFolder = date('m', strtotime($row['create_time']));

                    // lấy ảnh đầu tiên
                    $first_img = @array_pop(array_reverse($list_img));
                    $row['main_img'] = get_path_image($row['create_time'], $first_img);

                    // danh sach anh
                    foreach ($list_img as $image_name) {
                        $row['list_img'][] = get_path_image($row['create_time'], $image_name);
                    }
                    $row['year'] = $yearFolder;
                    $row['month'] = $monthFolder;

                    // tiền + đơn vị tiền
                    if ($row['price_total']  < PRICE_ONE_BILLION) {
                        $row['price_unit'] = PRICE_UNIT_TRIEU;
                        $row['price_view'] = $row['price_total'] / PRICE_ONE_MILLION;
                    } else {
                        $row['price_unit'] = PRICE_UNIT_TY;
                        $row['price_view'] = $row['price_total'] / PRICE_ONE_BILLION;
                    }

                    $data['list'][$row['id_bds']] = $row;
                }
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $data;
    }

    function add_bds_favorite($bds_id, $uid)
    {
        $id = 0;
        $iconn = $this->db->conn_id;
        $sql = "INSERT INTO tbl_save_bds (id_bds, id_user, create_time) VALUES (?, ?, ?)";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            $param = [$bds_id, $uid, date('Y-m-d H:i:s')];

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

    function delete_bds_favorite($bds_id, $uid)
    {
        $execute = false;
        $iconn = $this->db->conn_id;
        $sql = "DELETE FROM tbl_save_bds WHERE id_bds = ? AND id_user = ?";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute([$bds_id, $uid])) {
                $execute = true;
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $execute;
    }

    function tang_luot_xem_bds($view, $id_bds)
    {
        $execute = false;
        $iconn = $this->db->conn_id;
        $sql = "UPDATE tbl_bds SET view=$view WHERE id_bds = $id_bds ;";

        $stmt = $iconn->prepare($sql);
        if ($stmt) {

            if ($stmt->execute()) {
                $execute = true;
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $execute;
    }
}
