<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contact_model extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }


    function get_info($id_contact)
    {
        $data = [];
        $iconn = $this->db->conn_id;
        $sql = "SELECT * FROM tbl_contact WHERE id_contact = ?";
        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute([$id_contact])) {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                var_dump($stmt->errorInfo());
                die;
            }
        }
        $stmt->closeCursor();
        return $data;
    }

    function update_status($status, $id_contact)
    {
        $execute = false;
        $iconn = $this->db->conn_id;
        $sql = "UPDATE tbl_contact SET status=$status WHERE id_contact = $id_contact ;";

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

    function get_list_can_tu_van($fullname, $phone, $email, $content, $status, $type)
    {
        $data = [];
        $iconn = $this->db->conn_id;

        $where = 'WHERE 1=1 ';
        $where .= $fullname !== '' ? " AND tbl_contact.fullname LIKE ? " : "";
        $where .= $phone    !== '' ? " AND tbl_contact.phone LIKE ? " : "";
        $where .= $email    !== '' ? " AND tbl_contact.email LIKE ? " : "";
        $where .= $content  !== '' ? " AND tbl_contact.content LIKE ? " : "";
        $where .= $status   !== '' ? " AND tbl_contact.status = $status " : "";
        $where .= $type     !== '' ? " AND tbl_contact.type = $type " : "";

        $sql = " SELECT tbl_contact.*, tbl_bds.title as title_bds FROM tbl_contact ";
        $sql .= "LEFT JOIN tbl_bds ON tbl_bds.id_bds = tbl_contact.id_bds ";
        $sql .= $where;
        $sql .= "ORDER BY tbl_contact.status ASC, tbl_contact.id_contact DESC";

        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute(["%$fullname%", "%$phone%", "%$email%", "%$content%"])) {
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $data[$row['id_contact']] = $row;
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

    function get_list_yclhl($fullname, $phone, $email, $content, $status, $type, $id_user)
    {
        $data = [];
        $iconn = $this->db->conn_id;
        $where = 'WHERE 1=1 ';
        $where .= $fullname !== '' ? " AND tbl_contact.fullname LIKE ? " : "";
        $where .= $phone    !== '' ? " AND tbl_contact.phone LIKE ? " : "";
        $where .= $email    !== '' ? " AND tbl_contact.email LIKE ? " : "";
        $where .= $content  !== '' ? " AND tbl_contact.content LIKE ? " : "";
        $where .= $status   !== '' ? " AND tbl_contact.status = $status " : "";
        $where .= $id_user  !== '' ? " AND tbl_bds.id_user = $id_user " : '';
        $where .= " AND tbl_contact.type = $type ";

        $sql = " SELECT tbl_contact.*, tbl_bds.title as title_bds FROM tbl_contact ";
        $sql .= "LEFT JOIN tbl_bds ON tbl_bds.id_bds = tbl_contact.id_bds ";
        $sql .= $where;
        $sql .= "ORDER BY tbl_contact.status ASC, tbl_contact.id_contact DESC";

        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute(["%$fullname%", "%$phone%", "%$email%", "%$content%"])) {
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $data[$row['id_contact']] = $row;
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
}
