<?php
include "../model/pdo.php";
include "../model/danhmuc.php";
include "../model/sanpham.php";
include "../model/taikhoan.php";
include "../model/binhluan.php";
include "../model/thongke.php";

include "header.php";

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
        case 'adddm':
            // kiem tra xem nguoi dung co click vao nut add hay ko
            if (isset($_POST['themmoi']) && ($_POST['themmoi'])) {
                $tenloai = $_POST['tenloai'];
                insert_danhmuc($tenloai);
                $thongbao = "Thêm thành công";
            }

            include "danhmuc/add.php";
            break;

        case 'lisdm':
            $listdanhmuc = loadall_danhmuc();

            include "danhmuc/list.php";
            break;
        case 'xoadm':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                delete_danhmuc($_GET['id']);
            }
            $listdanhmuc = loadall_danhmuc();
            include "danhmuc/list.php";
            break;

        case 'suadm':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {

                $dm = loadone_danhmuc($_GET['id']);
            }

            include "danhmuc/update.php";
            break;

        case 'updatedm':
            if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
                $tenloai = $_POST['tenloai'];
                $id = $_POST['id'];
                update_danhmuc($id, $tenloai);
                $thongbao = "Thêm thành công";
            }

            $listdanhmuc = loadall_danhmuc();
            include "danhmuc/list.php";
            break;

            /* controller sản phẩm */
        case 'addsp':
            // kiem tra xem nguoi dung co click vao nut add hay ko
            if (isset($_POST['themmoi']) && ($_POST['themmoi'])) {
                $iddm = $_POST['iddm'];
                $tensp = $_POST['tensp'];
                $giasp = $_POST['giasp'];
                $mota = $_POST['mota'];
                $hinh = $_FILES['hinh']['name'];
                $target_dir = "../upload/";
                $target_file = $target_dir . basename($_FILES['hinh']['name']);
                if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file)) {
                } else {
                }
                insert_sanpham($tensp, $giasp, $hinh, $mota, $iddm);
                $thongbao = "Thêm thành công";
            }

            $listdanhmuc = loadall_danhmuc();
            include "sanpham/add.php";
            break;

        case 'listsp':
            if (isset($_POST['listok']) && ($_POST['listok'])) {
                $kyw = $_POST['kyw'];
                $iddm = $_POST['iddm'];
            } else {
                $kyw = '';
                $iddm = 0;
            }
            $listdanhmuc = loadall_danhmuc();
            $listsanpham = loadall_sanpham($kyw, $iddm);
            include "sanpham/list.php";
            break;
        case 'xoasp':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                delete_sanpham($_GET['id']);
            }
            $listsanpham = loadall_sanpham("", 0);
            include "sanpham/list.php";
            break;

        case 'suasp':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {

                $sanpham = loadone_sanpham($_GET['id']);
            }
            $listdanhmuc = loadall_danhmuc();
            include "sanpham/update.php";
            break;

        case "updatesp":
            if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
                $iddm = $_POST['iddm'];
                $id = $_POST['id'];
                $tensp = $_POST['tensp'];
                $giasp = $_POST['giasp'];
                $mota = $_POST['mota'];
                $hinh = $_FILES['hinh']['name'];
                $target_dir = "../upload/";
                $target_file = $target_dir . basename($_FILES["hinh"]["name"]);
                if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["hinh"]["name"])) . " has been uploaded.";
                } else {
                    //echo "Sorry, there was an error uploading your file.";
                }
                update_sanpham($id, $iddm, $tensp, $giasp, $mota, $hinh);
                $thongbao = "cập nhật thành công!";
            }
            $listsanpham = loadall_sanpham();
            $listdanhmuc = loadall_danhmuc();
            include "sanpham/list.php";
            break;
            // danh sach khach hang
        case 'dskh':

            $listtaikhoan = loadall_taikhoan();
            include "taikhoan/list.php";
            break;

        case 'xoatk':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                delete_taikhoan($_GET['id']);
            }
            $listtaikhoan = loadall_taikhoan("", 0);
            include "taikhoan/list.php";
            break;

        case 'suatk':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {

                $tk = loadone_taikhoan($_GET['id']);
            }
            $listtaikhoan = loadall_taikhoan();
            include "taikhoan/update.php";
            break;

        case 'updatetk':
            if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $tel = $_POST['tel'];
                $id = $_POST['id'];

                update_taikhoan($id, $user, $pass, $email, $address, $tel);
                $thongbao = "cập nhật thành công!";
            }
            $listtaikhoan = loadall_taikhoan();
            include "taikhoan/list.php";
            break;

        case "dsbl":
            $listbinhluan = loadall_binhluan(0);
            include "binhluan/list.php";
            break;

        case 'xoabl':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                delete_binhluan($_GET['id']);
            }
            $listbinhluan = loadall_binhluan("", 0);
            include "binhluan/list.php";
            break;
        case 'thongke':
            $dsthongke = load_thongke_sanpham_danhmuc();
            include "thongke/list.php";
            break;
        case "thongkebieudo":
            $bieudothongke = load_thongke_sanpham_danhmuc();
            include "thongke/bieudo.php";
            break;
    }
} else {
    include "home.php";
}

include "footer.php";
