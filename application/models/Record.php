<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
class Record extends CI_Model{
    
    public function get_product_details($slug){
        $this->db->select("*");
        $this->db->from("ec_product");
        $this->db->where(["slug"=>$slug,"status"=>0]);
        $q=$this->db->get();
        if($q->num_rows()){
            return $q->row();
        }
        else{
            return false;
        }
    }
     
    public function insert_user($post,$pop){
        $id=0;
        $this->db->select_max("id");
        $this->db->from("ec_users","ec_customers");
        foreach($this->db->get()->result() as $row){
            $id=$row->id;
        }
        $id++;

        

        $user_id="";
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
            $user_id=$user_id.$a[$b[$i]];
        }
        $user_id="U23".$user_id."_".$id;
        $post["id"]=$id;
        $post["user_id"]=$user_id;
        $post["status"]=0;
        $post["added_on"]=date("Y-m-d");
        $post["password"]= $post["password"];

        $pop["id"]=$id;
        $pop["user_id"]=$user_id;
        $pop["status"]=0;

         $ip_address=$_SERVER["REMOTE_ADDR"];

        $post["ip"]=$ip_address;

        // // $address_details=@unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=".$ip_address));
        // $url = "http://www.geoplugin.net/json.gp?ip=$ip_address";
        // $response = file_get_contents($url);
        // $data = json_decode($response, true);
        
        // $country = $data["geoplugin_countryName"];
        // $state = $data["geoplugin_region"];
        // $city = $data["geoplugin_city"];
        // //$pincode = $data["geoplugin_postCode"];
        // $address = $data["geoplugin_timezone"];


        //  $pop["country"]=$country;
        // $pop["state"]=$state;
        // $pop["city"]=$city;
        // $pop["address"]=$address;
        // //$pop["pincode"]=$pincode;

