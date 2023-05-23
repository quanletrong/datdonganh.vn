<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bds_model extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    function add($id_commune_ward, $id_street, $id_project, $id_user, $category, $status, $type, $title, $slug_title, $address, $maps, $sapo, $content, $images, $videos, $price, $price_type, $acreage, $facades, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $is_vip, $contacttype, $contactname, $contactaddress, $contactphone, $contactemail, $run_date, $create_time)
    {
        $new_id = 0;
        $iconn = $this->db->conn_id;
        $sql = "INSERT INTO tbl_bds (id_commune_ward, id_street, id_project, id_user, category, status, type, title, slug_title, address, maps, sapo, content, images, videos, price, price_type, acreage, facades, direction, floor, toilet, bedroom, noithat, road_surface, juridical, is_vip, contacttype, contactname, contactaddress, contactphone, contactemail, run_date, create_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            $param = [$id_commune_ward, $id_street, $id_project, $id_user, $category, $status, $type, $title, $slug_title, $address, $maps, $sapo, $content, $images, $videos, $price, $price_type, $acreage, $facades, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $is_vip, $contacttype, $contactname, $contactaddress, $contactphone, $contactemail, $run_date, $create_time];

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
        $sql = "SELECT * FROM tbl_bds WHERE id_bds = ?";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute([$id_bds])) {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                $data['year'] = date('Y', strtotime($data['create_time']));
                $data['month'] = date('m', strtotime($data['create_time']));
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $data;
    }

    // -1 = lấy tất cả
    function get_list($id_commune_ward, $id_street, $id_project, $id_user, $status, $type, $title, $f_price, $t_price, $f_acreage, $t_acreage, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $is_vip, $f_expired, $t_expired, $f_create, $t_create, $orderby, $sort, $limit, $offset)
    {
        $data = [];
        $iconn = $this->db->conn_id;

        $where = "WHERE A.title LIKE '%$title%' ";
        $param['title'] = $title;

        if ($id_commune_ward != '') $where                .= "AND A.id_commune_ward = $id_commune_ward ";
        if ($id_street != '') $where                      .= "AND A.id_street = $id_street ";
        if ($id_project != '') $where                     .= "AND A.id_project = $id_project ";
        if ($id_user != '') $where                        .= "AND A.id_user = $id_user ";
        if ($status != '')  $where                        .= "AND A.status = $status ";
        if ($type != '')  $where                          .= "AND A.type = $type ";
        if ($f_price != '' && $t_price != '') $where      .= "AND A.price BETWEEN $f_price AND $t_price ";
        if ($f_acreage != '' && $t_acreage != '') $where  .= "AND A.acreage BETWEEN $f_acreage AND $t_acreage ";
        if ($direction != '')  $where                     .= "AND A.direction = $direction ";
        if ($floor != '')  $where                         .= "AND A.floor = $floor ";
        if ($toilet != '')  $where                        .= "AND A.toilet = $toilet ";
        if ($bedroom != '')  $where                       .= "AND A.bedroom = $bedroom ";
        if ($noithat != '')  $where                       .= "AND A.noithat = $noithat ";
        if ($road_surface != '')  $where                  .= "AND A.road_surface = $road_surface ";
        if ($juridical != '')  $where                     .= "AND A.juridical = $juridical ";
        if ($is_vip != '')  $where                        .= "AND A.is_vip = $is_vip ";
        if ($f_expired != '' && $t_expired != '')  $where .= "AND A.expired BETWEEN '$f_expired' AND '$t_expired' ";
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
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            if ($stmt->execute($param)) {
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

    function edit($id_bds, $id_commune_ward, $id_street, $id_project, $id_user, $category, $status, $type, $title, $slug_title, $address, $maps, $sapo, $content, $images, $videos, $price, $price_type, $acreage, $facades, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $is_vip, $contacttype, $contactname, $contactaddress, $contactphone, $contactemail, $run_date, $update_time)
    {
        $execute = false;
        $iconn = $this->db->conn_id;
        $sql = "UPDATE tbl_bds SET id_commune_ward=?, id_street=?, id_project=?, id_user=?, category=?, status=?, type=?, title=?, slug_title=?, address=?, maps=?, sapo=?, content=?, images=?, videos=?, price=?, price_type=?, acreage=?, facades=?, direction=?, floor=?, toilet=?, bedroom=?, noithat=?, road_surface=?, juridical=?, is_vip=?, contacttype=?, contactname=?, contactaddress=?, contactphone=?, contactemail=?, run_date=?, update_time=? WHERE id_bds=?";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            $param = [$id_commune_ward, $id_street, $id_project, $id_user, $category, $status, $type, $title, $slug_title, $address, $maps, $sapo, $content, $images, $videos, $price, $price_type, $acreage, $facades, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $is_vip, $contacttype, $contactname, $contactaddress, $contactphone, $contactemail, $run_date, $update_time, $id_bds];

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

    function delete($id_street)
    {
        $execute = false;
        $iconn = $this->db->conn_id;
        $sql = "DELETE FROM tbl_street WHERE id_street=?";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute([$id_street])) {
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
