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
                                        <h5 class="card-title">Edit Banner</h5>
                                         <?php
                                          if($this->session->flashdata("succMsg")){
                                            ?>
                                             <div class="alert alert-success"><?=$this->session->flashdata("succMsg")?></div>
                                            <?php
                                          }
                                          $banner_id=$this->uri->segment(3);
                                          $banner_img="";
                                          $banner_status=0;
                                          $this->db->select("*");
                                          $this->db->from("ec_banner");
                                          $this->db->where("banner_id",$banner_id);
                                          foreach($this->db->get()->result() as $row){
                                            $banner_img=$row->banner_img;
                                            $banner_status=$row->status;
                                          }
                                         ?>
                                                                         
                                            <div class="row">
                                                <div class="col-md-2"></div>
                                                 <div class="col-md-8">
                                                     <div class="form-floating mb-3">
                                                         <img src="./<?=$banner_img?>" class="img-fluid" >
                                                        </div>
                                                 </div>  
                                                 <div class="col-md-2"></div>   
                                            </div>
                                            <?=form_open_multipart("admin/edit_banner/".$banner_id)?>
                                             <div class="row">
                                             <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="file" name="banner_img" class="form-control">
                                                        <?=form_error("banner_img")?>
                                                        <label for="floatingBannerImageInput">Edit Image</label>
                                                         
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <select name="status" class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
                                                             <?php
                                                               if($banner_status==0){
                                                                ?>
                                                                 <option value="0">Active</option>
                                                                <?php
                                                               }
                                                               else{
                                                                ?>
                                                                  <option value="1">Deactive</option>
                                                                <?php
                                                               }
                                                             ?>
                                                           <option value="0">Active</option>
                                                            <option value="1">Deactive</option>
                                                         </select>
                                                         <label for="floatingSelectGrid">Status</label>
                                                        
                                                    </div>
                                                     
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
                                                <button type="submit" class="btn btn-primary w-md">UPDATE BANNER</button>
                                            </div>
                                        <?=form_close()?>
                                        <?php
                                           ?>
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
         
    </body>


<!-- Mirrored from themesdesign.in/tocly/layouts/5.3.1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Nov 2023 08:52:54 GMT -->
</html>