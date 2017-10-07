<?php



if (!defined('BASEPATH'))



    exit('No direct script access allowed');



class Ajax extends MY_Controller {



    function __construct() {

        parent::__construct();

        $this->load->model(array('upload_model'));

        $this->load->library('session');

        if (!$this->session->userdata('user_id')) {

            if(IS_AJAX){

                echo json_encode(array('error'=>TRUE , 'is_login'=>FALSE));

                exit;

            }else{

                redirect('login', 'refresh');

            }

        }

    }



    public function uploads() {

        $data = array();

        $data['error'] = true;

        $config['upload_path'] = FCPATH.'uploads/tips-images';

        $config['allowed_types'] = 'png|jpg|jpeg|gif|bmp';

        $config['overwrite']     = FALSE;



        $fileName = $_FILES['file']['name'];

        $str = randomString(4);

        $ext = pathinfo($fileName, PATHINFO_EXTENSION);

        $new_name = $fileName = time() . $str . "." . $ext;

        $config['file_name'] = $new_name;



        if($_FILES['file']['name'] != ''){

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if($this->upload->do_upload('file')){

                $fileData = $this->upload->data();

                if($_FILES['file']['size'] >= 1000000) {

                    $config['image_library'] = 'gd2';

                    $config['source_image'] = $config['upload_path'].'/'.$fileName;

                    $config['new_image'] = FCPATH.'uploads/tips-images/';

                    $config['maintain_ratio'] = TRUE;

                    $config['create_thumb'] = FALSE;

                    $data = getimagesize($config['source_image']);

                    $width = $data[0];

                    $height = $data[1];



                    $config['width'] = $thumbWidth = 1024;

                    $config['height'] = floor($height * ($thumbWidth / $width));

                    $dim = (intval($width) / intval($height)) - ($config['width'] / $config['height']);

                    $config['master_dim'] = ($dim > 0) ? "height" : "width";

                    $this->load->library('image_lib', $config);

                    $this->image_lib->initialize($config);

                    if (!$this->image_lib->resize()) {

                        echo json_encode(array('error'=>TRUE , 'message'=>$this->image_lib->display_errors()));

                        exit;

                    }

                }

                $fileName = $fileData['file_name'];

                $photo_data = array(

                    'file_name' => $fileName,

                    'user_id' => $this->session->userdata('user_id'),

                    'uploaded_time' => date("Y-m-d H:i:s"),

                    'is_deleted' => 0,

                );

                $result = $this->upload_model->save_photos($photo_data);

                if ($result) {

                    echo json_encode(array('error'=>FALSE , 'file_id'=>$result, 'file_name' => $fileName));

                }else{

                    echo json_encode(array('error'=>TRUE , 'message'=>'Some error are exist!!'));

                }



            }else{

                echo json_encode(array('error'=>TRUE , 'message'=>$this->upload->display_errors()));

            }

        }

        exit;

    }



    public function banner_uploads() {

        $data = array();

        $data['error'] = true;

        $config['upload_path'] = FCPATH.'uploads/banners';

        $config['allowed_types'] = 'png|jpg|jpeg|gif|bmp';

        $config['overwrite']     = FALSE;



        $fileName = $_FILES['file']['name'];

        $str = randomString(4);

        $ext = pathinfo($fileName, PATHINFO_EXTENSION);

        $new_name = $fileName = time() . $str . "." . $ext;

        $config['file_name'] = $new_name;



        if($_FILES['file']['name'] != ''){

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if($this->upload->do_upload('file')){

                $fileData = $this->upload->data();

                $fileName = $fileData['file_name'];

                $photo_data = array(

                    'file_name' => $fileName,

                    'user_id' => $this->session->userdata('user_id'),

                    'uploaded_time' => date("Y-m-d H:i:s"),

                    'is_deleted' => 0,

                );

                $result = $this->upload_model->save_photos($photo_data);

                if ($result) {

                    echo json_encode(array('error'=>FALSE , 'file_id'=>$result, 'file_name' => $fileName));

                }else{

                    echo json_encode(array('error'=>TRUE , 'message'=>'Some error are exist!!'));

                }



            }else{

                echo json_encode(array('error'=>TRUE , 'message'=>$this->upload->display_errors()));

            }

        }

        exit;

    }



    public function delete_files() {
        $data = array();
        $targetDir = FCPATH.'uploads/tips-images/';
        $file_id = $this->input->post('file_id');
        $files=$this->upload_model->get_file_by_id($file_id);
        if (!empty($files)) {
            $fileName = $files;
            $targetFile = $targetDir . $fileName;
            if(file_exists($targetFile)) {
                if (unlink($targetFile)) {
                    $fileName = $this->upload_model->delete($file_id);
                }
            }
        }
        echo json_encode(array('error'=>FALSE , 'file_name' => $fileName));
        exit;
    }

}