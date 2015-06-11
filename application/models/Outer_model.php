<?php
class Outer_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
		
		public function validate_user($data)
		{
			$query = 'select * from login where email="' . $data['email'] . '" and pass="' . $data['password'] . '"';
			$result = $this->db->query($query);
			if ($result->num_rows() > 0)
			{
				$row = $result->row();
				$_SESSION['id'] = session_id();
				$query = 'select fname, user_type, regno, email, roomno from registration where registration.email="' . $row->email . '"';
				$res = $this->db->query($query);
				$row = $res->row();
				$_SESSION['email'] = $row->email;
				$_SESSION['name'] = $row->fname;
				$_SESSION['user_type'] = $row->user_type;
				$_SESSION['roll'] = $row->regno;
				return $row->user_type;
			}
			else return 0;
		}		
		
		public function contact($data)
		{
				return $this->db->insert('contact',$data);
				
			/*	$to=$_POST['email'];
				$subject="Regarding your Feedback/Request at Hostel-J online portal";
				$message="We have received your feedback/request. Its being processed and we will get back to you as soon as possible.";
				$headers="From:Hostel-J<developer@onlinehostelj.in>";
				mail($to,$subject,$message,$headers);
				$to="developer@onlinehostelj.in";
				$subject="New request or feedback";
				$message="Name = ".$_POST['name']." Email = ".$_POST['email']." Message = ".$_POST['message'];
				$headers="From:".$_POST['name']."<".$_POST['email'].">";
				mail($to,$subject,$message,$headers);*/
		}
}
?>