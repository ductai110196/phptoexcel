<?php
require_once("DBTool.php");
class m_student extends CI_Model implements DBTool
{
    private  $table = "";
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function set_table($table)
    {
        $this->table = $table;
    }

    public function get_table()
    {
        return $this->table;
    }

    public function getdata()
    { }
    public function getbyid($id)
    { }
    public function getquery($sql)
    { }
    public function insert($data = array())
    { }
    public function update($id, $data = array())
    { }
    public function delete($id)
    { }
}