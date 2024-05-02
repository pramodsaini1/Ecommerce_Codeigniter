<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view("includes/header");
 
?>
  <body data-sidebar="colored">
    
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            <?php $this->load->view("includes/menu")?>
            <!-- ========== Left Sidebar Start ========== -->
            <?php $this->load->view("includes/left_sidebar")?>
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                    <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Edit Product</h5>
                                         <?php
                                          if($this->session->flashdata("errorMsg")){
                                            ?>
                                             <div class="alert alert-success"><?=$this->session->flashdata("errorMsg")?></div>
                                            <?php
                                          }
                                          
                                         ?>
                                           
                                         <?php
                                          if(isset($rec)){
                                            foreach($rec as $row){
                                             
                                         ?>
                                          <?=form_open_multipart("admin/update_product_img/".$row->product_id)?>
                                         <div class="row">
                                            <div class="col-md-6">
                                                <img src="./<?=$row->product_main_image?>" class="img-fluid" style="width:300px;height:300px">
                                            </div>
                                             <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="file" name="product_main_image" class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button class="btn btn-primary">Upload New Photo</button>
                                                    </div>
                                                </div>
                                             </div>
                                         </div>
                                          <?=form_close()?>
                                         <?=form_open("admin/update_product/".$row->product_id)?>
                                            <div class="row">
                                            <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <select name="category" class="form-select" onchange="get_categories(this.value)" id="floatingSelectGrid" aria-label="Floating label select example">
                                                             <?php
                                                             $this->db->select("*");
                                                             $this->db->from("ec_category");
                                                              $this->db->where("category_id",$row->category);
                                                             foreach($this->db->get()->result() as $row1){
                                                                ?>
                                                                  <option value="<?=$row1->category_id?>"><?=$row1->category_name?></option>
                                                                 <?php
                                                                   $this->db->select("*");
                                                                   $this->db->from("ec_category");
                                                                   $this->db->where("status",0);
                                                                   $this->db->where("parent_id",'');
                                                                   foreach($this->db->get()->result() as $row2){
                                                                      ?>
                                                                        <option value="<?=$row2->category_id?>"><?=$row2->category_name?></option>
                                                                        <?php
                                                                   }
                                                             }
                                                            ?>
                                                         </select>
                                                         
                                                        <label for="floatingSelectGrid">Category</label>
                                                    </div>
                                                    <?=form_error("category")?>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <select name="sub_category" class="form-select subcat" id="floatingSelectGrid" aria-label="Floating label select example">
                                                           <?php
                                                             $this->db->select("*");
                                                             $this->db->from("ec_category");
                                                             $this->db->where("category_id",$row->sub_category);
                                                             foreach($this->db->get()->result() as $row3){
                                                                ?> 
                                                                <option value="<?=$row3->category_id?>"><?=$row3->category_name?></option>

                                                                <?php
                                                             }
                                                           ?>
                                                             
                                                         </select>
                                                         
                                                        <label for="floatingSelectGrid">Sub Category</label>
                                                    </div>
                                                    <?=form_error("sub_category")?>
                                                </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="number" class="form-control" name="p_id" value="<?=$row->p_id?>" id="floatingFirstnameInput" >
                                                         
                                                        <label for="floatingFirstnameInput">Product ID</label>
                                                    </div>
                                                    <?=form_error("p_id")?>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="product_name" value="<?=$row->product_name?>" id="floatingFirstnameInput" >
                                                         
                                                        <label for="floatingFirstnameInput">Product Name</label>
                                                    </div>
                                                    <?=form_error("product_name")?>
                                                </div>
                                            </div> 
                                            <div class="row">
                                            <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="product_mrp" value="<?=$row->product_mrp?>" id="floatingFirstnameInput" >
                                                         
                                                        <label for="floatingFirstnameInput">Product MRP</label>
                                                    </div>
                                                    <?=form_error("product_mrp")?>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="product_selling_price" value="<?=$row->product_selling_price?>" id="floatingFirstnameInput" >
                                                         
                                                        <label for="floatingFirstnameInput">Product Selling Price</label>
                                                    </div>
                                                    <?=form_error("product_selling_price")?>
                                                </div>
                                            </div> 
                                            <div class="row">
                                            <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                    <select name="featured" class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
                                                        <?php
                                                           if($row->featured==1){
                                                               ?>
                                                               <option value="1">Deal Of the month</option>
                                                               <?php
                                                           }
                                                           else{
                                                                ?>
                                                                 <option value="2">New Arrival</option>
                                                                <?php
                                                           }
                                                        ?>
                                                           <option value="1">Deal Of the month</option>
                                                            <option value="2">New Arrival</option>
                                                         </select>
                                                         
                                                        <label for="floatingFirstnameInput">Feature</label>
                                                    </div>
                                                    <?=form_error("featured")?>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea type="text" class="form-control" name="highlights" id="floatingFirstnameInput" ><?=$row->highlights?></textarea>
                                                         
                                                        <label for="floatingFirstnameInput">Highlights</label>
                                                    </div>
                                                    <?=form_error("highlights")?>
                                                </div>
                                            </div> 
                                            <div class="row">
                                            <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea type="text" class="form-control" name="description" id="floatingFirstnameInput" ><?=$row->description?></textarea>
                                                         
                                                        <label for="floatingFirstnameInput">Description</label>
                                                    </div>
                                                    <?=form_error("description")?>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="meta_title" value="<?=$row->meta_title?>" id="floatingFirstnameInput" >
                                                         
                                                        <label for="floatingFirstnameInput">Meta Title</label>
                                                    </div>
                                                    <?=form_error("meta_title")?>
                                                </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea type="text" class="form-control" name="meta_keywords" id="floatingFirstnameInput" ><?=$row->meta_keywords?></textarea>
                                                         
                                                        <label for="floatingFirstnameInput">Meta Keyword</label>
                                                    </div>
                                                    <?=form_error("meta_keywords")?>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea type="text" class="form-control" name="meta_description" id="floatingFirstnameInput" ><?=$row->meta_description?></textarea>
                                                         
                                                        <label for="floatingFirstnameInput">Meta Description</label>
                                                    </div>
                                                    <?=form_error("meta_description")?>
                                                </div>
                                            </div> 
                                            
                                            <div class="row">
                                            <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                           <select name="status" class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
                                                            <?php
                                                              if($row->status==0){
                                                                   ?> 
                                                                    <option value="0">Active</option>

                                                                   <?php
                                                              }
                                                              else if($row->status==1){
                                                                ?> 
                                                                <option value="1">Deactive</option>

                                                               <?php
                                                              }
                                                            ?>
                                                            <option value="0">Active</option>
                                                            <option value="1">Deactive</option>
                                                         </select>
                                                        <label for="floatingFirstnameInput">Status</label>
                                                    </div>
                                                    <?=form_error("status")?>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="number" class="form-control" name="stock" value="<?=$row->stock?>"id="floatingFirstnameInput" >
                                                         
                                                        <label for="floatingFirstnameInput">Stock</label>
                                                    </div>
                                                    <?=form_error("stock")?>
                                                </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="brand" value="<?=$row->brand?>" id="floatingFirstnameInput" >
                                                         
                                                        <label for="floatingFirstnameInput">Product Brand</label>
                                                    </div>
                                                    <?=form_error("brand")?>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="floatingCheck">
                                                    <label class="form-check-label" for="floatingCheck">
                                                      Check me out
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                                            </div>
                                            <?php
                                                
                                            }
                                        }
                                        ?>
                                        <?=form_close()?>
                                         
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                <?php $this->load->view("includes/footer")?>
                
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <?php $this->load->view("includes/right_sidebar")?>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <?php $this->load->view("includes/src")?>
        <script>
            function get_categories(category_id){
                $.ajax({
                    url:"<?=base_url()."admin/get_subcategory"?>",
                    type:"POST",
                    data:{category_id:category_id},
                    success:function(data){
                         $(".subcat").html(data);
                     }
                })
            }
        </script>
         
    </body>


<!-- Mirrored from themesdesign.in/tocly/layouts/5.3.1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Nov 2023 08:52:54 GMT -->
</html>