<?php
class Home extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("Excel");
        $this->load->library('table');
        $this->load->model("m_db");
    }
    public function index()
    {
        $this->data["page_title"] = "Home";
        $sql = "SELECT * from hocsinh INNER JOIN diemthi  ON hocsinh.id = diemthi.IDHS";
        $this->data["before_head"] = $this->m_db->getquery("quanlydiem", $sql);
        $this->render("admin/home/index.php");
        $this->load->view("admin/home/script.php");
    }

    //delete id
    public function delete()
    {
        $id = $this->input->get("id");
        if ($this->m_db->delete("quanlydiem", "hocsinh", $id)) {
            echo "thành công";
        } else {
            echo "thất bại";
        }
        redirect(base_url() . 'index.php/admin/trang-chu', 'refresh');
    }
    // add data view 
    public function add()
    {
        $this->data["page_title"] = "Add Data";
        $this->render("admin/home/add.php");
    }
    //insert data - > model
    public function insert()
    {
        $sv = array(
            "HoTen" => $this->input->post("hoten"),
            "GioiTinh" => $this->input->post("gioitinh"),
            "NgaySinh" => $this->input->post("ngaysinh"),
            "DiaChi" => $this->input->post("diachi")
        );
        $sql = 'SELECT * FROM `hocsinh` WHERE HoTen = "' . $this->input->post("hoten") . '" And NgaySinh = "' . $this->input->post("ngaysinh") . '"';
        if (count($this->m_db->getquery("quanlydiem", $sql)) == 0) {
            $result = $this->m_db->insert("quanlydiem", "hocsinh", $sv);
            $idhs  = $result;
            $toan = $this->input->post("diemtoan");
            $ly = $this->input->post("diemly");
            $hoa = $this->input->post("diemhoa");
            $dtb = ($toan + $ly + $hoa) / 3;
            $point = array(
                "IDHS" => $idhs,
                "Toan" => $toan,
                "Ly" => $ly,
                "Hoa" => $hoa,
                "DTB" => $dtb
            );
            $rs = $this->m_db->insert("quanlydiem", "diemthi", $point);
            echo "Thêm dữ Liệu Thành Công";
        } else {
            echo "Thêm dữ Liệu Không Thành Công";
        }
        redirect(base_url() . 'index.php/admin/trang-chu', 'refresh');
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
        $this->table->set_template($this->setuptable());
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