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
        $sql = "SELECT A.*, B.fullname FROM tbl_articles A
        LEFT JOIN tbl_user B ON A.id_user = B.id_user
         WHERE id_articles =?;";
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

        if ($title != '')  $where .= "AND A.title LIKE '%$title%' ";
        if ($type != '')  $where  .= "AND A.type IN ($type) ";
        
        $sql = "
            SELECT A.* FROM tbl_articles as A
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

                        if($row['type'] == NEWS) {
                            $loai = LINK_TIN_TUC;
                        } else if($row['type']== AUCTION) {
                            $loai =  LINK_DAU_GIA;
                        } else {
                            $loai =  LINK_TAI_LIEU;
                        }
                        
                        $row['link'] = ROOT_DOMAIN . $loai . '/' . $row['slug'] .'-p'. $row['id_articles'];
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

    function get_num_article_by_commune_ward($type_article)
    {
        $data = [];
        $iconn = $this->db->conn_id;
        

        $sql = "SELECT A.*, count(B.id_articles) as num_articles  FROM tbl_commune_ward as A  
            LEFT JOIN tbl_articles as B ON A.id_commune_ward = B.id_commune_ward AND B.status = 1
            WHERE A.status = 1 AND B.type = $type_article  GROUP BY A.id_commune_ward ORDER BY num_articles DESC; ";

        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                // echo json_encode($stmt, true);die;
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  
                        $year = date('Y', strtotime($row['create_time']));
                        $month = date('m', strtotime($row['create_time']));
                        $row['image_path'] = url_image($row['image'], PUBLIC_UPLOAD_PATH . $year . '/' . $month . '/');
                        
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

    
}
