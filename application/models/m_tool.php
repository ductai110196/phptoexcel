<?php
class m_tool extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getquery($sql)
    {
        return $this->db->query($sql)->result();
    }
}