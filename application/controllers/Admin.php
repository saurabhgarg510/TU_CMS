<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        header("X-XSS-Protection: 1 mode=block ");
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header("Content-Security-Policy: script-src 'self' http://fonts.googleapis.com 'unsafe-inline' 'unsafe-eval';");
        header("Cache-Control: no-cache");
        header("Pragma: no-cache");
        session_start();
        session_regenerate_id(true);
        if (!isset($_SESSION['id']))
            header('location:complaint');
        else if ($_SESSION['user_type'] == 'student') {
            header('location:student');
            die();
        }
        $this->load->model('Admin_model');
    }

    function format_date($str) {
        $month = array(" ", "Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec");
        $y = explode(' ', $str);
        $x = explode('-', $y[0]);
        $date = "";
        $m = (int) $x[1];
        $m = $month[$m];
        $st = array(1, 21, 31);
        $nd = array(2, 22);
        $rd = array(3, 23);
        if (in_array($x[2], $st)) {
            $date = $x[2] . 'st';
        } else if (in_array($x[2], $nd)) {
            $date .= $x[2] . 'nd';
        } else if (in_array($x[2], $rd)) {
            $date .= $x[2] . 'rd';
        } else {
            $date .= $x[2] . 'th';
        }
        $date .= ' ' . $m . ' ' . $x[0];
        return $date;
    }

    public function string_validate($str) {
        $str = filter_var($str, FILTER_SANITIZE_STRING);
        $str1 = str_replace("%", "p", "$str");
        /* @var $mysqli type */
        $str1 = $this->db->escape($str1);
        return str_replace("'", "", $str1);
    }

    function valid_pass($candidate) {
        if (!preg_match_all('$\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[\d])\S*$', $candidate))
            return FALSE;
        return TRUE;
    }

    public function index($page = 'warden') {
        if (!file_exists(APPPATH . '/views/admin/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $cat = $wing = $stat = $sdate = $edate = "";
        if (isset($_SESSION['fcat'])) {
            $cat = $_SESSION['fcat'];
        }
        if (isset($_SESSION['fwing'])) {
            $wing = substr($_SESSION['fwing'], 0, 1);
        }
        if (isset($_SESSION['fstat'])) {
            $stat = $_SESSION['fstat'];
        }
        if (isset($_SESSION['f_sdate']) && isset($_SESSION['f_edate'])) {
            $sdate = date("Y-m-d H:i:s", strtotime($_SESSION['f_sdate']));
            $edate = date("Y-m-d H:i:s", strtotime($_SESSION['f_edate']));
        } else {
            $sdate = '1970-01-01 00:00:00';
            $edate = '1970-01-01 00:00:00';
        }
        $sql = 'select * from complaints where ';
        if ($cat != "") {
            $sql = $sql . 'category = "' . $cat . '" ';
        }

        if ($wing != '' && $sql != 'select * from complaints where ') {
            $sql = $sql . "and roomno like '" . $wing . "%' ";
        } else if ($wing != "") {
            $sql = $sql . "roomno like '" . $wing . "%' ";
        }

        if ($stat != "" && $sql != 'select * from complaints where ') {
            $sql = $sql . "and status = '" . $stat . "' ";
        } else if ($stat != "") {
            $sql = $sql . "status = '" . $stat . "' ";
        }
        if ($sql != 'select * from complaints where ' && $sdate != '1970-01-01 00:00:00' && $edate != '1970-01-01 00:00:00') {
            $sql = $sql . " and comp_date between '" . $sdate . "'  and DATE_ADD('" . $edate . "', INTERVAL 1 DAY)";
        } else if ($sql == 'select * from complaints where ' && $sdate != '1970-01-01 00:00:00' && $edate != '1970-01-01 00:00:00') {
            $sql = $sql . "comp_date between '" . $sdate . "'  and DATE_ADD('" . $edate . "', INTERVAL 1 DAY)";
        } else if ($sql == 'select * from complaints where ') {
            $sql = 'select * from complaints  where status <>"Complete" ';
        }
        //echo $sql;
        $data['row'] = $this->Admin_model->filteredContent($sql);
        //print_r($data);
        $data['category'] = $this->Admin_model->getCategory();
        $title['title'] = ucfirst('View Complaints'); // Capitalize the first letter
        $this->load->view('templates/user_header', $title);
        $this->load->view('admin/' . $page, $data);
        $this->load->view('templates/footer');
    }

    public function filter() {
        $_SESSION['fcat'] = $this->input->get('fcat');
        $_SESSION['fwing'] = $this->input->get('fwing');
        $_SESSION['fstat'] = $this->input->get('fstat');
        $_SESSION['f_sdate'] = $this->input->get('f_sdate');
        $_SESSION['f_edate'] = $this->input->get('f_edate');
        redirect(base_url() . 'index.php/admin');
    }

    public function resetFilters() {
        $temp = $_SESSION['fcat'];
        unset($_SESSION['fcat'], $temp);
        $temp = $_SESSION['fwing'];
        unset($_SESSION['fwing'], $temp);
        $temp = $_SESSION['fstat'];
        unset($_SESSION['fstat'], $temp);
        $temp = $_SESSION['f_sdate'];
        unset($_SESSION['f_sdate'], $temp);
        $temp = $_SESSION['f_edate'];
        unset($_SESSION['f_edate'], $temp);
        redirect(base_url() . 'index.php/admin');
    }

    public function popup() {
        $_SESSION['compid'] = $this->input->post('send');
        $row = $this->Admin_model->popData();
        echo $row['name'] . "," . $row['comp_id'] . "," . $row['category'] . "," . $row['roomno'] . "," . $this->format_date($row['comp_date']) . "(" . date("H:i:s", strtotime($row['comp_date'])) . ")" . "," . $row['status'] . "," . $row['details'];
        $data = $this->Admin_model->popRemark();
        if ($data) {
            foreach ($data as $ro) {
                echo "," . $ro['user_type'] . "," . $this->format_date($ro['time']) . "(" . date("H:i:s", strtotime($ro['time'])) . ")" . "," . $ro['remark'];
            }
        }
    }

    public function add_category($page = 'addnew') {
        if (!file_exists(APPPATH . '/views/admin/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['title'] = 'Add Category';
        $this->load->view('templates/user_header', $data);
        $this->load->view('admin/' . $page, $data);
        $this->load->view('templates/footer');
        unset($_SESSION['stmt']);
    }

    public function newpoll($page = 'poll') {
        if (!file_exists(APPPATH . '/views/admin/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['title'] = 'New Poll';
        $this->load->view('templates/user_header', $data);
        $this->load->view('admin/' . $page, $data);
        $this->load->view('templates/footer');
        unset($_SESSION['flag']);
        unset($_SESSION['queserr']);
    }

    public function pollresult($page = 'poll_result') {
        if (!file_exists(APPPATH . '/views/admin/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['title'] = 'Poll Results';
        $data['query'] = $this->Admin_model->pollresquery();
        $this->load->view('templates/user_header', $data);
        $this->load->view('admin/' . $page, $data);
        $this->load->view('templates/footer');
    }

    public function pollinsert() {
        $data['ques'] = $this->string_validate($this->input->post('ques'));
        $data['op1'] = $this->string_validate($this->input->post('op1'));
        $data['op2'] = $this->string_validate($this->input->post('op2'));
        $data['op3'] = $this->string_validate($this->input->post('op3'));
        $data['op4'] = $this->string_validate($this->input->post('op4'));
        if ($data['ques'] == '' || $data['op1'] == '' || $data['op2'] == '')
            $_SESSION['queserr'] = 'Question, Option 1 and Option 2 are mandatory';
        else {
            $newdata = $this->Admin_model->pollinsertquery($data);
            $_SESSION['flag'] = 1;
        }
        redirect(base_url() . 'index.php/admin/newpoll');
    }

    public function pollgraph($page = 'poll_result1') {
        if (!file_exists(APPPATH . '/views/admin/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['title'] = 'poll_result1';
        $data['id'] = $this->input->get('z');
        $data = $this->Admin_model->pollresquery1($data);
        //	print_r($data);
        $this->load->view('templates/user_header', $data);
        $this->load->view('admin/' . $page, $data);
        $this->load->view('templates/footer');
        unset($_SESSION['stmt']);
    }

    public function insertCategory() {
        $data = $this->input->post();
        $this->Admin_model->addCat($data);
        $_SESSION['stmt'] = TRUE;
        redirect(base_url() . 'index.php/admin/add_category');
    }

    public function del_category($page = 'delete') {
        if (!file_exists(APPPATH . '/views/admin/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['title'] = 'Delete Category';
        $data['category'] = $this->Admin_model->getCategory();
        //	print_r($data);
        $this->load->view('templates/user_header', $data);
        $this->load->view('admin/' . $page, $data);
        $this->load->view('templates/footer');
        unset($_SESSION['stmt']);
    }

    public function deleteCategory() {
        $data = $this->input->get();
        //print_r($data);
        $cat = $data['category'];
        $this->Admin_model->deleteCat($cat);
        $_SESSION['stmt'] = TRUE;
        redirect(base_url() . 'index.php/admin/del_category');
    }

    public function clean_database($page = 'clean') {
        if (!file_exists(APPPATH . '/views/admin/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['title'] = ucfirst($page); // Capitalize the first letter
        $this->load->view('templates/user_header', $data);
        $this->load->view('admin/' . $page, $data);
        $this->load->view('templates/footer');
    }

    public function deleteComplaints() {
        $type = $this->input->post('clean');
        //print_r($type);        
        $this->Admin_model->deleteComplaints($type);
        redirect(base_url() . 'index.php/admin/clean_database');
    }

    public function profile($page = 'profile') {
        if (!file_exists(APPPATH . '/views/admin/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data = $this->Admin_model->getProfile();
        $data['title'] = ucfirst($page);
        $this->load->view('templates/user_header', $data);
        $this->load->view('admin/' . $page, $data);
        $this->load->view('templates/footer');
        unset($_SESSION['matcherr']);
        unset($_SESSION['passerr']);
        unset($_SESSION['olderr']);
        unset($_SESSION['success']);
    }

    public function updateProfile() {
        $oldpass = $this->input->post('oldpass');
        $pass = $this->input->post('pass');
        $repass = $this->input->post('repass');
        $data = $this->Admin_model->getProfile();
        if (isset($oldpass)) {
            $salt = "thispasswordcannotbehacked";
            $oldpass = hash('sha256', $salt . $oldpass);
            if ($data['pass'] != $oldpass) {
                $_SESSION['olderr'] = "Your password doesnot match your previous password.";
            } else
                $_SESSION['olderr'] = '';

            if (isset($pass) && isset($repass)) {
                if ($pass == $repass)
                    $_SESSION['matcherr'] = '';
                else
                    $_SESSION['matcherr'] = "Passwords do not match. Please try again";

                if ($this->valid_pass($pass))
                    $_SESSION['passerr'] = '';
                else
                    $_SESSION['passerr'] = "Password is not valid. ";

                if ($_SESSION['passerr'] == '') {
                    $salt = "thispasswordcannotbehacked";
                    $pass = hash('sha256', $salt . $pass);
                    $this->Admin_model->updatePro($pass);
                }
                redirect(base_url() . 'index.php/admin/profile');
            }
        }
    }

    public function updateRemark() {
        //
        $user = $_SESSION['compid'];
        //print_r($user);
        if ($_POST['remark'] != '') {
            $remark = $this->string_validate($_POST['remark']);
            $remark = str_replace("'", '', $remark);
            $sql = "insert into remarks(remark,comp_id,user_type,time) values('" . $remark . "','" . $user . "' ,'" . ucfirst($_SESSION['user_type']) . "','" . date('Y-m-d H:i:s') . "')";
            $this->Admin_model->addRemark($sql);
        }
        if ($_POST['status'] != '') {
            $sql = "update complaints set status = '" . $_POST['status'] . "' where comp_id = " . $_SESSION['compid'];
            $this->Admin_model->addRemark($sql);
            if ($_POST['cdate'] != "") {
                $cdate = date("Y-m-d H:i:s", strtotime($_POST['cdate']));
                $sql = "update complaints set exp_date = '" . $cdate . "' where comp_id = " . $_SESSION['compid'];
                $this->Admin_model->addRemark($sql);
            }
        }
        redirect(base_url() . 'index.php/admin');
    }

}

?>