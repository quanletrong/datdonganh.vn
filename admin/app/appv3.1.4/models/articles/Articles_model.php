<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Articles_model extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    function add($status, $type, $slug, $title, $image, $sapo, $content, $origin, $is_hot, $id_user, $create_time)
    {
        $new_id = 0;
        $iconn = $this->db->conn_id;
        $sql = "INSERT INTO tbl_articles (`status`, `type`, slug, `title`, `image`, sapo, content, origin, is_hot, id_user, create_time, update_time, create_time_set) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            $param = [$status, $type, $slug, $title, $image, $sapo, $content, $origin, $is_hot, $id_user, $create_time, $create_time, $create_time];

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

    function get_info($id_article)
    {
        $data = [];
        $iconn = $this->db->conn_id;
        $sql = "SELECT * FROM tbl_articles WHERE id_articles =?;";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute([$id_article])) {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $data;
    }

    function get_list($status, $type, $title, $id_user, $f_create, $t_create, $limit, $offset)
    {
        $data = [];
        $iconn = $this->db->conn_id;

        $where = "WHERE 1=1 ";

        if ($title != '')  $where                       .= "AND A.title LIKE '%$title%' ";
        if ($status != '')  $where                      .= "AND A.status = $status ";
        if ($type != '')  $where                        .= "AND A.type = $type ";
        if ($id_user != '') $where                      .= "AND A.id_user = $id_user ";
        if ($f_create != '' && $t_create != '')  $where .= "AND A.create_time BETWEEN '$f_create' AND '$t_create' ";

        $sql = "
            SELECT A.*, B.username FROM tbl_articles as A  
            LEFT JOIN tbl_user as B ON A.id_user = B.id_user 
            $where 
            ORDER BY A.id_articles DESC 
            LIMIT $limit OFFSET $offset";

        // var_dump($sql);die;
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $row['image_path'] = '';
                        $year = date('Y', strtotime($row['create_time']));
                        $month = date('m', strtotime($row['create_time']));
                        $row['image_path'] = url_image($row['image'], PUBLIC_UPLOAD_PATH . $year . '/' . $month . '/');
                        $data[$row['id_articles']] = $row;
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

    function edit($status, $slug, $title, $image, $sapo, $content, $origin, $update_time, $create_time_set, $id_article)
    {
        $execute = false;
        $iconn = $this->db->conn_id;
        $sql = "UPDATE tbl_articles SET `status`=?, slug=?, `title`=?, `image`=?, sapo=?, content=?, origin=?, update_time=?, create_time_set=? WHERE id_articles=?";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            $param = [$status, $slug, $title, $image, $sapo, $content, $origin, $update_time, $create_time_set, $id_article];

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

    function delete($id_articles)
    {
        $execute = false;
        $iconn = $this->db->conn_id;
        $sql = "DELETE FROM tbl_articles WHERE id_articles=?";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute([$id_articles])) {
                $execute = true;
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $execute;
    }

    function update_status($status, $id_articles)
    {
        $execute = false;
        $iconn = $this->db->conn_id;
        $sql = "UPDATE tbl_articles SET status=$status WHERE id_articles = $id_articles ;";

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
