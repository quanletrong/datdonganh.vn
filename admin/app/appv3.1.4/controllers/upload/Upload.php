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
            $chen_logo = $this->input->get('logo');
            $WATER_MARK = in_array($chen_logo, ['1', '0']) ? $chen_logo : '0';

            if (count($_FILES['file']['name'])) {
                $data = [];
                for ($i = 0; $i < count($_FILES['file']['name']); $i++) {

                    $FILE['name']     = $_FILES['file']['name'][$i];
                    $FILE['tmp_name'] = $_FILES['file']['tmp_name'][$i];
                    $FILE['size']     = $_FILES['file']['size'][$i];
                    $FILE['type']     = $_FILES['file']['type'][$i];
                    $FILE['error']    = $_FILES['file']['error'][$i];

                    $data[$i] = $this->_handle_upload($FILE, $WATER_MARK, TMP_UPLOAD_PATH);
                }

                resSuccess($data);
            } else {
                resError('Xin lỗi, không tìm thấy ảnh.');
            }
        }
    }

    function tinymce()
    {
        if (!in_array($this->_session_role(), [ADMIN, SUPERADMIN])) {
            show_custom_error('Tài khoản không có quyền truy cập!');
        }

        // SUBMIT FORM (nếu có)
        if (isset($_FILES['file'])) {

            $FILE['name']     = $_FILES['file']['name'];
            $FILE['tmp_name'] = $_FILES['file']['tmp_name'];
            $FILE['size']     = $_FILES['file']['size'];
            $FILE['type']     = $_FILES['file']['type'];
            $FILE['error']    = $_FILES['file']['error'];

            $WATER_MARK = 0; // TODO: tạm thời ko chèn logo, sau bổ sung nút tích chon

            $data = $this->_handle_upload($FILE, $WATER_MARK, TMP_UPLOAD_PATH);

            if ($data['status']) {
                resSuccess($data);
            } else {
                resError($data);
            }
        } else {
            resError('Xin lỗi, không tìm thấy ảnh.');
        }
    }

    function _handle_upload($F, $WATER_MARK, $FOLDER_UPLOAD)
    {
        $name_file = str_replace(" ", "", $F['name']); // xoa khoang trang trong ten
        $target_dir = $_SERVER["DOCUMENT_ROOT"] . '/' . $FOLDER_UPLOAD;
        $target_file = $target_dir . basename($name_file);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $data['status'] = 1;
        $data['name'] = $name_file;


        $check = @getimagesize($F['tmp_name']);
        if ($check !== false) {
        } else {
            $data['status'] = 0;
            $data['error'][] = 'File is not an image.';
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $name_file = generateRandomString(5) . '-' . basename($name_file);
            $target_file = $target_dir . $name_file;
        }

        // Check file size
        if ($F['size'] > 50000000) {
            $data['status'] = 0;
            $data['error'][] = 'Sorry, your file is too large, limit 50Mb';
        }

        // Allow certain file formats
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            $data['status'] = 0;
            $data['error'][] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
        }

        if ($data['status']) {
            if (move_uploaded_file($F['tmp_name'], $target_file)) {
                $link = ROOT_DOMAIN . $FOLDER_UPLOAD . $name_file;
                $data['link'] = $link;
                $image_path = $_SERVER["DOCUMENT_ROOT"] . '/' . $FOLDER_UPLOAD . $name_file;

                list($width, $height, $type) = getimagesize($image_path);

                // giảm dung lương ảnh lấy max width hoặc height là 2000
                if ($width > 2000 || $height > 2000) {
                    $this->resize_image($image_path, 2000, 2000, $width, $height, $type);
                }

                // watermart
                if ($WATER_MARK) {
                    $watermarkImagePath = 'images/watermark.png';
                    $watermarkImg       = imagecreatefrompng($watermarkImagePath);
                    $water_height       = imagesy($watermarkImg);
                    $water_width        = imagesx($watermarkImg);

                    $this->watermark($image_path, $watermarkImg, $water_height, $water_width, $type);
                }
            } else {
                $data['status'] = 0;
                $data['error'][] = 'Sorry, there was an error uploading your file.';
            }
        }
        return $data;
    }

    function watermark($image_path, $watermarkImg, $water_height, $water_width, $type)
    {
        $im = $this->load_image($image_path, $type);

        // get the width and height of the main image image
        $main_width = imagesx($im);
        $main_height = imagesy($im);

        // resize watermark to half-width of the image
        $new_height = round($water_height * $main_width / $water_width * 0.15);
        $new_width = round($main_width * 0.15);
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
        $this->save_image($im, $image_path, $type);
    }

    function resize_image($file, $new_w, $new_h, $old_w, $old_h, $type, $crop = FALSE)
    {
        $r = $old_w / $old_h;
        if ($crop) {
            if ($old_w > $old_h) {
                $old_w = ceil($old_w - ($old_w * abs($r - $new_w / $new_h)));
            } else {
                $old_h = ceil($old_h - ($old_h * abs($r - $new_w / $new_h)));
            }
            $newwidth = $new_w;
            $newheight = $new_h;
        } else {
            if ($new_w / $new_h > $r) {
                $newwidth = $new_h * $r;
                $newheight = $new_h;
            } else {
                $newheight = $new_w / $r;
                $newwidth = $new_w;
            }
        }
        $src = $this->load_image($file, $type);

        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $old_w, $old_h);

        //save
        $this->save_image($dst, $file, $type);
    }

    function load_image($filename, $type)
    {
        if ($type == IMAGETYPE_JPEG) {
            $image = imagecreatefromjpeg($filename);
        } elseif ($type == IMAGETYPE_PNG) {
            $image = imagecreatefrompng($filename);
        } elseif ($type == IMAGETYPE_GIF) {
            $image = imagecreatefromgif($filename);
        }
        return $image;
    }

    function save_image($im, $image_path, $type)
    {
        switch ($type) {
            case IMAGETYPE_JPEG:
                imagejpeg($im, $image_path);
                break;
            case IMAGETYPE_PNG:
                imagepng($im, $image_path);
                break;
            case IMAGETYPE_GIF:
                imagegif($im, $image_path);
                break;
            default:
                imagejpeg($im, $image_path);
        }
        imagedestroy($im);
    }
}
