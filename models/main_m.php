<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Main_m extends CI_Model {

    public function __construct(){
      parent::__construct();
    date_default_timezone_set('UTC');
  }
	  public function select_user($user,$pass){
		  $this->db->select('fname,lname,userID');
		  $this->db->from('users');
		  $this->db->where('username',$user);
		  $this->db->where('password',$pass);
		  $query=$this->db->get();
		  return $query->result_array();
		  }

		  public function getEvents(){

          $this->db->select('eventID,event_name,event_date,event_time,event_location,event_description,categories.category');
		  $this->db->from('events');
		  $this->db->join('categories','events.categoryID=categories.categoryID');
		  $query=$this->db->get();
		  return $query->result_array();

			  }


			 public function saveEvents_m($eventID,$userID)
			 {
				 $this->db->insert('userevents',array('userID'=>$userID,'eventID'=>$eventID));

				 }



			public function checkEvents_m($eventID,$userID){

				 $this->db->select('eventID,userID');
		 		 $this->db->from('userevents');
				 $this->db->where('eventID',$eventID);
				  $this->db->where('userID',$userID);
		 		 $query=$this->db->get();
		 		 return $query->result_array();


				}


			public function deleteEvents_m($eventID,$userID){
				 $this->db->where('eventID',$eventID);
				  $this->db->where('userID',$userID);
				$this->db->delete('userevents');


				}

			public function getMyEvents($userID){
				 $this->db->select('events.eventID,event_name,event_date,event_time,event_location,event_description,categories.category');
		  $this->db->from('events');
		  $this->db->join('categories','events.categoryID=categories.categoryID');
		  $this->db->join('userevents','events.eventID=userevents.eventID');
		  $this->db->where('userevents.userID',$userID);
		  $query=$this->db->get();
		  return $query->result_array();


				}
        /* new edit */
        //takes user id and event id, finds a match for user and returns match's info, if no match than null
        public function getMatch($userID,$eventID){
          // echo "--------------";
          // echo $eventID;
          $this->db->select('matchID');
          $this->db->from('matches');
          $this->db->where('userID2','0');
          $this->db->where('eventID',$eventID);
          $query=$this->db->get();
          if(count($query->result_array())===0)
          {
            $data = array(
              'userID1' => $userID ,
              'userID2' => '0' ,
              'eventID' => $eventID
            );
          $this->db->insert('matches', $data);
            return NULL;
          }
          else {
            $results = $query->result_object();;
            $data = array(
                'userID2' => $userID
              );
        /*    var_dump((array) $results[0]);
            echo ((array) $results[0])['matchID'];
        //    error_log($results[0]["matchID"]);
      /*    foreach ($query->result() as $row)
          {
        echo $row->title;
      } */

            $this->db->where('matchID', ((array) $results[0])['matchID']);
            $this->db->update('matches', $data);
                //$query2=$this->db->get();
              /////
              $this->db->select('users.fname, users.lname, users.username');
              $this->db->from('users');
              $this->db->join('matches', 'matches.userID1=users.userID');
              $this->db->where('matches.eventID', $eventID);
              $this->db->where('matches.userID2', $userID);
              $query1=$this->db->get();
        		  return $query1->result_array();

          }
        }

				public function getCategories(){

					$this->db->select('categoryID,category');
					$this->db->from('categories');
					 $query=$this->db->get();
					  return $query->result_array();


					}



			public function saveNewEvents_m($insert_array)
			{
				$this->db->insert('events',$insert_array);

				}
        public function sendMessage_m($content,$userID1, $eventID)
        {
          ////get userID2
          $this->db->select('userID2');
          $this->db->from('matches');
          $this->db->where('userID1',$userID1);
          $this->db->where('eventID',$eventID);
          $query=$this->db->get();
          $results = $query->result_object();

          $data = array(
        //'message_content' => $insert_array,
        'message_content' => $content,
        'from_user' => $userID1,
        'to_user' => ((array) $results[0])['userID2']
          );
          $this->db->insert('messages', $data);
        }

        public function getChat($userID1, $userID2)
        {
        $this->db->select('messages.message_content, users.username');
        $this->db->from('messages');
        $this->db->join('users','messages.from_user=users.userID');
        // $this->db->where('messages.from_user',$userID1);
        // $this->db->where('messages.to_user',$userID2);
        // $this->db->or_where('messages.to_user',$userID1);
        $this->db->where("(messages.from_user=$userID1 AND messages.to_user=$userID2) OR (messages.from_user=$userID2 AND messages.to_user=$userID1)");
        $query=$this->db->get();
       return $query->result_array();
        }
        public function getMessageUsers($userID)
        {
          $this->db->distinct();
          $this->db->select('users.username, users.userID');
          $this->db->from('users');
          $this->db->join('matches','users.userID=matches.userID1 OR users.userID=userID2');
          $this->db->where('matches.userID1', $userID);
          //$this->db->where('users.userID != ', $userID);
          $this->db->or_where('matches.userID2', $userID);
          $query=$this->db->get();
         return $query->result_array();
        }

		public function getEvents_filtered($categoryID){
			 $this->db->select('eventID,event_name,event_date,event_time,event_location,event_description,categories.category');
		  $this->db->from('events');
		  $this->db->join('categories','events.categoryID=categories.categoryID');
		  $this->db->where('events.categoryID',$categoryID);
		  $query=$this->db->get();
		  return $query->result_array();


			}
      public function messages_m($userID1, $eventID)
      {
         $this->db->select('*');
         $this->db->from('messages');
         $this->db->join('matches', 'matches.userID1=messages.from_user OR matches.userID2=messages.from_user');
         $this->db->where('messages.eventID', $eventID);
         $query=$this->db->get();
         return $query->result_array();
      }
      public function users_online()
      {
  if(isset($_SESSION['user'])){
  $sqlm=$this->db->prepare("SELECT from_user FROM messages WHERE from_user=?");
 $sqlm->execute(array($_SESSION['user']));
 if($sqlm->rowCount()!=0){
  $sql=$this->db->prepare("UPDATE messages SET seen=NOW() WHERE from_user=?");
  $sql->execute(array($_SESSION['user']));
 }else{
  $sql=$this->db->prepare("INSERT INTO messages (to_user,seen) VALUES (?,NOW())");
  $sql->execute(array($_SESSION['user']));
  }
  }
/* Make sure the timezone on Database server and PHP server is same */
  $sql=$this->db->prepare("SELECT * FROM messages");
  $sql->execute();
  while($r=$sql->fetch()){
    $curtime=strtotime(date("Y-m-d H:i:s",strtotime('-25 seconds', time())));
    if(strtotime($r['seen']) < $curtime){
      $kql=$this->db->prepare("DELETE FROM messages WHERE from_user=?");
      $kql->execute(array($r['from_user']));
    }
    }
    }
		public function reg_user($user_parameters){

			$this->db->insert('users',$user_parameters);

			}



	  }



?>
