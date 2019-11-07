<?php
require_once("DBTool.php");
class m_db extends CI_Model implements DBTool
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function getdata()
    { }
    public function getbyid($id)
    { }
    public function getquery($sql)
    {
        return $this->db->query($sql)->result();
    }
    public function insert($data = array())
    { }
    public function update($id, $data = array())
    { }
    public function delete($id)
    { }
}