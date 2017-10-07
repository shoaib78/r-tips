<?php

class Admin_model extends CI_Model
{

    public function save($table, $data)
    {
        $this->db->insert($table, $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    public function delete($table, $where, $data)
    {
        $this->db->where($where, $data);
        $this->db->delete($table);
    }

    public function update_category($table, $where, $data)
    {
        $this->db->update($table, $data, $where);
    }

    public function update_all($table, $where, $data)
    {
        $this->db->update($table, $data, $where);
    }

    public function login($email, $pass)
    {
        $this->db->select('user_id,email,type');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->where('password', $pass);
        $this->db->where('type', 1);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function get_all_users($params = '', $limit = 10, $offset = 0)
    {
        $result = array();
        $this->db->start_cache();
        $this->db->select('*');
        $this->db->from('users');
        if (!empty($params['search']['value'])) {
            $this->db->like('username', $params['search']['value']);
            $this->db->or_like('first_name', $params['search']['value']);
            $this->db->or_like('last_name', $params['search']['value']);
        }

        if (isset($params['order'][0]['column'])) {
            switch ($params['order'][0]['column']) {
                case '1' :
                    $this->db->order_by('email', $params['order'][0]['dir']);
                    break;

                case '2' :
                    $this->db->order_by('username', $params['order'][0]['dir']);
                    break;

                case '3' :
                    $this->db->order_by('first_name', $params['order'][0]['dir']);
                    $this->db->order_by('last_name', $params['order'][0]['dir']);
                    break;

                case '4' :
                    $this->db->order_by('gender', $params['order'][0]['dir']);
                    break;

                case '5' :
                    $this->db->order_by('dob', $params['order'][0]['dir']);
                    break;

                case '6' :
                    $this->db->order_by('location', $params['order'][0]['dir']);
                    break;

                default:
                    $this->db->order_by('user_id', "desc");
            }
        } else {
            $this->db->order_by('user_id', "desc");
        }
        $this->db->order_by('user_id', "desc");
        $this->db->stop_cache();
        $result['total'] = $this->db->count_all_results();
        $this->db->limit($limit, $offset);

        $query = $this->db->get();
        $result['res'] = $query->result();

        $this->db->flush_cache();
        return $result;
    }

    public function get_all_trips($params = '', $limit = 10, $offset = 0)
    {
        $result = array();
        $this->db->start_cache();
        $this->db->select('*');
        $this->db->from('trip');
        if (!empty($params['search']['value']) && $params['search']['value'] != "select") {
            if ($params['search']['value'] == 'publish' || $params['search']['value'] == 'featured' || $params['search']['value'] == 'favorite') {
                $this->db->where($params['search']['value'], 1);
            } else {
                $this->db->like('title', $params['search']['value']);
            }
        }

        if (isset($params['order'][0]['column'])) {
            switch ($params['order'][0]['column']) {
                case '1' :
                    $this->db->order_by('title', $params['order'][0]['dir']);
                    break;

                case '2' :
                    $this->db->order_by('description', $params['order'][0]['dir']);
                    break;

                case '3' :
                    $this->db->order_by('tips', $params['order'][0]['dir']);
                    break;
                case '4' :
                    $this->db->order_by('go_there', $params['order'][0]['dir']);
                    break;
                case '5' :
                    $this->db->order_by('budget', $params['order'][0]['dir']);
                    break;
                default:
                    $this->db->order_by('trip_id', "desc");
            }
        } else {
            $this->db->order_by('trip_id', "desc");
        }

        $this->db->stop_cache();
        $result['total'] = $this->db->count_all_results();
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        $result['res'] = $query->result();
        $this->db->flush_cache();
        return $result;
    }

    public function get_advertisment($params = '', $limit = 10, $offset = 0)
    {
        $result = array();
        $this->db->start_cache();
        $this->db->select('banners.*,transaction.status as transaction_status, , users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username, users.user_id');
        $this->db->from('banners');
        $this->db->join('transaction', 'transaction.banner_id = banners.banner_id');
        $this->db->join('users', 'banners.user_id = users.user_id');
        if (!empty($params['search']['value'])) {
            $this->db->like('users.first_name', $params['search']['value']);
            $this->db->or_like('users.last_name', $params['search']['value']);
            $this->db->or_like('users.username', $params['search']['value']);
        }

        if (isset($params['order'][0]['column'])) {
            switch ($params['order'][0]['column']) {
                case '1' :
                    $this->db->order_by('users.first_name', $params['order'][0]['dir']);
                    $this->db->order_by('users.last_name', $params['order'][0]['dir']);
                    $this->db->order_by('users.username', $params['order'][0]['dir']);
                    break;
                case '3' :
                    $this->db->order_by('banners.banner_link', $params['order'][0]['dir']);
                    break;
                default:
                    $this->db->order_by('order', "desc");
            }
        } else {
            $this->db->order_by('order', "desc");
        }

        $this->db->stop_cache();
        $result['total'] = $this->db->count_all_results();
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        $result['res'] = $query->result();
        $this->db->flush_cache();
        return $result;
    }

    public function get_banners($params = '', $limit = 10, $offset = 0)
    {
        $result = array();
        $this->db->start_cache();
        $this->db->select('*');
        $this->db->from('manage_advertisment');
        $this->db->where('type', "banners");
        if (!empty($params['search']['value'])) {
            $this->db->like('title', $params['search']['value']);
        }

        if (isset($params['order'][0]['column'])) {
            switch ($params['order'][0]['column']) {
                case '1' :
                    $this->db->order_by('title', $params['order'][0]['dir']);
                    break;
                case '3' :
                    $this->db->order_by('link', $params['order'][0]['dir']);
                    break;
                default:
                    $this->db->order_by('order', "desc");
            }
        } else {
            $this->db->order_by('order', "desc");
        }

        $this->db->stop_cache();
        $result['total'] = $this->db->count_all_results();
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        $result['res'] = $query->result();
        $this->db->flush_cache();
        return $result;
    }

    public function get_all_batch($params = '', $limit = 10, $offset = 0)
    {
        $result = array();
        $this->db->start_cache();
        $this->db->select('*');
        $this->db->from('batch');
        if (!empty($params['search']['value'])) {
            $this->db->like('total_post', $params['search']['value']);
        }

        if (isset($params['order'][0]['column'])) {
            switch ($params['order'][0]['column']) {
                case '1' :
                    $this->db->order_by('total_post', $params['order'][0]['dir']);
                    break;

                case '2' :
                    $this->db->order_by('alot_bacth', $params['order'][0]['dir']);
                    break;

                default:
                    $this->db->order_by('batch_id', "desc");
            }
        } else {
            $this->db->order_by('batch_id', "desc");
        }

        $this->db->stop_cache();
        $result['total'] = $this->db->count_all_results();
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        $result['res'] = $query->result();
        $this->db->flush_cache();
        return $result;
    }

    public function get_all_wishtips($params = '', $limit = 10, $offset = 0)
    {
        $result = array();
        $this->db->start_cache();
        $this->db->select("wishtips.*, users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username, users.user_id");
        $this->db->from('wishtips');
        $this->db->join('users', 'wishtips.owner_id = users.user_id');
        if (!empty($params['search']['value'])) {
            $this->db->like('wishtips.description', $params['search']['value']);
        }

        if (isset($params['order'][0]['column'])) {
            switch ($params['order'][0]['column']) {
                case '1' :
                    $this->db->order_by('users.username', $params['order'][0]['dir']);
                    $this->db->order_by('users.first_name', $params['order'][0]['dir']);
                    $this->db->order_by('users.last_name', $params['order'][0]['dir']);
                    break;

                case '2' :
                    $this->db->order_by('wishtips.description', $params['order'][0]['dir']);
                    break;

                case '3' :
                    $this->db->order_by('wishtips.images', $params['order'][0]['dir']);
                    break;

                case '4' :
                    $this->db->order_by('wishtips.category', $params['order'][0]['dir']);
                    break;

                case '5' :
                    $this->db->order_by('wishtips.location', $params['order'][0]['dir']);
                    break;

                default:
                    $this->db->order_by('wishtips_id', "desc");
            }
        } else {
            $this->db->order_by('wishtips_id', "desc");
        }
        $this->db->order_by('wishtips_id', "desc");
        $this->db->stop_cache();
        $result['total'] = $this->db->count_all_results();
        $this->db->limit($limit, $offset);

        $query = $this->db->get();
        $result['res'] = $query->result();

        $this->db->flush_cache();
        return $result;
    }

    public function get_featured_faverite_trip($table, $where, $order)
    {
        return $this->db->order_by($order, 'asc')->get_where($table, $where)->result();
    }

    public function get_today_count($table, $data)
    {
        $query = $this->db->get_where($table, $data);
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    public function get_data_by_id($table, $data)
    {
        return $this->db->get_where($table, $data)->row();
    }

    public function get_all_data($table)
    {
        return $this->db->get($table)->result_array();
    }

    public function get_all_categories($params = '', $limit = 10, $offset = 0)
    {
        $result = array();
        $this->db->start_cache();
        $this->db->select('*');
        $this->db->from('trip_categories');
        if (!empty($params['search']['value'])) {
            $this->db->like('category', $params['search']['value']);
        }

        if (isset($params['order'][0]['column'])) {
            switch ($params['order'][0]['column']) {
                case '1' :
                    $this->db->order_by('category', $params['order'][0]['dir']);
                    break;
                default:
                    $this->db->order_by('category_id', "desc");
            }
        } else {
            $this->db->order_by('category_id', "desc");
        }

        $this->db->stop_cache();
        $result['total'] = $this->db->count_all_results();
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        $result['res'] = $query->result();
        $this->db->flush_cache();
        return $result;
    }

    public function get_all_wishtips_categories($params = '', $limit = 10, $offset = 0)
    {
        $result = array();
        $this->db->start_cache();
        $this->db->select('*');
        $this->db->from('wishtips_category');
        if (!empty($params['search']['value'])) {
            $this->db->like('category_name', $params['search']['value']);
        }

        if (isset($params['order'][0]['column'])) {
            switch ($params['order'][0]['column']) {
                case '1' :
                    $this->db->order_by('category_name', $params['order'][0]['dir']);
                    break;
                default:
                    $this->db->order_by('wishtips_cat_id', "desc");
            }
        } else {
            $this->db->order_by('wishtips_cat_id', "desc");
        }

        $this->db->stop_cache();
        $result['total'] = $this->db->count_all_results();
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        $result['res'] = $query->result();
        $this->db->flush_cache();
        return $result;
    }

    public function get_all_credit_points($params = '', $limit = 10, $offset = 0)
    {
        $result = array();
        $this->db->start_cache();
        $this->db->select('*');
        $this->db->from('manage_credit_points');
        if (!empty($params['search']['value'])) {
            $this->db->like('credit_point', $params['search']['value']);
        }

        if (isset($params['order'][0]['column'])) {
            switch ($params['order'][0]['column']) {
                case '1' :
                    $this->db->order_by('credit_point', $params['order'][0]['dir']);
                    break;
                case '2' :
                    $this->db->order_by('total_picture', $params['order'][0]['dir']);
                    break;
                default:
                    $this->db->order_by('credit_points_id', "desc");
            }
        } else {
            $this->db->order_by('credit_points_id', "desc");
        }

        $this->db->stop_cache();
        $result['total'] = $this->db->count_all_results();
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        $result['res'] = $query->result();
        $this->db->flush_cache();
        return $result;
    }

    public function update($table, $where, $data)
    {
        $this->db->where('trip_id', $where);
        if ($this->db->update($table, $data) !== FALSE) {
            return TRUE;
        }

        return FALSE;
    }

    public function get_detail_by_id($table, $trip_id, $row = "")
    {
        if ($row) {
            $result = $this->db->get_where($table, array('trip_id =' => $trip_id))->result();
        } else {
            $result = $this->db->get_where($table, array('trip_id =' => $trip_id))->row();
        }
        return $result;
    }

    public function get_discover_favorite_detail($table)
    {
        $result = $this->db->order_by("order", "asc")->get($table)->result_array();
        return $result;
    }

    public function get_count($table, $where = "", $value = "")
    {
        $this->db->select('*');
        $this->db->from($table);
        if ($where && $value) {
            $this->db->where($where, $value);
        }
        $total = $this->db->count_all_results();
        return $total;
    }

    function getSettings()
    {
        return $this->db->get('settings')->result();
    }

    public function setSetting($key, $value)
    {
        if ($key == '') {
            return false;
        }

        if ($this->isSettingExist($key)) {
            $this->db->update("settings", array('value' => $value), array('key' => $key));
        } else {
            $this->db->insert("settings", array('key' => $key, 'value' => $value, 'created_date' => date('Y-m-d H:i:s')));
        }

    }

    public function isSettingExist($key)
    {
        if ($key == '') {
            return false;
        }
        return $this->db->get_where("settings", array('key' => $key))->row();

    }

    public function get_all_plans($params = '', $limit = 10, $offset = 0)
    {
        $result = array();
        $this->db->start_cache();
        $this->db->select('*');
        $this->db->from('plans');
        if (!empty($params['search']['value'])) {
            $this->db->like('username', $params['search']['value']);
        }

        if (isset($params['order'][0]['column'])) {
            switch ($params['order'][0]['column']) {
                case '1' :
                    $this->db->order_by('plans_day', $params['order'][0]['dir']);
                    break;

                case '2' :
                    $this->db->order_by('plans_month', $params['order'][0]['dir']);
                    break;

                case '3' :
                    $this->db->order_by('plans_rate', $params['order'][0]['dir']);
                    break;

                default:
                    $this->db->order_by('id', "desc");
            }
        } else {
            $this->db->order_by('id', "desc");
        }
        $this->db->order_by('id', "desc");
        $this->db->stop_cache();
        $result['total'] = $this->db->count_all_results();
        $this->db->limit($limit, $offset);

        $query = $this->db->get();
        $result['res'] = $query->result();

        $this->db->flush_cache();
        return $result;
    }

    public function getPlanById($id)
    {
        return $this->db->get_where("plans", array('id' => $id))->row();
    }

    public function get_wishtips_report($params = '', $limit = 10, $offset = 0)
    {
        $result = array();
        $this->db->start_cache();
        $this->db->select("wishtips.*,wishtip_report.feedback,wishtip_report.reason,users.location as user_location ,users.first_name, users.last_name, users.profile_pic, users.username, users.user_id");
        $this->db->from('wishtips');
        $this->db->join('wishtip_report', 'wishtips.wishtips_id = wishtip_report.wishtip_id');
        $this->db->join('users', 'wishtip_report.user_id = users.user_id');
        if (!empty($params['search']['value'])) {
            $this->db->like('wishtips.description', $params['search']['value']);
        }

        if (isset($params['order'][0]['column'])) {
            switch ($params['order'][0]['column']) {
                case '1' :
                    $this->db->order_by('users.username', $params['order'][0]['dir']);
                    $this->db->order_by('users.first_name', $params['order'][0]['dir']);
                    $this->db->order_by('users.last_name', $params['order'][0]['dir']);
                    break;

                case '2' :
                    $this->db->order_by('wishtip_report.feedback', $params['order'][0]['dir']);
                    break;

                case '3' :
                    $this->db->order_by('wishtip_report.reason', $params['order'][0]['dir']);
                    break;

                case '4' :
                    $this->db->order_by('wishtips.description', $params['order'][0]['dir']);
                    break;

                case '5' :
                    $this->db->order_by('wishtips.location', $params['order'][0]['dir']);
                    break;

                default:
                    $this->db->order_by('report_id', "desc");
            }
        } else {
            $this->db->order_by('report_id', "desc");
        }
        $this->db->order_by('report_id', "desc");
        $this->db->stop_cache();
        $result['total'] = $this->db->count_all_results();
        $this->db->limit($limit, $offset);

        $query = $this->db->get();
        $result['res'] = $query->result();

        $this->db->flush_cache();
        return $result;
    }
}

?>