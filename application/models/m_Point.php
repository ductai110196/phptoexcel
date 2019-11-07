<?php
require_once("DBTool.php");
class m_Point extends CI_Model implements DBTool
{

    private $table = "thongtin";
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function getdata($json = false)
    {
        return !$json ? $this->db->get($this->table)->result() : json_encode($this->db->get($this->table)->result(), JSON_UNESCAPED_UNICODE);
    }
    public function getbyid($id)
    { }
    public function insert($data = array())
    { }
    public function update($id, $data = array())
    { }
    public function delete($id)
    { }
    public function getquery($sql)
    { }
}