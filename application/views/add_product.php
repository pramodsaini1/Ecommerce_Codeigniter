<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view("includes/header");
 $p_id="";
 if($this->session->userdata("p_id")!=''){
    $p_id=$this->session->userdata("p_id");
 }
 else{
    $this->session->set_userdata("p_id",mt_rand(11111,99999));
 }
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
                                        <h5 class="card-title">Add Product</h5>
                                         <?php
                                          if($this->session->flashdata("succMsg")){
                                            ?>
                                             <div class="alert alert-success"><?=$this->session->flashdata("succMsg")?></div>
                                            <?php
                                          }
                                         else if($this->session->flashdata("succM")){
                                            ?>
                                             <div class="alert alert-success"><?=$this->session->flashdata("succM")?></div>
                                            <?php
                                          }
                                          else if($this->session->flashdata("updateMsg")){
                                            ?>
                                             <div class="alert alert-success"><?=$this->session->flashdata("updateMsg")?></div>
                                            <?php
                                          }
                                         
                                         ?>
                                         <?php echo form_open_multipart("admin/add_product")?>                                       
                                            <div class="row">
                                            <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <select name="category" class="form-select" onchange="get_categories(this.value)" id="floatingSelectGrid" aria-label="Floating label select example">
                                                           <option value="">select</option>
                                                            <?php
                                                             $this->db->select("*");
                                                             $this->db->from("ec_category");
                                                             $this->db->where("status",0);
                                                             $this->db->where("parent_id",'');
                                                             foreach($this->db->get()->result() as $row){
                                                                ?>
                                                                  <option value="<?=$row->category_id?>"><?=$row->category_name?></option>
                                                                <?php
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
                                                           <option value="">select</option>
                                                             
                                                         </select>
                                                         
                                                        <label for="floatingSelectGrid">Sub Category</label>
                                                    </div>
                                                    <?=form_error("sub_category")?>
                                                </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="number" class="form-control" name="p_id" value="<?=set_value('',$p_id)?>" id="floatingFirstnameInput" >
                                                         
                                                        <label for="floatingFirstnameInput">Product ID</label>
                                                    </div>
                                                    <?=form_error("p_id")?>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="product_name" id="floatingFirstnameInput" >
                                                         
                                                        <label for="floatingFirstnameInput">Product Name</label>
                                                    </div>
                                                    <?=form_error("product_name")?>
                                                </div>
                                            </div> 
                                            <div class="row">
                                            <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="product_mrp" id="floatingFirstnameInput" >
                                                         
                                                        <label for="floatingFirstnameInput">Product MRP</label>
                                                    </div>
                                                    <?=form_error("product_mrp")?>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="product_selling_price" id="floatingFirstnameInput" >
                                                         
                                                        <label for="floatingFirstnameInput">Product Selling Price</label>
                                                    </div>
                                                    <?=form_error("product_selling_price")?>
                                                </div>
                                            </div> 
                                            <div class="row">
                                            <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                    <select name="featured" class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
                                                        <option value="">select</option> 
                                                           <option value="1">Deal Of the month</option>
                                                            <option value="2">New Arrival</option>
                                                         </select>
                                                         
                                                        <label for="floatingFirstnameInput">Feature</label>
                                                    </div>
                                                    <?=form_error("featured")?>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea type="text" class="form-control" name="highlights" id="floatingFirstnameInput" ></textarea>
                                                         
                                                        <label for="floatingFirstnameInput">Highlights</label>
                                                    </div>
                                                    <?=form_error("highlights")?>
                                                </div>
                                            </div> 
                                            <div class="row">
                                            <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea type="text" class="form-control" name="description" id="floatingFirstnameInput" ></textarea>
                                                         
                                                        <label for="floatingFirstnameInput">Description</label>
                                                    </div>
                                                    <?=form_error("description")?>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="meta_title" id="floatingFirstnameInput" >
                                                         
                                                        <label for="floatingFirstnameInput">Meta Title</label>
                                                    </div>
                                                    <?=form_error("meta_title")?>
                                                </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea type="text" class="form-control" name="meta_keywords" id="floatingFirstnameInput" ></textarea>
                                                         
                                                        <label for="floatingFirstnameInput">Meta Keyword</label>
                                                    </div>
                                                    <?=form_error("meta_keywords")?>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea type="text" class="form-control" name="meta_description" id="floatingFirstnameInput" ></textarea>
                                                         
                                                        <label for="floatingFirstnameInput">Meta Description</label>
                                                    </div>
                                                    <?=form_error("meta_description")?>
                                                </div>
                                            </div> 
                                            <div class="row">
                                            <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="file" class="form-control" name="product_main_image" id="floatingFirstnameInput" >
                                                         
                                                        <label for="floatingFirstnameInput">Product Main Image</label>
                                                    </div>
                                                    <?=form_error("product_main_image")?>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="file" class="form-control" name="gallery_img" id="floatingFirstnameInput" >
                                                         
                                                        <label for="floatingFirstnameInput">Gallery Image</label>
                                                    </div>
                                                    <?=form_error("gallery_img")?>
                                                </div>
                                            </div> 
                                            <div class="row">
                                            <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                           <select name="status" class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
                                                            <option value="">select</option>
                                                            <option value="0">Active</option>
                                                            <option value="1">Deactive</option>
                                                         </select>
                                                        <label for="floatingFirstnameInput">Status</label>
                                                    </div>
                                                    <?=form_error("status")?>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="number" class="form-control" name="stock" id="floatingFirstnameInput" >
                                                         
                                                        <label for="floatingFirstnameInput">Stock</label>
                                                    </div>
                                                    <?=form_error("stock")?>
                                                </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="brand" id="floatingFirstnameInput" >
                                                         
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
                                        <?=form_close()?>
                                         
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                       <div class="row"><!-- start row--->
                       <div class="col-xl-12">
                           <div class="card">
                            <div class="card-header"><b>All Product Matches</b></div>
                              <div class="table-responsive">
                                    <table class="table align-middle table-nowrap mb-0">
                                      <tbody>
                                        <tr>
                                             <th>Product ID</th>
                                             <th>Product Image</th>
                                             <th>Category</th>
                                             <th>Sub-Category</th>
                                             <th>Product Name</th>
                                             <th>product MRP</th>
                                             <th>Product Selling Price</th>
                                             <th>Product Brand</th>
                                             <th>Featured</th>
                                             <th>Highlights</th>
                                             <th>Description</th>
                                             <th>Meta Title</th>
                                             <th>Meta Keywords</th>
                                             <th>Meta Description</th>
                                             <th>Status</th>
                                             <th>Stock</th>
                                             <th>Edit</th>
                                             <th>Delete</th>
                                          </tr>
                                      </tbody>
                                         <?php
                                          $this->db->select("*");
                                          $this->db->from("ec_product");
                                          foreach($this->db->get()->result() as $row){
                                            ?>
                                            <tr>
                                                <td><?=$row->p_id?></td>
                                                <td><img src="./<?=$row->product_main_image?>" class="img-fluid"></td>
                                                <?php
                                                  $this->db->select("*");
                                                  $this->db->from("ec_category");
                                                  $this->db->where("category_id",$row->category);
                                                  foreach($this->db->get()->result() as $row1){
                                                    ?>
                                                    <td><?=$row1->category_name?></td>
                                                    <?php
                                                  }
                                                ?>
                                                 <?php
                                                  $this->db->select("*");
                                                  $this->db->from("ec_category");
                                                  $this->db->where("category_id",$row->sub_category);
                                                  foreach($this->db->get()->result() as $row2){
                                                    ?>
                                                    <td><?=$row2->category_name?></td>
                                                    <?php
                                                  }
                                                ?>
                                                <td><?=$row->product_name?></td>
                                                <td><?=$row->product_mrp?></td>
                                                <td><?=$row->product_selling_price?></td>
                                                <td><?=$row->brand?></td>
                                                <?php
                                                 if($row->featured==1){
                                                    ?>
                                                    <td>Deal of the month</td>
                                                    <?php
                                                 }
                                                 else if($row->featured==2){
                                                    ?>
                                                     <td>New Arrival</td>
                                                    <?php
                                                 }
                                                ?>
                                                <td><textarea><?=$row->highlights?></textarea></td>
                                                <td><textarea><?=$row->description?></textarea></td>
                                                <td><?=$row->meta_title?></td>
                                                <td><textarea><?=$row->meta_keywords?></textarea></td>
                                                <td><textarea><?=$row->meta_description?></textarea></td>
                                                <?php
                                                 if($row->status==0){
                                                    ?>
                                                    <td><button class="btn btn-success">Active</button></td>
                                                    <?php
                                                 }
                                                 else if($row->status==1){
                                                    ?>
                                                    <td><button class="btn btn-success">Deactive</button></td>
                                                    <?php
                                                 }
                                                ?>
                                                <td><?=$row->stock?></td>
                                                <td><a href="<?=base_url()."admin/edit_product/".$row->product_id?>" style="text-decoration:none"><button class="btn btn-success">Edit</button></a></td>
                                               <td><a href="<?=base_url()."admin/delete_product/".$row->product_id?>" style="text-decoration:none"><i class="fa fa-trash" style="color:red,font-size:20px;"></i></td>
                                            </tr>
                                            <?php
                                          }
                                         ?>
                                      
                                    </table>
                             </div>
                           </div>
                                    </div>
                       </div><!--end row-->
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