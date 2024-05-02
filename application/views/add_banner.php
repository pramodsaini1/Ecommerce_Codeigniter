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
                                        <h5 class="card-title">Add Banner</h5>
                                         <?php
                                          if($this->session->flashdata("succMsg")){
                                            ?>
                                             <div class="alert alert-success"><?=$this->session->flashdata("succMsg")?></div>
                                            <?php
                                          }
                                         
                                         ?>
                                         <?php echo form_open_multipart("admin/add_banner")?>                                       
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="file" name="banner_img" class="form-control">
                                                         
                                                        <label for="floatingBannerImageInput">Banner Image</label>
                                                    </div>
                                                    <?=form_error("banner_img")?>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <select name="status" class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
                                                           <option value="">select</option>
                                                            <option value="0">Active</option>
                                                            <option value="1">Deactive</option>
                                                         </select>
                                                         
                                                        <label for="floatingSelectGrid">Status</label>
                                                    </div>
                                                    <?=form_error("status")?>
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
                            <div class="card-header"><b>All Banner Matches</b></div>
                              <div class="table-responsive">
                                    <table class="table align-middle table-nowrap mb-0">
                                      <tbody>
                                        <tr>
                                            <th>Banner image</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                          </tr>
                                      </tbody>
                                      <?php
                                          $this->db->select("*");
                                          $this->db->from("ec_banner");
                                             foreach($this->db->get()->result() as $row){
                                                ?>
                                                <tr>
                                                    <td><img src="./<?=$row->banner_img?>" style="width:300px" class="img-fluid"></td>
                                                     <?php
                                                      if($row->status==0){
                                                        ?>
                                                          <td><button class="btn btn-success">Active</button></td>
                                                        <?php
                                                      }
                                                      else{
                                                        ?>
                                                        <td><button class="btn btn-success">Deactive</td></td>
                                                      <?php
                                                      }
                                                     ?>
                                                     <td><a  style="text-decoration:none;" href="<?=base_url()."admin/banner/".$row->banner_id?>"><i  style="color:blue;font-size:20px;cursor:pointer" class="fa fa-edit"></a></td>
                                                     <td><a style="text-decoration:none;" href="<?=base_url()."admin/delete_banner/".$row->banner_id?>"><i  style="color:blue;font-size:20px;cursor:pointer" class="fa fa-trash"></i></a></td>
                                                     </tr>
                                                <?php
                                            }
                                        
                                      ?>
                                      <tr>

                                      </tr>
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
         
    </body>


<!-- Mirrored from themesdesign.in/tocly/layouts/5.3.1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Nov 2023 08:52:54 GMT -->
</html>