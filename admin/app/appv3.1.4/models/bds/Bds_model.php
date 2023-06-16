<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bds_model extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    function add($id_commune_ward, $id_street, $id_project, $id_user, $category, $status, $type, $title, $slug_title, $address, $maps, $sapo, $content, $images, $videos, $price_total, $price_m2, $price_type, $acreage, $facades, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $is_vip, $contacttype, $contactname, $contactaddress, $contactphone, $contactemail, $create_time)
    {
        $new_id = 0;
        $iconn = $this->db->conn_id;
        $sql = "INSERT INTO tbl_bds (id_commune_ward, id_street, id_project, id_user, category, `status`, `type`, title, slug_title, `address`, maps, sapo, content, images, videos, price_total, price_m2, price_type, acreage, facades, direction, floor, toilet, bedroom, noithat, road_surface, juridical, is_vip, contacttype, contactname, contactaddress, contactphone, contactemail, create_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            $param = [$id_commune_ward, $id_street, $id_project, $id_user, $category, $status, $type, $title, $slug_title, $address, $maps, $sapo, $content, $images, $videos, $price_total, $price_m2, $price_type, $acreage, $facades, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $is_vip, $contacttype, $contactname, $contactaddress, $contactphone, $contactemail, $create_time];

            if ($stmt->execute($param)) {
                $new_id = $iconn->lastInsertId();
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $new_id;
    }

    function get_info($id_bds)
    {
        $data = [];
        $iconn = $this->db->conn_id;
        $sql = "SELECT * FROM tbl_bds WHERE id_bds = ?;";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute([$id_bds])) {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!empty($data)) {

                    $data['year'] = date('Y', strtotime($data['create_time']));
                    $data['month'] = date('m', strtotime($data['create_time']));

                    if ($data['price_type'] == PRICE_TYPE_TOTAL) {

                        if ($data['price_total']  < PRICE_ONE_BILLION) {
                            $data['price_unit'] = PRICE_UNIT_TRIEU;
                            $data['price_view'] = $data['price_total'] / PRICE_ONE_MILLION;
                        } else {
                            $data['price_unit'] = PRICE_UNIT_TY;
                            $data['price_view'] = $data['price_total'] / PRICE_ONE_BILLION;
                        }
                    }

                    if ($data['price_type'] == PRICE_TYPE_M2) {

                        if ($data['price_m2']  < PRICE_ONE_BILLION) {
                            $data['price_unit'] = PRICE_UNIT_TRIEU;
                            $data['price_view'] = $data['price_m2'] / PRICE_ONE_MILLION;
                        } else {
                            $data['price_unit'] = PRICE_UNIT_TY;
                            $data['price_view'] = $data['price_m2'] / PRICE_ONE_BILLION;
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

    // -1 = lấy tất cả
    function get_list($category, $id_commune_ward, $id_street, $id_project, $id_user, $status, $type, $title, $f_price, $t_price, $price_type, $f_acreage, $t_acreage, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $is_vip, $is_home_vip, $f_expired, $t_expired, $f_create, $t_create, $orderby, $sort, $limit, $offset)
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

        if ($price_type == PRICE_TYPE_TOTAL) {
            if ($f_price != '' && $t_price == '') $where .= "AND A.price_total >= $f_price ";
            if ($f_price == '' && $t_price != '') $where .= "AND A.price_total <= $t_price ";
            if ($f_price != '' && $t_price != '') $where .= "AND A.price_total BETWEEN $f_price AND $t_price ";
        }

        if ($price_type == PRICE_TYPE_M2) {
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
            SELECT A.*, B.username, C.name as street, D.name as commune  FROM tbl_bds as A  
            LEFT JOIN tbl_user as B ON A.id_user = B.id_user 
            LEFT JOIN tbl_street as C ON A.id_street = C.id_street 
            LEFT JOIN tbl_commune_ward as D ON A.id_commune_ward = D.id_commune_ward 
            $where
            ORDER BY A.$orderby $sort, A.id_bds DESC, A.status DESC 
            LIMIT $limit OFFSET $offset";

        // var_dump($sql);die;
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
                        $first_img = @array_pop(array_reverse($list_img)); // lấy ảnh đầu tiên
                        $row['main_img'] = fullPathImage($first_img, $yearFolder, $monthFolder);
                        $row['year'] = $yearFolder;
                        $row['month'] = $monthFolder;
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

    function edit($id_bds, $id_commune_ward, $id_street, $id_project, $id_user, $category, $status, $type, $title, $slug_title, $address, $maps, $sapo, $content, $images, $videos, $price_total, $price_m2, $price_type, $acreage, $facades, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $is_vip, $contacttype, $contactname, $contactaddress, $contactphone, $contactemail, $update_time)
    {
        $execute = false;
        $iconn = $this->db->conn_id;
        $sql = "UPDATE tbl_bds SET id_commune_ward=?, id_street=?, id_project=?, id_user=?, category=?, status=?, type=?, title=?, slug_title=?, address=?, maps=?, sapo=?, content=?, images=?, videos=?, price_total=?, price_m2=?, price_type=?, acreage=?, facades=?, direction=?, floor=?, toilet=?, bedroom=?, noithat=?, road_surface=?, juridical=?, is_vip=?, contacttype=?, contactname=?, contactaddress=?, contactphone=?, contactemail=?, update_time=? WHERE id_bds=?; ";

        if ($is_vip == '0') {
            $sql .= "UPDATE tbl_bds SET is_home_vip = 0 WHERE id_bds = $id_bds ; ";
        }

        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            $param = [$id_commune_ward, $id_street, $id_project, $id_user, $category, $status, $type, $title, $slug_title, $address, $maps, $sapo, $content, $images, $videos, $price_total, $price_m2, $price_type, $acreage, $facades, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $is_vip, $contacttype, $contactname, $contactaddress, $contactphone, $contactemail, $update_time, $id_bds];

            if ($stmt->execute($param)) {
                $execute = true;
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $execute;
    }

    function delete($id_bds)
    {
        $execute = false;
        $iconn = $this->db->conn_id;
        $TAG_BDS = TAG_BDS;
        $sql = "DELETE FROM tbl_bds WHERE id_bds= $id_bds; 
        DELETE FROM tbl_tag_assign WHERE type_assign= $TAG_BDS AND id_assign = $id_bds; 
        DELETE FROM tbl_save_bds WHERE id_bds = $id_bds; ";
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

    function update_vip_to_home($is_home_vip, $str_id_bds)
    {
        $execute = false;
        $iconn = $this->db->conn_id;
        $sql = "UPDATE tbl_bds SET is_home_vip=? WHERE FIND_IN_SET(id_bds, ?)";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {

            if ($stmt->execute([$is_home_vip, $str_id_bds])) {
                $execute = true;
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $execute;
    }

    function update_status($status, $id_bds)
    {
        $execute = false;
        $iconn = $this->db->conn_id;
        $sql = "UPDATE tbl_bds SET status=$status WHERE id_bds = $id_bds ;";

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
