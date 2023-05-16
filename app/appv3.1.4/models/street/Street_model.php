<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Street_model extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    function add($name, $status, $id_user)
    {
        $execute = false;
        $iconn = $this->db->conn_id;
        $sql = "INSERT INTO tbl_street (name, status, id_user, create_time) VALUES (?, ?, ?, ?)";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            $param = [$name, $status, $id_user, date('Y-m-d H:i:s')];

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

    function get_list($status = '')
    {
        $data = [];
        $iconn = $this->db->conn_id;

        $where = 'WHERE 1=1 ';
        $where .= $status !== '' ? " AND A.status =? " : "";

        $sql = "
        SELECT A.*, B.username 
        FROM tbl_street as A 
        LEFT JOIN tbl_user as B ON A.id_user = B.id_user 
        $where
        ORDER BY A.id_street DESC";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute([$status])) {
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
