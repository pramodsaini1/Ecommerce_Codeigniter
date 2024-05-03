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
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                             
                                            <div class="flex-grow-1 overflow-hidden ms-4">
                                                <p class="text-muted text-truncate font-size-15 mb-2"> Total Signup</p>
                                                <?php
                                                  $total_signup=0;
                                                  $this->db->select("count(*) AS total_user");
                                                  $this->db->from("ec_users");
                                                  $this->db->where("status",0);
                                                  $total_signup=$this->db->get()->row()->total_user;
                                                ?>
                                                <h3 class="fs-4 flex-grow-1 mb-3"><?=intval($total_signup)?></h3>
                                             </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                             
                                            <div class="flex-grow-1 overflow-hidden ms-4">
                                                <p class="text-muted text-truncate font-size-15 mb-2"> Today Signup</p>
                                                <?php
                                                  $total_signup=0;
                                                  $current_date=date('Y-m-d');
                                                  $this->db->select("count(*) AS today_user");
                                                  $this->db->from("ec_users");
                                                  $this->db->where("status",0);
                                                  $this->db->where("added_on",$current_date);
                                                  $today_signup=$this->db->get()->row()->today_user;
                                                ?>
                                                <h3 class="fs-4 flex-grow-1 mb-3"><?=intval($today_signup)?></h3>
                                             </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                             
                                            <div class="flex-grow-1 overflow-hidden ms-4">
                                                <p class="text-muted text-truncate font-size-15 mb-2"> Total Orders</p>
                                                <?php
                                                  $total_order=0;
                                                   $this->db->select("count(*) AS total_order");
                                                  $this->db->from("ec_order");
                                                  $this->db->where("status",0);
                                                   $total_order=$this->db->get()->row()->total_order;
                                                ?>
                                                <h3 class="fs-4 flex-grow-1 mb-3"><?=intval($total_order)?></h3>
                                             </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                             
                                            <div class="flex-grow-1 overflow-hidden ms-4">
                                                <p class="text-muted text-truncate font-size-15 mb-2"> Total Orders Sum</p>
                                                <?php
                                                  $total_order=0;
                                                   $this->db->select("SUM(product_price) AS total_order");
                                                  $this->db->from("ec_order");
                                                  $this->db->where("status",0);
                                                   $total_order_sum=$this->db->get()->row()->total_order;
                                                ?>
                                                <h3 class="fs-4 flex-grow-1 mb-3"><?=intval($total_order_sum)?></h3>
                                             </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
 
                        </div>
                        <!-- END ROW -->
  

 

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