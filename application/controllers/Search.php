<?php
defined('BASEPATH') or exit('No direct script access allowed');

class  Search extends CI_Controller
{

	public function searchAll()
	{
		if ($this->session->userdata('logged_in') !== null) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['level'] = $session_data['level'];
		} else {
			$session_data = [];
			$data['username'] = null;
			$data['level'] = null;
		}

		$this->load->model('SearchModel');
		$this->load->model('EventScheduleModel');
		$data["artist_list"] = $this->EventScheduleModel->getArtistOption();
		$data["cat_list"] = $this->EventScheduleModel->getCatOption();
		$keyword    =   $this->input->post('keyword');
		$data['search']    =   $this->SearchModel->search($keyword);
		$data['detail'] = 'Search By Word : ' . $keyword;
		$data['keyword'] = $keyword;
		$this->load->view('user/headerAllEvent', $data);
		$this->load->view('user/allEvent', $data);
		$this->load->view('user/footer');
	}

	public function byCat($id)
	{
		if ($this->session->userdata('logged_in') !== null) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['level'] = $session_data['level'];
		} else {
			$session_data = [];
			$data['username'] = null;
			$data['level'] = null;
		}

		$this->load->model('SearchModel');
		$this->load->model('EventScheduleModel');
		$data["artist_list"] = $this->EventScheduleModel->getArtistOption();
		$data["cat_list"] = $this->EventScheduleModel->getCatOption();

		$data['search']    =   $this->SearchModel->cat($id);
		$data['detail'] = 'Search By Category : ';
		$this->load->view('user/headerAllEvent', $data);
		$this->load->view('user/allEvent', $data);
		$this->load->view('user/footer');
	}
	public function byArtist($id)
	{
		if ($this->session->userdata('logged_in') !== null) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['level'] = $session_data['level'];
		} else {
			$session_data = [];
			$data['username'] = null;
			$data['level'] = null;
		}

		$this->load->model('SearchModel');
		$this->load->model('EventScheduleModel');
		$data["artist_list"] = $this->EventScheduleModel->getArtistOption();
		$data["cat_list"] = $this->EventScheduleModel->getCatOption();
		$data['search']    =   $this->SearchModel->artist($id);
		$data['detail'] = 'Search By Artist : ';
		$this->load->view('user/headerAllEvent', $data);
		$this->load->view('user/allEvent', $data);
		$this->load->view('user/footer');
	}

	public function result($id)
	{
		if ($this->session->userdata('logged_in') !== null) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['level'] = $session_data['level'];
		} else {
			$session_data = [];
			$data['username'] = null;
			$data['level'] = null;
		}
		$this->load->model('SearchModel');
		$this->load->model('EventScheduleModel');
		$data["artist_list"] = $this->EventScheduleModel->getArtistOption();
		$data["cat_list"] = $this->EventScheduleModel->getCatOption();
		$data['search']    =   $this->SearchModel->resultAll($id);
		$this->load->view('user/headerAllEvent', $data);
		$this->load->view('user/eventSorting', $data);
		$this->load->view('user/footer');
	}

	
	public function detailEvent($id)
	{
			$session_data=$this->session->userdata('logged_in');
			$data['username']=(isset($session_data['username']))? $session_data['username'] : null;
			$data['level']= (isset($session_data['level']))? $session_data['level'] : null ;
			$this->load->model('SearchModel');
			$this->load->model('EventScheduleModel');

			$tickets = $this->input->post('subject');
			if(!empty($tickets)){
							$data['ticket'] = $this->SearchModel->getTicket($id,$tickets);
							$data['numberTicket'] = $tickets;
							$session_array = array('qty'=>$tickets);
						 $this->session->set_userdata('count', $session_array);
			
			}
			$data["artist_list"] = $this->EventScheduleModel->getArtistOption();
			$data["cat_list"] = $this->EventScheduleModel->getCatOption();
			$data['search']    =   $this->SearchModel->detailAll($id);
			$this->load->view('user/headerAllEvent',$data);
			$this->load->view('user/detailEvent',$data);
	}

	public function detailEvents($id)
	{
		if ($this->session->userdata('logged_in') !== null) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['level'] = $session_data['level'];
		} else {
			$session_data = [];
			$data['username'] = null;
			$data['level'] = null;
		}
		$this->load->model('SearchModel');
		$this->load->model('EventScheduleModel');

		$tickets = $this->input->post('subject');
		if (!empty($tickets)) {
			$data['ticket'] = $this->SearchModel->getTicket($id, $tickets);
			$data['numberTicket'] = $tickets;
			$session_array = array('qty' => $tickets);
			$this->session->set_userdata('count', $session_array);
		}else{
			if ($this->session->userdata('logged_in') !== null) {
				$user_id = $this->session->userdata('logged_in')['id'];
				$data['ticket'] = $this->SearchModel->getTicketByUserId($user_id);
				$data['numberTicket'] = null;
				$session_array = array('qty' => count($data['ticket']));
				$this->session->set_userdata('count', $session_array);
			}else{
				$data['ticket'] = null;
				$data['numberTicket'] = null;
				$session_array = array('qty' => null);
				$this->session->set_userdata('count', $session_array);
			}
		}

		$data["artist_list"] = $this->EventScheduleModel->getArtistOption();
		$data["cat_list"] = $this->EventScheduleModel->getCatOption();
		$data['search']    =   $this->SearchModel->detailAll($id);
		// dd($data);
		$this->load->view('user/headerAllEvent', $data);
		$this->load->view('user/detailTicket', $data);
	}

	public function detailTicket($id, $idPrice)
	{
		if ($this->session->userdata('logged_in') !== null) {
			$tickets = $this->input->post('subject');
			if (!empty($tickets)) {
				$data['numberTicket'] = $tickets;
				$session_array = array('qty' => $tickets);
				$this->session->set_userdata('count', $session_array);
			}
			$session_data = $this->session->userdata('count');
			if (!$session_data) {
				$session_data['qty'] = 1;
			} else {
				$session_data['qty'] = $session_data['qty'];
			}

			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['level'] = $session_data['level'];
		} else {
			$session_data = [];
			$data['username'] = null;
			$data['level'] = null;
		}

		$this->load->model('SearchModel');
		$this->load->model('EventScheduleModel');
		$data["artist_list"] = $this->EventScheduleModel->getArtistOption();
		$data["cat_list"] = $this->EventScheduleModel->getCatOption();
		$data['detail']    =   $this->SearchModel->detailTickets($idPrice);
		// $data['detail']['numberTicket'] = $tickets;
		$data['search']    =   $this->SearchModel->detailAll($id);
		$this->load->view('user/headerAllEvent', $data);
		$this->load->view('user/detailTicket', $data);
	}
}

/* End of file Search.php */
/* Location: ./application/controllers/Search.php */
