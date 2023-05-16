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
