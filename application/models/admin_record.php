<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class admin_record extends CI_Model{
    public function check($email,$password){
        $this->db->select("*");
        $this->db->from("admin");
        $this->db->where("email",$email);
        foreach($this->db->get()->result() as $row){
            if($row->password==$password){
                return true;
            }
            else{
                return false;
            }
        }
    }
    public function insert_category($post){
        $sn=0;
        $this->db->select_max("id");
        $this->db->from("ec_category");
        foreach($this->db->get()->result() as $row){
            $sn=$row->id;
        }
        $sn++;

        $category_id="";
        $a=array();
        for($i='A';$i<='Z';$i++){
            array_push($a,$i);
            if($i=='Z'){
                break;
            }
        }
        for($i='a';$i<='z';$i++){
            array_push($a,$i);
            if($i=='z'){
                break;
            }
        }
        for($i=0;$i<=9;$i++){
            array_push($a,$i);
        }
        $b=array_rand($a,6);
        for($i=0;$i<sizeof($b);$i++){
            $category_id=$category_id.$a[$b[$i]];
        }
        $category_id=$category_id."_".$sn;
        $post["id"]=$sn;
        $post["category_id"]=$category_id;

        $post["added_on"]=date('d M,Y');
        $post["slug"]=$this->slugify($post["category_name"]);

        $this->db->insert("ec_category",$post);
        return true;
    }
    public function update_category($data,$category_id){
        $this->db->where("category_id",$category_id);
        $this->db->update("ec_category",$data);
        return true;
    }
    public function update_category_status($category_id){
        $this->db->select("*");
        $this->db->from("ec_category");
        $this->db->where("category_id",$category_id);
        foreach($this->db->get()->result() as $row){
            if($row->status==0){
                $data=array("status"=>1);
                $this->db->where("category_id",$category_id);
                $this->db->update("ec_category",$data);
                return"deactive";
            }
            else{
                $data=array("status"=>0);
                $this->db->where("category_id",$category_id);
                $this->db->update("ec_category",$data);
                return"active";
            }
        }
    }
    public function insert_pincode($data){
        $sn=0;
        $this->db->select_max("id");
        $this->db->from("ec_pincode");
        foreach($this->db->get()->result() as $row){
            $sn=$row->id;
        }
        $sn++;

        $data["id"]=$sn;

        $this->db->insert("ec_pincode",$data);
        return true;
    }
    public function insert_banner($post){
        $sn=0;
        $this->db->select_max("id");
        $this->db->from("ec_banner");
        foreach($this->db->get()->result() as $row){
            $sn=$row->id;
        }
        $sn++;

        $banner_id="";
        $a=array();
        for($i='A';$i<='Z';$i++){
            array_push($a,$i);
            if($i=='Z'){
                break;
            }
        }
        for($i='a';$i<='z';$i++){
            array_push($a,$i);
            if($i=='z'){
                break;
            }
        }
        for($i=0;$i<=9;$i++){
            array_push($a,$i);
        }
        $b=array_rand($a,6);
        for($i=0;$i<sizeof($b);$i++){
            $banner_id=$banner_id.$a[$b[$i]];
        }
        $banner_id=$banner_id."_".$sn;

        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
         $post["id"]=$sn;
        $post["banner_id"]=$banner_id;
        $post["added_on"]=date('Y-m-d');
        $this->load->library('upload', $config);
        $this->upload->do_upload("banner_img");
        $data=$this->upload->data();
        $post["banner_img"]=$config['upload_path'].$data["raw_name"].$data["file_ext"];
        if($this->db->insert("ec_banner",$post)){
            return true;
        }
        else{
            return false;
        }
        

    }
    public function update_banner($post,$banner_id){
        $old_image="";
        $this->db->select("*");
        $this->db->from("ec_banner");
        $this->db->where("banner_id",$banner_id);
        foreach($this->db->get()->result() as $row){
            $old_image=$row->banner_img;
        }
        if(file_exists($old_image)){
            unlink($old_image);
            $this->db->where("banner_id",$banner_id);
           $this->db->update("ec_banner",$post);
           return true;
        }
        else{
            return false;
        }
         
    }
    public function get_subcategory($category_id){
        $output="";
        $this->db->select("*");
        $this->db->from("ec_category");
        $this->db->where("status",0);
        $this->db->where("parent_id",$category_id);
        foreach($this->db->get()->result() as $row){
            $output .='<option value="'.$row->category_id.'">'.$row->category_name.'</option>';
        }
        echo $output;
    }
    public function insert_product($post){
        $id=0;
        $this->db->select_max("id");
        $this->db->from("ec_product");
        foreach($this->db->get()->result() as $row){
            $id=$row->id;
        }
        $id++;

        $product_id="";
        $a=array();
        for($i='A';$i<='Z';$i++){
            array_push($a,$i);
            if($i=='Z'){
                break;
            }
        }
        for($i='a';$i<='z';$i++){
            array_push($a,$i);
            if($i=='z'){
                break;
            }
        }
        for($i=0;$i<=9;$i++){
            array_push($a,$i);
        }
        $b=array_rand($a,6);
        for($i=0;$i<sizeof($b);$i++){
            $product_id=$product_id.$a[$b[$i]];
        }
        $product_id=$product_id."_".$id;

        $post["id"]=$id;
        $post["product_id"]=$product_id;
        
          $config['upload_path']='./uploads/';
        $config['allowed_types']='gif|jpg|png';

           $post["added_on"]=date('Y-m-d');
        $post["ip"]=$_SERVER["REMOTE_ADDR"];
         
         $this->load->library("upload", $config);
         $this->upload->do_upload("product_main_image");
         $data=$this->upload->data();
         $post["product_main_image"]="./uploads/".$data["raw_name"].$data["file_ext"];
         $post["slug"]=$this->slugify($post['product_name']);

         if($this->db->insert("ec_product",$post)){
            $this->session->unset_userdata("p_id");
            return true;
         }
         else{
            
            return false;
         }     
    }
    function slugify($text) {
         $text = preg_replace('~[^\pL\d]+~u', '-', $text);
         $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
    
        return $text;
    }
    public function edit_product($product_id){
        $this->db->select("*");
        $this->db->from("ec_product");
        $this->db->where("product_id",$product_id);
        return $this->db->get()->result();
    }
    public function update_product($post,$product_id){
        $this->db->where("product_id",$product_id);
        $this->db->update("ec_product",$post);
        return true;
    }
    public function update_product_img($post,$product_id){
        $old_image="";
        $this->db->select("*");
        $this->db->from("ec_product");
        $this->db->where("product_id",$product_id);
        foreach($this->db->get()->result() as $row){
            $old_image=$row->product_main_image;
        }
        if(file_exists($old_image)){
            unlink($old_image);
            $this->db->where("product_id",$product_id);
           $this->db->update("ec_product",$post);
           return true;
        }
        else{
            return false;
        }
         
    }
    public function get_info_category($category_id){
        $this->db->select("*");
        $this->db->from("ec_category");
        $this->db->where("category_id",$category_id);
        return $this->db->get()->result();
    }
    public function update_category_img($post,$category_id){
        $old_image="";
        $this->db->select("*");
        $this->db->from("ec_category");
        $this->db->where("category_id",$category_id);
        foreach($this->db->get()->result() as $row){
            $old_image=$row->category_img;
        }
        if(file_exists($old_image)){
            unlink($old_image);
            $this->db->where("category_id",$category_id);
            $this->db->update("ec_category",$post);
            return true;
        }
    }
    public function delete_banner($banner_id){
        $this->db->where("banner_id",$banner_id);
        $this->db->delete("ec_banner");
        return true;
    }
    public function delete_product($product_id){
        $this->db->where("product_id",$product_id);
        $this->db->delete("ec_product");
        return true;
    }
    public function get_all_users(){
        $this->db->select("*");
        $this->db->from("ec_users");
        return $this->db->get()->result();
    }
    public function block_user($user_id){
        $this->db->select("*");
        $this->db->from("ec_users");
        $this->db->where("user_id",$user_id);
        foreach($this->db->get()->result() as $row){
            if($row->status==0){
                $data=array(
                    "status"=>1
                );
                $this->db->where("user_id",$user_id);
                $this->db->update("ec_users",$data);
                return"block";
            }
            else if($row->status==1){
                  $data=array(
                    "status"=>0
                  );
                  $this->db->where("user_id",$user_id);
                  $this->db->update("ec_users",$data);
                  return"unblock";
            }
        }
    }
}
?>