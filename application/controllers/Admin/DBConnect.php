<?php
class DBConnect extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("m_tool");
        $this->load->database();
    }

    public function index()
    {
        $this->data["page_title"] = "Database";
        $this->data["before_head"] = $this->m_tool->getquery("SHOW DATABASES");
        if ($this->session->userdata("db") != "") {
            $this->db->db_select($this->session->userdata("db"));
        }
        $this->data["curent_db"] = $this->db->database;
        $this->render("admin/database/index.php");
        $this->load->view("admin/database/script.php");
    }

    public function check()
    {
        $data = $this->input->get("name");
        $this->session->set_userdata("db", $data);
        redirect(base_url() . "index.php/admin/co-so-du-lieu");
    }
}