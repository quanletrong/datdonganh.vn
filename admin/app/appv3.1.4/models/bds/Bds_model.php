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

    function get_info($id_bds)
    {
        $data = [];
        $iconn = $this->db->conn_id;
        $sql = "SELECT * FROM tbl_bds WHERE id_bds = ?";
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
            ORDER BY A.$orderby $sort 
            LIMIT $limit OFFSET $offset";

            // var_dump($sql);die;
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            if ($stmt->execute($param)) {
                // echo json_encode($stmt, true);die;
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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


    // -1 = lấy tất cả
    function get_list_loi($id_commune_ward = '-1', $id_street = '-1', $id_project = '-1', $id_user = '-1', $status = '-1', $type = '-1', $title = '', $f_price = '-1', $t_price = '-1', $f_acreage = '-1', $t_acreage = '-1', $direction = '-1', $floor = '-1', $toilet = '-1', $bedroom = '-1', $noithat = '-1', $road_surface = '-1', $juridical = '-1', $is_vip = '-1', $f_expired = '-1', $t_expired = '-1', $f_create = '-1', $t_create = '-1', $orderby = 'A.id_bds', $sort = 'DESC', $limit = 30, $offset = 1)
    {
        $data = [];
        $iconn = $this->db->conn_id;
        $param = [];
        $where = "WHERE 1=1 ";
        if ($id_commune_ward != '-1') $where                 .= "AND A.id_commune_ward =:id_commune_ward ";
        if ($id_street != '-1') $where                       .= "AND A.id_street =:id_street ";
        if ($id_project != '-1') $where                      .= "AND A.id_project =:id_project ";
        if ($id_user != '-1') $where                         .= "AND A.id_user =:id_user ";
        if ($status != '-1')  $where                         .= "AND A.status =:status ";
        if ($type != '-1')  $where                           .= "AND A.type =:type ";
        if ($title != '') $where                             .= "AND A.title LIKE '%:title%' ";
        if ($f_price != '-1' && $t_price != '-1') $where     .= "AND A.price BETWEEN :f_price AND :t_price ";
        if ($f_acreage != '-1' && $t_acreage != '1') $where  .= "AND A.acreage BETWEEN :f_acreage AND :t_acreage ";
        if ($direction != '-1')  $where                      .= "AND A.direction =:direction ";
        if ($floor != '-1')  $where                          .= "AND A.floor =:floor ";
        if ($toilet != '-1')  $where                         .= "AND A.toilet =:toilet ";
        if ($bedroom != '-1')  $where                        .= "AND A.bedroom =:bedroom ";
        if ($noithat != '-1')  $where                        .= "AND A.noithat =:noithat ";
        if ($road_surface != '-1')  $where                   .= "AND A.road_surface =:road_surface ";
        if ($juridical != '-1')  $where                      .= "AND A.juridical =:juridical ";
        if ($is_vip != '-1')  $where                         .= "AND A.is_vip =:is_vip ";
        if ($f_expired != '-1' && $t_expired != '1')  $where .= "AND A.expired BETWEEN :f_expired AND :t_expired ";
        if ($f_create != '-1' && $t_create != '1')  $where   .= "AND A.create_time BETWEEN :f_create AND :t_create ";
        var_dump($where);
        die;

        $sql = "SELECT A.*, B.username  FROM tbl_bds as A   
        LEFT JOIN tbl_user as B ON A.id_user = B.id_user 
        $where
        ORDER BY :orderby, :sort 
        LIMIT :limit OFFSET :offset;";

        $stmt = $iconn->prepare($sql);
        // echo json_encode($stmt, true);die;
        if ($stmt) {
            $stmt->bindValue(':orderby', $orderby, PDO::PARAM_STR);
            $stmt->bindValue(':sort', $sort, PDO::PARAM_STR);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
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
