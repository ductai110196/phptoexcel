<?php
class Home extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("m_Point");
        $this->load->library("Excel");
        $this->load->library('table');
    }
    public function index()
    {
        $this->data["page_title"] = "Home";
        //$this->data["before_head"] = $this->m_Point->getdata(true);
        $this->render("admin/home/index.php");
        $this->load->view("admin/home/script.php");
    }

    public function upload()
    {
        $file = $_FILES["file"]["tmp_name"];
        $data = $this->excel->loadexcel($file);
        for ($i = 1; $i <= count($data); $i++) {
            if ($i == 1) {
                $this->table->set_heading($data[$i]);
            } else {
                $data[$i]["D"] = is_numeric($data[$i]["D"]) ? $this->dateformatexcel($data[$i]["D"]) : $data[$i]["D"];
                $this->table->add_row($data[$i]);
            }
        }
        // $this->table->set_template($this->setuptable());
        echo $this->table->generate();
    }


    public function setuptable()
    {
        $template = array(
            'table_open'            => '<table class="table table-bordered table-hover shadow">',

            'thead_open'            => '<thead>',
            'thead_close'           => '</thead>',

            'heading_row_start'     => '<tr class="bg-success text-white">',
            'heading_row_end'       => '</tr>',
            'heading_cell_start'    => '<th>',
            'heading_cell_end'      => '</th>',

            'tbody_open'            => '<tbody>',
            'tbody_close'           => '</tbody>',

            'row_start'             => '<tr>',
            'row_end'               => '</tr>',
            'cell_start'            => '<td>',
            'cell_end'              => '</td>',

            'row_alt_start'         => '<tr>',
            'row_alt_end'           => '</tr>',
            'cell_alt_start'        => '<td>',
            'cell_alt_end'          => '</td>',

            'table_close'           => '</table>'
        );
        return $template;
    }

    public function dateformatexcel($date)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $UNIX_DATE = ($date - 25569) * 86400;
        return gmdate("d/m/Y", $UNIX_DATE);
    }
}