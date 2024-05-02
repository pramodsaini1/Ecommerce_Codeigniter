<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->helper("url");
 		$this->load->model("Record");
		$this->load->database();
		$this->load->helper("form");
 		$this->load->library("form_validation");
		$this->load->library("session");
		$this->form_validation->set_error_delimiters('<div class="text-danger mt-1 mb-3">','</div>');
	}
	public function index()
	{
		$this->load->view("home"); 
	}
	 public function product_details($slug){
		$rem["rep"]=$this->Record->get_product_details($slug);
		 $this->load->view("product_details.php",$rem);
	 }
	 public function login(){
		$this->load->view("login.php");
	 }
	 public function register(){
		$this->load->view("register.php");
	 }
	 public function create_account(){
		$this->form_validation->set_rules("username","UserName","required|trim");
		$this->form_validation->set_rules("email","Your Email","required|valid_email|is_unique[ec_users.email]");
		$this->form_validation->set_rules("password","Password","required|trim");
		$this->form_validation->set_rules("phone","Phone","required|trim");
		if(empty($_FILES["user_image"]["name"])){
			$this->form_validation->set_rules("user_image","User Image","required|trim");
		}
		if($this->form_validation->run()==FALSE){
			$this->load->view("register.php");
		}
		else{
			$post=$this->input->post();
			$post["user_image"]=$_FILES["user_image"]["name"];
			
			$config['upload_path']='./uploads/';
			$config['allowed_types']='gif|jpg|png';

			$this->load->library("upload",$config);
			if($this->upload->do_upload("user_image")){
                 $data=$this->upload->data();
				 $image_path=$config['upload_path'].$data["raw_name"].$data["file_ext"];
				 $post["user_image"]=$image_path;
 				 $pop["user_image"]=$image_path;
				 $pop["phone"]=$post["phone"];
				 if($this->Record->insert_user($post,$pop)){
                     $this->session->set_flashdata("insertMsg","Registration Successfully");
					 redirect(base_url()."Dashboard/register");
				 }
				 else{
					$this->session->set_flashdata("againtMsg","Registration Not Successfully");
					redirect(base_url()."Dashboard/register");
				 }
			}
			else{
				$this->session->set_flashdata("errorImage","Image Uploading Error");
				redirect(base_url()."Dashboard/register");
			}
		}
	 }
	 public function login_account(){
		$this->form_validation->set_rules("email","Your Email","required|valid_email");
		$this->form_validation->set_rules("password","Password","required|trim");
		if($this->form_validation->run()==FALSE){
			$this->load->view("login.php");
		}
		else{
			$post=$this->input->post();
			$email=$post["email"];
			$user_password=$post["password"];
 			$user_id="";
			$this->db->select("*");
			$this->db->from("ec_users");
			$this->db->where("email",$email);
			foreach($this->db->get()->result() as $row){
				$user_id=$row->user_id;
			}
   			 if($this->Record->check($email,$user_password)){
				 $this->session->set_userdata("login_id",$user_id);
				 redirect(base_url()."Dashboard/profile");
			 }
			 else{
				$this->session->set_flashdata("passErr","Invalid Password");
				redirect(base_url()."Dashboard/login");
			 }
		}
	 }
	 public function profile(){
		  if($this->session->userdata("login_id")){
			$user_id=$this->session->userdata("login_id");
 			  $this->load->view("home");
		  }
		  else{
			 redirect(base_url()."Dashboard/login");
		  }
	 }
	  public function add_to_cart(){
		 if($this->session->userdata("login_id")){
            $post=$this->input->post();
			$post["user_id"]=$this->session->userdata("login_id");
			 if($this->Record->add_cart($post)){
				$this->session->set_flashdata("succCart","Cart Added Successfully");
                 redirect(base_url()."Dashboard/display_cart");
			 }
			 else{
				$this->session->set_flashdata("cartErr","Already Cart Added");
				redirect(base_url()."Dashboard/display_cart");
			 }
		 }
		 else{
		    redirect(base_url()."Dashboard/login");
		 }
		
	  }
	  public function display_cart(){
		if($this->session->userdata("login_id")){
			$user_id=$this->session->userdata("login_id");
			$recd["rec"]=$this->Record->all_cart($user_id);
			$recd["total"]=$this->Record->sub_total($user_id);
            $this->load->view("display_cart.php",$recd);
		}
		else{
		    redirect(base_url()."Dashboard/login");
		}
	  }
	  public function user_details(){
		 if($this->session->userdata("login_id")){
             $user_id=$this->session->userdata("login_id");
			 $ren["res"]=$this->Record->user_record($user_id);
			 $this->load->view("user_profile.php",$ren);
		 }
		 else{
			redirect(base_url()."Dashboard/login");
		 }
	  }
	  public function logout(){
		 $this->session->unset_userdata("login_id");
		 redirect(base_url()."Dashboard/index");
	  }
	  public function update_user_image(){
		  if($this->session->userdata("login_id")){
			$user_id=$this->session->userdata("login_id");
			 
				$post=$this->input->post();
				$post["user_image"]=$_FILES["user_image"]["name"];
				
				$config['upload_path']='./uploads/';
				$config['allowed_types']='gif|jpg|png';

				$this->load->library("upload",$config);
				if($this->upload->do_upload("user_image")){
					$data=$this->upload->data();
					$image_path=$config['upload_path'].$data["raw_name"].$data["file_ext"];
					$post["user_image"]=$image_path;
					if($this->Record->update_user_image($post,$user_id)){
						$this->session->set_flashdata("succImage","Image Updated Successfully");
						 redirect(base_url()."Dashboard/user_details");
					}
					else{
						$this->session->set_flashdata("errImage","Image Not Updated Successfully");
						 redirect(base_url()."Dashboard/user_details");
					}
				}
				else{
					$this->session->set_flashdata("upImage","Image Uploading Error");
						 redirect(base_url()."Dashboard/user_details");
				}
		 
		  }
		  else{
			  redirect(base_url()."Dashboard/login");
		  }
	  }
	  public function update_user_details(){
		if($this->session->userdata("login_id")){
           $user_id=$this->session->userdata("login_id");
		   $this->form_validation->set_rules("username","UserName","required|trim");
		   $this->form_validation->set_rules("email","Email-ID","required|trim|valid_email|is_unique[ec_users.email]");
		   $this->form_validation->set_rules("phone","Phone","required|trim");
		   if($this->form_validation->run()==FALSE){
			   $this->load->view("user_profile.php");
		   }
		   else{
			  $post=$this->input->post();
			  print_r($post);
		   }
		}
		else{
			redirect(base_url()."Dashboard/login");
		}
	  }
	  public function change_password(){
		 if($this->session->userdata("login_id")){
            $this->form_validation->set_rules("old_pass","Old Password","required|trim");
			$this->form_validation->set_rules("new_pass","New Password","required|trim");
			$this->form_validation->set_rules("con_new_pass","Confirm Password","required|trim");
			if($this->form_validation->run()==FALSE){
				$this->load->view("user_profile");
			}
			else{
				$post=$this->input->post();
				$user_id=$this->session->userdata("login_id");
				if($this->Record->update_pass($post,$user_id)){
                  $this->session->set_flashdata("succPass","Password Changed Successfully");
				  redirect(base_url()."Dashboard/user_details");
				}
				else{
					
				}
			}
		 }
		 else{
			redirect(base_url()."Dashboard/login");
		 }
	  }
	  public function shopping_cart(){
		if($this->session->userdata("login_id")){
			$user_id=$this->session->userdata("login_id");
			$recd["rec"]=$this->Record->all_cart($user_id);
			$recd["total"]=$this->Record->sub_total($user_id);
            $this->load->view("display_cart.php",$recd);
		}
		else{
		    redirect(base_url()."Dashboard/login");
		}
	  }
	  public function update_cart(){
		if($this->session->userdata("login_id")){
           $user_id=$this->session->userdata("login_id");
		   $post=$this->input->post();
		   if($this->Record->update_cart($post,$user_id)){
			   $this->session->set_flashdata("upCart","Cart Updated Successfully");
			   redirect(base_url()."Dashboard/display_cart");
		   }
		   else{
			$this->session->set_flashdata("notCart","Cart Not Updated Successfully");
			redirect(base_url()."Dashboard/display_cart");
		   }
		}
		else{
			redirect(base_url()."Dashboard/login");
		}
	  }
	  public function cart_delete(){
		if($this->session->userdata("login_id")){
           $user_id=$this->session->userdata("login_id");
		   $product_id=$this->uri->segment(3);
		   if($this->Record->delete_cart($product_id,$user_id)){
               $this->session->set_flashdata("delCart","Cart Deleted Successfully");
			   redirect(base_url()."Dashboard/display_cart");
		   }
		   else{
				$this->session->set_flashdata("notdelCart","Cart Not Deleted Successfully");
				redirect(base_url()."Dashboard/display_cart");
		   }
 		}
		else{
			redirect(base_url()."Dashboard/login");
		}
	  }
	  public function checkout(){
		 if($this->session->userdata("login_id")){
            $user_id=$this->session->userdata("login_id");
			$this->load->view("checkout.php");
		 }
		 else{
			 redirect(base_url()."Dashboard/login");
		 }
	  }
	  public function wishlist(){
		if($this->session->userdata("login_id")){
             $user_id=$this->session->userdata("login_id");
			 $product_id=$this->input->post("product_id");
			 if($this->Record->insert_wishlist($user_id,$product_id)){
				echo"success";
			 }
			 else{
				echo"again";
			 }
		}
		else{
			 echo"login";
		}
	  }
	  public function wishlist_show(){
		if($this->session->userdata("login_id")){
             $this->load->view("wishlist.php");
		}
		else{
			 redirect(base_url()."Dashboard/login");
		}
	  }
	  public function remove_wishlist(){
		if($this->session->userdata("login_id")){
           $product_id=$this->uri->segment(3);
		   $user_id=$this->session->userdata("login_id");
		   if($this->Record->remove_wishlist($user_id,$product_id)){
			   $this->session->set_flashdata("removeWish","Wishlist Removed Successfully");
			   redirect(base_url()."Dashboard/wishlist_show");
		   }
		   else{
			$this->session->set_flashdata("notremoveWish","Wishlist  Not Removed Successfully");
			redirect(base_url()."Dashboard/wishlist_show");
		   }
		}
		else{
			redirect(base_url()."Dashboard/login");
	   }
	  }
	  public function product_by_category($slug,$slug1=''){
		  if(!empty($slug) && !empty($slug1)){
             $slug=$slug1;
		  }
		  else{
			$slug=$slug;
		  }
		  $category_id= $this->Record->fetch_cat($slug);
		  $recd["rec"]=$this->Record->product_by_category($category_id);
		   $this->load->view("product_by_category.php",$recd);
 	  }
	  public function about(){
         $this->load->view("about.php");
	  }
	  public function contact(){
         $this->load->view("contact.php");
	  }
	   
}
