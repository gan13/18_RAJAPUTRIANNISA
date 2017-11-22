<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class LoginMember extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('member_model');
    }

    public function index()
    {
		if($this->session->userdata('logined') && $this->session->userdata('logined') == true) //jika ada session maka akan ke home
		{
			redirect('member/home');
		}
		
		if(!$this->input->post()) //jika tidak ada input data post maka akan ke halaman login
		{
			$this->load->view('User/login');
		}
		else
		{
			$cek_login = $this->member_model->cek_login_member(
				$this->input->post('username'),
				$this->input->post('password')
				);
			if(!empty($cek_login))
			{
				$this->session->set_userdata('username',$cek_login->username);
				$this->session->set_userdata('id_member',$cek_login->id_member);
				echo $this->session->userdata('id_member');
				$this->session->set_userdata('logined',true);				
				redirect("member/home");
			}
			else 
			{
				//alert gagal
				redirect("member/login");
			}
		}
        
    } 
	
	public function logout()
    {
		$this->session->unset_userdata('logined');//hapus session userdata
		redirect("member/login");
    } 
}

/* End of file Workflows.php */
/* Location: ./application/controllers/Workflows.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-04-15 00:43:10 */
/* http://harviacode.com */