<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Commune_model extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    function add($name, $type, $status, $image, $id_user)
    {
        $execute = false;
        $iconn = $this->db->conn_id;
        $sql = "INSERT INTO tbl_commune_ward (name, type, status, image, id_user, create_time) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            $param = [$name, $type, $status, $image, $id_user, date('Y-m-d H:i:s')];

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

    function get_info($id_commune)
    {
        $data = [];
        $iconn = $this->db->conn_id;
        $sql = "SELECT * FROM tbl_commune_ward WHERE id_commune_ward = ?";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            // $stmt->bindParam(':id_commune', $id_commune, PDO::PARAM_STR);
            if ($stmt->execute([$id_commune])) {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $data;
    }

    function get_list($status = '')
    {
        $data = [];
        $iconn = $this->db->conn_id;

        $where = 'WHERE 1=1 ';
        $where .= $status !== '' ? " AND A.status =? " : "";

        $sql = " SELECT A.*, B.username 
        FROM tbl_commune_ward as A 
        LEFT JOIN tbl_user as B ON A.id_user = B.id_user 

        ORDER BY `name` ASC";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $row['image_path'] = '';
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

    function edit($id_commune, $name, $type, $status, $image)
    {
        $execute = false;
        $iconn = $this->db->conn_id;
        $sql = "UPDATE tbl_commune_ward SET name=?, type=?, status=?, image=?, update_time=? WHERE id_commune_ward=?";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            $param = [$name, $type, $status, $image, date('Y-m-d H:i:s'), $id_commune];

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

    function delete($id_commune)
    {
        $execute = false;
        $iconn = $this->db->conn_id;
        $sql = "DELETE FROM tbl_commune_ward WHERE id_commune_ward=?";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute([$id_commune])) {
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
