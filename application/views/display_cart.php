<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view("includes/main_head");
?>
   <body>
        <?php $this->load->view("includes/main_header.php")?>
       <?php $this->load->view("includes/main_header_area.php")?>
       <?php $this->load->view("includes/main_menu.php")?>
       <main>

<!-- breadcrumb area start -->
<section class="breadcrumb__area include-bg pt-95 pb-50">
   <div class="container">
      <div class="row">
         <div class="col-xxl-12">
            <div class="breadcrumb__content p-relative z-index-1">
               <h3 class="breadcrumb__title">Shopping Cart</h3>
               <div class="breadcrumb__list">
                  <span><a href="<?=base_url()."Dashboard/index"?>">Home</a></span>
                </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- breadcrumb area end -->
 
<!-- cart area start -->
<section class="tp-cart-area pb-120">
   <?=form_open("Dashboard/update_cart")?>
   <div class="container">
   <?php
if($this->session->flashdata("cartErr")){
    ?>
<div class="alert alert-danger"><?=$this->session->flashdata("cartErr")?></div>
    <?php
}
else if($this->session->flashdata("succCart")){
    ?>
<div class="alert alert-success"><?=$this->session->flashdata("succCart")?></div>
    <?php
}
else if($this->session->flashdata("upCart")){
   ?>
<div class="alert alert-success"><?=$this->session->flashdata("upCart")?></div>
   <?php
}
else if($this->session->flashdata("notCart")){
   ?>
<div class="alert alert-danger"><?=$this->session->flashdata("notCart")?></div>
   <?php
}
else if($this->session->flashdata("delCart")){
   ?>
<div class="alert alert-success"><?=$this->session->flashdata("delCart")?></div>
   <?php
}
else if($this->session->flashdata("notdelCart")){
   ?>
<div class="alert alert-danger"><?=$this->session->flashdata("notdelCart")?></div>
   <?php
}

?>
      <div class="row">
      <?php
                     if(!empty($rec)){
                        
                         
                    ?>
         <div class="col-xl-9 col-lg-8">
            <div class="tp-cart-list mb-25 mr-30">
               <table class="table">
                  <thead>
                    <tr>
                      <th colspan="2" class="tp-cart-header-product">Product</th>
                      <th class="tp-cart-header-price">Price</th>
                      <th class="tp-cart-header-quantity">Quantity</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php
                        foreach($rec as $row){
                     ?>
                     <input type="text" name="product_id[]" class="tp-cart-input" hidden value="<?=$row->product_id?>">
                     <tr>
                        <!-- img -->
                        <td class="tp-cart-img"><img src="<?=base_url()?>./<?=$row->product_image?>" alt=""></td>
                        <!-- title -->
                        <td class="tp-cart-title"><?=$row->product_name?></td>
                        <!-- price -->
                        <td class="tp-cart-price"><span>₹<?=number_format($row->product_price,2)?></span></td>
                        <!-- quantity -->
                        <td class="tp-cart-quantity">
                           <div class="tp-product-quantity mt-10 mb-10">
                              <span class="tp-cart-minus">
                                 <svg width="10" height="2" viewBox="0 0 10 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 1H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 </svg>                                                             
                              </span>
                              <input class="tp-cart-input" type="text" name="product_quantity[]" value="<?=$row->product_quantity?>">
                              
                              <span class="tp-cart-plus">
                                 <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 1V9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M1 5H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 </svg>
                              </span>
                           </div>
                        </td>
                        <!-- action -->
                        <td class="tp-cart-action">
                           <a href="<?=base_url()."Dashboard/cart_delete/".$row->product_id?>" class="">
                              <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M9.53033 1.53033C9.82322 1.23744 9.82322 0.762563 9.53033 0.46967C9.23744 0.176777 8.76256 0.176777 8.46967 0.46967L5 3.93934L1.53033 0.46967C1.23744 0.176777 0.762563 0.176777 0.46967 0.46967C0.176777 0.762563 0.176777 1.23744 0.46967 1.53033L3.93934 5L0.46967 8.46967C0.176777 8.76256 0.176777 9.23744 0.46967 9.53033C0.762563 9.82322 1.23744 9.82322 1.53033 9.53033L5 6.06066L8.46967 9.53033C8.76256 9.82322 9.23744 9.82322 9.53033 9.53033C9.82322 9.23744 9.82322 8.76256 9.53033 8.46967L6.06066 5L9.53033 1.53033Z" fill="currentColor"/>
                              </svg>
                              <span>Remove</span>
                        </a>
                        </td>
                     </tr>
                      <?php
    
                    }
                   
                     
                    ?>
                  </tbody>
                </table>
            </div>
            <div class="tp-cart-bottom">
               <div class="row align-items-end">
                  <div class="col-xl-4 col-md-4">
                     <!-- <div class="tp-cart-coupon">
                        <form action="#">
                           <div class="tp-cart-coupon-input-box">
                              <label>Coupon Code:</label>
                              <div class="tp-cart-coupon-input d-flex align-items-center">
                                 <input type="text" placeholder="Enter Coupon Code">
                                 <button type="submit">Apply</button>
                              </div>
                           </div>
                        </form>
                     </div> -->
                  </div>
                  <div class="col-xl-8 col-md-8">
                     <div class="tp-cart-update text-md-end">
                        <center><button type="submit" class="tp-cart-update-btn">Update Cart</button></center>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="tp-cart-checkout-wrapper">
               <div class="tp-cart-checkout-top d-flex align-items-center justify-content-between">
                  <span class="tp-cart-checkout-top-title">Subtotal</span>
                  <span class="tp-cart-checkout-top-price">₹<?=number_format($total["subtotal"],2)?></span>
               </div>
               <div class="tp-cart-checkout-shipping">
                  <h4 class="tp-cart-checkout-shipping-title">Shipping</h4>

                  <div class="tp-cart-checkout-shipping-option-wrapper">
                      
                     <div class="tp-cart-checkout-shipping-option">
                        <?php
                          if($total["subtotal"]>499){
                              ?>
                                 <p>Free shipping <del><?=number_format(0,2)?></del></p>
                              <?php
                          }
                          else{
                           ?>
                           <p>shipping Charge  <?=number_format(40,2)?></p>
                        <?php
                          }
                        ?>
                         
                     </div>
                  </div>
               </div>
               <div class="tp-cart-checkout-total d-flex align-items-center justify-content-between">
                  <span>Total</span>
                  <span>₹<?=number_format($total["grandtotal"],2)?></span>
               </div>
               <div class="tp-cart-checkout-proceed">
                  <a href="<?=base_url()."Dashboard/checkout"?>" class="tp-cart-checkout-btn w-100">Proceed to Checkout</a>
               </div>
            </div>
         </div>
         <?php
                     }
         else{
            ?>
            
               <h3>No Product in cart<a href="" class="btn btn-info w-25 ml-100">Shop Now</a></h3>
                   
        <?php
          }
          ?>
      </div>
   </div>
   <?=form_close()?>
</section>
<!-- cart area end -->

</main>
       <?php $this->load->view("includes/main_footer.php")?>