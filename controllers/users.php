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

		   $table['events'].='<a href="/index.php/users/addEvents"><button type="button" class="btn btn-success" style="margin-top:10px; margin-left:2px; margin-bottom:3px;">Add Events</button></a>
		   <a href="/index.php/users/myEvents"><button type="button" class="btn btn-info" style="margin-top:10px; margin-bottom:3px;">My Events</button></a>
		   <a href="/index.php/users"><button type="button" class="btn btn-warning" style="margin-top:10px; margin-bottom:3px;">All Events</button></a>
       <a href="/index.php/users/messageUsers"><button type="button" class="btn btn-primary" style="margin-top:10px; margin-bottom:3px;">Messages <span class="badge badge-light">3</span> </button></a>
		   <a href="/index.php/users/signOut"><button type="button" class="btn btn-danger" style="margin-top:10px; margin-bottom:3px;">Sign Out</button></a>';
		   $categories=$this->main_m->getCategories();
			$table['categories']='';
			$table['categories'].='<form style="margin-left:1030px; margin-top:10px; position:absolute; " action="" method="post">
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



          if(isset($_GET['eventID']))
          {
            $evtID = $_GET['eventID'];
            echo '<div class="alert alert-danger">
            Do you want to be matched with anyone who is also going?
            <form action="/index.php/users/match" method="post">
              <button type="submit" class="btn btn-default">Yes</button>
              <input type="hidden" name="eventID" value="1">
            </form>
            <a href="/index.php/users"><button type="button" class="btn btn-danger">No</button></a>
            </div>';
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
				 </form>
         </td>
				</tr>';

          /* new edit */

        //echo "<h1>".$_GET['eventID']."</h1>";

//        if(isset($_POST['GoonEvent'])&&($_GET[$follow]==="Follow"))

        /*  end */

        /* instead of echo:
        <div class="alert alert-danger">
        Do you want to be matched with anyone?
        <button type="button" class="btn btn-default">Yes</button>
        <button type="button" class="btn btn-danger">No</button>
        </div>
        */
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
			 redirect('/users?eventID='.$this->input->post('GoonEvent'));
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

		   $table['events'].='<a href="/index.php/users/addEvents"><button type="button" class="btn btn-success" style="margin-top:10px; margin-left:2px; margin-bottom:3px;">Add Events</button></a>
		   <a href="/index.php/users/myEvents"><button type="button" class="btn btn-info" style="margin-top:10px; margin-bottom:3px;">My Events</button></a>
		   <a href="/index.php/users"><button type="button" class="btn btn-warning" style="margin-top:10px; margin-bottom:3px;">All Events</button></a>
       <a href="/index.php/users/messageUsers"><button type="button" class="btn btn-secondary" style="margin-top:10px; margin-bottom:3px;">Messages</button>
		   <a href="/index.php/users/signOut"><button type="button" class="btn btn-danger" style="margin-top:10px; margin-bottom:3px;">Sign Out</button></a>
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
			 $table['events'].='<a href="/index.php/users/addEvents"><button type="button" class="btn btn-success">Add Events</button></a>
		   <a href="/index.php/users/myEvents"><button type="button" class="btn btn-info">My Events</button></a>
		   <a href="/index.php/users"><button type="button" class="btn btn-warning">All Events</button></a>
       <a href="/index.php/users/messageUsers"><button type="button" class="btn btn-secondary">Messages</button>
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
      public function messageForm(){
        $table['events']='';
         $table['events'].='<a href="/index.php/users/addEvents"><button type="button" class="btn btn-success">Add Events</button></a>
         <a href="/index.php/users/myEvents"><button type="button" class="btn btn-info">My Events</button></a>
         <a href="/index.php/users"><button type="button" class="btn btn-warning">All Events</button></a>
         <a href="/index.php/users/messageUsers"><button type="button" class="btn btn-secondary">Messages</button>
         <a href="/index.php/users/signOut"><button type="button" class="btn btn-danger">Sign Out</button></a>
         ';
         	$this->load->view('messageForm',$table);
      }
      /*new edit*/
      public function match()
      {
        $table['events']='';
  			 $table['events'].='<a href="/index.php/users/addEvents"><button type="button" class="btn btn-success">Add Events</button></a>
  		   <a href="/index.php/users/myEvents"><button type="button" class="btn btn-info">My Events</button></a>
  		   <a href="/index.php/users"><button type="button" class="btn btn-warning">All Events</button></a>
         <a href="/index.php/users/messageUsers"><button type="button" class="btn btn-secondary">Messages</button>
  		   <a href="/index.php/users/signOut"><button type="button" class="btn btn-danger">Sign Out</button></a>
  			 ';
         //echo $this->input->post('eventID');
         $match=$this->main_m->getMatch($this->session->userdata('userID'), $this->input->post('eventID'));
         if(!empty($match))
         {

             echo '<div class="alert alert-danger">
             Do you want to send message to your match?
             <a href="/index.php/users/messageForm?matchID=15"><button type="button" class="btn btn-default">Yes</button>
             <a href="/index.php/users/match"><button type="button" class="btn btn-danger">No</button>
             </div>';
           //undefined index:matches
             $table['matches']='';
           $table['matches'].='<center><table class="table" style="color:White;"><tr>
     			<td>First Name</td>
     			<td>Last Name</td>
     			<td>Username</td>
     			</tr>';

          foreach($match as $key=>$value){
          $table['matches'].='<tr>
          <td>'.$value['fname'].'</td>
          <td>'.$value['lname'].'</td>
          <td>'.$value['username'].'</td>
          </tr>';
          break;
        }
        	$table['matches'].='</table></center>';
        }
           $this->load->view('match',$table);
           //redirect('/match');

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
      public function sendMessage(){
        //echo $this->input->post('Content');
        $content=$this->input->post('Content');
        $this->main_m->sendMessage_m($content,$this->session->userdata('userID'),$this->input->post('eventID'));
          redirect('/users/messageForm');
      }
      public function sendMessage1()
      {
        $msg=$this->input->post('msg');
        //$msg2 = $_POST['msg'];
        // if(isset($_GET['user'])){
        // $user= $_GET['user'];}
        $user = $this->input->post('user');
        //$user2 = $_POST['user'];

        // error_log('2:'.$user2);
        // error_log('2:'.$msg2);
        //echo $user;
        //$user=$this->input->post('user_message');
        $this->main_m->sendMessage_m($msg,$this->session->userdata('userID'),$this->input->post('eventID'));
        //redirect('/users/messages?user='.$this->input->post('user_message'));
        //redirect('/users/messages');
        redirect('/users/messages?user='.$user);
        //redirect('/users/messages?user='.$this->input->post('user_message'));
      }

      public function messages()
      {
      /*  $this->load->helper('url');
         $this->load->view('messages');
         */
         $table['events']='';
         $table['events'].='<a href="/index.php/users/addEvents"><button type="button" class="btn btn-success" style="margin-left:2px; margin-bottom:3px;">Add Events</button></a>
         <a href="/index.php/users/myEvents"><button type="button" class="btn btn-info" style="margin-bottom:3px;">My Events</button></a>
         <a href="/index.php/users"><button type="button" class="btn btn-warning" style="margin-bottom:3px;">All Events</button></a>
          <a href="/index.php/users/messageUsers"><button type="button" class="btn btn-secondary" style="margin-bottom:3px;">Messages</button>
         <a href="/index.php/users/signOut"><button type="button" class="btn btn-danger" style="margin-bottom:3px;">Sign Out</button></a>
         ';

        // $this->load->view('messages', $table);
         //$messages=$this->main_m->get_chat($this->session->userdata('userID'));
         //$msgs=$this->main_m->messages_m($this->session->userdata('userID'),$this->input->post('eventID'));
         //$sql=$dbh->prepare("SELECT * FROM messages");
         //$sql->execute();
         ///send a message
      /*$msgs=$this->input->post('msg');
         $this->main_m->sendMessage_m($msgs,$this->session->userdata('userID'),$this->input->post('eventID'));
         */
         ////////////
    /*     if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest')
         {
           die("<script>window.location.reload()</script>");
         }
         */

         // if(isset($_POST['msg'])){
         //   //$msg=htmlspecialchars($_POST['msg']);
         //   $msgs=$this->input->post('msg');
         //   if($msgs!=""){
         //     /*$sql=$dbh->prepare("INSERT INTO messages (name,msg,posted) VALUES (?,?,NOW())");
         //     $sql->execute(array($_SESSION['user'],$msg));
         //     */
         //     $this->main_m->sendMessage_m($msgs,$this->session->userdata('userID'),$this->input->post('eventID'));
         //   }
         // }

         $user=$_GET['user'];
         //error_log($user.'--$user');
         $table['Messages']='';
       //   if(!empty($this->input->post('user'))){
       //  $user = $this->input->post('user');}
       //   else{
       //   $user=$this->input->post('user_message');
       // }
         $messages=$this->main_m->getChat($this->session->userdata('userID'), $user);

         if(!empty($messages))
        {
       $table['Messages'].='<center><table class="table" style="color:White;"><tr>
       <td>Username</td>
       <td>Message</td>

       </tr>';

       foreach($messages as $key=>$value)
       {

         $table['Messages'].='<tr>
         <td>'.$value['username'].'</td>
         <td>'.$value['message_content'].'</td>
         </tr>';

         }
       $table['Messages'].='</table></center>';
          }

       $this->load->view('messages',$table);

       echo '<form id="msg_form" action="/index.php/users/sendMessage1?user='.$user.'" method="post" style="margin-left:2px; margin-top:10px;">
        <input type="hidden" name="user" value="'.$user.'">
        <input name="msg" size="30" type="text"/>
        <button>Send</button>
       </form>';
       // form action="/index.php/users/saveEvents" method="post"> <input '.$style.' type="submit" value="'.$follow.'"/>
       // <input type="hidden" name="GoonEvent" value="'.$value['eventID'].'">
       //  </form>
      /* if(!isset($_SESSION['user']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest'){
         echo "<script>window.location.reload()</script>";
       }

       redirect('/users/messages');
       */
      }
      public function messageUsers(){
        $table['events']='';

        $table['events'].='<a href="/index.php/users/addEvents"><button type="button" class="btn btn-success">Add Events</button></a>
        <a href="/index.php/users/myEvents"><button type="button" class="btn btn-info">My Events</button></a>
        <a href="/index.php/users"><button type="button" class="btn btn-warning">All Events</button></a>
        <a href="/index.php/users/messageUsers"><button type="button" class="btn btn-primary">Messages <span class="badge badge-light">3</span> </button></a>
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
           $message_users=$this->main_m->getMessageUsers($this->session->userdata('userID'));
             $table['listusers']='';
             $table['listusers'].='<center><table class="table" style="color:White;"><tr>
             <td>Username</td>

             </tr>';
               foreach($message_users as $key=>$value)
               {
                 if($value['userID']!==$this->session->userdata('userID'))
                 //$userID2=$value['username'];
               {
                 $table['listusers'].='<tr>
               <td> <form action="/index.php/users/messages?user='.$value['userID'].'" class="list-group-item list-group-item-action" method="post"> <input type="submit" value="'.$value['username'].'"/>
               <input type="hidden" name="user_message" value="'.$value['userID'].'"></form></td>
                </tr>';
              }
                 }
               $table['listusers'].='</table></center>';


              $this->load->view('messageUsers',$table);
      }
      public function messageSent(){
        $table['events']='';

        $table['events'].='<a href="/index.php/users/addEvents"><button type="button" class="btn btn-success">Add Events</button></a>
        <a href="/index.php/users/myEvents"><button type="button" class="btn btn-info">My Events</button></a>
        <a href="/index.php/users"><button type="button" class="btn btn-warning">All Events</button></a>
        <a href="/index.php/users/messageUsers"><button type="button" class="btn btn-primary">Messages <span class="badge badge-light">3</span> </button></a>
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
        $this->load->view('messagesent');
      }


			public function signOut(){

			$this->session->sess_destroy();
			 redirect('/main/login');

				}
	 }




?>
