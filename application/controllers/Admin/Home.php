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

    //update to database

    public function update()
    {
        $idhs = $this->input->post("idhs");
        $sv = array(
            "HoTen" => $this->input->post("hoten"),
            "GioiTinh" => $this->input->post("gioitinh"),
            "NgaySinh" => $this->input->post("ngaysinh"),
            "DiaChi" => $this->input->post("diachi")
        );

        $id_dt = $this->input->post("iddt");
        $toan = $this->input->post("diemtoan");
        $ly = $this->input->post("diemly");
        $hoa = $this->input->post("diemhoa");
        $dtb = ($toan + $ly + $hoa) / 3;
        $point = array(
            "Toan" => $toan,
            "Ly" => $ly,
            "Hoa" => $hoa,
            "DTB" => round($dtb, 2)
        );
        $res = $this->m_db->update("quanlydiem", "hocsinh", $idhs, $sv);
        $result = $this->m_db->update("quanlydiem", "diemthi", $id_dt, $point);
        if ($res && $result) {
            echo "Cập nhật dữ liệu thành công";
        } else {
            echo "Cập nhật dữ liệu thất bại";
        }
        redirect(base_url() . 'index.php/admin/trang-chu');
    }

    //update id return view 
    public function edit()
    {
        $this->data["page_title"] = "Edit";
        $id = $this->input->get('id');
        $query = "SELECT * from hocsinh INNER JOIN diemthi  ON hocsinh.id = diemthi.IDHS WHERE hocsinh.id = " . $id . "";
        $this->data["before_head"] = $this->m_db->getquery("quanlydiem", $query);
        $this->render("admin/home/edit.php");
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
        redirect(base_url() . 'index.php/admin/trang-chu');
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
                "DTB" => round($dtb, 2)
            );
            $rs = $this->m_db->insert("quanlydiem", "diemthi", $point);
            echo "Thêm dữ Liệu Thành Công";
        } else {
            echo "Thêm dữ Liệu Không Thành Công";
        }
        redirect(base_url() . 'index.php/admin/trang-chu');
    }
    public function upload()
    {
        $file = $_FILES["file"]["tmp_name"];
        $data = $this->excel->loadexcel($file);
        $status = 0;
        for ($i = 2; $i <= count($data); $i++) {
            $ngaysinh = is_numeric($data[$i]["D"]) ? $this->dateformatexcel($data[$i]["D"]) : date("Y-m-d", strtotime($data[$i]["D"]));
            $sv = array(
                "HoTen" => $data[$i]["B"],
                "GioiTinh" => $data[$i]["C"] == "Nam" ? 1 : 0,
                "NgaySinh" => $ngaysinh,
                "DiaChi" => $data[$i]["E"]
            );
            $sql = 'SELECT * FROM `hocsinh` WHERE HoTen = "' . $data[$i]["B"] . '" And NgaySinh = "' .   $ngaysinh . '"';
            if (count($this->m_db->getquery("quanlydiem", $sql)) == 0) {
                $result = $this->m_db->insert("quanlydiem", "hocsinh", $sv);
                $idhs  = $result;
                $toan = $data[$i]["H"];
                $ly = $data[$i]["F"];
                $hoa = $data[$i]["G"];
                $dtb = $data[$i]["I"];
                $point = array(
                    "IDHS" => $idhs,
                    "Toan" => $toan,
                    "Ly" => $ly,
                    "Hoa" => $hoa,
                    "DTB" => $dtb
                );
                $rs = $this->m_db->insert("quanlydiem", "diemthi", $point);
                $status = 1;
            } else {
                $status = 0;
            }
        }
        echo $status;
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
        return gmdate("Y/m/d", $UNIX_DATE);
    }

    public function dateformattomysql($date)
    {
        return date('Y-m-d', strtotime($date));
    }
}