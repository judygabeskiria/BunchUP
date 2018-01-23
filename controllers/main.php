<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


  class Main extends CI_Controller{
	  
	  
	  public function login(){
		  
		  $this->load->view("login");
		  
		  }
	  
	  public function authorization(){
		  $this->load->model('main_m');
		  $data=$this->main_m->select_user($this->input->post('user'),md5($this->input->post('pass')));
		 
		  if(!empty($data))
		  {
			  
			   $this->session->set_userdata('userID',$data[0]['userID']);
			    $this->session->set_userdata('fname',$data[0]['fname']);
				 $this->session->set_userdata('lname',$data[0]['lname']);
				 
				 redirect('/users');
			  
			  
			  }else {
				  
				   redirect('/main/login');
				  
				  }
		    
		  }
		  
		  public function signUp(){
			  
			  $this->load->view('SignUp');
			  
			  
			  }
			  
			  
		public function registration(){
			if($this->input->post('pass')!=$this->input->post('confpass'))
			{
				$message['message']='Password Dont Match!!!';
				 $this->load->view('SignUp',$message);
				}else {
					
				  $this->load->model('main_m');
				  $user_parameters=array("fname"=>$this->input->post('fname'),
				  						"lname"=>$this->input->post('lname'),
										"username"=>$this->input->post('username'),
										"password"=>md5($this->input->post('pass')));
				  
				  
				  $this->main_m->reg_user($user_parameters);
					  redirect('/main/login');
					
					
					} 
			
			}	  
		  
	  
	  }





?>