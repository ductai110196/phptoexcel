<?php
class Upload extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("Excel");
        $this->load->model("m_db");
    }
    public function index()
    {
        $this->data["page_title"] = "Index";
        $sql = "SELECT * FROM hocsinh INNER JOIN lop ON hocsinh.id_lop = lop.id";
        $this->data["before_head"] = $this->m_db->getquery("quanlyhocsinh", $sql);
        $this->render("admin/upload/index.php");
        $this->load->view("admin/upload/script.php");
    }
    //excute upload data;
    public function add()
    {
        $this->data["page_title"] = "Add";
        $file = $_FILES["file"]["tmp_name"];
        $list = $this->excel->ListSheet($file);
        foreach ($list as $item) {
            $lop = array(
                "TenLop" => $item
            );
            $result  = $this->m_db->insert("quanlyhocsinh", "lop", $lop);
            $data =  $this->excel->ExcelReader($file, $item);
            for ($i = 2; $i <= count($data); $i++) {
                $hs = array(
                    "id_lop" => $result,
                    "HoTen" => $data[$i]["A"],
                    "Toan" => $data[$i]["B"],
                    "Ly" => $data[$i]["C"],
                    "Hoa" => $data[$i]["D"]
                );
                $status = $this->m_db->insert("quanlyhocsinh", "hocsinh", $hs);
                echo 1;
            }
        }
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
}