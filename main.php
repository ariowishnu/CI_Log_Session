<?php  
 defined('BASEPATH') OR exit('No direct script access allowed');  
 class Main extends CI_Controller {  
      //functions 
      function index()  
      {  
           //http://localhost/tutorial/codeigniter/main/login  
           $data['title'] = 'CodeIgniter Simple Login Form With Sessions';  
           $this->load->view("login", $data);  
      }  
      function login_validation()  
      {  
           $this->load->library('form_validation');  
           $this->form_validation->set_rules('username', 'Username', 'required');  
           $this->form_validation->set_rules('password', 'Password', 'required');  
           if($this->form_validation->run())  
           {  
                //true  
                $username = $this->input->post('username');  
                $password = $this->input->post('password');  
                //model function  
                $this->load->model('main_model');  
                if($this->main_model->can_login($username, $password))  
                {  
                     $session_data = array(  
                          'username'     =>     $username  
                     );  
                     $this->session->set_userdata($session_data);  
                     redirect(base_url() . 'index.php/main/welcome');  
                }  
                else  
                {  
                     $this->session->set_flashdata('error', 'Invalid Username and Password');  
                     redirect(base_url() . 'index.php/main/index');  
                }  
           }  
           else  
           {  
                //false  
                $this->index();  
           }  
      }  
     
      /*
      function enter(){  
           if($this->session->userdata('username') != '')  
           {  
                //echo '<h2>Welcome - '.$this->session->userdata('username').'</h2>';  
                //echo '<label><a href="'.base_url().'index.php/main/logout">Logout</a></label>';
                $this->welcome(); 
                //redirect(base_url());

           }  
           else  
           {  
                redirect(base_url());  
           }  
      }  
      */

      //start controller link ke menu logout
      function logout()  
      {  
           $this->session->unset_userdata('username');  
           redirect(base_url());  
      }
     //end controller link ke menu logout

     //start controller link ke halaman _blank 
     function welcome()  
      {
		if($this->session->userdata('username') != '')  
           {  
                //echo '<h2>Welcome - '.$this->session->userdata('username').'</h2>';  
                //echo '<label><a href="'.base_url().'index.php/main/logout">Logout</a></label>';
                //$this->welcome(); 
                //redirect(base_url());

                $comp = array(
                    "content" => $this->load->view("_blank",array(),true),
                    "sidenav" => $this->load->view("sidenav",array(),true)
        
                );
                
                $this->load->view("index",$comp);
           }  
           else  
           {  
                redirect(base_url());  
           }  
	}
    //end controller link ke halaman _blank   
    
    //start controller link ke halaman user_list
    function user_list() 
	{
		if($this->session->userdata('username') != '')  
           {  
                //echo '<h2>Welcome - '.$this->session->userdata('username').'</h2>';  
                //echo '<label><a href="'.base_url().'index.php/main/logout">Logout</a></label>';
                //$this->welcome(); 
                //redirect(base_url());

                $comp = array(
                    "content" => $this->load->view("content",array(),true),
                    "sidenav" => $this->load->view("sidenav",array(),true)
        
                );
                
                $this->load->view("index",$comp);


           }  
           else  
           {  
                redirect(base_url());  
           }  
	}
    //end start controller link ke halaman user_list
 }  


