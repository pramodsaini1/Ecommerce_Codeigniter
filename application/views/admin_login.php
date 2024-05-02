<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view("includes/header");
?>
 
    <body>
        <div class="auth-maintenance d-flex align-items-center min-vh-100">
            <div class="bg-overlay bg-light"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="auth-full-page-content d-flex min-vh-100 py-sm-5 py-4">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100 py-0 py-xl-3">
                                     
    
                                    <div class="card my-auto overflow-hidden">
                                            <div class="row g-0">
                                                <div class="col-lg-6">
                                                    <div class="bg-overlay bg-primary"></div>
                                                    <div class="h-100 bg-auth align-items-end">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="p-lg-5 p-4">
                                                        <div>
                                                            <div class="text-center mt-1">
                                                                <h4 class="font-size-18">Welcome Back !</h4>
                                                                <p class="text-muted">Sign in to continue to Dashboard.</p>
                                                            </div>
                                                               <?=form_open("admin/login")?>
                                                                 <div class="mb-2">
                                                                    <label for="email" class="form-label">Email</label>
                                                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email-Id">
                                                                    <?=form_error("email")?>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="password-input">Password</label>
                                                                    <input type="password" class="form-control" name="password" placeholder="Enter password">
                                                                    <?=form_error("password")?>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                                                    <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <button class="btn btn-primary w-100" type="submit">Sign In</button>
                                                                </div>
                                                                <div class="mt-4 pt-2 text-center">
                                                                    
                                                                    <div class="pt-2 hstack gap-2 justify-content-center">
                                                                     </div>
                                                                </div>
                                                             <?=form_close()?>
                                                        </div>
                                                    
                                                        <div class="mt-4 text-center">
                                                         </div>
                                                    </div>
                                                </div>  
                                        </div>
                                    </div>
                                    <!-- end card -->
                                    
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
        </div>
        
        <?php $this->load->view("includes/src")?>

    </body>

<!-- Mirrored from themesdesign.in/tocly/layouts/5.3.1/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Nov 2023 08:53:06 GMT -->
</html>
