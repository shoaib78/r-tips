<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('admin_model', 'user_model','upload_model'));
        $this->load->library('session');
        if ($this->session->userdata('user_id')) {
            $data["user_detail"] = $this->user_model->getUserDetail($this->session->userdata('user_id'));
            $this->load->vars($data);
        }

    }

    public function index()
    {
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            redirect('admin/dashboard', 'refresh');
        } else {
            $data = array();
            if ($this->input->post(NULL, TRUE)) {
                $this->form_validation->set_rules('email', 'Email', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');

                if ($this->form_validation->run() == False) {
                    $data['form_errors'] = validation_errors();
                } else {
                    $email = $this->input->post('email');
                    $password = md5($this->input->post('password'));

                    $userdata = $this->admin_model->login($email, $password);
                    if (!empty($userdata)) {
                        $this->session->set_userdata('is_login', true);
                        $this->session->set_userdata('user_id', $userdata->user_id);
                        $this->session->set_userdata('type', $userdata->type);
                        redirect('admin/dashboard', 'refresh');
                    } else {
                        $data['form_errors'] = "Some errors are exist. please try again!!";
                    }
                }
            }
            $this->load->view('admin/login');
        }
    }

    public function dashboard()
    {
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            $data = array();
            $data["dashboard"] = TRUE;
            $data['today_count'] = $this->get_today_count();
            $this->load->view('admin/header', $data);
            $this->load->view('admin/dashboard', $data);
        } else {
            redirect('admin', 'refresh');
        }
    }

    public function edit_profile()
    {
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            $data = array();
            if ($this->input->post(NULL, TRUE)) {
                $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
                $email_unique = "";
                $username_unique = "";
                if ($this->input->post("email") != $this->session->userdata("user_email")) {
                    $email_unique = "|is_unique[users.email]";
                }
                if ($this->input->post("username") != $this->session->userdata("username")) {
                    $username_unique = "|is_unique[users.username]";
                }

                $this->form_validation->set_rules(array(
                    array('field' => 'first_name', 'label' => 'First name', 'rules' => 'trim|required'),
                    array('field' => 'last_name', 'label' => 'Last name', 'rules' => 'trim|required'),
                    array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required' . $email_unique),
                    array('field' => 'username', 'label' => 'Username', 'rules' => 'trim|required' . $username_unique),
                    array('field' => 'gender', 'label' => 'Gender', 'rules' => 'trim|required'),
                    array('field' => 'dob', 'label' => 'Date of birth', 'rules' => 'trim|required'),
                    array('field' => 'profession', 'label' => 'Profession', 'rules' => 'trim|required'),
                    array('field' => 'language', 'label' => 'Language', 'rules' => 'trim|required'),
                    array('field' => 'location', 'label' => 'Location', 'rules' => 'trim|required'),
                    array('field' => 'travel_with', 'label' => 'Travel With', 'rules' => 'trim|required'),
                    array('field' => 'travelling', 'label' => 'Travelling', 'rules' => 'trim|required'),
                ));

                if (empty($_FILES['userfile']['name']) && !($this->input->post("profile_pic"))) {
                    $this->form_validation->set_rules('userfile', 'User Profile Pic', 'required');
                }
                if ($this->form_validation->run() == TRUE) {
                    $post_data = $this->input->post(NULL, TRUE);

                    $config['upload_path'] = FCPATH . 'uploads/user-pic';
                    $config['allowed_types'] = 'png|jpg|jpeg|gif|bmp';
                    $fileName = $_FILES['userfile']['name'];
                    $str = $this->randomString(4);
                    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                    $new_name = $fileName = time() . $str . "." . $ext;
                    $config['file_name'] = $new_name;
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload() && !empty($_FILES['userfile']['name'])) {
                        $this->session->set_flashdata('file_error', $this->upload->display_errors());
                    } else {
                        if (!empty($_FILES['userfile']['name'])) {
                            $upload = array('upload_data' => $this->upload->data());
                            $uploaded_file = $upload['upload_data']['file_name'];
                        } else {
                            $uploaded_file = $post_data["profile_pic"];
                        }
                        $data_arr = array(
                            "first_name" => $post_data['first_name'],
                            "last_name" => $post_data['last_name'],
                            "email" => $post_data['email'],
                            "username" => $post_data['username'],
                            "location" => $post_data['location'],
                            "lat" => $post_data['lat'],
                            "long" => $post_data['long'],
                            "gender" => $post_data['gender'],
                            "dob" => $post_data['dob'],
                            "profession" => $post_data['profession'],
                            "language" => $post_data['language'],
                            "about_me" => (isset($post_data['about_me']) ? $post_data['about_me'] : ''),
                            "profile_pic" => $uploaded_file,
                            "travel_with" => $post_data['travel_with'],
                            "travelling" => $post_data['travelling'],
                        );
                        $update = $this->user_model->update('users', $this->session->userdata('user_id'), $data_arr);

                        $this->session->unset_userdata("user_email");
                        $this->session->unset_userdata("username");
                        $success = "Successfully updated  user data";
                        $this->session->set_flashdata('success', $success);
                    }
                } else {
                    $this->session->set_flashdata('error', validation_errors());
                }
            } else {
                $this->session->set_flashdata('success', "");
                $this->session->set_flashdata('file_error', "");
            }
            $data["user_detail"] = $this->user_model->getUserDetail($this->session->userdata('user_id'));
            $this->session->set_userdata("user_email", $data["user_detail"]->email);
            $this->session->set_userdata("username", $data["user_detail"]->username);
            $data["dashboard"] = TRUE;
            $data['today_count'] = $this->get_today_count();
            $this->load->view('admin/header', $data);
            $this->load->view('admin/edit_profile', $data);

        } else {
            redirect('admin', 'refresh');
        }
    }

    public function change_password()
    {
        $data = array();
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            if ($this->input->post(NULL, TRUE)) {
                $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
                $this->form_validation->set_rules(array(
                    array('field' => 'old_password', 'label' => 'Old Password', 'rules' => 'trim|required'),
                    array('field' => 'new_password', 'label' => 'New Password', 'rules' => 'trim|required|matches[cpassword]'),
                    array('field' => 'cpassword', 'label' => 'Password Confirmation', 'rules' => 'required')
                ));
                if ($this->form_validation->run() === TRUE) {
                    $userId = $this->session->userdata('user_id');
                    $OldPassword = $this->input->post('old_password');
                    $NewPassword = $this->input->post('new_password');
                    $cpassword = $this->input->post('cpassword');
                    $checkPass = $this->user_model->checkpassword($OldPassword);
                    if (!$checkPass) {
                        $this->session->set_flashdata('error', 'Sorry, your Old Password is not incorrect!!');
                    } else {
                        $data = array("password" => md5($NewPassword));
                        $updatePass = $this->user_model->update('users', $userId, $data);
                        $this->session->set_flashdata('error', "");
                        $this->session->set_flashdata('success', 'Reset Password Successfully!!');
                    }
                }
            } else {
                $this->session->set_flashdata('success', "");
                $this->session->set_flashdata('error', "");
            }
            $data["dashboard"] = TRUE;
            $data['today_count'] = $this->get_today_count();
            $this->load->view('admin/header', $data);
            $this->load->view('admin/change_password', $data);
        } else {
            redirect('admin', 'refresh');
        }
    }

    public function manage_users()
    {
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            $data = array();
            $get = $_GET;
            $limit = isset($_GET['length']) ? $_GET['length'] : 10;
            $offset = isset($_GET['start']) ? $_GET['start'] : 0;
            $results = $this->admin_model->get_all_users($get, $limit, $offset);

            if (IS_AJAX) {
                $output = array(
                    "sEcho" => isset($_GET['sEcho']) ? intval($_GET['sEcho']) : 0,
                    "iTotalRecords" => $results['total'],
                    "iTotalDisplayRecords" => $results['total'],
                    "aaData" => array()
                );
                if ($results) {
                    $counter = $offset + 1;
                    foreach ($results['res'] as $object) {
                        $row = array();
                        $row[] = $object->email;
                        $row[] = $object->username;
                        $row[] = $object->first_name . " " . $object->last_name;
                        $row[] = ($object->gender == 1) ? "Male" : "Femail";
                        $row[] = date("d F, Y", strtotime($object->dob));
                        $row[] = $object->location;
                        $row[] = ("<a class='btn btn-info user_view' href=" . base_url('admin/user_detail/' . $object->user_id) . "  title='View User'>View</a>&nbsp;&nbsp;<a class='btn btn-primary status' href=" . base_url('admin/status/' . $object->user_id) . " data-status=" . ($object->approve == 0 ? '1' : '0') . " >" . ($object->approve == 0 ? 'Active' : 'Deactive') . "</a>");
                        $output['aaData'][] = $row;
                        $counter++;
                    }

                }
                echo json_encode($output);
                exit;
            }
            $data['today_count'] = $this->get_today_count();
            $data["users"] = TRUE;
            $data["is_table"] = TRUE;
            $this->load->view('admin/header', $data);
            $this->load->view('admin/users', $data);
        } else {
            redirect('admin', 'refresh');
        }
    }

    public function delete_user($id)
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(array('error' => TRUE, 'message' => 'Please Login First!!'));
        } else {
            if ($id != "") {
                $res = $this->admin_model->delete('users', "user_id", $id);
                echo json_encode(array('error' => FALSE, 'message' => 'User has been successfully deleted.'));
            } else {
                echo json_encode(array('error' => TRUE, 'message' => 'Sorry, some error are exist.so please try again!'));
            }
        }
        exit;
    }

    public function user_detail($id)
    {
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            if ($id != "") {
                $user_id = $this->input->post('user_id');
                $data['user_detail'] = $user = $this->admin_model->get_data_by_id("users", array('user_id' => $id));
                $htmlContent = $this->load->view("admin/user_detail", $data, TRUE);
                echo json_encode(array('error' => FALSE, 'htmlContent' => $htmlContent));
            } else {
                echo json_encode(array('error' => TRUE, 'message' => 'Sorry, some error are exist.so please try again!'));
            }
        } else {
            echo json_encode(array('error' => TRUE, 'message' => 'Sorry, some error are exist.so please try again!'));
        }
        exit;
    }

    public function status($id)
    {
        if ($id != "") {
            $status = $this->input->post('status');
            $data = array('approve' => $status);
            $wdata = array('user_id' => $id);
            $update = $this->admin_model->update_all('users', $wdata, $data);
            $user = $this->admin_model->get_data_by_id("users", array('user_id' => $id));
            echo json_encode(array('error' => FALSE, 'detail' => $user));
        } else {
            echo json_encode(array('error' => TRUE, 'message' => 'Sorry, some error are exist.so please try again!'));
        }
        exit;
    }

    public function trips()
    {
        //echo 'test';exit;
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            $data = array();
            $data['is_trips'] = true;
            $get = $_GET;
            $limit = isset($_GET['length']) ? $_GET['length'] : 10;
            $offset = isset($_GET['start']) ? $_GET['start'] : 0;
            $results = $this->admin_model->get_all_trips($get, $limit, $offset);

            if (IS_AJAX) {
                $output = array(
                    "sEcho" => isset($_GET['sEcho']) ? intval($_GET['sEcho']) : 0,
                    "iTotalRecords" => $results['total'],
                    "iTotalDisplayRecords" => $results['total'],
                    "aaData" => array()
                );
                if ($results) {
                    $counter = $offset + 1;
                    foreach ($results['res'] as $object) {
                        $row = array();
                        $row[] = (strlen($object->title) > 15) ? substr($object->title, 0, 15) . '...' : $object->title;
                        $row[] = (strlen($object->description) > 15) ? substr($object->description, 0, 15) . '...' : $object->description;
                        $row[] = (strlen($object->tips) > 15) ? substr($object->tips, 0, 15) . '...' : $object->tips;
                        $row[] = (strlen($object->go_there) > 15) ? substr($object->go_there, 0, 15) . '...' : $object->go_there;
                        $row[] = number_format($object->budget, 2);
                        $row[] = $object->location;
                        if ($object->publish) {
                            //$feature_active = ($object->featured)?' checked':'';
                            //$favorite_active = ($object->favorite)?' checked':'';
                            /*$opt = '<input type="checkbox" value="'.$object->trip_id.'" class="admin_featured" '.$feature_active.' />   Featured &nbsp;&nbsp;&nbsp;
						<input type="checkbox" value="'.$object->trip_id.'" class="admin_favorite"  '.$favorite_active.' />   Discover';*/
                            $opt = "";
                        } else {
                            $opt = '<a class="btn btn-info publish" href=' . base_url("admin/publish") . ' data-id="' . $object->trip_id . '">Publish</a>';
                        }
                        $row[] = '<button class="btn btn-primary view" href=' . base_url("admin/view_detail") . ' data-id="' . $object->trip_id . '">View</button>&nbsp;&nbsp;&nbsp;' . $opt;
                        $output['aaData'][] = $row;
                        $counter++;
                    }

                }
                echo json_encode($output);
                exit;
            }
            $data['today_count'] = $this->get_today_count();
            $data["trip"] = TRUE;
            $this->load->view('admin/header', $data);
            $this->load->view('admin/trips', $data);
        } else {
            redirect('admin', 'refresh');
        }
    }

    public function get_featured_faverite_trip()
    {
        $result = array();
        $where = $this->input->post("where");
        $data = array($where => 1);
        $output['table_data'] = $this->admin_model->get_featured_faverite_trip('trip', $data, $where . "_order");
        $result['htmlContent'] = $this->load->view('admin/table_content', $output, TRUE);
        if (!empty($output['table_data'])) {
            $result['error'] = 1;
        } else {
            $result['error'] = 0;
        }
        echo json_encode($result);
        exit;
    }

    public function get_today_count()
    {
        $data = array('publish' => 0, 'creation_date' => date("Y-m-d"));
        $count = $this->admin_model->get_today_count('trip', $data);
        return $count;
    }

    public function publish()
    {
        $data = array();
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            $trip_id = $this->input->post('trip_id');
            $trip_data = array("publish" => 1);
            $this->admin_model->update('trip', $trip_id, $trip_data);
            $data['opt'] = '<button class="btn btn-primary view" href=' . base_url("admin/view_detail") . ' data-id="' . $trip_id . '">View</button>&nbsp;&nbsp;&nbsp;<input type="checkbox" value="' . $trip_id . '" class="admin_featured" />   Featured &nbsp;&nbsp;&nbsp;
						<input type="checkbox" value="' . $trip_id . '" class="admin_favorite"/>   Discover';
            $data['error'] = 1;

        } else {
            $data['error'] = 0;
        }
        echo json_encode($data);
        exit;
    }

    public function featured_favorite()
    {
        $data = array();
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            $value = $this->input->post('value');
            $trip_id = $this->input->post('trip_id');
            $count_res = true;
            $count_error = '';
            if ($this->input->post('type') == 'featured') {
                $trip_data = array("featured" => $value);
                if ($value == 1) {
                    $output = $this->admin_model->get_count('trip', 'featured', 1);
                    if ($output >= 6) {
                        $count_res = false;
                        $count_error = "You can featured only 6 trips";
                    }
                }

            } else {
                $trip_data = array("favorite" => $value);
                $output = $this->admin_model->get_count('trip', 'favorite', 1);
                if ($value == 1) {
                    if ($output >= 5) {
                        $count_res = false;
                        $count_error = "You can favorite only 5 trips";
                    }
                }
            }

            if ($count_res) {

                $output = $this->admin_model->update('trip', $trip_id, $trip_data);
                if ($output) {
                    $data['error'] = 1;
                } else {
                    $data['error'] = 0;
                }
            } else {
                $data['error'] = 0;
                $data['count_error'] = $count_error;
            }


        } else {
            $data['error'] = 0;
        }
        echo json_encode($data);
        exit;
    }

    public function view_detail()
    {
        $data = array();
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            $trip_id = $this->input->post('trip_id');
            $data['trip'] = $this->admin_model->get_detail_by_id('trip', $trip_id);
            $data['trip_pictures'] = $this->admin_model->get_detail_by_id('photos', $trip_id, 1);
            //echo "<pre>"; print_r($data['trip_pictures']);exit();
            $data['output'] = $this->load->view("admin/detail", $data, TRUE);
            $data['error'] = 1;
        } else {
            $data['error'] = 0;
        }
        echo json_encode($data);
        exit;
    }

    public function trip_categories()
    {
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            $data = array();
            $data['is_trips'] = true;
            $get = $_GET;
            $limit = isset($_GET['length']) ? $_GET['length'] : 10;
            $offset = isset($_GET['start']) ? $_GET['start'] : 0;
            $results = $this->admin_model->get_all_categories($get, $limit, $offset);

            if (IS_AJAX) {
                $output = array(
                    "sEcho" => isset($_GET['sEcho']) ? intval($_GET['sEcho']) : 0,
                    "iTotalRecords" => $results['total'],
                    "iTotalDisplayRecords" => $results['total'],
                    "aaData" => array()
                );
                if ($results) {
                    $counter = $offset + 1;
                    foreach ($results['res'] as $object) {
                        $row = array();
                        $row[] = ucwords($object->category);

                        $row[] = '<button class="btn btn-info edit_category" href=' . base_url("admin/edit_category") . ' data-id="' . $object->category_id . '" title="Edit Category" >Edit</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger delete_category" href=' . base_url("admin/delete_category") . ' data-id="' . $object->category_id . '" title="Delete">Delete</a>';
                        $output['aaData'][] = $row;
                        $counter++;
                    }

                }
                echo json_encode($output);
                exit;
            }
            $data['today_count'] = $this->get_today_count();
            $data["trip_categories"] = TRUE;
            $this->load->view('admin/header', $data);
            $this->load->view('admin/trip_categories', $data);
        } else {
            redirect('admin', 'refresh');
        }
    }

    public function add_category()
    {
        $data = array();
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            $category = $this->input->post('category');
            $last_id = $this->admin_model->save('trip_categories', array('category' => $category));
            if ($last_id) {
                $data['form_success'] = "Category has been successfully saved.";
                $data['error'] = 1;
            } else {
                $data['form_errors'] = "Some errors are exist. please try again!!";
                $data['error'] = 0;
            }

        } else {
            $data['error'] = 0;
        }
        echo json_encode($data);
        exit;
    }

    public function edit_category()
    {
        $data = array();
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            $category_id = $this->input->post('category_id');
            if (($this->input->post('edit'))) {
                $category = $this->input->post('category');
                $where = array('category_id' => $category_id);
                $data = array('category' => $category);
                $res['categories'] = $this->admin_model->update_category('trip_categories', $where, $data);
                $data['form_success'] = "Category has been successfully update.";
            } else {
                $category_data = array('category_id' => $category_id);
                $res['categories'] = $this->admin_model->get_data_by_id('trip_categories', $category_data);
                $data['output'] = $this->load->view("admin/edit_category", $res, TRUE);
            }
            $data['error'] = 1;
        } else {
            $data['error'] = 0;
            $data['form_errors'] = "Some errors are exist. please try again!!";
        }
        echo json_encode($data);
        exit;
    }

    public function delete_category()
    {
        $data = array();
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            $category = $this->input->post('category_id');
            $res = $this->admin_model->delete('trip_categories', "category_id", $category);
            $data['error'] = 1;

        } else {
            $data['error'] = 0;
        }
        echo json_encode($data);
        exit;
    }

    public function favorite_trips()
    {
        $data = array();
        $data['reset'] = FALSE;
        $favorite_trip_count = $this->admin_model->get_count('favorite_trips');

        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            if ($this->input->post(NULL, TRUE)) {
                $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
                if ($this->input->post('favorite_id')) {
                    $data['trip'] = $trip = $this->admin_model->get_data_by_id('favorite_trips', array("favorite_trip_id" => $this->input->post('favorite_id')));
                }

                $isPost = TRUE;
                if ($favorite_trip_count + 1 > 5) {
                    if ($this->input->post('discover_trip_id'))
                        $isPost = TRUE;
                    else
                        $isPost = FALSE;
                }

                $this->form_validation->set_rules(array(
                    array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required'),
                    array('field' => 'location', 'label' => 'Location', 'rules' => 'trim|required'),
                    array('field' => 'check_in', 'label' => 'Check In', 'rules' => 'trim|required'),
                    array('field' => 'check_out', 'label' => 'Check Out', 'rules' => 'trim|required')
                ));
                if (empty($_FILES['userfile']['name']) && !($this->input->post("picture"))) {
                    $this->form_validation->set_rules('userfile', 'Trip Picture', 'required');
                }

                if ($this->form_validation->run() == TRUE && $isPost) {
                    $post_data = $this->input->post(NULL, TRUE);
                    $config['upload_path'] = FCPATH . 'uploads';
                    $config['allowed_types'] = 'png|jpg|jpeg|gif|bmp';
                    $fileName = $_FILES['userfile']['name'];
                    $str = $this->randomString(4);
                    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                    $new_name = $fileName = time() . $str . "." . $ext;
                    $config['file_name'] = $new_name;

                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload() && !empty($_FILES['userfile']['name'])) {
                        $data['file_error'] = $this->session->set_flashdata('file_error', $this->upload->display_errors());
                    } else {
                        if (!empty($_FILES['userfile']['name'])) {
                            $upload = array('upload_data' => $this->upload->data());
                            $uploaded_file = $upload['upload_data']['file_name'];
                        } else {
                            $uploaded_file = $post_data["picture"];
                        }

                        $data_arr = array(
                            "title" => $post_data['title'],
                            "location" => $post_data['location'],
                            "check_in" => date("Y-m-d", strtotime($post_data['check_in'])),
                            "check_out" => date("Y-m-d", strtotime($post_data['check_out'])),
                            "picture" => $uploaded_file
                        );

                        if ($post_data['favorite_id']) {
                            $data["user_detail"] = $this->admin_model->update_category('favorite_trips', array("favorite_trip_id" => $post_data['favorite_id']), $data_arr);
                            $success = "Successfully update favorite trips data";
                            $this->session->set_flashdata('success', $success);
                            redirect("admin/edit_favorite_trip/" . $post_data['favorite_id'], "refresh");
                        } else {
                            $data["user_detail"] = $this->admin_model->save('favorite_trips', $data_arr);
                            $success = "Successfully saved favorite trips data";
                            $data['success'] = $this->session->set_flashdata('success', $success);
                        }

                        $data['reset'] = TRUE;
                    }
                } else {
                    $data['form_error'] = TRUE;
                    $data['limit_error'] = "You can favorite only 6 trips";
                }
            } else {
                $data['success'] = FALSE;
                $data['file_error'] = FALSE;
                $data['form_error'] = FALSE;
            }
            $data['trips'] = $this->admin_model->get_discover_favorite_detail('favorite_trips');
            $data['today_count'] = $this->get_today_count();
            $data["favorite_trip"] = TRUE;
            //echo "<pre>";                        print_r($data);exit;
            $this->load->view('admin/header', $data);
            $this->load->view('admin/favorite_trip', $data);
        } else {
            redirect('admin', 'refresh');
        }
    }

    public function edit_favorite_trip($id = "")
    {
        $data = array();
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            $data['trips'] = $this->admin_model->get_discover_favorite_detail('favorite_trips');
            $data['trip'] = $trip = $this->admin_model->get_data_by_id('favorite_trips', array("favorite_trip_id" => $id));
            $data['today_count'] = $this->get_today_count();
            $data["favorite_trip"] = TRUE;
            $data['success'] = $this->session->flashdata('success');
            $this->load->view('admin/header', $data);
            $this->load->view('admin/favorite_trip', $data);
        } else {
            redirect('admin', 'refresh');
        }
    }

    public function discover_trips()
    {
        $data = array();
        $data['reset'] = FALSE;
        $discover_trip_count = $this->admin_model->get_count('discover_trips');

        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            if ($this->input->post(NULL, TRUE)) {
                $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
                if ($this->input->post('discover_trip_id')) {
                    $data['trip'] = $trip = $this->admin_model->get_data_by_id('discover_trips', array("discover_trip_id" => $this->input->post('discover_trip_id')));
                }
                $isPost = TRUE;
                if ($discover_trip_count + 1 > 5) {
                    if ($this->input->post('discover_trip_id'))
                        $isPost = TRUE;
                    else
                        $isPost = FALSE;
                }

                $this->form_validation->set_rules(array(
                    array('field' => 'location', 'label' => 'Location', 'rules' => 'trim|required'),
                ));

                if (empty($_FILES['userfile']['name']) && !($this->input->post("profile_pic"))) {
                    $this->form_validation->set_rules('userfile', 'Trip Picture', 'required');
                }

                if ($this->form_validation->run() == TRUE && $isPost) {
                    $post_data = $this->input->post(NULL, TRUE);
                    $config['upload_path'] = FCPATH . 'uploads';
                    $config['allowed_types'] = 'png|jpg|jpeg|gif|bmp';
                    $fileName = $_FILES['userfile']['name'];
                    $str = $this->randomString(4);
                    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                    $new_name = $fileName = time() . $str . "." . $ext;
                    $config['file_name'] = $new_name;

                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload() && !empty($_FILES['userfile']['name'])) {
                        $this->session->set_flashdata('file_error', $this->upload->display_errors());
                    } else {
                        if (!empty($_FILES['userfile']['name'])) {
                            $upload = array('upload_data' => $this->upload->data());
                            $uploaded_file = $upload['upload_data']['file_name'];
                        } else {
                            $uploaded_file = $post_data["picture"];
                        }

                        $data_arr = array(
                            "location" => $post_data['location'],
                            "picture" => $uploaded_file
                        );
                        if ($post_data['discover_trip_id']) {
                            $data["user_detail"] = $this->admin_model->update_category('discover_trips', array("discover_trip_id" => $post_data['discover_trip_id']), $data_arr);
                            $success = "Successfully update discover trips data";
                            $this->session->set_flashdata('success', $success);
                            redirect("admin/edit_discover_trip/" . $post_data['discover_trip_id'], "refresh");
                        } else {
                            $data["user_detail"] = $this->admin_model->save('discover_trips', $data_arr);
                            $success = "Successfully saved discover trips data";
                            $data['success'] = $this->session->set_flashdata('success', $success);
                        }

                        $success = "Successfully saved discover trips data";
                        $this->session->set_flashdata('success', $success);
                        $data['reset'] = TRUE;
                    }
                } else {
                    $this->session->set_flashdata('form_error', TRUE);
                    $data['limit_error'] = "You can discover only 5 trips";
                    $this->session->set_flashdata('success', FALSE);
                    $this->session->set_flashdata('file_error', FALSE);
                }
            } else {
                $this->session->set_flashdata('success', FALSE);
                $this->session->set_flashdata('file_error', FALSE);
                $this->session->set_flashdata('form_error', FALSE);
            }
            $data['trips'] = $this->admin_model->get_discover_favorite_detail('discover_trips');
            $data['today_count'] = $this->get_today_count();
            $data["discover_trip"] = TRUE;
            $this->load->view('admin/header', $data);
            $this->load->view('admin/discover_trip', $data);
        } else {
            redirect('admin', 'refresh');
        }
    }

    public function edit_discover_trip($id = "")
    {
        $data = array();
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            $data['trips'] = $this->admin_model->get_discover_favorite_detail('discover_trips');
            $data['trip'] = $trip = $this->admin_model->get_data_by_id('discover_trips', array("discover_trip_id" => $id));
            $data['today_count'] = $this->get_today_count();
            $data["discover_trip"] = TRUE;
            $data['success'] = $this->session->flashdata('success');
            $this->load->view('admin/header', $data);
            $this->load->view('admin/discover_trip', $data);
        } else {
            redirect('admin', 'refresh');
        }
    }

    public function delete_discover_trip()
    {
        $data = array();
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            $id = $this->input->post('id');
            $res = $this->admin_model->delete('discover_trips', "discover_trip_id", $id);
            $data['error'] = 1;
        } else {
            $data['error'] = 0;
        }
        echo json_encode($data);
        exit;
    }

    public function delete()
    {
        $data = array();
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            $id = $this->input->post('id');
            $res = $this->admin_model->delete('favorite_trips', "favorite_trip_id", $id);
            $data['error'] = 1;
        } else {
            $data['error'] = 0;
        }
        echo json_encode($data);
        exit;
    }

    public function update_add_order()
    {
        $data = array();
        $orders = $this->input->post("orderval[]");
        $table = $this->input->post("table");
        $where = $this->input->post("where");
        $i = 1;
        foreach ($orders as $order):
            $result = explode('##', $order);
            $where_data = array($where => $result[0], "type" => $result[2]);
            $data = array("order" => $i);
            $res['categories'] = $this->admin_model->update_all($table, $where_data, $data);
            $i++;
        endforeach;
        $data['error'] = 1;
        echo json_encode($data);
        exit;
    }

    public function update_order()
    {
        $data = array();
        $orders = $this->input->post("orderval[]");
        $table = $this->input->post("table");
        $where = $this->input->post("where");
        $i = 1;
        foreach ($orders as $order):
            $result = explode('##', $order);
            $where_data = array($where => $result[0]);
            $data = array("order" => $i);
            $res['categories'] = $this->admin_model->update_category($table, $where_data, $data);
            $i++;
        endforeach;
        $data['error'] = 1;
        echo json_encode($data);
        exit;
    }

    function randomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function manage_wishtips()
    {
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            $data = array();
            $get = $_GET;
            $limit = isset($_GET['length']) ? $_GET['length'] : 10;
            $offset = isset($_GET['start']) ? $_GET['start'] : 0;
            $results = $this->admin_model->get_all_wishtips($get, $limit, $offset);

            if (IS_AJAX) {
                $output = array(
                    "sEcho" => isset($_GET['sEcho']) ? intval($_GET['sEcho']) : 0,
                    "iTotalRecords" => $results['total'],
                    "iTotalDisplayRecords" => $results['total'],
                    "aaData" => array()
                );
                if ($results) {
                    $counter = $offset + 1;
                    foreach ($results['res'] as $object) {
                        $row = array();
                        $row[] = ($object->first_name && $object->last_name) ? ucwords($object->first_name . " " . $object->last_name) : ucwords($object->username);
                        $row[] = $object->description;
                        if (!empty($object->images)) {
                            $img = explode(",", $object->images);
                            $img = base_url("uploads/tips-images/") . $img[0];
                        } else {
                            $img = base_url("assets/images/54432148763frde.jpg");
                        }
                        $row[] = '<img src="' . $img . '" width="100" />';
                        $row[] = ucwords($object->category);
                        $row[] = $object->location;
                        $row[] = ("<a class='btn btn-danger delete_wishtips' href=" . base_url('admin/delete_wishtips/' . $object->wishtips_id) . "  title='Delete Wishtips'>Delete</a>");
                        $output['aaData'][] = $row;
                        $counter++;
                    }

                }
                echo json_encode($output);
                exit;
            }
            $data['today_count'] = $this->get_today_count();
            $data["wishtips"] = TRUE;
            $data["is_table"] = TRUE;
            $this->load->view('admin/header', $data);
            $this->load->view('admin/wishtips', $data);
        } else {
            redirect('admin', 'refresh');
        }
    }

    public function delete_wishtips($id)
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(array('error' => TRUE, 'message' => 'Please Login First!!'));
        } else {
            if ($id != "") {
                $res = $this->admin_model->delete('wishtips', "wishtips_id", $id);
                echo json_encode(array('error' => FALSE, 'message' => 'User has been successfully deleted.'));
            } else {
                echo json_encode(array('error' => TRUE, 'message' => 'Sorry, some error are exist.so please try again!'));
            }
        }
        exit;
    }

    public function wishtips_category()
    {
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            $data = array();
            $data['is_trips'] = true;
            $get = $_GET;
            $limit = isset($_GET['length']) ? $_GET['length'] : 10;
            $offset = isset($_GET['start']) ? $_GET['start'] : 0;
            $results = $this->admin_model->get_all_wishtips_categories($get, $limit, $offset);

            if (IS_AJAX) {
                $output = array(
                    "sEcho" => isset($_GET['sEcho']) ? intval($_GET['sEcho']) : 0,
                    "iTotalRecords" => $results['total'],
                    "iTotalDisplayRecords" => $results['total'],
                    "aaData" => array()
                );
                if ($results) {
                    $counter = $offset + 1;
                    foreach ($results['res'] as $object) {
                        $row = array();
                        $row[] = ucwords($object->category_name);

                        $row[] = '<button class="btn btn-info edit_category" href=' . base_url("admin/get_wishtip__category/" . $object->wishtips_cat_id) . ' title="Edit Category" >Edit</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger delete_wishtip_category" href=' . base_url("admin/delete_wishtip_category/" . $object->wishtips_cat_id) . ' title="Delete">Delete</a>';
                        $output['aaData'][] = $row;
                        $counter++;
                    }

                }
                echo json_encode($output);
                exit;
            }
            $data['today_count'] = $this->get_today_count();
            $data["wishtips_category"] = TRUE;
            $data["is_table"] = TRUE;
            $this->load->view('admin/header', $data);
            $this->load->view('admin/wishtips_category', $data);
        } else {
            redirect('admin', 'refresh');
        }
    }

    public function save_wishtips_category()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(array('error' => TRUE, 'message' => 'Please Login First!!'));
        } else {
            $this->form_validation->set_rules(array(
                array('field' => 'category', 'label' => 'Category', 'rules' => 'trim|required'),
            ));

            if ($this->form_validation->run() == TRUE) {

                $data['category_name'] = $this->input->post("category");
                $data['created_date'] = date("Y-m-d H:i:s");
                $add_id = $this->activity_model->saveData("wishtips_category", $data);
                if ($add_id) {
                    echo json_encode(array('error' => FALSE, 'message' => 'Category has been successfully saved.'));
                } else {
                    echo json_encode(array('error' => TRUE, 'message' => 'Sorry, some error are exist.so please try again!'));
                }
            } else {
                echo json_encode(array('error' => TRUE, 'message' => validation_errors()));
            }
        }
        exit;
    }

    public function get_wishtip__category($id)
    {
        if ($id != "") {
            $data = array('wishtips_cat_id' => $id);
            $wishtips_category = $this->admin_model->get_data_by_id('wishtips_category', $data);
            echo json_encode(array('error' => FALSE, 'details' => $wishtips_category));
        } else {
            echo json_encode(array('error' => TRUE, 'message' => 'Sorry, some error are exist.so please try again!'));
        }
        exit;
    }

    public function edit_wishtips_category()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(array('error' => TRUE, 'message' => 'Please Login First!!'));
        } else {
            $this->form_validation->set_rules(array(
                array('field' => 'category', 'label' => 'Category', 'rules' => 'trim|required'),
            ));

            if ($this->form_validation->run() == TRUE) {

                $data['category_name'] = $this->input->post("category");
                $data['created_date'] = date("Y-m-d H:i:s");
                if ($this->input->post("wishtips_cat_id")) {
                    $wdata = array('wishtips_cat_id' => $this->input->post("wishtips_cat_id"));
                    $update = $this->admin_model->update_all('wishtips_category', $wdata, $data);
                    echo json_encode(array('error' => FALSE, 'message' => 'Category has been successfully update.'));
                } else {
                    echo json_encode(array('error' => TRUE, 'message' => 'Sorry, some error are exist.so please try again!'));
                }
            } else {
                echo json_encode(array('error' => TRUE, 'message' => validation_errors()));
            }
        }
        exit;
    }

    public function manage_credit_points()
    {
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            $data = array();
            $data['is_trips'] = true;
            $get = $_GET;
            $limit = isset($_GET['length']) ? $_GET['length'] : 10;
            $offset = isset($_GET['start']) ? $_GET['start'] : 0;
            $results = $this->admin_model->get_all_credit_points($get, $limit, $offset);

            if (IS_AJAX) {
                $output = array(
                    "sEcho" => isset($_GET['sEcho']) ? intval($_GET['sEcho']) : 0,
                    "iTotalRecords" => $results['total'],
                    "iTotalDisplayRecords" => $results['total'],
                    "aaData" => array()
                );
                if ($results) {
                    $counter = $offset + 1;
                    foreach ($results['res'] as $object) {
                        $row = array();
                        $row[] = number_format($object->credit_point, 2);
                        $row[] = number_format($object->total_picture, 2);
                        $row[] = '<button class="btn btn-info edit_credit_points" href=' . base_url("admin/get_credit_points/" . $object->credit_points_id) . ' title="Edit Credit Point" >Edit</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger delete_credit_points" href=' . base_url("admin/delete_credit_points/" . $object->credit_points_id) . ' title="Delete">Delete</a>';
                        $output['aaData'][] = $row;
                        $counter++;
                    }

                }
                echo json_encode($output);
                exit;
            }
            $data['today_count'] = $this->get_today_count();
            $data["credit"] = TRUE;
            $data["is_table"] = TRUE;
            $this->load->view('admin/header', $data);
            $this->load->view('admin/credit_points', $data);
        } else {
            redirect('admin', 'refresh');
        }
    }

    public function save_credit_points()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(array('error' => TRUE, 'message' => 'Please Login First!!'));
        } else {
            $this->form_validation->set_rules(array(
                array('field' => 'credit_point', 'label' => 'Points', 'rules' => 'trim|required|numeric'),
                array('field' => 'total_picture', 'label' => 'Per Picture', 'rules' => 'trim|required|numeric'),
            ));

            if ($this->form_validation->run() == TRUE) {
                $data['credit_point'] = $this->input->post("credit_point");
                $data['total_picture'] = $this->input->post("total_picture");
                $data['created_date'] = date("Y-m-d H:i:s");
                $add_id = $this->activity_model->saveData("manage_credit_points", $data);
                if ($add_id) {
                    echo json_encode(array('error' => FALSE, 'message' => 'Credit Points has been successfully saved.'));
                } else {
                    echo json_encode(array('error' => TRUE, 'message' => 'Sorry, some error are exist.so please try again!'));
                }
            } else {
                echo json_encode(array('error' => TRUE, 'message' => validation_errors()));
            }
        }
        exit;
    }

    public function get_credit_points($id)
    {
        if ($id != "") {
            $data = array('credit_points_id' => $id);
            $wishtips_category = $this->admin_model->get_data_by_id('manage_credit_points', $data);
            echo json_encode(array('error' => FALSE, 'details' => $wishtips_category));
        } else {
            echo json_encode(array('error' => TRUE, 'message' => 'Sorry, some error are exist.so please try again!'));
        }
        exit;
    }

    public function edit_credit_points()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(array('error' => TRUE, 'message' => 'Please Login First!!'));
        } else {
            $this->form_validation->set_rules(array(
                array('field' => 'credit_point', 'label' => 'Points', 'rules' => 'trim|required|numeric'),
                array('field' => 'total_picture', 'label' => 'Per Picture', 'rules' => 'trim|required|numeric'),
            ));

            if ($this->form_validation->run() == TRUE) {

                $data['credit_point'] = $this->input->post("credit_point");
                $data['total_picture'] = $this->input->post("total_picture");
                $data['created_date'] = date("Y-m-d H:i:s");
                if ($this->input->post("credit_points_id")) {
                    $wdata = array('credit_points_id' => $this->input->post("credit_points_id"));
                    $update = $this->admin_model->update_all('manage_credit_points', $wdata, $data);
                    echo json_encode(array('error' => FALSE, 'message' => 'Credit Points has been successfully update.'));
                } else {
                    echo json_encode(array('error' => TRUE, 'message' => 'Sorry, some error are exist.so please try again!'));
                }
            } else {
                echo json_encode(array('error' => TRUE, 'message' => validation_errors()));
            }
        }
        exit;
    }

    public function manage_batch()
    {
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            $data = array();
            $data['is_trips'] = true;
            $get = $_GET;
            $limit = isset($_GET['length']) ? $_GET['length'] : 10;
            $offset = isset($_GET['start']) ? $_GET['start'] : 0;
            $results = $this->admin_model->get_all_batch($get, $limit, $offset);

            if (IS_AJAX) {
                $output = array(
                    "sEcho" => isset($_GET['sEcho']) ? intval($_GET['sEcho']) : 0,
                    "iTotalRecords" => $results['total'],
                    "iTotalDisplayRecords" => $results['total'],
                    "aaData" => array()
                );
                if ($results) {
                    $counter = $offset + 1;
                    foreach ($results['res'] as $object) {
                        $row = array();
                        $row[] = number_format($object->total_post, 2);
                        $row[] = '<img src="' . base_url("uploads/" . $object->alot_bacth) . '" width="50" />';
                        $row[] = '<button class="btn btn-info edit_batch" href=' . base_url("admin/get_user_batch/" . $object->batch_id) . ' title="Edit Batch" >Edit</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger delete_batch" href=' . base_url("admin/delete_batch/" . $object->batch_id) . ' title="Delete">Delete</a>';
                        $output['aaData'][] = $row;
                        $counter++;
                    }

                }
                echo json_encode($output);
                exit;
            }
            $data['today_count'] = $this->get_today_count();
            $data["batch"] = TRUE;
            $data["is_table"] = TRUE;
            $this->load->view('admin/header', $data);
            $this->load->view('admin/batch', $data);
        } else {
            redirect('admin', 'refresh');
        }
    }

    public function save_user_batch()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(array('error' => TRUE, 'message' => 'Please Login First!!'));
        } else {
            $this->form_validation->set_rules(array(
                array('field' => 'total_post', 'label' => 'Total Trip Post', 'rules' => 'trim|required|numeric'),
            ));

            if (empty($_FILES['batch_picture']['name'])) {
                $this->form_validation->set_rules('batch_picture', 'Batch', 'required');
            }

            if ($this->form_validation->run() == TRUE) {
                if (!empty($_FILES['batch_picture']['name'])) {
                    $config['upload_path'] = FCPATH . 'uploads';
                    $config['allowed_types'] = 'png|jpg|jpeg|gif|bmp';
                    $fileName = $_FILES['batch_picture']['name'];
                    $str = $this->randomString(4);
                    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                    $new_name = $fileName = time() . $str . "." . $ext;
                    $config['file_name'] = $new_name;

                    $this->load->library('upload', $config);
                    if ($_FILES['batch_picture']['name'] != '') {
                        if ($this->upload->do_upload('batch_picture')) {
                            $result = $this->upload->data();
                            $data['alot_bacth'] = $result['file_name'];
                        } else {
                            echo json_encode(array('error' => TRUE, 'message' => $this->upload->display_errors()));
                            exit;
                        }
                    }
                }

                $data['total_post'] = $this->input->post("total_post");
                $data['created_date'] = date("Y-m-d H:i:s");
                $add_id = $this->activity_model->saveData("batch", $data);
                if ($add_id) {
                    echo json_encode(array('error' => FALSE, 'message' => 'Batch has been successfully saved.'));
                } else {
                    echo json_encode(array('error' => TRUE, 'message' => 'Sorry, some error are exist.so please try again!'));
                }
            } else {
                echo json_encode(array('error' => TRUE, 'message' => validation_errors()));
            }
        }
        exit;
    }

    public function get_user_batch($id)
    {
        if ($id != "") {
            $data = array('batch_id' => $id);
            $batch = $this->admin_model->get_data_by_id('batch', $data);
            echo json_encode(array('error' => FALSE, 'details' => $batch));
        } else {
            echo json_encode(array('error' => TRUE, 'message' => 'Sorry, some error are exist.so please try again!'));
        }
        exit;
    }

    public function edit_user_batch()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(array('error' => TRUE, 'message' => 'Please Login First!!'));
        } else {
            $this->form_validation->set_rules(array(
                array('field' => 'total_post', 'label' => 'Total Trip Post', 'rules' => 'trim|required|numeric'),
            ));
            if (empty($_FILES['batch_picture']['name']) && !($this->input->post("batch_img"))) {
                $this->form_validation->set_rules('batch_picture', 'Batch Picture', 'required');
            }

            if ($this->form_validation->run() == TRUE) {
                $data['alot_bacth'] = $this->input->post("batch_img");
                if (!empty($_FILES['batch_picture']['name'])) {
                    $config['upload_path'] = FCPATH . 'uploads';
                    $config['allowed_types'] = 'png|jpg|jpeg|gif|bmp';
                    $fileName = $_FILES['batch_picture']['name'];
                    $str = $this->randomString(4);
                    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                    $new_name = $fileName = time() . $str . "." . $ext;
                    $config['alot_bacth'] = $new_name;

                    $this->load->library('upload', $config);
                    if ($_FILES['batch_picture']['name'] != '') {
                        if ($this->upload->do_upload('batch_picture')) {
                            $result = $this->upload->data();
                            $data['alot_bacth'] = $result['file_name'];
                        } else {
                            echo json_encode(array('error' => TRUE, 'message' => $this->upload->display_errors()));
                            exit;
                        }
                    }
                }

                $data['total_post'] = $this->input->post("total_post");

                if ($this->input->post("batch_id")) {
                    $wdata = array('batch_id' => $this->input->post("batch_id"));
                    $update = $this->admin_model->update_all('batch', $wdata, $data);
                    echo json_encode(array('error' => FALSE, 'message' => 'Batch has been successfully update.'));
                } else {
                    echo json_encode(array('error' => TRUE, 'message' => 'Sorry, some error are exist.so please try again!'));
                }
            } else {
                echo json_encode(array('error' => TRUE, 'message' => validation_errors()));
            }
        }
        exit;
    }

    public function delete_batch($id)
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(array('error' => TRUE, 'message' => 'Please Login First!!'));
        } else {
            if ($id != "") {
                $res = $this->admin_model->delete('batch', "batch_id", $id);
                echo json_encode(array('error' => FALSE, 'message' => 'Batch has been successfully deleted.'));
            } else {
                echo json_encode(array('error' => TRUE, 'message' => 'Sorry, some error are exist.so please try again!'));
            }
        }
        exit;
    }

    public function manage_advertisment()
    {
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            $data = array();
            $data['is_trips'] = true;
            $get = $_GET;
            $limit = isset($_GET['length']) ? $_GET['length'] : 10;
            $offset = isset($_GET['start']) ? $_GET['start'] : 0;
            $results = $this->admin_model->get_advertisment($get, $limit, $offset);
            if (IS_AJAX) {
                $output = array(
                    "sEcho" => isset($_GET['sEcho']) ? intval($_GET['sEcho']) : 0,
                    "iTotalRecords" => $results['total'],
                    "iTotalDisplayRecords" => $results['total'],
                    "aaData" => array()
                );
                if ($results) {
                    $counter = $offset + 1;
                    foreach ($results['res'] as $object) {
                        $row = array();

                        $row['DT_RowId'] = $object->banner_id . "##" . $counter;
                        $row[] = (!empty($object->first_name) && !empty($object->last_name)) ? ucwords($object->first_name." ".$object->last_name): ucwords($object->username);
                        $row[] = '<img src="' . base_url("uploads/banners/" . $object->banner_image) . '" width="100" />';
                        $row[] = date("d M, Y", strtotime($object->start_date));
                        $row[] = date("d M, Y", strtotime($object->expiry_date));
                        $row[] = $object->banner_size;
                        $row[] = $object->banner_link;
                        if($object->transaction_status == "Pending")
                        {
                            $payment_status =  '<div class="alert alert-warning" role="alert"> Pending </div>';
                        }
                        else if($object->transaction_status == "Incomplete")
                        {
                            $payment_status = '<div class="alert alert-danger" role="alert"> Incomplete </div>';
                        }
                        else if($object->transaction_status == "Complete")
                        {
                            $payment_status = '<div class="alert alert-success" role="alert"> Complete</div>';
                        }
                        $row[] = $payment_status;
                        $btn = ($object->status == 0 ? "Active" : "Deactive");
                        /* <button class="btn btn-info edit_advertisment" href='.base_url("admin/get_advertisment/".$object->advertisment_id).' title="Edit" >Edit</button>&nbsp;&nbsp;&nbsp;*/
                        $row[] = '<a class="btn btn-primary status" href="' . base_url('admin/advertisment_status/' . $object->banner_id) . '" data-status="' . ($object->status == 0 ? '1' : '0') . '" >' . $btn . '</a>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger delete_advertisment" href=' . base_url("admin/delete_advertisment/" . $object->banner_id) . '  title="Delete">Delete</a>';
                        $output['aaData'][] = $row;
                        $counter++;
                    }

                }
                echo json_encode($output);
                exit;
            }
            $data['today_count'] = $this->get_today_count();
            $data["advertisment"] = TRUE;
            $this->load->view('admin/header', $data);
            $this->load->view('admin/manage_advertisment', $data);
        } else {
            redirect('admin', 'refresh');
        }
    }

    public function manage_banners()
    {
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            $data = array();
            $data['is_trips'] = true;
            $get = $_GET;
            $limit = isset($_GET['length']) ? $_GET['length'] : 10;
            $offset = isset($_GET['start']) ? $_GET['start'] : 0;
            $results = $this->admin_model->get_banners($get, $limit, $offset);

            if (IS_AJAX) {
                $output = array(
                    "sEcho" => isset($_GET['sEcho']) ? intval($_GET['sEcho']) : 0,
                    "iTotalRecords" => $results['total'],
                    "iTotalDisplayRecords" => $results['total'],
                    "aaData" => array()
                );
                if ($results) {
                    $counter = $offset + 1;
                    foreach ($results['res'] as $object) {
                        $row = array();
                        $row['DT_RowId'] = $object->advertisment_id . "##" . $counter . "##" . $object->type;
                        $row[] = (strlen($object->title) > 15) ? substr($object->title, 0, 15) . '...' : $object->title;
                        $row[] = '<img src="' . base_url("uploads/" . $object->image) . '" width="100" />';
                        $row[] = date("d M, Y", strtotime($object->expiry_date));
                        $row[] = $object->link;
                        /* <button class="btn btn-info edit_advertisment" href='.base_url("admin/get_advertisment/".$object->advertisment_id).' title="Edit" >Edit</button>&nbsp;&nbsp;&nbsp;*/
                        $btn = ($object->status == 0 ? "Active" : "Deactive");
                        $row[] = '<a class="btn btn-primary status" href="' . base_url('admin/advertisment_status/' . $object->advertisment_id) . '" data-status="' . ($object->status == 0 ? '1' : '0') . '" >' . $btn . '</a>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger delete_advertisment" href=' . base_url("admin/delete_advertisment/" . $object->advertisment_id) . ' title="Delete">Delete</a>';
                        $output['aaData'][] = $row;
                        $counter++;
                    }

                }
                echo json_encode($output);
                exit;
            }
            $data['today_count'] = $this->get_today_count();
            $data["advertisment"] = TRUE;
            $this->load->view('admin/header', $data);
            $this->load->view('admin/manage_advertisment', $data);
        } else {
            redirect('admin', 'refresh');
        }
    }

    public function save_advertisment()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(array('error' => TRUE, 'message' => 'Please Login First!!'));
        } else {
            $this->form_validation->set_rules(array(
                array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required'),
                array('field' => 'link', 'label' => 'Link', 'rules' => 'trim|required'),
                array('field' => 'expiry_date', 'label' => 'Expiry Date', 'rules' => 'trim|required'),
            ));
            if (empty($_FILES['picture']['name'])) {
                $this->form_validation->set_rules('picture', 'Advertisment Picture', 'required');
            }

            if ($this->form_validation->run() == TRUE) {
                if (!empty($_FILES['picture']['name'])) {
                    $config['upload_path'] = FCPATH . 'uploads';
                    $config['allowed_types'] = 'png|jpg|jpeg|gif|bmp';
                    $fileName = $_FILES['picture']['name'];
                    $str = $this->randomString(4);
                    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                    $new_name = $fileName = time() . $str . "." . $ext;
                    $config['file_name'] = $new_name;

                    $this->load->library('upload', $config);
                    if ($_FILES['picture']['name'] != '') {
                        if ($this->upload->do_upload('picture')) {
                            $result = $this->upload->data();
                            $data['image'] = $result['file_name'];
                        } else {
                            echo json_encode(array('error' => TRUE, 'message' => $this->upload->display_errors()));
                            exit;
                        }
                    }
                }

                $data['title'] = $this->input->post("title");
                $data['link'] = $this->input->post("link");
                $data['expiry_date'] = date("Y-m-d H:i:s", strtotime($this->input->post("expiry_date")));
                $data['type'] = $this->input->post("type");
                $data['created_date'] = date("Y-m-d H:i:s");
                $add_id = $this->activity_model->saveData("manage_advertisment", $data);
                if ($add_id) {
                    echo json_encode(array('error' => FALSE, 'message' => 'Advertisment has been successfully saved.'));
                } else {
                    echo json_encode(array('error' => TRUE, 'message' => 'Sorry, some error are exist.so please try again!'));
                }
            } else {
                echo json_encode(array('error' => TRUE, 'message' => validation_errors()));
            }
        }
        exit;
    }

    public function advertisment_status($id)
    {
        if ($id != "") {
            $status = $this->input->post('status');
            $data = array('status' => $status);
            $wdata = array('banner_id' => $id);
            $update = $this->admin_model->update_all('banners', $wdata, $data);
            $user = $this->admin_model->get_data_by_id("banners", array('banner_id' => $id));
            echo json_encode(array('error' => FALSE, 'detail' => $user));
        } else {
            echo json_encode(array('error' => TRUE, 'message' => 'Sorry, some error are exist.so please try again!'));
        }
        exit;
    }

    public function delete_advertisment($id)
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(array('error' => TRUE, 'message' => 'Please Login First!!'));
        } else {
            if ($id != "") {
                $targetDir = FCPATH.'uploads/banners/';
                $data = array('banner_id' => $id);
                $advertisment = $this->admin_model->get_data_by_id('banners', $data);
                if (!empty($advertisment)) {
                    $this->common_model->initialize('photos');
                    $files = $this->common_model->getRow("*",array("file_name"=>$advertisment->banner_image));
                    if(!empty($files)){
                        $fileName = $files->file_name;
                        $targetFile = $targetDir . $fileName;
                        if (unlink($targetFile)) {
                            $fileName = $this->upload_model->delete($files->photo_id);
                        }
                    }
                }
                $res = $this->admin_model->delete('banners', "banner_id", $id);
                echo json_encode(array('error' => FALSE, 'message' => 'Advertisment has been successfully deleted.'));
            } else {
                echo json_encode(array('error' => TRUE, 'message' => 'Sorry, some error are exist.so please try again!'));
            }
        }
        exit;
    }

    public function get_advertisment($id)
    {
        if ($id != "") {
            $data = array('advertisment_id' => $id);
            $advertisment_details = $this->admin_model->get_data_by_id('manage_advertisment', $data);
            $advertisment_details->expiry_date = date("d-m-Y", strtotime($advertisment_details->expiry_date));
            echo json_encode(array('error' => FALSE, 'details' => $advertisment_details));
        } else {
            echo json_encode(array('error' => TRUE, 'message' => 'Sorry, some error are exist.so please try again!'));
        }
        exit;
    }

    public function edit_advertisment()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(array('error' => TRUE, 'message' => 'Please Login First!!'));
        } else {
            $this->form_validation->set_rules(array(
                array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required'),
                array('field' => 'link', 'label' => 'Link', 'rules' => 'trim|required'),
                array('field' => 'expiry_date', 'label' => 'Expiry Date', 'rules' => 'trim|required'),
            ));
            if (empty($_FILES['picture']['name']) && !($this->input->post("add_picture"))) {
                $this->form_validation->set_rules('picture', 'Advertisment Picture', 'required');
            }

            if ($this->form_validation->run() == TRUE) {
                $data['image'] = $this->input->post("add_picture");
                if (!empty($_FILES['picture']['name'])) {
                    $config['upload_path'] = FCPATH . 'uploads';
                    $config['allowed_types'] = 'png|jpg|jpeg|gif|bmp';
                    $fileName = $_FILES['picture']['name'];
                    $str = $this->randomString(4);
                    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                    $new_name = $fileName = time() . $str . "." . $ext;
                    $config['file_name'] = $new_name;

                    $this->load->library('upload', $config);
                    if ($_FILES['picture']['name'] != '') {
                        if ($this->upload->do_upload('picture')) {
                            $result = $this->upload->data();
                            $data['image'] = $result['file_name'];
                        } else {
                            echo json_encode(array('error' => TRUE, 'message' => $this->upload->display_errors()));
                            exit;
                        }
                    }
                }

                $data['title'] = $this->input->post("title");
                $data['link'] = $this->input->post("link");
                $data['expiry_date'] = date("Y-m-d H:i:s", strtotime($this->input->post("expiry_date")));
                $data['type'] = $this->input->post("type");

                if ($this->input->post("advertisment_id")) {
                    $wdata = array('advertisment_id' => $this->input->post("advertisment_id"));
                    $update = $this->admin_model->update_all('manage_advertisment', $wdata, $data);
                    echo json_encode(array('error' => FALSE, 'message' => 'Advertisment has been successfully update.'));
                } else {
                    echo json_encode(array('error' => TRUE, 'message' => 'Sorry, some error are exist.so please try again!'));
                }
            } else {
                echo json_encode(array('error' => TRUE, 'message' => validation_errors()));
            }
        }
        exit;
    }

    public function profile($id)
    {
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            if ($id != "") {
                $user_id = $this->input->post('user_id');
                $data['user_detail'] = $user = $this->admin_model->get_data_by_id("users", array('user_id' => $id));

            } else {
                $data['error'] = 'Sorry, user details not available!';
            }
        } else {
            redirect('admin');
        }
        $data['today_count'] = $this->get_today_count();
        $data["dashboard"] = TRUE;
        $this->load->view('admin/header', $data);
        $this->load->view('admin/user_detail', $data);
    }

    public function settings()
    {
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            $settings = $this->admin_model->getSettings();
            $data['SETTINGS'] = array();
            foreach ($settings as $setting) {
                $data['SETTINGS'][$setting->key] = $setting->value;
            }
            $this->SETTINGS = $data['SETTINGS'];
            $data['today_count'] = $this->get_today_count();
            $data["settings"] = TRUE;
            $this->load->view('admin/header', $data);
            $this->load->view('admin/settings', $data);
        } else {
            redirect('admin');
        }
    }

    function save_social_settings()
    {
        if ($this->input->post()) {
            $update['fb_url'] = $this->input->post('fb_url') ? $this->input->post('fb_url') : NULL;
            $update['twitter_url'] = $this->input->post('twitter_url') ? $this->input->post('twitter_url') : NULL;
            $update['gplus_url'] = $this->input->post('gplus_url') ? $this->input->post('gplus_url') : NULL;
            $update['linkedin_url'] = $this->input->post('linkedin_url') ? $this->input->post('linkedin_url') : NULL;
            foreach ($update as $key => $val) {
                $this->admin_model->setSetting($key, $val);
            }

            $this->session->set_flashdata('msg_success', 'Social links have been save successfully!!!.');
            redirect('admin/settings');
        }
    }

    function save_general_settings()
    {
        $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
        $fieldsValidation[] = array('field' => 'admin_email', 'label' => 'Admin Email', 'rules' => 'trim|required|valid_email');
        $fieldsValidation[] = array('field' => 'noreply_email', 'label' => 'No-reply Email', 'rules' => 'trim|required|valid_email');
        $fieldsValidation[] = array('field' => 'site_email', 'label' => 'Store Email', 'rules' => 'trim|valid_email');

        if ($_FILES['logo']['name'] == '' && (isset($this->SETTINGS['logo']) && $this->SETTINGS['logo'] == '')) {
            $this->session->set_flashdata('msg_error', 'Please Upload Your Site Logo.');
            redirect('admin/settings');
        }

        $this->form_validation->set_rules($fieldsValidation);
        if ($this->form_validation->run() === TRUE) {

            $update['admin_email'] = $this->input->post('admin_email') ? $this->input->post('admin_email') : NULL;
            $update['welcome_text'] = $this->input->post('welcome_text') ? $this->input->post('welcome_text') : NULL;
            $update['aboutus_text'] = $this->input->post('aboutus_text') ? $this->input->post('aboutus_text') : NULL;
            $update['noreply_email'] = $this->input->post('noreply_email') ? $this->input->post('noreply_email') : NULL;
            $update['site_mobile'] = $this->input->post('site_mobile') ? $this->input->post('site_mobile') : NULL;
            $update['copyright'] = $this->input->post('copyright') ? $this->input->post('copyright') : NULL;
            $config['upload_path'] = FCPATH . 'uploads/logo';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|ico';
            $update['site_name'] = $this->input->post('site_name') ? $this->input->post('site_name') : NULL;
            $update['site_keywords'] = $this->input->post('site_keywords') ? $this->input->post('site_keywords') : NULL;
            $update['site_meta_desc'] = $this->input->post('site_meta_desc') ? $this->input->post('site_meta_desc') : NULL;
            $update['site_email'] = $this->input->post('site_email') ? $this->input->post('site_email') : NULL;
            $update['order_email'] = $this->input->post('order_email') ? $this->input->post('order_email') : NULL;
            $update['site_phone'] = $this->input->post('site_phone') ? $this->input->post('site_phone') : NULL;
            $update['site_fax'] = $this->input->post('site_fax') ? $this->input->post('site_fax') : NULL;
            $update['site_address'] = $this->input->post('site_address') ? $this->input->post('site_address') : NULL;
            $config['upload_path'] = FCPATH . 'uploads/logo';
            $config['allowed_types'] = 'png|jpg|jpeg|gif|bmp';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (isset($_FILES['logo']) && $_FILES['logo']['error'] != 4) {
                if ($this->upload->do_upload('logo')) {
                    $uploadData = $this->upload->data();
                    $update['logo'] = $uploadData['file_name'];

                } else {
                    $this->session->set_flashdata('msg_error', $this->upload->display_errors());
                    redirect('admin/settings');
                }
            }
            if (isset($_FILES['favicon']) && $_FILES['favicon']['error'] != 4) {
                if ($this->upload->do_upload('favicon')) {
                    $uploadData = $this->upload->data();
                    $update['favicon'] = $uploadData['file_name'];

                } else {
                    $this->session->set_flashdata('msg_error', $this->upload->display_errors());
                    redirect('admin/settings');
                }
            }
            foreach ($update as $key => $val) {
                $this->admin_model->setSetting($key, $val);
            }
            $this->session->set_flashdata('msg_success', 'Settings have been updated successfully!!!');
            redirect('admin/settings');

        } else {
            echo validation_errors();
            $this->session->set_flashdata('msg_error', validation_errors());
            redirect('admin/settings');
        }


    }

    public function membership_plans()
    {
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            $data = array();
            $data['is_trips'] = true;
            $get = $_GET;
            $limit = isset($_GET['length']) ? $_GET['length'] : 10;
            $offset = isset($_GET['start']) ? $_GET['start'] : 0;
            $results = $this->admin_model->get_all_plans($get, $limit, $offset);

            if (IS_AJAX) {
                $output = array(
                    "sEcho" => isset($_GET['sEcho']) ? intval($_GET['sEcho']) : 0,
                    "iTotalRecords" => $results['total'],
                    "iTotalDisplayRecords" => $results['total'],
                    "aaData" => array()
                );
                if ($results) {
                    $counter = $offset + 1;
                    foreach ($results['res'] as $object) {
                        $row = array();
                        $row[] = ($object->plans_day) ? $object->plans_day : "NA";
                        $row[] = $object->plans_month ? $object->plans_month : "NA";
                        $row[] = number_format($object->plans_rate, 2, ",", ".");
                        $row[] = '<a class="btn btn-info" href=' . base_url("admin/plans/" . $object->id) . ' title="Edit Plans" >Edit</a>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger delete_plan" href=' . base_url("admin/delete_plan/" . $object->id) . ' title="Delete Plan">Delete</a>';
                        $output['aaData'][] = $row;
                        $counter++;
                    }

                }
                echo json_encode($output);
                exit;
            }
            $data['today_count'] = $this->get_today_count();
            $data["membership"] = TRUE;
            $this->load->view('admin/header', $data);
            $this->load->view('admin/membership', $data);
        } else {
            redirect('admin', 'refresh');
        }
    }

    public function plans($id = "")
    {
        if ($this->session->userdata('user_id') && $this->session->userdata('type') == 1) {
            if ($this->input->post(NULL, TRUE)) {

                $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
                $fieldsValidation[] = array('field' => 'plans_rate', 'label' => 'Plans Rate', 'rules' => 'trim|required|numeric');
                $this->form_validation->set_rules($fieldsValidation);

                if ($this->form_validation->run() === TRUE) {
                    if ($this->input->post('plans_duration_type') && $this->input->post('plans_duration_type') == "month") {
                        $attributes['plans_month'] = $this->input->post('plans_duration') ? $this->input->post('plans_duration') : NULL;
                        $attributes['type'] = 'month';
                    } else {
                        $attributes['plans_day'] = $this->input->post('plans_duration') ? $this->input->post('plans_duration') : NULL;
                        $attributes['type'] = 'day';
                    }

                    $attributes['plans_rate'] = $this->input->post('plans_rate') ? $this->input->post('plans_rate') : NULL;
                    if ($id != "") {
                        $settings = $this->admin_model->update_all("plans", array("id" => $id), $attributes);
                        $this->session->set_flashdata('msg_success', 'Membership plans have been update successfully!!!.');
                    } else {
                        $settings = $this->admin_model->save("plans", $attributes);
                        $this->session->set_flashdata('msg_success', 'Membership plans have been save successfully!!!.');
                    }

                    redirect('admin/membership_plans');
                } else {
                    $this->session->set_flashdata('msg_error', 'Sorry, some errors are founds. please try agaib !!.');
                }
            } else {
                $this->session->set_flashdata('msg_success', '');
                $this->session->set_flashdata('msg_error', '');
            }
            if ($id != "") {
                $data['plan'] = $this->admin_model->getPlanById($id);
            }
            $data['today_count'] = $this->get_today_count();
            $data["membership"] = TRUE;
            $this->load->view('admin/header', $data);
            $this->load->view('admin/plans', $data);
        } else {
            redirect('admin');
        }
    }

    public function delete_plan($id)
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(array('error' => TRUE, 'message' => 'Please Login First!!'));
        } else {
            if ($id != "") {
                $res = $this->admin_model->delete('plans', "id", $id);
                echo json_encode(array('error' => FALSE, 'message' => 'Plan has been successfully deleted.'));
            } else {
                echo json_encode(array('error' => TRUE, 'message' => 'Sorry, some error are exist.so please try again!'));
            }
        }
        exit;
    }

    public function wishtips_report()
    {
        if($this->session->userdata('user_id') && $this->session->userdata('type') == 1){
            $data = array();
            $get=$_GET;
            $limit=isset($_GET['length'])?$_GET['length']:10;
            $offset=isset($_GET['start'])?$_GET['start']:0;
            $results = $this->admin_model->get_wishtips_report($get,$limit,$offset);

            if(IS_AJAX){
                $output = array(
                    "sEcho" => isset($_GET['sEcho'])?intval($_GET['sEcho']):0,
                    "iTotalRecords" =>  $results['total'],
                    "iTotalDisplayRecords" =>  $results['total'],
                    "aaData" => array()
                );
                if($results)
                {
                    $counter = $offset+1;
                    foreach($results['res'] as $object)
                    {
                        $row = array();
                        $row[] = ($object->first_name && $object->last_name)?ucwords($object->first_name." ".$object->last_name):ucwords($object->username);
                        $row[] = $object->feedback;
                        if($object->reason == 1){
                            $row[] = "It's annoying or not interesting";
                        }elseif($object->reason == 2){
                            $row[] = "I think it shouldn't be on tipsandgo";
                        }elseif($object->reason == 3){
                            $row[] = "It's spam";
                        }else{
                            $row[] = "Other";
                        }
                        $row[] = $object->description;
                        $row[] = ucwords($object->category);
                        $row[] = $object->location;
                        $output['aaData'][] = $row;
                        $counter++;
                    }

                }
                echo json_encode( $output );
                exit;
            }
            $data['today_count'] = 	$this->get_today_count();
            $data["wishtips_report"] = TRUE;
            $data["is_table"] = TRUE;
            $this->load->view('admin/header',$data);
            $this->load->view('admin/wishtips_report',$data);
        }else{
            redirect('admin', 'refresh');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('is_admin');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('type');
        $this->session->all_userdata();
        redirect('admin');
    }
}
