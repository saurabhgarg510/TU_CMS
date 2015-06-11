<?php
class Complaint extends CI_Controller{
	public function developers($page = 'developers')
	{
        if ( ! file_exists(APPPATH.'/views/complaint/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

		$data['title'] = ucfirst($page); // Capitalize the first letter
        $this->load->view('templates/header_static',$data);
        $this->load->view('complaint/'.$page);
        $this->load->view('templates/footer');
	}
	
	public function instructions($page='instruction'){
		if ( ! file_exists(APPPATH.'/views/complaint/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

		$data['title'] = ucfirst($page.'s'); // Capitalize the first letter
        $this->load->view('templates/header_static',$data);
        $this->load->view('complaint/'.$page);
        $this->load->view('templates/footer');
	}
	
	public function home($page='index'){
		if ( ! file_exists(APPPATH.'/views/complaint/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

		$data['title'] = "Home"; 
        $this->load->view('templates/header',$data);
        $this->load->view('complaint/'.$page);
        $this->load->view('templates/footer');
	}
	
	public function sign_in($page='login'){
		if ( ! file_exists(APPPATH.'/views/complaint/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

		$data['title'] = 'Sign In'; 
        $this->load->view('templates/header',$data);
        $this->load->view('complaint/'.$page);
	}
	
	public function contact($page='contact'){
		if ( ! file_exists(APPPATH.'/views/complaint/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
		session_start();
		$data['title'] = ucfirst($page.' Us'); // Capitalize the first letter
        $this->load->view('templates/header_static',$data);
        $this->load->view('complaint/'.$page);
		$this->load->view('templates/footer');
		unset($_SESSION['stmt']);
	}
	
	public function string_validate($str) {

		$str = filter_var($str, FILTER_SANITIZE_STRING);
		$str1 = str_replace("%","p","$str");
		/* @var $mysqli type */
		return $this->db->escape($str1);
	}
	
	public function insertContact(){
		$data=$this->input->post();
		//print_r($data);
		$data['name']	= 	$this->string_validate($data['name']);
		$data['email']	=	$this->string_validate($data['email']);
		$data['message']=	$this->string_validate($data['message']);
		$this->load->model('Outer_model');
		$this->Outer_model->contact($data);
		session_start();
		$_SESSION['stmt']=TRUE;
		$_SESSION['nm']=$data['name'];
		redirect('http://localhost/ci/index.php/complaint/contact/');
	}
	
	public function check_user() {
		$data['email']=$this->input->post('email');
		$data['password']=$this->input->post('password');
		$salt = "thispasswordcannotbehacked";
		$data['password'] = hash('sha256', $salt . $data['password']);
		session_start();
		$this->load->model('Outer_model');
		$result=$this->Outer_model->validate_user($data);
		if ($result == 'student')
			echo 'student';
		else if ($result == 'caretaker')
			echo 'caretaker';
		else if ($result == 'warden')
			echo 'warden';
		else echo 0;
	}		

	
}
?>