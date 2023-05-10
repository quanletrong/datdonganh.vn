<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bds_model extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    function add($id_commune_ward, $id_street, $id_project, $id_user, $status, $type, $title, $slug_title, $maps, $sapo, $content, $images, $videos, $price, $acreage, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $is_vip, $expired, $create_time)
    {
        // var_dump([
        //     '$id_commune_ward' => $id_commune_ward,
        //     '$id_street'       => $id_street,
        //     '$id_project'      => $id_project,
        //     '$id_user'         => $id_user,
        //     '$status'          => $status,
        //     '$type'            => $type,
        //     '$title'           => $title,
        //     '$slug_title'      => $slug_title,
        //     '$maps'            => $maps,
        //     '$sapo'            => $sapo,
        //     '$content'         => $content,
        //     '$images'          => $images,
        //     '$videos'          => $videos,
        //     '$price'           => $price,
        //     '$acreage'         => $acreage,
        //     '$direction'       => $direction,
        //     '$floor'           => $floor,
        //     '$toilet'          => $toilet,
        //     '$bedroom'         => $bedroom,
        //     '$noithat'         => $noithat,
        //     '$road_surface'    => $road_surface,
        //     '$juridical'       => $juridical,
        //     '$is_vip'          => $is_vip,
        //     '$expired'         => $expired,
        //     '$create_time'     => $create_time
        // ]);
        // die;

        $execute = false;
        $iconn = $this->db->conn_id;
        $sql = "INSERT INTO tbl_bds (id_commune_ward, id_street, id_project, id_user, status, type, title, slug_title, maps, sapo, content, images, videos, price, acreage, direction, floor, toilet, bedroom, noithat, road_surface, juridical, is_vip, expired, create_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            $param = [$id_commune_ward, $id_street, $id_project, $id_user, $status, $type, $title, $slug_title, $maps, $sapo, $content, $images, $videos, $price, $acreage, $direction, $floor, $toilet, $bedroom, $noithat, $road_surface, $juridical, $is_vip, $expired, $create_time];

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

    function get_info($id_street)
    {
        $data = [];
        $iconn = $this->db->conn_id;
        $sql = "SELECT * FROM tbl_street WHERE id_street = ?";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute([$id_street])) {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $data;
    }

    // -1 = lấy tất cả
    function get_list_ok($id_commune_ward = '-1', $id_street = '-1', $id_project = '-1', $id_user = '-1', $status = '-1', $type = '-1', $title = '', $f_price = '-1', $t_price = '-1', $f_acreage = '-1', $t_acreage = '-1', $direction = '-1', $floor = '-1', $toilet = '-1', $bedroom = '-1', $noithat = '-1', $road_surface = '-1', $juridical = '-1', $is_vip = '-1', $f_expired = '-1', $t_expired = '-1', $f_create = '-1', $t_create = '-1', $orderby = 'id_bds', $sort = 'DESC', $limit = 30, $offset = 1)
    {
        $data = [];
        $iconn = $this->db->conn_id;
        $param = [];
        $where = "WHERE 1=1 ";
        if ($id_commune_ward != '-1') {
            $where .= "AND A.id_commune_ward =:id_commune_ward ";
            $param['id_commune_ward'] = $id_commune_ward;
        }
        if ($id_street != '-1') {
            $where .= "AND A.id_street =:id_street ";
            $param['id_street'] = $id_street;
        }
        if ($id_project != '-1') {
            $where .= "AND A.id_project =:id_project ";
            $param['id_project'] = $id_project;
        }
        if ($id_user != '-1') {
            $where .= "AND A.id_user =:id_user ";
            $param['id_user'] = $id_user;
        }
        if ($status != '-1') {
            $where .= "AND A.status =:status ";
            $param['status'] = $status;
        }
        if ($type != '-1') {
            $where .= "AND A.type =:type ";
            $param['type'] = $type;
        }
        if ($title != '') {
            $where .= "AND A.title LIKE '%:title%' ";
            $param['title'] = $title;
        }
        if ($f_price != '-1' && $t_price != '-1') {
            $where .= "AND A.price BETWEEN :f_price AND :t_price ";
            $param['f_price'] = $f_price;
            $param['t_price'] = $t_price;
        }
        if ($f_acreage != '-1' && $t_acreage != '1') {
            $where .= "AND A.acreage BETWEEN :f_acreage AND :t_acreage ";
            $param['f_acreage'] = $f_acreage;
            $param['t_acreage'] = $t_acreage;
        }
        if ($direction != '-1') {
            $where .= "AND A.direction =:direction ";
            $param['direction'] = $direction;
        }
        if ($floor != '-1') {
            $where .= "AND A.floor =:floor ";
            $param['floor'] = $floor;
        }
        if ($toilet != '-1') {
            $where .= "AND A.toilet =:toilet ";
            $param['toilet'] = $toilet;
        }
        if ($bedroom != '-1') {
            $where .= "AND A.bedroom =:bedroom ";
            $param['bedroom'] = $bedroom;
        }
        if ($noithat != '-1') {
            $where .= "AND A.noithat =:noithat ";
            $param['noithat'] = $noithat;
        }
        if ($road_surface != '-1') {
            $where .= "AND A.road_surface =:road_surface ";
            $param['road_surface'] = $road_surface;
        }
        if ($juridical != '-1') {
            $where .= "AND A.juridical =:juridical ";
            $param['juridical'] = $juridical;
        }

        if ($is_vip != '-1') {
            $where .= "AND A.is_vip =:is_vip ";
            $param['is_vip'] = $is_vip;
        }
        if ($f_expired != '-1' && $t_expired != '1') {
            $where .= "AND A.expired BETWEEN :f_expired AND :t_expired ";
            $param['f_expired'] = $f_expired;
            $param['t_expired'] = $t_expired;
        }
        if ($f_create != '-1' && $t_create != '1') {
            $where .= "AND A.create_time BETWEEN :f_create AND :t_create ";
            $param['f_create'] = $f_create;
            $param['t_create'] = $t_create;
        }


        $sql = "SELECT A.*, B.username  FROM tbl_bds as A  
        LEFT JOIN tbl_user as B ON A.id_user = B.id_user 
        $where";
        // -- ORDER BY A.:orderby, :sort 
        // -- LIMIT :limit OFFSET :offset";

        $param['orderby'] = $orderby;
        $param['sort']    = $sort;
        $param['limit']   = $limit;
        $param['offset']  = $offset;
        // var_dump($param);
        // var_dump($sql);die;
        $stmt = $iconn->prepare($sql);
        // echo json_encode($stmt, true);die;
        if ($stmt) {
            if ($stmt->execute($param)) {
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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


    // -1 = lấy tất cả
    function get_list($id_commune_ward = '-1', $id_street = '-1', $id_project = '-1', $id_user = '-1', $status = '-1', $type = '-1', $title = '', $f_price = '-1', $t_price = '-1', $f_acreage = '-1', $t_acreage = '-1', $direction = '-1', $floor = '-1', $toilet = '-1', $bedroom = '-1', $noithat = '-1', $road_surface = '-1', $juridical = '-1', $is_vip = '-1', $f_expired = '-1', $t_expired = '-1', $f_create = '-1', $t_create = '-1', $orderby = 'id_bds', $sort = 'DESC', $limit = 30, $offset = 1)
    {
        $data = [];
        $iconn = $this->db->conn_id;
        $param = [];
        $where = "WHERE 1=1 ";
        if ($id_commune_ward != '-1')  $where                .= "AND A.id_commune_ward =:id_commune_ward ";
        if ($id_street != '-1') $where                       .= "AND A.id_street =:id_street ";
        if ($id_project != '-1')  $where                     .= "AND A.id_project =:id_project ";
        if ($id_user != '-1') $where                         .= "AND A.id_user =:id_user ";
        // if ($status != '-1')  $where                         .= "AND A.status =:status ";
        // if ($type != '-1')  $where                           .= "AND A.type =:type ";
        // if ($title != '') $where                             .= "AND A.title LIKE '%:title%' ";
        // if ($f_price != '-1' && $t_price != '-1') $where     .= "AND A.price BETWEEN :f_price AND :t_price ";
        // if ($f_acreage != '-1' && $t_acreage != '1') $where  .= "AND A.acreage BETWEEN :f_acreage AND :t_acreage ";
        // if ($direction != '-1')  $where                      .= "AND A.direction =:direction ";
        // if ($floor != '-1')  $where                          .= "AND A.floor =:floor ";
        // if ($toilet != '-1')  $where                         .= "AND A.toilet =:toilet ";
        // if ($bedroom != '-1')  $where                        .= "AND A.bedroom =:bedroom ";
        // if ($noithat != '-1')  $where                        .= "AND A.noithat =:noithat ";
        // if ($road_surface != '-1')  $where                   .= "AND A.road_surface =:road_surface ";
        // if ($juridical != '-1')  $where                      .= "AND A.juridical =:juridical ";
        // if ($is_vip != '-1')  $where                         .= "AND A.is_vip =:is_vip ";
        // if ($f_expired != '-1' && $t_expired != '1')  $where .= "AND A.expired BETWEEN :f_expired AND :t_expired ";
        // if ($f_create != '-1' && $t_create != '1')  $where   .= "AND A.create_time BETWEEN :f_create AND :t_create ";

        $sql = "SELECT A.*, B.username  FROM tbl_bds as A  
        LEFT JOIN tbl_user as B ON A.id_user = B.id_user 
        $where";
        
        // ORDER BY A.:orderby, :sort 
        // LIMIT :limit OFFSET :offset

        $stmt = $iconn->prepare($sql);
        // echo json_encode($stmt, true);die;
        if ($stmt) {
            $stmt->bindValue(':id_commune_ward', $id_commune_ward, PDO::PARAM_INT);
            $stmt->bindValue(':id_street', $id_street, PDO::PARAM_INT);
            $stmt->bindValue(':id_project', $id_project, PDO::PARAM_INT);
            $stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
            // $stmt->bindParam(':id_commune_ward', $id_commune_ward, PDO::PARAM_INT);
            // $stmt->bindParam(':id_commune_ward', $id_commune_ward, PDO::PARAM_INT);
            // $stmt->bindParam(':id_commune_ward', $id_commune_ward, PDO::PARAM_INT);
            // $stmt->bindParam(':id_commune_ward', $id_commune_ward, PDO::PARAM_INT);
            // $stmt->bindParam(':id_commune_ward', $id_commune_ward, PDO::PARAM_INT);
            // $stmt->bindParam(':id_commune_ward', $id_commune_ward, PDO::PARAM_INT);
            // $stmt->bindParam(':id_commune_ward', $id_commune_ward, PDO::PARAM_INT);
            // $stmt->bindParam(':id_commune_ward', $id_commune_ward, PDO::PARAM_INT);
            // $stmt->bindParam(':id_commune_ward', $id_commune_ward, PDO::PARAM_INT);
            // $stmt->bindParam(':id_commune_ward', $id_commune_ward, PDO::PARAM_INT);
            // $stmt->bindParam(':id_commune_ward', $id_commune_ward, PDO::PARAM_INT);
            // $stmt->bindParam(':id_commune_ward', $id_commune_ward, PDO::PARAM_INT);
            // $stmt->bindParam(':id_commune_ward', $id_commune_ward, PDO::PARAM_INT);
            // $stmt->bindParam(':id_commune_ward', $id_commune_ward, PDO::PARAM_INT);
            // $stmt->bindParam(':id_commune_ward', $id_commune_ward, PDO::PARAM_INT);
            // $stmt->bindParam(':id_commune_ward', $id_commune_ward, PDO::PARAM_INT);
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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

    function edit($id_street, $name, $status)
    {
        $execute = false;
        $iconn = $this->db->conn_id;
        $sql = "UPDATE tbl_street SET name=?, status=?, update_time=? WHERE id_street=?";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            $param = [$name, $status, date('Y-m-d H:i:s'), $id_street];

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
