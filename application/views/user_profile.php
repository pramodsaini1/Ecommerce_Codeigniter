<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view("includes/main_head");
?>
   <body>
        <?php $this->load->view("includes/main_header.php")?>
       <?php $this->load->view("includes/main_header_area.php")?>
       <?php $this->load->view("includes/main_menu.php")?>
       <main>

<!-- profile area start -->
<section class="profile__area pt-120 pb-120">
    <?php
if(isset($res)){
    foreach($res as $row){
  
    ?>
     <?php
           if($this->session->flashdata("succImage")){
              ?>
               <div class="alert alert-success"><?=$this->session->flashdata("succImage")?></div>
              <?php
           }
           else if($this->session->flashdata("errImage")){
            ?>
             <div class="alert alert-danger"><?=$this->session->flashdata("errImage")?></div>
            <?php
         }
         else if($this->session->flashdata("upImage")){
            ?>
             <div class="alert alert-danger"><?=$this->session->flashdata("upImage")?></div>
            <?php
         }
          ?>
 <div class="container">
    <div class="profile__inner p-relative">
       <div class="profile__shape">
          <img class="profile__shape-1" src="assets/img/login/laptop.png" alt="" >
          <img class="profile__shape-2" src="assets/img/login/man.png" alt="" >
          <img class="profile__shape-3" src="assets/img/login/shape-1.png" alt="" >
          <img class="profile__shape-4" src="assets/img/login/shape-2.png" alt="" >
          <img class="profile__shape-5" src="assets/img/login/shape-3.png" alt="" >
          <img class="profile__shape-6" src="assets/img/login/shape-4.png" alt="" >
       </div>
       <div class="row">
          <div class="col-xxl-4 col-lg-4">
             <div class="profile__tab mr-40">
                <nav>
                   <div class="nav nav-tabs tp-tab-menu flex-column" id="profile-tab" role="tablist">
                      <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><span><i class="fa-regular fa-user-pen"></i></span>Profile</button>
                      <button class="nav-link" id="nav-information-tab" data-bs-toggle="tab" data-bs-target="#nav-information" type="button" role="tab" aria-controls="nav-information" aria-selected="false"><span><i class="fa-regular fa-circle-info"></i></span> Information</button>
                      <button class="nav-link" id="nav-address-tab" data-bs-toggle="tab" data-bs-target="#nav-address" type="button" role="tab" aria-controls="nav-address" aria-selected="false"><span><i class="fa-light fa-location-dot"></i></span> Address </button>
                      <button class="nav-link" id="nav-order-tab" data-bs-toggle="tab" data-bs-target="#nav-order" type="button" role="tab" aria-controls="nav-order" aria-selected="false"><span><i class="fa-light fa-clipboard-list-check"></i></span> My Orders </button>
                      <button class="nav-link" id="nav-notification-tab" data-bs-toggle="tab" data-bs-target="#nav-notification" type="button" role="tab" aria-controls="nav-notification" aria-selected="false"><span><i class="fa-regular fa-bell"></i></span> Notification</button>
                      <button class="nav-link" id="nav-password-tab" data-bs-toggle="tab" data-bs-target="#nav-password" type="button" role="tab" aria-controls="nav-password" aria-selected="false"><span><i class="fa-regular fa-lock"></i></span> Change Password</button>
                      <span id="marker-vertical" class="tp-tab-line d-none d-sm-inline-block"></span>
                   </div>
                </nav>
             </div>
          </div>
          
          <div class="col-xxl-8 col-lg-8">
             <div class="profile__tab-content">
                <div class="tab-content" id="profile-tabContent">
                   <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                      <div class="profile__main">
                        <?=form_open_multipart("Dashboard/update_user_image")?>
                         <div class="profile__main-top pb-80">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                  <div class="profile__main-inner d-flex flex-wrap align-items-center">
                                     <div class="profile__main-thumb">
                                        <img src="<?=base_url()?>./<?=$row->user_image?>" alt="">
                                        <div class="profile__main-thumb-edit">
                                           <input id="profile-thumb-input" class="profile-img-popup" name="user_image" type="file">
                                           <label for="profile-thumb-input"><i class="fa-light fa-camera"></i></label>
                                        </div>
                                        <?=form_error("user_image")?>
                                     </div>
                                     <div class="profile__main-content">
                                        <h4>Welcome <?=$row->username?></h4>
                                      </div>
                                  </div>
                                  <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Upload New Photo</button>
                                  </div>
                               </div>
                                <div class="col-md-6">
                                  <div class="profile__main-logout text-sm-end">
                                     <a href="<?=base_url()."Dashboard/logout"?>" class="tp-logout-btn">Logout</a>
                                  </div>
                               </div>
                            </div>
                         </div>
                         <?=form_close()?>
                         <div class="profile__main-info">
                            <div class="row gx-3">
                                
                               <div class="col-md-3 col-sm-6">
                                  <div class="profile__main-info-item">
                                     <div class="profile__main-info-icon">
                                        <span>
                                          <?php
                                          $user_id=$this->session->userdata("login_id");
                                           $total_order=0;
                                             
                                          ?>
                                           <span class="profile-icon-count profile-order"><?=$total_order?></span>
                                          <svg viewBox="0 0 512 512"><path d="M472.916,224H448.007a24.534,24.534,0,0,0-23.417-18H398V140.976a6.86,6.86,0,0,0-3.346-6.062L207.077,26.572a6.927,6.927,0,0,0-6.962,0L12.48,134.914A6.981,6.981,0,0,0,9,140.976V357.661a7,7,0,0,0,3.5,6.062L200.154,472.065a7,7,0,0,0,3.5.938,7.361,7.361,0,0,0,3.6-.938L306,415.108v41.174A29.642,29.642,0,0,0,335.891,486H472.916A29.807,29.807,0,0,0,503,456.282v-202.1A30.2,30.2,0,0,0,472.916,224Zm-48.077-4A10.161,10.161,0,0,1,435,230.161v.678A10.161,10.161,0,0,1,424.839,241H384.161A10.161,10.161,0,0,1,374,230.839v-.678A10.161,10.161,0,0,1,384.161,220ZM203.654,40.717l77.974,45.018L107.986,185.987,30.013,140.969ZM197,453.878,23,353.619V153.085L197,253.344Zm6.654-212.658-81.668-47.151L295.628,93.818,377.3,140.969ZM306,254.182V398.943l-95,54.935V253.344L384,153.085V206h.217A24.533,24.533,0,0,0,360.8,224H335.891A30.037,30.037,0,0,0,306,254.182Zm183,202.1A15.793,15.793,0,0,1,472.916,472H335.891A15.628,15.628,0,0,1,320,456.282v-202.1A16.022,16.022,0,0,1,335.891,238h25.182a23.944,23.944,0,0,0,23.144,17H424.59a23.942,23.942,0,0,0,23.143-17h25.183A16.186,16.186,0,0,1,489,254.182Z"/><path d="M343.949,325h7.327a7,7,0,1,0,0-14H351V292h19.307a6.739,6.739,0,0,0,6.655,4.727A7.019,7.019,0,0,0,384,289.743v-4.71A7.093,7.093,0,0,0,376.924,278H343.949A6.985,6.985,0,0,0,337,285.033v32.975A6.95,6.95,0,0,0,343.949,325Z"/><path d="M344,389h33a7,7,0,0,0,7-7V349a7,7,0,0,0-7-7H344a7,7,0,0,0-7,7v33A7,7,0,0,0,344,389Zm7-33h19v19H351Z"/><path d="M351.277,439H351V420h18.929a7.037,7.037,0,0,0,14.071.014v-6.745A7.3,7.3,0,0,0,376.924,406H343.949A7.191,7.191,0,0,0,337,413.269v32.975A6.752,6.752,0,0,0,343.949,453h7.328a7,7,0,1,0,0-14Z"/><path d="M393.041,286.592l-20.5,20.5-6.236-6.237a7,7,0,1,0-9.9,9.9l11.187,11.186a7,7,0,0,0,9.9,0l25.452-25.452a7,7,0,0,0-9.9-9.9Z"/><path d="M393.041,415.841l-20.5,20.5-6.236-6.237a7,7,0,1,0-9.9,9.9l11.187,11.186a7,7,0,0,0,9.9,0l25.452-25.452a7,7,0,0,0-9.9-9.9Z"/><path d="M464.857,295H420.891a7,7,0,0,0,0,14h43.966a7,7,0,0,0,0-14Z"/><path d="M464.857,359H420.891a7,7,0,0,0,0,14h43.966a7,7,0,0,0,0-14Z"/><path d="M464.857,423H420.891a7,7,0,0,0,0,14h43.966a7,7,0,0,0,0-14Z"/></svg>
                                        </span>
                                     </div>
                                     <h4 class="profile__main-info-title">Orders</h4>
                                  </div>
                               </div>
                               <div class="col-md-3 col-sm-6">
                                  <div class="profile__main-info-item">
                                     <div class="profile__main-info-icon">
                                        <span>
                                          <?php
                                           
                                              $count=0;
                                              $this->db->select("count(*) AS count");
                                              $this->db->from("ec_wishlist");
                                              $this->db->where("user_id",$user_id);
                                              $count=$this->db->get()->row()->count;
                                          ?>
                                           <span class="profile-icon-count profile-wishlist"><?=$count?></span>
                                           <svg viewBox="0 -20 480 480" xmlns="http://www.w3.org/2000/svg"><path d="m348 0c-43 .0664062-83.28125 21.039062-108 56.222656-24.71875-35.183594-65-56.1562498-108-56.222656-70.320312 0-132 65.425781-132 140 0 72.679688 41.039062 147.535156 118.6875 216.480469 35.976562 31.882812 75.441406 59.597656 117.640625 82.625 2.304687 1.1875 5.039063 1.1875 7.34375 0 42.183594-23.027344 81.636719-50.746094 117.601563-82.625 77.6875-68.945313 118.726562-143.800781 118.726562-216.480469 0-74.574219-61.679688-140-132-140zm-108 422.902344c-29.382812-16.214844-224-129.496094-224-282.902344 0-66.054688 54.199219-124 116-124 41.867188.074219 80.460938 22.660156 101.03125 59.128906 1.539062 2.351563 4.160156 3.765625 6.96875 3.765625s5.429688-1.414062 6.96875-3.765625c20.570312-36.46875 59.164062-59.054687 101.03125-59.128906 61.800781 0 116 57.945312 116 124 0 153.40625-194.617188 266.6875-224 282.902344zm0 0"/></svg>
                                        </span>
                                     </div>
                                     <h4 class="profile__main-info-title">Wishlist</h4>
                                  </div>
                               </div>
                               
                            </div>
                         </div>
                      </div>
                   </div>
                    <div class="tab-pane fade" id="nav-information" role="tabpanel" aria-labelledby="nav-information-tab">
                        <?=form_open("Dashboard/update_user_details")?>
                      <div class="profile__info">
                         <h3 class="profile__info-title">Personal Details</h3>
                         <div class="profile__info-content">
                            <form action="#">
                               <div class="row">
                                  <div class="col-xxl-6 col-md-6">
                                     <div class="profile__input-box">
                                        <div class="profile__input">
                                            <input type="text" name="username" placeholder="Enter your username" value="<?=$row->username?>">
                                           <span>
                                              <svg width="17" height="19" viewBox="0 0 17 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                 <path d="M9 9C11.2091 9 13 7.20914 13 5C13 2.79086 11.2091 1 9 1C6.79086 1 5 2.79086 5 5C5 7.20914 6.79086 9 9 9Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                 <path d="M15.5 17.6C15.5 14.504 12.3626 12 8.5 12C4.63737 12 1.5 14.504 1.5 17.6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                              </svg>
                                           </span>
                                        </div>
                                     </div>
                                     <?=form_error("username")?>
                                  </div>
                                  
                                  <div class="col-xxl-6 col-md-6">
                                     <div class="profile__input-box">
                                        <div class="profile__input">
                                            <input type="email" name="email" placeholder="Enter your email" value="<?=$row->email?>">
                                           <span>
                                              <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                 <path d="M13 14.6H5C2.6 14.6 1 13.4 1 10.6V5C1 2.2 2.6 1 5 1H13C15.4 1 17 2.2 17 5V10.6C17 13.4 15.4 14.6 13 14.6Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                 <path d="M13 5.3999L10.496 7.3999C9.672 8.0559 8.32 8.0559 7.496 7.3999L5 5.3999" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                              </svg>                                             
                                           </span>
                                        </div>
                                     </div>
                                     <?=form_error("email")?>
                                  </div>
                                   
                                  <div class="col-xxl-6 col-md-6">
                                     <div class="profile__input-box">
                                        <div class="profile__input">
                                            <input type="text" name="phone" placeholder="Enter your Phone" value="<?=$row->phone?>">
                                           <span>
                                              <svg width="15" height="18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                 <path d="M13.9148 5V13C13.9148 16.2 13.1076 17 9.87892 17H5.03587C1.80717 17 1 16.2 1 13V5C1 1.8 1.80717 1 5.03587 1H9.87892C13.1076 1 13.9148 1.8 13.9148 5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                 <path opacity="0.4" d="M9.08026 3.80054H5.85156" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                 <path opacity="0.4" d="M7.45425 14.6795C8.14522 14.6795 8.70537 14.1243 8.70537 13.4395C8.70537 12.7546 8.14522 12.1995 7.45425 12.1995C6.76327 12.1995 6.20312 12.7546 6.20312 13.4395C6.20312 14.1243 6.76327 14.6795 7.45425 14.6795Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                              </svg>                                                                                        
                                           </span>
                                        </div>
                                     </div>
                                     <?=form_error("phone")?>
                                  </div>
                                   
                                   
                                  <div class="col-xxl-12">
                                     <div class="profile__btn">
                                        <button type="submit" class="tp-btn">Update Profile</button>
                                     </div>
                                  </div>
                               </div>
                            </form>
                         </div>
                      </div>
                      <?=form_close()?>
                   </div>
                    <div class="tab-pane fade" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
                        <?=form_open("Dashboard/change_password")?>
                      <div class="profile__password">
                         <form action="#">
                            <div class="row">
                               <div class="col-xxl-12">
                                  <div class="tp-profile-input-box">
                                     <div class="tp-contact-input">
                                        <input name="old_pass" id="old_pass" type="password">
                                     </div>
                                     <div class="tp-profile-input-title">
                                        <label for="old_pass">Old Password</label>
                                     </div>
                                     
                                  </div>
                               </div>
                               <div class="col-xxl-6 col-md-6">
                                  <div class="tp-profile-input-box">
                                     <div class="tp-profile-input">
                                        <input name="new_pass" id="new_pass" type="password">
                                     </div>
                                     <div class="tp-profile-input-title">
                                        <label for="new_pass">New Password</label>
                                     </div>
                                  </div>
                               </div>
                               <div class="col-xxl-6 col-md-6">
                                  <div class="tp-profile-input-box">
                                     <div class="tp-profile-input">
                                        <input name="con_new_pass" id="con_new_pass" type="password">
                                     </div>
                                     <div class="tp-profile-input-title">
                                        <label for="con_new_pass">Confirm Password</label>
                                     </div>
                                  </div>
                               </div>
                               <div class="col-xxl-6 col-md-6">
                                  <div class="profile__btn">
                                     <button type="submit" class="tp-btn">Update</button>
                                  </div>
                               </div>
                            </div>
                         </form>
                      </div>
                      <?=form_close()?>
                   </div>
                   <div class="tab-pane fade" id="nav-address" role="tabpanel" aria-labelledby="nav-address-tab">
                      <div class="profile__address">
                         <div class="row">
                            <div class="col-md-6">
                               <div class="profile__address-item d-sm-flex align-items-start">
                                  <div class="profile__address-icon">
                                     <span>
                                        <svg enable-background="new 0 0 32 32" viewBox="0 0 32 32" ><g><path d="m31.494 23.128-.959-.844v-3.708c0-1.315-1.067-2.382-2.382-2.382-1.144 0-2.126.813-2.34 1.937l-.821-.721c-.954-.835-2.378-.835-3.332 0l-6.5 5.717c-.307.276-.332.748-.057 1.055.262.292.704.331 1.014.091v5.326c.001 1.187.963 2.149 2.15 2.15h10.119c1.187-.001 2.148-.963 2.149-2.15v-5.326c.323.257.793.204 1.05-.119.248-.311.208-.763-.091-1.026zm-4.227-4.552c-.016-.488.366-.897.854-.913s.897.366.913.854c.001.02.001.04 0 .059v2.389l-1.767-1.554zm-2.625 11.671h-2.5v-1.748c.001-.613.497-1.109 1.11-1.11h.285c.613.001 1.109.497 1.11 1.11zm4.393-.648c0 .171-.068.336-.189.457h-.004c-.122.123-.287.191-.46.191h-2.24v-1.748c-.002-1.441-1.169-2.608-2.61-2.61h-.285c-1.441.002-2.608 1.169-2.61 2.61v1.746h-2.373c-.359-.001-.649-.291-.65-.65v-6.63l5.035-4.428c.387-.339.965-.339 1.352 0l5.034 4.426z"/><path d="m21.106 22.318c0 1.226.993 2.219 2.219 2.219s2.219-.994 2.219-2.219v-.001c-.002-1.225-.994-2.217-2.219-2.218-1.226 0-2.219.993-2.219 2.219zm2.938-.001c-.002.396-.323.716-.719.717v.002c-.397 0-.719-.322-.719-.719s.322-.719.719-.719.719.322.719.719z"/><path d="m23.001 10.145c0-.414-.336-.75-.75-.75h-15.462c-.414 0-.75.336-.75.75s.336.75.75.75h15.463c.414-.001.749-.336.749-.75z"/><path d="m6.789 14.216c-.414 0-.75.336-.75.75s.336.75.75.75h10.572c.414 0 .75-.336.75-.75s-.336-.75-.75-.75z"/><path d="m12.075 19.039h-5.286c-.414 0-.75.336-.75.75s.336.75.75.75h5.286c.414 0 .75-.336.75-.75s-.336-.75-.75-.75z"/><path d="m11.556 30.247h-9.03c-.427-.001-.772-.346-.773-.773v-25.653c.001-.27.142-.52.372-.661l2.11-1.283c.268-.164.609-.148.862.039l1.404 1.037c.749.558 1.764.598 2.554.1l1.9-1.183c.26-.163.593-.156.846.018l1.629 1.111c.766.527 1.776.532 2.547.013l1.692-1.133c.255-.171.587-.175.846-.009l1.836 1.171c.783.504 1.796.476 2.55-.072l1.425-1.027c.265-.191.622-.195.891-.01l1.736 1.2c.21.144.335.382.335.637v8.089c0 .414.336.75.75.75s.75-.336.75-.75v-8.093c-.001-.748-.37-1.449-.987-1.872l-1.733-1.194c-.792-.544-1.839-.532-2.619.028l-1.425 1.025c-.256.186-.6.196-.867.025l-1.836-1.17c-.761-.485-1.736-.474-2.486.028l-1.692 1.133c-.262.177-.606.177-.868 0l-1.63-1.119c-.746-.509-1.722-.529-2.488-.05l-1.896 1.181c-.269.169-.614.155-.868-.034l-1.406-1.037c-.742-.55-1.744-.593-2.531-.11l-2.11 1.279c-.677.414-1.09 1.15-1.093 1.943v25.653c.001 1.255 1.018 2.272 2.273 2.273h9.03c.414 0 .75-.336.75-.75s-.336-.75-.75-.75z"/></g></svg>
                                     </span>
                                  </div>
                                  <div class="profile__address-content">
                                     <h3 class="profile__address-title">Billing Address</h3>
                                     <p><span>Street:</span>3576 Glen Street</p>
                                     <p><span>City:</span>Summer Shade</p>
                                     <p><span>State/province/area:</span>Kentucky</p>
                                     <p><span>Phone number:</span>270-428-8378</p>
                                     <p><span>Zip code:</span>42166</p>
                                     <p><span>Country calling code:</span> +1</p>
                                     <p><span>Country:</span>United States</p>
                                  </div>
                               </div>
                            </div>
                            <div class="col-md-6">
                               <div class="profile__address-item d-sm-flex align-items-start">
                                  <div class="profile__address-icon">
                                     <span>
                                        <svg viewBox="0 0 64 64"><g id="ad"><g><path d="m50 49c-1.654 0-3 1.346-3 3s1.346 3 3 3 3-1.346 3-3-1.346-3-3-3zm0 4c-.551 0-1-.448-1-1s.449-1 1-1 1 .448 1 1-.449 1-1 1z"/><path d="m13 55c1.654 0 3-1.346 3-3s-1.346-3-3-3-3 1.346-3 3 1.346 3 3 3zm0-4c.551 0 1 .448 1 1s-.449 1-1 1-1-.448-1-1 .449-1 1-1z"/><path d="m62 47.278v-8.653c0-.612-.184-1.203-.533-1.708l-7.452-10.763c-.933-1.349-2.47-2.154-4.111-2.154h-7.61l1.742-3.049c1.285-1.731 1.963-3.788 1.963-5.951 0-5.514-4.486-10-10-10-1.791 0-3.547.479-5.081 1.385-.476.281-.633.895-.352 1.37s.893.632 1.37.353c1.225-.725 2.63-1.107 4.063-1.107 4.411 0 8 3.589 8 8 0 1.748-.554 3.408-1.601 4.802-.025.033-.048.068-.069.104l-6.331 11.078-6.33-11.077c-.021-.036-.044-.071-.069-.104-1.047-1.394-1.601-3.055-1.601-4.803 0-1.897.676-3.736 1.902-5.179.358-.42.307-1.052-.114-1.409-.421-.358-1.052-.308-1.41.114-1.534 1.803-2.379 4.103-2.379 6.474 0 1.781.467 3.486 1.346 5h-23.343c-1.654 0-3 1.346-3 3v27c0 1.654 1.346 3 3 3h2.08c.488 3.386 3.401 6 6.92 6s6.432-2.614 6.92-6h9.223c.552 0 1-.447 1-1s-.448-1-1-1h-9.223c-.488-3.386-3.401-6-6.92-6s-6.432 2.614-6.92 6h-2.08c-.551 0-1-.448-1-1v-9h26c.552 0 1-.447 1-1s-.448-1-1-1h-26v-16.001c0-.552.449-1 1-1h24.563l6.569 11.496c.178.312.509.504.868.504s.69-.192.868-.504l1.132-1.981v7.485h-5c-.552 0-1 .447-1 1s.448 1 1 1h5v10h-5.5c-.552 0-1 .447-1 1s.448 1 1 1h10.58c.488 3.386 3.401 6 6.92 6s6.432-2.614 6.92-6h4.08c1.103 0 2-.897 2-2v-2c0-.737-.405-1.375-1-1.722zm-49-.278c2.757 0 5 2.243 5 5s-2.243 5-5 5-5-2.243-5-5 2.243-5 5-5zm46.784-9h-15.784v-8h10.245zm-18.632-12h8.753c.984 0 1.906.483 2.466 1.293l.49.707h-8.86c-1.103 0-2 .897-2 2v8c0 1.103.897 2 2 2h16v7h-5.111c-1.263-1.235-2.988-2-4.889-2s-3.627.765-4.889 2h-5.111v-18.985l1.152-2.015zm-1.152 23h3.685c-.297.622-.503 1.294-.605 2h-3.08zm10 8c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5zm11-6h-4.08c-.102-.706-.308-1.378-.605-2h4.685z"/><path d="m36 21c3.309 0 6-2.691 6-6s-2.691-6-6-6-6 2.691-6 6 2.691 6 6 6zm0-10c2.206 0 4 1.794 4 4s-1.794 4-4 4-4-1.794-4-4 1.794-4 4-4z"/><path d="m43 43h4c.552 0 1-.447 1-1s-.448-1-1-1h-4c-.552 0-1 .447-1 1s.448 1 1 1z"/></g></g></svg>
                                     </span>
                                  </div>
                                  <div class="profile__address-content">
                                     <h3 class="profile__address-title">Shipping Address</h3>
                                     <p><span>Street:</span>3133 Lewis Street</p>
                                     <p><span>City:</span>Naperville</p>
                                     <p><span>State/province/area:</span>Illinois</p>
                                     <p><span>Phone number:</span>630-857-9127</p>
                                     <p><span>Zip code:</span> 60563</p>
                                     <p><span>Country calling code:</span>+1</p>
                                     <p><span>Country:</span>United States</p>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                   <div class="tab-pane fade" id="nav-order" role="tabpanel" aria-labelledby="nav-order-tab">
                      <div class="profile__ticket table-responsive">
                         <table class="table">
                            <thead>
                               <tr>
                                  <th scope="col">Order Id</th>
                                  <th scope="col">Product Title</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">View</th>
                               </tr>
                            </thead>
                            <tbody>
                               <tr>
                                  <th scope="row"> #2245</th>
                                  <td data-info="title">How can i share ?</td>
                                  <td data-info="status pending">Pending </td>
                                  <td><a href="#" class="tp-logout-btn">Invoice</a></td>
                               </tr>
                               <tr>
                                  <th scope="row"> #2220</th>
                                  <td data-info="title">Send money, but not working</td>
                                  <td data-info="status reply">Need your replay</td>
                                  <td><a href="#" class="tp-logout-btn">Reply</a></td>
                               </tr>
                               <tr>
                                  <th scope="row"> #2125</th>
                                  <td data-info="title">Balance error</td>
                                  <td data-info="status done">Resolved</td>
                                  <td><a href="#" class="tp-logout-btn">Invoice</a></td>
                               </tr>
                               <tr>
                                  <th scope="row"> #2124</th>
                                  <td  data-info="title">How to decline bid</td>
                                  <td data-info="status hold">On Hold</td>
                                  <td><a href="#" class="tp-logout-btn">Status</a></td>
                               </tr>
                               <tr>
                                  <th scope="row"> #2121</th>
                                  <td data-info="title">How to contact</td>
                                  <td data-info="status done">Resolved</td>
                                  <td><a href="#" class="tp-logout-btn">Invoice</a></td>
                               </tr>
                            </tbody>
                         </table>
                      </div>
                   </div>
                   <div class="tab-pane fade" id="nav-notification" role="tabpanel" aria-labelledby="nav-notification-tab">
                      <div class="profile__notification">
                         <div class="profile__notification-top mb-30">
                            <h3 class="profile__notification-title">My activity settings</h3>
                            <p>Stay up to date with notification on activity that involves you including mentions, messages, replies to your bids, new items, sale and administrative updates </p>
                         </div>
                         <div class="profile__notification-wrapper">
                            <div class="profile__notification-item mb-20">
                               <div class="form-check form-switch d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox" role="switch" id="like" checked>
                                  <label class="form-check-label" for="like">Like & Follows Notifications</label>
                               </div>
                            </div>
                            <div class="profile__notification-item mb-20">
                               <div class="form-check form-switch d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox" role="switch" id="post" checked>
                                  <label class="form-check-label" for="post">Post, Comments & Replies Notifications</label>
                               </div>
                            </div>
                            <div class="profile__notification-item mb-20">
                               <div class="form-check form-switch d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox" role="switch" id="new" checked>
                                  <label class="form-check-label" for="new">New Product Notifications</label>
                               </div>
                            </div>
                            <div class="profile__notification-item mb-20">
                               <div class="form-check form-switch d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox" role="switch" id="sale" checked>
                                  <label class="form-check-label" for="sale">Product on sale Notifications</label>
                               </div>
                            </div>
                            <div class="profile__notification-item mb-20">
                               <div class="form-check form-switch d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox" role="switch" id="payment" checked>
                                  <label class="form-check-label" for="payment">Payment Notifications</label>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
 <?php
        
    }
}
?>
</section>
<!-- profile area end -->

</main>

       <?php $this->load->view("includes/main_footer.php")?>