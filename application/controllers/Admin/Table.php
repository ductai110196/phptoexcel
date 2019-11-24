<?php
class Table extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model("m_tool");
    }
    public function index()
    {
        $this->data["page_title"] = "Table";
        if ($this->session->userdata("db") != "") {
            $this->db->db_select($this->session->userdata("db"));
            $this->data["before_head"] = $this->m_tool->getquery("SHOW TABLES");
            if ($this->session->userdata("table") != "") {
                $this->data["curent"] = $this->session->userdata("table");
            } else {
                $this->data["curent"] = "a";
            }
        }
        $this->render("admin/table/index.php");
        $this->load->view("admin/table/script.php");
    }
    public function check()
    {
        $data = $this->input->get("name");
        $this->session->set_userdata("table", $data);
        redirect(base_url() . "index.php/admin/du-lieu/bang");
    }
}