<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 class Users extends CI_Controller {
	 
	 public function __construct(){
		 
		 
		 
		 
		 parent::__construct();
		 
		 if(empty($this->session->userdata('userID'))){
			 redirect('/main/login');
			 
			 }
			  $this->load->model('main_m');
			  		  
		?>
         <link href="<?=base_url()?>public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?=base_url()?>public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="<?=base_url()?>public/css/sb-admin.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="<?=base_url()?>public/vendor/jquery/jquery.min.js"></script>
  <script src="<?=base_url()?>public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="<?=base_url()?>public/vendor/jquery-easing/jquery.easing.min.js"></script>
        
        
        <?php  
		  }
	 
	 
	 
	 
	 public function index(){ 
		   
		   $table['events']='';
		   
		   $table['events'].='<a href="/index.php/users/addEvents"><button type="button" class="btn btn-success">ADD Events</button></a> 
		   <a href="/index.php/users/myEvents"><button type="button" class="btn btn-info">My Events</button></a>
		   <a href="/index.php/users"><button type="button" class="btn btn-warning">All Events</button></a>
		   <a href="/index.php/users/signOut"><button type="button" class="btn btn-danger">Sign Out</button></a>';
		   $categories=$this->main_m->getCategories();
			$table['categories']='';
			$table['categories'].='<form style="margin-left:823px;" action="" method="post">
			<div class="form-group">
			<select class="form-control" style="width: 37% !important;"  name="eventCategory" onchange="this.form.submit()"><option></option>';
			foreach($categories as $key=>$value)
			{
				$selected="";
				if($this->input->post('eventCategory')==$value['categoryID']){$selected="selected";}
				
				
				$table['categories'].='<option value="'.$value['categoryID'].'" '.$selected.'>'.$value['category'].'</option>';
				
				}
			
			$table['categories'].='</select>
			</div>
			</form>';
			
			
			if($this->input->post('eventCategory')!="")
			{
					$data=$this->main_m->getEvents_filtered($this->input->post('eventCategory'));
				
				}else {
					
					$data=$this->main_m->getEvents();
					
					}
			
			  
			
			
		   
		   if(!empty($data))
		   {
			$table['events'].='<center><table class="table" style="color:White;"><tr>
			<td>Event Name</td>
			<td>Event Date</td>
			<td>Event Time</td>
			<td>Event Location</td>
			<td>Event Description</td>
			<td>Event Category</td>
			<td>Go</td>
			
			</tr>';
			
			foreach($data as $key=>$value)
			{
				
				$checkEvents=$this->main_m->checkEvents_m($value['eventID'],$this->session->userdata('userID'));
				if(!empty($checkEvents))
				{
					$follow="Unfollow";
					$style='class="btn btn-outline-danger"';
					}else {
						
						$follow="Follow";
						$style='class="btn btn-outline-success"';
						}
				
				
				$table['events'].='<tr>
				<td>'.$value['event_name'].'</td>
				<td>'.$value['event_date'].'</td>
				<td>'.$value['event_time'].'</td>
				<td>'.$value['event_location'].'</td>
				<td>'.$value['event_description'].'</td>
				<td>'.$value['category'].'</td> 
				<td><form action="/index.php/users/saveEvents" method="post"> <input '.$style.' type="submit" value="'.$follow.'"/>
				<input type="hidden" name="GoonEvent" value="'.$value['eventID'].'">
				
				 </form></td> 
				</tr>';
				
				}
			$table['events'].='</table></center>';    
			   }
		   
		  
		  $this->load->view('getEvents',$table);
		  
		 
		 }
		 
		 public function saveEvents(){ 
			 $checkEvents=$this->main_m->checkEvents_m($this->input->post('GoonEvent'),$this->session->userdata('userID')); 
			 
			 if(!empty($checkEvents))
			 {
			 $this->main_m->deleteEvents_m($this->input->post('GoonEvent'),$this->session->userdata('userID')); 	 
				  redirect('/users');
				 }else { 
			  $this->main_m->saveEvents_m($this->input->post('GoonEvent'),$this->session->userdata('userID')); 
			 redirect('/users');
				 }
			 } 
			 
			 
			 
			 
			  public function saveMyEvents(){ 
			 $checkEvents=$this->main_m->checkEvents_m($this->input->post('GoonEvent'),$this->session->userdata('userID')); 
			 
			 if(!empty($checkEvents))
			 {
			 $this->main_m->deleteEvents_m($this->input->post('GoonEvent'),$this->session->userdata('userID')); 	 
				  redirect('/users/myEvents');
				 }else { 
			  $this->main_m->saveEvents_m($this->input->post('GoonEvent'),$this->session->userdata('userID')); 
			 redirect('/users/myEvents');
				 }
			 } 
			 
			 
			
			public function  myEvents(){
				 $data=$this->main_m->getMyEvents($this->session->userdata('userID'));
		   
		   $table['events']='';
		   
		   $table['events'].='<a href="/index.php/users/addEvents"><button type="button" class="btn btn-success">ADD Events</button></a> 
		   <a href="/index.php/users/myEvents"><button type="button" class="btn btn-info">My Events</button></a>
		   <a href="/index.php/users"><button type="button" class="btn btn-warning">All Events</button></a>
		   <a href="/index.php/users/signOut"><button type="button" class="btn btn-danger">Sign Out</button></a>
		   ';
		   
		   
		   if(!empty($data))
		   {
			$table['events'].='<center><table class="table" style="color:White;"><tr>
			<td>Event Name</td>
			<td>Event Date</td>
			<td>Event Time</td>
			<td>Event Location</td>
			<td>Event Description</td>
			<td>Event Category</td>
			<td>Go</td>
			
			</tr>';
			
			foreach($data as $key=>$value)
			{
				
				$checkEvents=$this->main_m->checkEvents_m($value['eventID'],$this->session->userdata('userID'));
				if(!empty($checkEvents))
				{
					$follow="Unfollow";
						$style='class="btn btn-outline-danger"';
					
					}else {
						
						$follow="Follow";
						$style='class="btn btn-outline-success"';
						}
				
				
				$table['events'].='<tr>
				<td>'.$value['event_name'].'</td>
				<td>'.$value['event_date'].'</td>
				<td>'.$value['event_time'].'</td>
				<td>'.$value['event_location'].'</td>
				<td>'.$value['event_description'].'</td>
				<td>'.$value['category'].'</td> 
				<td><form action="/index.php/users/saveMyEvents" method="post"> <input '.$style.' type="submit" value="'.$follow.'"/>
				<input type="hidden" name="GoonEvent" value="'.$value['eventID'].'">
				
				 </form></td> 
				</tr>';
				
				}
			$table['events'].='</table></center>';    
			   }
		   
		  
		  $this->load->view('getEvents',$table);
		  
		 
		 }
		 
		public function addEvents(){
			$table['events']='';
			 $table['events'].='<a href="/index.php/users/addEvents"><button type="button" class="btn btn-success">ADD Events</button></a> 
		   <a href="/index.php/users/myEvents"><button type="button" class="btn btn-info">My Events</button></a>
		   <a href="/index.php/users"><button type="button" class="btn btn-warning">All Events</button></a>
		   <a href="/index.php/users/signOut"><button type="button" class="btn btn-danger">Sign Out</button></a>
			 ';
		
		 
			$categories=$this->main_m->getCategories();
			$table['categories']='';
			$table['categories'].='<select class="form-control" name="eventCategory"><option></option>';
			foreach($categories as $key=>$value)
			{
				$table['categories'].='<option value="'.$value['categoryID'].'">'.$value['category'].'</option>';
				
				}
			
			$table['categories'].='</select>';
			
			
			
			$this->load->view('addEvents',$table);
			
			}
		public function saveNewEvents(){ 
			
			$insert_array=array("event_name"=>$this->input->post('EventName'),
								"event_date"=>$this->input->post('EventDate'),
								"event_time"=>$this->input->post('EventTime'),
								"event_location"=>$this->input->post('EventLocation'),
								"event_description"=>$this->input->post('EventDescription'),
								"categoryID"=>$this->input->post('eventCategory'));
			
		 				$this->main_m->saveNewEvents_m($insert_array);
			  redirect('/users/addEvents');
			}
			
			
			public function signOut(){
				
			$this->session->sess_destroy();
			 redirect('/main/login');
				
				}
	 }




?>