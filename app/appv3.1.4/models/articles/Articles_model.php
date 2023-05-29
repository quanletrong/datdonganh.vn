<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Articles_model extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
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

    function get_list($type, $title, $limit, $offset)
    {
        $data = [];
        $iconn = $this->db->conn_id;

        $where = "WHERE A.status=1 ";

        if ($title != '')  $where                       .= "AND A.title LIKE '%$title%' ";
        if ($type != '')  $where                        .= "AND A.type = $type ";
        
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
                        $row['image_path'] = ROOT_DOMAIN . PUBLIC_UPLOAD_PATH . $year . '/' . $month . '/' . $row['image'];
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
    
    
    function get_list_by_view($type, $limit)
    {
        $data = [];
        $iconn = $this->db->conn_id;

        $where = "WHERE A.status=1 ";
        if ($type != '')  $where                        .= "AND A.type = $type ";

        $sql = "SELECT A.* FROM tbl_articles as A
                $where
                ORDER BY A.view DESC
                LIMIT $limit;";

        // var_dump($sql);die;
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $row['image_path'] = '';
                        $year = date('Y', strtotime($row['create_time']));
                        $month = date('m', strtotime($row['create_time']));
                        $row['image_path'] = ROOT_DOMAIN . PUBLIC_UPLOAD_PATH . $year . '/' . $month . '/' . $row['image'];
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

    
}
