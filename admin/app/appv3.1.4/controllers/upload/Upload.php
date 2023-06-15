<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends MY_Controller
{

    function __construct()
    {
        $this->_module = trim(strtolower(__CLASS__));
        parent::__construct();

        if (!$this->_isLogin()) {
            if ($this->input->is_ajax_request()) {
                echo 'unlogin';
                die();
            }
            $currUrl = getCurrentUrl();
            dbClose();
            redirect(site_url('login/?url=' . urlencode($currUrl), $this->_langcode));
            die();
        }
    }

    function index()
    {
        if (!in_array($this->_session_role(), [ADMIN, SUPERADMIN])) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        // SUBMIT FORM (nếu có)
        if (isset($_FILES['file'])) {

            $watermarkImagePath = 'images/watermark.png';
            $watermarkImg = imagecreatefrompng($watermarkImagePath);
            // get the width and height of the watermark image
            $water_width = imagesx($watermarkImg);
            $water_height = imagesy($watermarkImg);

            $chen_logo = $this->input->get('logo');
            $chen_logo = in_array($chen_logo, ['1', '0']) ? $chen_logo : '0';

            if (count($_FILES['file']['name'])) {
                $data = [];
                for ($i = 0; $i < count($_FILES['file']['name']); $i++) {


                    $name_file = $_FILES['file']['name'][$i];
                    $name_file = str_replace(" ", "", $name_file); // xoa khoang trang trong ten
                    $tmp_name = $_FILES['file']['tmp_name'][$i];
                    $size = $_FILES['file']['size'][$i];
                    $target_dir = $_SERVER["DOCUMENT_ROOT"] . '/' . TMP_UPLOAD_PATH;
                    $target_file = $target_dir . basename($name_file);
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    $data[$i]['status'] = 1;
                    $data[$i]['name'] = $name_file;


                    $check = @getimagesize($tmp_name);
                    if ($check !== false) {
                    } else {
                        $data[$i]['status'] = 0;
                        $data[$i]['error'][] = 'File is not an image.';
                    }

                    // Check if file already exists
                    if (file_exists($target_file)) {
                        $name_file = generateRandomString(5) . '-' . basename($name_file);
                        $target_file = $target_dir . $name_file;
                    }

                    // Check file size
                    if ($size > 50000000) {
                        $data[$i]['status'] = 0;
                        $data[$i]['error'][] = 'Sorry, your file is too large, limit 50Mb';
                    }

                    // Allow certain file formats
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                        $data[$i]['status'] = 0;
                        $data[$i]['error'][] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
                    }

                    if ($data[$i]['status']) {
                        if (move_uploaded_file($tmp_name, $target_file)) {
                            $link = ROOT_DOMAIN . TMP_UPLOAD_PATH . $name_file;
                            $data[$i]['link'] = $link;

                            // watermart
                            if ($chen_logo == '1') {
                                $image_path = $_SERVER["DOCUMENT_ROOT"] . '/' . TMP_UPLOAD_PATH . $name_file;
                                switch ($imageFileType) {
                                    case 'jpg':
                                        $im = imagecreatefromjpeg($image_path);
                                        break;
                                    case 'jpeg':
                                        $im = imagecreatefromjpeg($image_path);
                                        break;
                                    case 'png':
                                        $im = imagecreatefrompng($image_path);
                                        break;
                                    default:
                                        $im = imagecreatefromjpeg($image_path);
                                }

                                // get the width and height of the main image image
                                $main_width = imagesx($im);
                                $main_height = imagesy($im);

                                // resize watermark to half-width of the image
                                $new_height = round($water_height * $main_width / $water_width * 0.1);
                                $new_width = round($main_width * 0.1);
                                $new_watermark = imagecreatetruecolor($new_width, $new_height);
                                // keep transparent background
                                imagealphablending($new_watermark, false);
                                imagesavealpha($new_watermark, true);
                                imagecopyresampled($new_watermark, $watermarkImg, 0, 0, 0, 0, $new_width, $new_height, $water_width, $water_height);

                                // Set the dimension of the area you want to place your watermark we use 0
                                // from x-axis and 0 from y-axis 
                                $dime_x = round(($main_width - $new_width) / 2);
                                $dime_y = round(($main_height - $new_height) / 2);

                                // copy both the images
                                imagecopy($im, $new_watermark, $dime_x, $dime_y, 0, 0, $new_width, $new_height);

                                // Save image and free memory 
                                imagepng($im, $image_path);
                                imagedestroy($im);
                            }
                        } else {
                            $data[$i]['status'] = 0;
                            $data[$i]['error'][] = 'Sorry, there was an error uploading your file.';
                        }
                    }
                }

                resSuccess($data);
            } else {
                resError('Xin lỗi, không tìm thấy ảnh.');
            }
        }
    }
}
