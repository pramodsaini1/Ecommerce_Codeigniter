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

            <div class="main-content">

               <div class="page-content">
                     <div class="container-fluid">
                     <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">All Users</h4>
                                         
        
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                         <th>User Image</th>
                                                        <th>UserName</th>
                                                        <th>Email</th>
                                                        <th>Password</th>
                                                        <th>Phone</th>
                                                        <th>IP</th>
                                                        <th>Block</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                  <?php
                                                   if(isset($rec)){
                                                      foreach($rec as $row){
                                                        ?>
                                                         <td><img src="<?=base_url()?>./<?=$row->user_image?>" class="img-fluid" style="width:110px;height:110px"></td>
                                                         <td><?=$row->username?></td>
                                                         <td><?=$row->email?></td>
                                                         <td><?=$row->password?></td>
                                                         <td><?=$row->phone?></td>
                                                         <td><?=$row->ip?></td>
                                                         <td><button class="btn btn-info" id="block-<?=$row->user_id?>" rel="<?=$row->user_id?>">Unblock</button></td>
                                                         <td><button class="btn btn-danger" id="delete-<?=$row->user_id?>" rel="<?=$row->user_id?>">Delete</button</td>
                                                        <?php
                                                      
                                                  ?>
                                                  </tr>
                                                  <?php
                                                   }
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                     </div>
                </div>
            </div>



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
                $(document).ready(function(){
                    $(".btn.btn-info").click(function(){
                        var user_id=$(this).attr("rel");
                        $.ajax({
                            url:"<?=base_url()."admin/block_user"?>",
                            type:"POST",
                            data:{user_id:user_id},
                            success:function(data){
                                if(data=="block"){
                                   document.getElementById("block-"+user_id).innerHTML="UnBlock";
                                }
                                else if(data=="unblock"){
                                    document.getElementById("block-"+user_id).innerHTML="Block";
                                }
                            }
                        })
                    })
                })
            </script>
        </body>
    
    
    <!-- Mirrored from themesdesign.in/tocly/layouts/5.3.1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Nov 2023 08:52:54 GMT -->
    </html>