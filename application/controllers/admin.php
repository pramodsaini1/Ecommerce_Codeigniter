<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class admin extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper("url");
         $this->load->library("session");
        $this->load->helper("form");
        $this->load->library("form_validation");
        $this->load->model("admin_record");
        $this->load->database();
        $this->form_validation->set_error_delimiters('<div class="text-danger mt-1 mb-3">','</div>');

    }
    public function index(){
        $session=$this->session->userdata("admin");
         if(isset($session)){
            $this->load->view("index");
         }
         else{
            $this->load->view("admin_login");
         }
    }
    public function login(){
        $session=$this->session->userdata("admin");
        if(isset($session)){
            redirect(base_url()."admin/index");
        }
        else{
            $this->form_validation->set_rules("email","Email","required|trim");
            $this->form_validation->set_rules("password","Password","required|trim");
            if($this->form_validation->run()==FALSE){
              $this->load->view("admin_login");
            }
            else{
                $data=$this->input->post();
                $email=$data["email"];
                $password=$data["password"];
                $this->db->select("*");
                $this->db->from("admin");
                $this->db->where("email",$email);
                $admin_id="";
                foreach($this->db->get()->result() as $row){
                 $admin_id=$row->admin_id;
                }
                if($this->admin_record->check($email,$password)){
                     $this->session->set_userdata("admin",$admin_id);
                     redirect(base_url()."admin/index");
                }
                else{
                 redirect(base_url()."admin/index/invalid_password");
                }
                 
            }
        }
    }
    public function logout(){
        $session=$this->session->userdata("admin");
        $this->session->unset_userdata("admin");
        redirect(base_url()."admin/index");
    }
    public function category(){
        $session=$this->session->userdata("admin");
        if(isset($session)){
           $this->load->view("add_category.php");
        }
        else{
            redirect(base_url()."admin/index");
        }
    }
    public function add_category(){
        $session=$this->session->userdata("admin");
        if(isset($session)){
            $this->form_validation->set_rules("category_name","Category Name","required|trim");
            $this->form_validation->set_rules("status","Selects Status","required|trim");
            if(empty($_FILES["category_img"]["name"])){
                $this->form_validation->set_rules("category_img","Category Image","required|trim");
            }
            if($this->form_validation->run()==FALSE){
                $this->load->view("add_category");
            }
            else{
                $post=$this->input->post();
                $post["category_img"]=$_FILES["category_img"]["name"];
                $config['upload_path']='./uploads/';
                $config['allowed_types']='gif|jpg|png';

                $this->load->library('upload',$config);
                $this->upload->do_upload("category_img");
                $data=$this->upload->data();
                $post["category_img"]=$config['upload_path'].$data["raw_name"].$data["file_ext"];
                if($this->admin_record->insert_category($post)){
                    $this->session->set_flashdata("succMsg","Category Insert Successfully");
                   redirect(base_url()."admin/category");
                }
                else{
                    redirect(base_url()."admin/category/again");
                }
            }
        }
        else{
            redirect(base_url()."admin/index");
        }
    }
    public function update_category(){
        $category_id=$this->input->post("category_id");
        $category_name=$this->input->post("category_name");
        if(isset($category_id) && isset($category_name)){
            $data=array(
                "category_name"=>$category_name
            );
            if($this->admin_record->update_category($data,$category_id)){
                echo"success";
            }
        }
    }
    public function update_category_status(){
        $category_id=$this->input->post("category_id");
        if(isset($category_id)){
            $rec=$this->admin_record->update_category_status($category_id);
            if($rec=="deactive"){
                return"deactive";
            }
            else if($rec=="active"){
                echo"active";
            }
          }
        
    }
    public function pincode(){
        $session=$this->session->userdata("admin");
        if(isset($session)){
           $this->load->view("add_pincode");
        }
        else{
            redirect(base_url()."admin/index");
        }
    }
    public function add_pincode(){
        $session=$this->session->userdata("admin");
        if(isset($session)){
            $this->form_validation->set_rules("pincode","Pincode","required|trim");
            $this->form_validation->set_rules("status","Selects Status","required|trim");
            $this->form_validation->set_rules("delivery_charge","Delivery Charge","required|trim");
            if($this->form_validation->run()==FALSE){
                $this->load->view("add_pincode");
            }
            else{
                $data=$this->input->post();
                if($this->admin_record->insert_pincode($data)){
                    $this->session->set_flashdata("succMsg","Pin-Code Inserted Successfully");
                    redirect(base_url()."admin/pincode");
                }
                else{
                    redirect(base_url()."admin/pincode/again");
                }
            }
        }
        else{
            redirect(base_url()."admin/index");
        }
    }
    public function banner(){
        $session=$this->session->userdata("admin");
        if(isset($session)){
             $banner_code=$this->uri->segment(3);
             if(isset($banner_code)){
                $this->load->view("edit_banner",$banner_code);
             }
             else{
                $this->load->view("add_banner");
             }
        }
        else{
            redirect(base_url()."admin/index");
        }
    }
    public function add_banner(){
        $session=$this->session->userdata("admin");
        if(isset($session)){
             $this->form_validation->set_rules("status","Selects Status","required|trim");
             if(empty($_FILES["banner_img"]["name"])){
                $this->form_validation->set_rules("banner_img","Banner Image","required|trim");
             }
             if($this->form_validation->run()==FALSE){
                $this->load->view("add_banner.php");
             }
             else{
                $post=$this->input->post();
                $post["banner_img"]=$_FILES["banner_img"]["name"];
                 if($this->admin_record->insert_banner($post)){
                    $this->session->set_flashdata("succMsg","Banner Insert Successfully");
                    redirect(base_url()."admin/banner");
                }
                else{
                    redirect(base_url()."admin/banner/again");
                }

             }
             
        }
        else{
            redirect(base_url()."admin/index");
        }
    }
    public function edit_banner(){
        $banner_id=$this->uri->segment(3);
        if(isset($banner_id)){
            $session=$this->session->userdata("admin");
            if(isset($session)){
                  $this->form_validation->set_rules("status","Status","required|trim");
                 if(empty($_FILES["banner_img"]["name"])){
                    $this->form_validation->set_rules("banner_img","Edit Image","required|trim");
                 }
                 if($this->form_validation->run()==FALSE){
                    $this->load->view("edit_banner",$banner_id);
                 }
                 else{
                    $post=$this->input->post();
                    $post["banner_img"]=$_FILES["banner_img"]["name"];
                      $config['upload_path']='./uploads/';
                     $config['allowed_types']='gif|jpg|png';
                     
                     $this->load->library("upload",$config);
                     $this->upload->do_upload("banner_img");

                     $data=$this->upload->data();
                     $img_path=$config['upload_path'].$data["raw_name"].$data["file_ext"];

                      $post["banner_img"]=$img_path;
                      if($this->admin_record->update_banner($post,$banner_id)){
                        redirect(base_url()."admin/banner");
                      }
                      else{
                        redirect(base_url()."admin/banner/again");
                      }
                     
                 }

            }
            else{
                redirect(base_url()."admin/index");
            }
        }
        else{
            redirect(base_url()."admin/banner");
        }
    }
    public function product(){
        $session=$this->session->userdata("admin");
        if(isset($session)){
            $this->load->view("add_product");
        }
        else{
            redirect(base_url()."admin/index");
        }
    }
    public function get_subcategory(){
         $category_id=$this->input->post("category_id");
       echo $this->admin_record->get_subcategory($category_id);
        
     }
     public function add_product(){
        $this->form_validation->set_rules("category","Category","required|trim");
        $this->form_validation->set_rules("sub_category","Sub Category","required|trim");
        $this->form_validation->set_rules("p_id","Product ID","required|trim");
        $this->form_validation->set_rules("product_name","Product Name","required|trim");
        $this->form_validation->set_rules("brand","Product Brand","required|trim");
        $this->form_validation->set_rules("product_mrp","Product MRP","required|trim");
        $this->form_validation->set_rules("product_selling_price","Product Selling Price","required|trim");
        $this->form_validation->set_rules("featured","Feature","required|trim");
        $this->form_validation->set_rules("highlights","Highlights","required|trim");
        $this->form_validation->set_rules("description","Description","required|trim");
        $this->form_validation->set_rules("meta_title","Meta Title","required|trim");
        $this->form_validation->set_rules("meta_keywords","Meta Keyword","required|trim");
        $this->form_validation->set_rules("meta_description","Meta Description","required|trim");
        $this->form_validation->set_rules("status","Status","required|trim");
        $this->form_validation->set_rules("stock","Stock","required|trim");
        if(empty($_FILES["product_main_image"]["name"])){
            $this->form_validation->set_rules("product_main_image","Product Main Image","required|trim");
        }
        if($this->form_validation->run()==FALSE){
            $this->load->view("add_product");
        }
        else{
            $post=$this->input->post();
            $post["product_main_image"]=$_FILES["product_main_image"]["name"];
              if($this->admin_record->insert_product($post)){
                $this->session->set_flashdata("succMsg","Product Added Successfully");
                redirect(base_url()."admin/product");
             }
             else{
                $this->session->set_flashdata("succM","Product Not Added");
                redirect(base_url()."admin/product");
             }
        }

     }
     public function edit_product(){
        $product_id=$this->uri->segment(3);
        if(isset($product_id)){
            $recd["rec"]=$this->admin_record->edit_product($product_id);
            $this->load->view("edit_product",$recd);
        }
     }
     public function update_product(){
         $product_id=$this->uri->segment(3);
        if(isset($product_id)){
             $this->form_validation->set_rules("category","Category","required|trim");
             $this->form_validation->set_rules("sub_category","Sub Category","required|trim");
             $this->form_validation->set_rules("p_id","Product ID","required|trim");
             $this->form_validation->set_rules("product_name","Product Name","required|trim");
             $this->form_validation->set_rules("product_mrp","Product MRP","required|trim");
             $this->form_validation->set_rules("product_selling_price","Product Selling Price","required|trim");
             $this->form_validation->set_rules("featured","Feature","required|trim");
             $this->form_validation->set_rules("highlights","Highlights","required|trim");
             $this->form_validation->set_rules("description","Description","required|trim");
             $this->form_validation->set_rules("meta_title","Meta Title","required|trim");
             $this->form_validation->set_rules("meta_keywords","Meta Keyword","required|trim");
             $this->form_validation->set_rules("meta_description","Meta Description","required|trim");
             $this->form_validation->set_rules("status","Status","required|trim");
             $this->form_validation->set_rules("stock","Stock","required|trim");
             $this->form_validation->set_rules("brand","Product Brand","required|trim");

             if($this->form_validation->run()==FALSE){
                $recd["rec"]=$this->admin_record->edit_product($product_id);
                $this->load->view("edit_product",$recd);
             }
             else{
                $post=$this->input->post();
                 if($this->admin_record->update_product($post,$product_id)){
                    $this->session->set_userdata("updateMsg","Product Updted Successfully");
                    redirect(base_url()."admin/product");
                 }
                 else{
                    $this->session->set_userdata("errorMsg","Product Not Updated");
                    $recd["rec"]=$this->admin_record->edit_product($product_id);
                    $this->load->view("edit_product",$recd);
                 }
             }
        }
        else{
            redirect(base_url()."admin/product");
        }
     }
     public function update_product_img(){
        $product_id=$this->uri->segment(3);
        if(isset($product_id)){

            $config['upload_path']='./uploads/';
            $config['allowed_types']='gif|jpg|png';

            $this->load->library("upload",$config);
            $this->upload->do_upload("product_main_image");

                $data=$this->upload->data();
                $img_path=$config['upload_path'].$data["raw_name"].$data["file_ext"];
            
                    $post=array(
                        "product_main_image"=>$img_path
                    );
                    if($this->admin_record->update_product_img($post,$product_id)){
                        $this->session->set_userdata("succImg","Image Updated Successfully");
                        $recd["rec"]=$this->admin_record->edit_product($product_id);
                            $this->load->view("edit_product",$recd);
                    }
 
        }
     }
     public function edit_category_img(){
        $category_id=$this->uri->segment(3);
        if(isset($category_id)){
            $recd["rep"]=$this->admin_record->get_info_category($category_id);
            $this->load->view("add_category",$recd);
        }
     }
     public function update_category_img(){
        $category_id=$this->uri->segment(3);
        if(isset($category_id)){
            if(empty($_FILES["category_img"]["name"])){
                $this->form_validation->set_rules("caetgory_img","Category Image","required|trim");
            }
            else{
                $post=$this->input->post();
                $post["category_img"]=$_FILES["category_img"]["name"];
                
                $config['upload_path']='./uploads/';
                $config['allowed_types']='gif|jpg|png';

                $this->load->library('upload',$config);
                $this->upload->do_upload("category_img");
                $data=$this->upload->data();
 
                $post["category_img"]=$config['upload_path'].$data["raw_name"].$data["file_ext"];
                 if($this->admin_record->update_category_img($post,$category_id)){
                    $this->session->set_userdata("updateCategory","Category Image Updated Successfully");
                    redirect(base_url()."admin/add_category");
                }
                 
            }
        }
     }
     public function delete_banner(){
        $banner_id=$this->uri->segment(3);
        if(isset($banner_id)){
            if($this->admin_record->delete_banner($banner_id)){
                redirect(base_url()."admin/banner");
            }
            else{
                redirect(base_url()."admin/banner/again");
            }
        }
     }
     public function delete_product(){
        $product_id=$this->uri->segment(3);
        if(isset($product_id)){
            if($this->admin_record->delete_product($product_id)){
                redirect(base_url()."admin/product");
            }
            else{
                redirect(base_url()."admin/product/again");
            }
        }
     }
      public function users(){
        if($this->session->userdata("admin")){
            $recd["rec"]=$this->admin_record->get_all_users();
            $this->load->view("all_users.php",$recd);
        }
        else{
            redirect(base_url()."admin/index");
        }
      }
      public function block_user(){
         if($this->session->userdata("admin")){
            $user_id=$this->input->post("user_id");
             if($this->admin_record->block_user($user_id)=="block"){
                 echo"block";
             }
             else{
                echo"unblock";
             }
         }
         else{
            redirect(base_url()."admin/index");
         }
      }
     
}
?>