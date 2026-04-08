<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FatList extends CI_Controller {

    public function index()
    {
        $title['title'] = 'List FAT';

        session_start();
        if(
            $_SESSION['role']=='Superadmin' || 
            $_SESSION['role']=='NOC Ritel' || 
            $_SESSION['role']=='Team Leader' || 
            $_SESSION['role']=='Pemeliharaan Ritel' ||
            $_SESSION['role']=='Guest 1'
        ){
            $this->load->view('navbar', $title);
            $this->load->view('fatlist');
        } else {
            header('location: ./DashboardNoc');
        }
    }
}
