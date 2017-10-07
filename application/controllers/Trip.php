<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Trip extends MY_Controller {
	/**
	* Index Page for this controller.
	*
	* Maps to the following URL
	* 		http://example.com/index.php/welcome
	*	- or -
	* 		http://example.com/index.php/welcome/index
	*	- or -
	* Since this controller is set as the default controller in
	* config/routes.php, it's displayed at http://example.com/
	*
	* So any other public methods not prefixed with an underscore will
	* map to /index.php/welcome/<method_name>
	* @see https://codeigniter.com/user_guide/general/urls.html
	*/
	function __construct() {
		parent::__construct();
		$this->load->model(array("user_model","trip_model","activity_model"));
		$this->load->library('session');
		//$this->session->unset_userdata('is_login');
	}
	
	public function index()
	{		
		if(!$this->session->userdata('is_login')){                   
			redirect('login', 'refresh');
		}
		$data = array();
		$data["page"] = "trip";
		$data['reset'] = TRUE;
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
		$this->form_validation->set_rules('title', 'Title', 'required|trim|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		$this->form_validation->set_rules('tags', 'Tags', 'required|trim');
		$this->form_validation->set_rules('tips', 'Tips', 'required|trim');
		$this->form_validation->set_rules('category', 'Category', 'required|trim');
		$this->form_validation->set_rules('go_there', 'How to get there', 'required|trim');
		$this->form_validation->set_rules('suggestion_for', 'Suggested for', 'required|trim');
		$this->form_validation->set_rules('nearby_attractions', 'Nearby Attractions', 'required|trim');
		$this->form_validation->set_rules('budget', 'Budget', 'required|trim|numeric');
		$this->form_validation->set_rules('check_in_date', 'Check in', 'required|trim');
		$this->form_validation->set_rules('check_out_date', 'Check out', 'required|trim');
		$this->form_validation->set_rules('location', 'Set location', 'required|trim');
		$this->form_validation->set_rules('term_condition', 'Term and Condition', 'required|trim');
		$this->form_validation->set_rules('budget_min', 'Min Budget', 'trim|required|trim|numeric');
		$this->form_validation->set_rules('budget_max', 'Max budget', 'trim|required|trim|numeric|callback_check_equal_less['.$this->input->post('budget_min').']');
		if ($this->form_validation->run() == False)
		{
			$data['form_errors'] = validation_errors();
		}
		else
		{
			$postData = $this->input->post(NULL, TRUE);
			$trip_img = isset($postData['trip_img'])?$postData['trip_img']:'';
			$postData['check_in_date'] = date("Y:m:d", strtotime($postData['check_in_date']));
			$postData['check_out_date'] = date("Y:m:d", strtotime($postData['check_out_date']));
			$postData['user_id'] = $this->session->userdata('user_id');
			$res = explode(",", $postData['location']);
			$postData['country'] = trim(end($res));
			$postData['creation_date'] = date('Y-m-d H:i:s');
			unset($postData['term_condition']);
			unset($postData['userfiles']);
			unset($postData['trip_img']);
			$trip_id = $this->trip_model->save($postData, 'trip');
			$tags = explode(',',$postData['tags']);
			foreach($tags as $tag){
				$tags = array(
					'tag' => trim($tag),
					'trip_id' => $trip_id
				);
				$tag_id = $this->trip_model->save($tags,'trip_tags');
			}
			$neighbourhoods = explode(',',$postData['neighbourhood']);
			if(isset($neighbourhoods) && !empty($neighbourhoods)){
				foreach($neighbourhoods as $val){
					$neighbourhood_data = array(
						'neighbourhood' => $val,
						'trip_id' => $trip_id
					);
					$transport_id = $this->trip_model->save($neighbourhood_data, 'trip_neighbourhood');
				}
			}
			$go_theres = explode(',',$postData['go_there']);
			if(isset($go_theres) && !empty($go_theres)){
				foreach($go_theres as $val){
					$transports = array(
						'transport' => strtolower(trim($val)),
						'trip_id' => $trip_id
					);
					$transport_id = $this->trip_model->save($transports, 'trip_transportation_ficility');
				}
			}
			if(isset($trip_img) && !empty($trip_img)){
				foreach($trip_img as $img){
					$update_data = array('trip_id' => $trip_id);
					$is_tag_avail = $this->trip_model->save_trip_id_by_img($img, $update_data);
				}
			}
			$data['reset'] = FALSE;
			if($trip_id){
				$data['form_success'] = "trip has been successfully saved. ";
			}else{
				$data['form_errors'] = "Sorry,some technical issue are coming. please try again after sometimes.";
			}
		}
		$data['tags'] = $this->trip_model->get_all_tags();
		$data['categories'] = $this->trip_model->get_all_data("trip_categories", array("category_id","category"),1);
		$data['tags'] = $this->map($data['tags']);
		$this->load->view('header',$data);
		$this->load->view('trip_form',$data);
		$this->load->view('footer');
	}
	
	public function map($arr = array())
	{		
		if(!$this->session->userdata('is_login'))
		{                   
			redirect('login', 'refresh');          
		}
		$new_array = array();
		if(!empty($arr)){
			foreach($arr as $v){
				$new_array[] = $v['tag'];
			}
		}else{
			$new_array = $arr;
		}
		return $new_array;
	}
	
	function check_equal_less($second_field,$first_field)
	{			
		if(!$this->session->userdata('is_login')){                    
			redirect('login', 'refresh');            
		}
		if ($second_field < $first_field)
		{
			$this->form_validation->set_message('check_equal_less', 'Max budget field is always greater than min budget field.');
			return false;       
		}
		else
		{
			return true;
		}
	}
	
	public function listings()
	{
		$data = array();
		$data['is_discover'] = FALSE;
		$data['is_favorite'] = FALSE;
		$data['is_result'] = FALSE;
		$data['is_listing'] = FALSE;
		$data['discoverall'] = FALSE;
		$data['my_wishlist'] = FALSE;	
		if($this->input->post(NULL, TRUE)){
			$data['is_result'] = TRUE;
			$postData = $this->input->post(NULL, TRUE);
			$data['location'] = $location = $postData['location'];
			$data['category'] = $category = $postData['category'];
			$data['trips'] = $this->trip_model->getTripSearchResult($location,$category);
		}elseif($this->uri->segment(3) == "discover"){
			$data['is_discover'] = TRUE;
			$discover_id = $this->uri->segment(4);
			$discover_trip = $this->trip_model->getTripById("discover_trips",array("discover_trip_id" => $discover_id));
			$data['trips'] = $this->trip_model->getSimilerTripCount($discover_trip->location,1);
			$data['location'] = $discover_trip->location;
		}elseif($this->uri->segment(3) == "favorite"){
			$data['is_favorite'] = TRUE;
			$favorite_id = $this->uri->segment(4);
			$favorite_trip = $this->trip_model->getTripById("favorite_trips",array("favorite_trip_id" => $favorite_id));
			$data['trips'] = $this->trip_model->getTripByParams($favorite_trip);
			$data['location'] = $favorite_trip->location; 
		}elseif($this->uri->segment(3) == "discoverall"){
			$data['discoverall'] = TRUE;
			$data["page"] = "discoverall";
			$data["trips"] = $this->trip_model->get_discover_favorite_detail("discover_trips");
			if(!empty($data["trips"])){
				$i=0;
				foreach($data["trips"] as $val):
				$data["trips"][$i]['similer_count'] = $this->trip_model->getSimilerTripCount($val['location']);
				$i++;
				endforeach;
			}
		}elseif($this->uri->segment(3) == "wishlist"){
			if($this->session->userdata('is_login')){
				$data['my_wishlist'] = TRUE;
				$data["trips"] = $this->activity_model->getWishlist($this->session->userdata('user_id'));
			}else{
				redirect("login");
			}
		}else{
			$data['is_listing'] = TRUE;
			$data["page"] = "listing";
			$data['trips'] = $this->trip_model->get_all_trip_data("trip","*");
		}
		if(!empty($data['trips']) && !($data['discoverall'])){
			$i=0;
			foreach($data['trips'] as $val):
			$data["trips"][$i]['photos'] = $this->trip_model->getPhotosByTripId($val['trip_id']);
			$data["trips"][$i]['faverites'] = $this->activity_model->is_faverite($val['trip_id'],$val['user_id']);
			if(!empty($data["trips"][$i]['faverites'])){
				$data["trips"][$i]['faverites'] = array_column($data["trips"][$i]['faverites'], 'user_id');
			}
			$i++;
			endforeach;
		}
		$data["trip_category"] = $this->trip_model->getTripCategories();
        $data['tags'] = $this->trip_model->get_all_tags();
        if(!empty( $data['tags'])){
            $data['tags'] = array_column( $data['tags'], 'tag');
        }
        //prx($data['tags']);
		$this->load->view('header', $data);
		$this->load->view('trip_listings', $data);
		$this->load->view('footer');
	}
	
	public function trip_details($id="")
	{
		$data = array();
		if($id !=""){
			(array) $data["trip"] = $this->trip_model->getTripDetails($id);
			if(!empty($data['trip'])){
				$data["trip"]->photos = $this->trip_model->getPhotosByTripId($data["trip"]->trip_id);
                $data["trip"]->faverites = $this->activity_model->is_faverite($data["trip"]->trip_id,$data["trip"]->user_id);
                if(!empty($data["trip"]->faverites)){
                    $data["trip"]->faverites = array_column($data["trip"]->faverites, 'user_id');
                }
			}
			
			$data["user_trips"] = $this->trip_model->getUserTripById($this->session->userdata('user_id'));
			if(!empty($data["user_trips"])){
				$i=0;
				foreach($data["user_trips"] as $val):
				$data["user_trips"][$i]['picture'] = $this->trip_model->getPhotosByTripId($val['trip_id']);
				$i++;
				endforeach;
			}
			$data["trip_reviews"] = $this->trip_model->getTripReviewById($id);
            $data["currency"] = $this->trip_model->getResult("currency_converter");
			$this->load->view('header', $data);
			$this->load->view('trip_details', $data);
			$this->load->view('footer');
		}else{
			redirect("");
		}
	}
	
	public function getFilterData()
	{
		$data = array();
		$postData = $this->input->post(NULL, TRUE);
		$key = $postData['key'];
		$value = $postData['value'];
		if(!empty($key) && !empty($value)){
			$data["trips"] = $trips = $this->trip_model->getFilterData($key, $value);
			if(!empty($trips)){
				$i=0;
				foreach($trips as $val):
				$data["trips"][$i]['photos'] = $this->trip_model->getPhotosByTripId($val['trip_id']);
				$data["trips"][$i]['photos'] = $this->trip_model->getPhotosByTripId($val['trip_id']);
				$data["trips"][$i]['faverites'] = $this->activity_model->is_faverite($val['trip_id'],$val['user_id']);
				if(!empty($data["trips"][$i]['faverites'])){
					$data["trips"][$i]['faverites'] = array_column($data["trips"][$i]['faverites'], 'user_id');
				}
				$i++;
				endforeach;
			}
			
			$data['htmlContent'] = $this->load->view('trip_data', $data, TRUE);
			$data['error'] = TRUE;
		}else{
			$data['error'] = FALSE;
		}
		echo json_encode( $data );
		exit;
	}

	public function getTripsByParams()
	{
		if (!$this->session->userdata('user_id')) 
		{
			echo json_encode(array('error'=>TRUE , 'message'=>'Please Login First!!'));
		}else{
			$count = 100;
			$offset = 0;
			$params['category'] = $category = $this->input->post("category");
			$params['location'] = $location = $this->input->post("location");
			$trips = $this->trip_model->getTripsByParams($count, $offset, $params);
			if(!empty($data['trips'])){
				$i=0;
				foreach($trips as $val):
					$trips[$i]['photos'] = $this->trip_model->getPhotosByTripId($val['trip_id']);
					if(!empty($trips[$i]['photos'])){
						$trips[$i]['photos'] = $data["trips"][$i]['photos'][0]['file_name'];
					}else{
						$trips[$i]['photos'] = '';
					}
				$i++;
				endforeach;
			}

			echo json_encode(array('error'=>FALSE , 'trips'=>$trips));
		}
		exit;
	}

	public function get_currency()
	{
		if(IS_AJAX && $this->session->userdata('user_id')){
			$currencyHtml = $this->load->view("currency_convert", TRUE);
			echo json_encode(array('error'=>FALSE , 'html'=>$currencyHtml));
		}
		exit;
	}

    public function save_currency()
    {
        $from_arr = array("USD", "EUR", "GBP", "INR", "AUD");
        $to_arr = array("USD", "EUR", "GBP", "INR", "AUD");
        $amount = number_format((float)1, 4, '.', '');

        foreach ($from_arr as $from)
        {
            foreach ($to_arr as $to)
            {
                if($from != $to) {
                    $rate = $this->convertCurrency($amount, $from, $to);
                    $rates = $this->trip_model->save_currency($from, $to ,$rate);
                }
            }
        }
        $currency = $this->trip_model->getResult("currency_converter");
        exit;
    }

    public function convertCurrency($amount, $from, $to)
    {
        $data = file_get_contents("https://www.google.com/finance/converter?a=$amount&from=$from&to=$to");
        preg_match("/<span class=bld>(.*)<\/span>/", $data, $converted);
        if (!empty($converted)) {
            $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
            $result = number_format(round($converted, 3), 4);
        } else {
            $result = number_format((float)0, 4, '.', '');
        }
        return $result;
    }
}
