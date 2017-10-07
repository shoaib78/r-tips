<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends MY_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    function __construct() {
        parent::__construct();
        $this->load->model('upload_model');
        $this->load->library('session');
        if (!$this->session->userdata('is_login')) {
            redirect('login', 'refresh');
        }
    }

    public function index() {
        $data = array();
        $data['error'] = true;
        $targetDir = './uploads/';
        $fileName = $_FILES['file']['name'];
        $str = $this->randomString(4);
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $data['file'] = $fileName = time() . $str . "." . $ext;
        $targetFile = $targetDir . $fileName;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
            $photo_data = array(
                'file_name' => $fileName,
                'user_id' => $this->session->userdata('user_id'),
                'uploaded_time' => date("Y-m-d H:i:s")
            );
            $result = $this->upload_model->save_photos($photo_data);
            if ($result) {
                $data['error'] = false;
                $data['file_id'] = $result;
            }
        }
        echo json_encode($data);
    }

    public function delete() {
        $data = array();
        $targetDir = FCPATH . 'uploads/';
        $file_id = $this->input->post('file_id');
        $fileName = $this->upload_model->get_file_by_id($file_id);
        if (!empty($fileName)) {
            $targetFile = $targetDir . $fileName;
            if (unlink($targetFile)) {
                $fileName = $this->upload_model->delete($file_id);
            }
        }
        echo json_encode($data);
        exit;
    }

    function randomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
