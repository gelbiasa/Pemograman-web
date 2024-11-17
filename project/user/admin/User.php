<?php
class User {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getTotalUsersByStatus($status) {
        $sql = "SELECT COUNT(*) AS total FROM m_user WHERE user_status = '$status' AND EXISTS (SELECT 1 FROM m_survey WHERE m_user.user_id = m_survey.user_id AND survey_tanggal IS NOT NULL)";
        $result = $this->db->query($sql);
        return $this->db->fetchAssoc($result)['total'];
    }

    public function getSurveyUsers() {
        $sql = "SELECT 
                m_survey.survey_id, 
                m_survey.survey_nama AS jenis_survey, 
                m_user.Nama AS username, 
                m_user.user_status AS user, 
                DATE_FORMAT(m_survey.survey_tanggal, '%d/%m/%Y') AS date 
                FROM 
                    m_survey 
                INNER JOIN 
                    m_user 
                ON 
                    m_survey.user_id = m_user.user_id 
                WHERE 
                    m_survey.survey_tanggal IS NOT NULL;
                ";
        return $this->db->query($sql);
    }
}
?>
