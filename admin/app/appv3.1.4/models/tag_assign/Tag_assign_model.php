<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tag_assign_model extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    function add($id_tag, $id_assign, $type_assign, $id_user, $create_time)
    {
        $new_id = 0;
        $iconn = $this->db->conn_id;
        $sql = "INSERT INTO tbl_tag_assign (id_tag, id_assign, type_assign, id_user, create_time) VALUES (?, ?, ?, ?, ?)";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            $param = [$id_tag, $id_assign, $type_assign, $id_user, $create_time];

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

    function get_info($id_tag)
    {
        $data = [];
        $iconn = $this->db->conn_id;
        $sql = "SELECT * FROM tbl_tag WHERE id_tag = ?";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute([$id_tag])) {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $data;
    }

    function get_tag_assign($id_assign, $type_assign)
    {
        $data = [];
        $iconn = $this->db->conn_id;
        $sql = "
        SELECT A.* FROM tbl_tag as A
        INNER JOIN tbl_tag_assign as B ON A.id_tag = B.id_tag
        WHERE B.id_assign = ? AND B.type_assign = ? AND A.status = 1";

        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute([$id_assign, $type_assign])) {
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $data[$row['id_tag']] = $row;
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
    


    function get_list($status, $name)
    {
        $data = [];
        $iconn = $this->db->conn_id;

        $where = 'WHERE 1=1 ';
        $where .= $name != '' ? " AND A.name LIKE '%$name%' " : "";
        $where .= $status != '' ? " AND A.status =? " : "";

        $sql = "
        SELECT A.*, B.username 
        FROM tbl_tag as A 
        LEFT JOIN tbl_user as B ON A.id_user = B.id_user 
        $where
        ORDER BY A.id_tag DESC";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute([$status])) {
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $data[$row['id_tag']] = $row;
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

    function edit($id_tag, $name, $status)
    {
        $execute = false;
        $iconn = $this->db->conn_id;
        $sql = "UPDATE tbl_tag SET name=?, status=?, update_time=? WHERE id_tag=?";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            $param = [$name, $status, date('Y-m-d H:i:s'), $id_tag];

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

    function delete($id_tag)
    {
        $execute = false;
        $iconn = $this->db->conn_id;
        $sql = "DELETE FROM tbl_tag WHERE id_tag=?";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute([$id_tag])) {
                $execute = true;
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $execute;
    }

    function delete_tag_assign($id_assign, $type_assign)
    {
        $execute = false;
        $iconn = $this->db->conn_id;
        $sql = "DELETE FROM tbl_tag_assign WHERE id_assign=? AND type_assign= ?";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute([$id_assign, $type_assign])) {
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
