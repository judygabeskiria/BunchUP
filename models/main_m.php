<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Main_m extends CI_Model {
	  
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
				
		public function getEvents_filtered($categoryID){
			 $this->db->select('eventID,event_name,event_date,event_time,event_location,event_description,categories.category');
		  $this->db->from('events');
		  $this->db->join('categories','events.categoryID=categories.categoryID');
		  $this->db->where('events.categoryID',$categoryID);
		  $query=$this->db->get(); 
		  return $query->result_array();  
			
			
			}		
		public function reg_user($user_parameters){
			
			$this->db->insert('users',$user_parameters);
			
			}		
					 
		  
	  }



?>