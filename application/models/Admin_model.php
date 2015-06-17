<?php

class Admin_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function addCat($data) {
        return $this->db->insert("category", $data);
    }

    public function deleteComplaints($type) {
        if ($type == 'all')
            $this->db->query('truncate complaints');
        else
            $this->db->query("delete from complaints where status='Complete'");
    }

    public function getProfile() {
        $query = "select pass from login where email = '" . $_SESSION['email'] . "'";
        $result = $this->db->query($query);
        $row = $result->row();
        $data['pass'] = $row->pass;
        $query1 = "select * from registration where email = '" . $_SESSION['email'] . "'";
        $result1 = $this->db->query($query1);
        $row1 = $result1->row();
        $data['contact'] = $row1->contact;
        return $data;
    }

    public function updatePro($pass) {
        $query = "update login set pass = '" . $pass . "' where email = '" . $_SESSION['email'] . "'";
        $this->db->query($query);
        $_SESSION['success'] = "Your changes have been saved";
    }

    public function getCategory() {
        $query = "select category from category";
        $result = $this->db->query($query);
        $data = array();
        foreach ($result->result() as $row) {
            array_push($data, $row->category);
        }
        return $data;
    }

    public function deleteCat($cat) {
        $query = "delete from category where category ='" . $cat . "'";
        $this->db->query($query);
    }

    public function filteredContent($sql) {
        $result = $this->db->query($sql);
        $details = array();
        foreach ($result->result() as $row) {
            $data['row']['comp_id'] = $row->comp_id;
            $data['row']['category'] = $row->category;
            $data['row']['roomno'] = $row->roomno;
            $contact=$this->db->query("select contact from registration where roomno='".$row->roomno."'");
            $data['row']['contact'] = $contact->row()->contact;
            $data['row']['comp_date'] = $row->comp_date;
            $data['row']['status'] = $row->status;
            $data['row']['details'] = $row->details;
            $data['row']['name'] = $row->name;
            $data['row']['comp_type'] = $row->comp_type;
            array_push($details, $data['row']);
        }
        return $details;
    }

    function popData() {
        $sql = "SELECT * FROM complaints where comp_id = '" . $_SESSION['compid'] . "' order by comp_date desc";
        $result = $this->db->query($sql);
        $row = $result->row_array();
        return $row;
    }

    function popRemark() {
        $sql = "SELECT * FROM remarks where comp_id = '" . $_SESSION['compid'] . "' order by time desc";
        $result = $this->db->query($sql);
        $details = array();
        foreach ($result->result_array() as $row) {
            $data['user_type'] = $row['user_type'];
            $data['time'] = $row['time'];
            $data['remark'] = $row['remark'];
            array_push($details, $data);            
            //format_date($row['time']) . "(" . date("H:i:s", strtotime($row['time'])) . ")" . "," . $row['remark'];
        }
        return $details;
    }

    function addRemark($sql) {
        $this->db->query($sql);
    }

}

?>