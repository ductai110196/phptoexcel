<?php
require_once("DBTool.php");
class m_db extends CI_Model implements DBTool
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getdata($db, $table)
    {
        $this->db->db_select($db);
        return $this->db->get($table)->result();
    }
    public function getbyid($db, $table, $id)
    {
        $this->db->db_select($db);
        $this->db->where("id", $id);
        $this->db->get($table)->result();
    }
    public function getquery($db, $sql)
    {
        $this->db->db_select($db);
        return $this->db->query($sql)->result();
    }
    public function insert($db, $table, $data = array())
    {
        $this->db->db_select($db);
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function update($db, $table, $id, $data = array())
    {
        $this->db->db_select($db);
        $this->db->where("id", $id);
        return $this->db->update($table, $data);
    }
    public function delete($db, $table, $id)
    {
        $this->db->db_select($db);
        $this->db->where("id", $id);
        return $this->db->delete($table);
    }
}