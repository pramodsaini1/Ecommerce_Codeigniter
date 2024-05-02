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
                                        <h5 class="card-title">Add Category</h5>
                                         <?php
                                          if($this->session->flashdata("succMsg")){
                                            ?>
                                             <div class="alert alert-success"><?=$this->session->flashdata("succMsg")?></div>
                                            <?php
                                          } 
                                         else if($this->session->flashdata("updateCategory")){
                                            ?>
                                             <div class="alert alert-success"><?=$this->session->flashdata("updateCategory")?></div>
                                            <?php
                                          }
                                          if(isset($rep)){
                                            foreach($rep as $rec){

                                           
                                             ?>
                                              <?=form_open_multipart("admin/update_category_img/".$rec->category_id)?>                                       
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                      <img src="./<?=$rec->category_img?>" class="img-fluid">                                                         
                                                     </div>
                                                 </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                         <input type="file" name="category_img" class="form-control">
                                                         
                                                        <label for="floatingSelectGrid">Category Image</label>
                                                    </div>
                                                    <?=form_error("category_img" )?>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <?=form_close()?>
                                             <?php
                                               }
                                          }
                                          else{

                                         
                                         ?>

                                         <?=form_open_multipart("admin/add_category")?>                                       
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="category_name" id="floatingFirstnameInput">
                                                         
                                                        <label for="floatingFirstnameInput">Category Name</label>
                                                    </div>
                                                    <?=form_error("category_name")?>
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
                                                    <?=form_error("status" )?>
                                                </div>
                                            </div>
                                              <div class="row">
                                              <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <select name="parent_id" class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
                                                           
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
                                                         
                                                        <label for="floatingSelectGrid">Parent Category</label>
                                                    </div>
                                                    <?=form_error("parent_id" )?>
                                                </div>
                                                <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                <input type="file" class="form-control" name="category_img" id="floatingFirstnameInput" >
                                                         
                                                         <label for="floatingFirstnameInput">Category Image</label>
                                                </div>
                                                <?=form_error("category_img") ?>
                                                
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
                                        <?php
                                                }
                                                ?>
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
                            <div class="card-header"><b>All Category Matches</b></div>
                              <div class="table-responsive">
                                    <table class="table align-middle table-nowrap mb-0">
                                      <tbody>
                                        <tr>
                                            <th>Category Name</th>
                                            <th>Category Image</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                          </tr>
                                      </tbody>
                                      <?php
                                          $this->db->select("*");
                                          $this->db->from("ec_category");
                                             foreach($this->db->get()->result() as $row){
                                                ?>
                                                <tr>
                                                    <td id="d-<?=$row->category_id?>"><?=$row->category_name?></td>
                                                    <td><a href="<?=base_url()."admin/edit_category_img/".$row->category_id?>"><img src="./<?=$row->category_img?>" class="img-fluid"></a></td>
                                                     <?php
                                                      if($row->status==0){
                                                        ?>
                                                          <td><button class="btn btn-success" rel="<?=$row->category_id?>" id="r-<?=$row->category_id?>">Deactive</button></td>
                                                        <?php
                                                      }
                                                      else{
                                                        ?>
                                                        <td><button class="btn btn-success" rel="<?=$row->category_id?>" id="r-<?=$row->category_id?>">Active</td></td>
                                                      <?php
                                                      }
                                                     ?>
                                                     <td><i id="<?=$row->category_id?>" style="color:blue;font-size:20px;cursor:pointer" class="fa fa-edit"></td>
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
        <script>
                 $(document).on("click",".fa.fa-edit",function(){
                     var category_id=$(this).attr("id");
                     var category_name=$("#d-"+category_id).text();
                       $("#d-"+category_id).html("<input type='text' id='f-"+category_id+"' value='"+category_name+"'>");
                       $(this).attr("class","fa fa-save");
                       $(this).css("color","blue");
                       
                });
                $(document).on("click",".fa.fa-save",function(){
                   var category_id=$(this).attr("id");
                   var category_name=$("#f-"+category_id).val();
                   $.ajax({
                       url:"<?=base_url()."admin/update_category"?>",
                       type:"POST",
                       data:{category_id:category_id,category_name:category_name},
                       success:function(data){
                           if(data=="success"){
                              $("#d-"+category_id).html(category_name);
                              $("#"+category_id).attr("class","fa fa-edit");
                           }
                       }
                   })
                });
                $(document).on("click",".btn.btn-success",function(){
                  var category_id=$(this).attr("rel");
                   $.ajax({
                      url:"<?=base_url()."admin/update_category_status"?>",
                      type:"POST",
                      data:{category_id:category_id},
                      success:function(data){
                           if(data=="active"){
                            document.getElementById("r-"+category_id).innerHTML="Deactive";
                          }
                          else if(data=="deactive"){
                            document.getElementById("r-"+category_id).innerHTML="Active";
                          }
                      }
                   });
                });
            
            
        </script>
    </body>


<!-- Mirrored from themesdesign.in/tocly/layouts/5.3.1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Nov 2023 08:52:54 GMT -->
</html>