        $this->db->insert("ec_users",$post);
        //$this->db->insert("ec_customers",$pop);
        return true;


    }
    public function check($email,$user_password){
        $this->db->select("*");
        $this->db->from("ec_users");
        $this->db->where("email",$email);
        foreach($this->db->get()->result() as $row){
            if($row->password==$user_password){
                return true;
            }
            else{
                return false;
            }
        }
    }
     public function add_cart($post){
        $id=0;
        $this->db->select_max("id");
        $this->db->from("ec_cart");
        foreach($this->db->get()->result() as $row){
            $id=$row->id;
        }
        $id++;

        $cart_id="";
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
            $cart_id=$cart_id.$a[$b[$i]];
        }
        $cart_id="C23".$cart_id."_".$id;

        $product_id=$post["product_id"];
        $user_id=$post["user_id"];
        $product_name="";
        $product_price="";
        $slug="";
        $pro_image="";
        $this->db->select("*");
        $this->db->from("ec_product");
        $this->db->where("p_id",$product_id);
        foreach($this->db->get()->result() as $row1){
            $product_name=$row1->product_name;
            $product_price=$row1->product_selling_price;
            $slug=$row1->slug;
            $pro_image=$row1->product_main_image;
        }
        $post["product_name"]=$product_name;
        $post["product_price"]=$product_price;
        $post["slug"]=$slug;
        $post["product_image"]=$pro_image;
        $post["cart_id"]=$cart_id;
        $post["id"]=$id;
        $post["added_on"]=date("Y-m-d");

         $this->db->select("*");
         $this->db->from("ec_cart");
         $this->db->where("user_id",$user_id);
         $this->db->where("product_id",$product_id);
         $result=$this->db->get()->row();
         if($result){
            return false;
         }
         else{
            $this->db->insert("ec_cart",$post);
            return true;
         }
     }
     public function all_cart($user_id){
        $this->db->select("*");
        $this->db->from("ec_cart");
        $this->db->where("user_id",$user_id);
        return $this->db->get()->result();
     }
     public function user_record($user_id){
        $this->db->select("*");
        $this->db->from("ec_users");
        $this->db->where("user_id",$user_id);
        return $this->db->get()->result();
     }
     public function update_user_image($post,$user_id){
        $this->db->where("user_id",$user_id);
        $this->db->update("ec_users",$post);
        return true;
     }
     public function update_pass($post,$user_id){
        $this->db->select("*");
        $this->db->from("ec_users");
        $this->db->where("user_id",$user_id);
        $data=array(
            "password"=>$post["new_pass"]
        );
        foreach($this->db->get()->result() as $row){
            if($row->password==$post["old_pass"]){
               if($post["new_pass"]==$post["con_new_pass"]){
                   $this->db->where("user_id",$user_id);
                   $this->db->update("ec_users",$data);
                   return true;
               }
               else{
                  return "mismatch";
               }
            }
            else{
               return "invalid";
            }
        }
     }
     public function update_cart($post,$user_id){
        for($i=0;$i<sizeof($post);$i++){
            $this->db->where(["product_id"=>$post["product_id"][$i],"user_id"=>$user_id]);
            $this->db->update("ec_cart",["product_quantity"=>$post["product_quantity"][$i]]);
        }
        return true;
     }
     public function delete_cart($product_id,$user_id){
        $this->db->where(["product_id"=>$product_id,"user_id"=>$user_id]);
        $this->db->delete("ec_cart");
        return true;
     }
     public function sub_total($user_id){
         $this->db->select("sum(product_price*product_quantity) as total_price");
        $this->db->from("ec_cart");
        $this->db->where("user_id",$user_id);
        $result=$this->db->get();
        if($result->num_rows()){
            $total= $result->row()->total_price;
            if($total>499){
                 return array("subtotal"=>$total,"grandtotal"=>$total,"delivery"=>0);
            }
            else{
                return array("subtotal"=>$total,"grandtotal"=>$total+40,"delivery"=>40);
            }
        }
     }
     public function insert_wishlist($user_id,$product_id){
        $product_name="";
        $product_price="";
         $product_image="";
         $slug="";
        $this->db->select("*");
        $this->db->from("ec_product");
        $this->db->where("p_id",$product_id);
        foreach($this->db->get()->result() as $row){
          $product_name=$row->product_name;
          $product_price=$row->product_selling_price;
           $product_image=$row->product_main_image;
           $slug=$row->slug;
        }

        $id=0;
        $this->db->select_max("id");
        $this->db->from("ec_wishlist");
        foreach($this->db->get()->result() as $row){
            $id=$row->id;
        }
        $id++;

        $wishlist_id="";
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
            $wishlist_id=$wishlist_id.$a[$b[$i]];
        }
        $wishlist_id="W23".$wishlist_id."_".$id;

        $post["id"]=$id;
        $post["wishlist_id"]=$wishlist_id;
        $post["user_id"]=$user_id;
        $post["product_id"]=$product_id;
        $post["product_name"]=$product_name;
        $post["product_price"]=$product_price;
        $post["slug"]=$slug;
         $post["product_image"]=$product_image;
        $post["added_on"]=date("Y-m-d");
         
       
        $this->db->select("*");
        $this->db->from("ec_wishlist");
        $this->db->where("user_id",$user_id);
        $this->db->where("product_id",$product_id);
        $result=$this->db->get()->row();
        if($result){
           return false;
        }
        else{
           $this->db->insert("ec_wishlist",$post);
           return true;
        }
        
     }
     public function remove_wishlist($user_id,$product_id){
        $this->db->where(["user_id"=>$user_id,"product_id"=>$product_id]);
        $this->db->delete("ec_wishlist");
        return true;
     }
     public function fetch_cat($slug){
         $q=$this->db->select("category_id")->where("slug",$slug)->get("ec_category");
         if($q->num_rows()){
            return $q->row()->category_id;
         }
     }
     public function product_by_category($category_id){
        $this->db->select("*");
        $this->db->from("ec_product");
        $this->db->where("status",0);
        $this->db->like("category",$category_id);
        $this->db->or_like("sub_category",$category_id);
        return $this->db->get()->result();
     }
     
}
?>