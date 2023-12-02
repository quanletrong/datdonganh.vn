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

    function get_list($fullname, $phone, $email, $content, $status = '')
    {
        $data = [];
        $iconn = $this->db->conn_id;

        $where = 'WHERE 1=1 ';
        $where .= $fullname !== '' ? " AND A.fullname LIKE ? " : "";
        $where .= $phone    !== '' ? " AND A.phone LIKE ? " : "";
        $where .= $email    !== '' ? " AND A.email LIKE ? " : "";
        $where .= $content  !== '' ? " AND A.content LIKE ? " : "";
        $where .= $status   !== '' ? " AND A.status =? " : "";

        $sql = " SELECT * FROM tbl_contact ";
        $sql .= $where;
        $sql .= "ORDER BY tbl_contact.status ASC, tbl_contact.id_contact DESC";

        $stmt = $iconn->prepare($sql);
        if ($stmt) {
            if ($stmt->execute(["%$fullname%", "%$phone%", "%$email%", "%$content%", $status])) {
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
