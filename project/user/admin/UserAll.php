<?php
class User {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getTotalUsersByStatus($status) {
        $query = "SELECT COUNT(*) AS total FROM m_user WHERE user_status = ?";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bind_param("s", $status);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }

    public function getUsers() {
        $users = array();

        // Query untuk mengambil data dari tabel m_user
        $sql_m_user = "SELECT Nama AS username, user_status AS user FROM m_user WHERE user_status != 'admin'";
        $result_m_user = $this->db->query($sql_m_user);

        while ($row_m_user = $this->db->fetchAssoc($result_m_user)) {
            $username = $row_m_user['username'];
            $users[$username] = $row_m_user;
        }

        // Query untuk mengambil data dari tabel responden
        $responden_tables = ['t_responden_mahasiswa', 't_responden_alumni', 't_responden_industri'];
        foreach ($responden_tables as $table) {
            $sql_responden = "SELECT responden_nama AS username, responden_email AS email FROM $table";
            $result_responden = $this->db->query($sql_responden);

            while ($row_responden = $this->db->fetchAssoc($result_responden)) {
                $username = $row_responden['username'];
                if (isset($users[$username])) {
                    $users[$username]['email'] = $row_responden['email'];
                } else {
                    $users[$username] = $row_responden;
                }
            }
        }

        // Ubah array $users menjadi array numerik agar nomor urut bisa digunakan sebagai kunci
        return array_values($users);
    }
}
?>
