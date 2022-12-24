
@php
  $route = Route::current()->getName();
  $prefix = Request::route()->getPrefix();
@endphp


<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">	
		
        <div class="user-profile">
			<div class="ulogo">
				 <a href="index.html">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">					 	
						  <img src="{{ asset('backend/images/logo-dark.png') }}" alt="">
						  <h3><b>Easy</b> Shop</h3>
					 </div>
				</a>
			</div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">  
		  
		    <li class="{{ ($route == 'admin.dashboard') ? 'active' : '' }}">
          <a href="{{ route('admin.dashboard') }}">
            <i data-feather="pie-chart"></i>
			      <span>Dashboard</span>
          </a>
        </li>  
		
        <li id="active" class="treeview ">
          <a href="#">
            <i data-feather="message-circle"></i>
            <span>Brands</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'brand.view') ? 'active' : '' }}"><a href="{{ route('brand.view') }}"><i class="ti-more"></i>All Brand</a></li>
          </ul>
        </li> 

        <li id="active" class="treeview ">
          <a href="#">
            <i data-feather="message-circle"></i>
            <span>Category</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'category.view') ? 'active' : '' }}"><a href="{{ route('category.view') }}"><i class="ti-more"></i>All Category</a></li>
            <li class="{{ ($route == 'SubCategory.view') ? 'active' : '' }}"><a href="{{ route('SubCategory.view') }}"><i class="ti-more"></i>All SubCategory</a></li>
            <li class="{{ ($route == 'SubSubCategory.view') ? 'active' : '' }}"><a href="{{ route('SubSubCategory.view') }}"><i class="ti-more"></i>All Sub->SubCategory</a></li>
          </ul>
        </li> 
		  
        <li id="active" class="treeview">
          <a href="#">
            <i data-feather="mail"></i> <span>Product</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'product.view') ? 'active' : '' }}"><a href="{{ route('product.view') }}"><i class="ti-more"></i>All Product</a></li>
            <li class="{{ ($route == 'product.create') ? 'active' : '' }}"><a href="{{ route('product.create') }}"><i class="ti-more"></i>Add Product</a></li>
          </ul>
        </li>
		  
        <li id="active" class="treeview">
          <a href="#">
            <i data-feather="mail"></i> <span>Slider</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'slider.view') ? 'active' : '' }}"><a href="{{ route('slider.view') }}"><i class="ti-more"></i>All Slider</a></li>
          </ul>
        </li>

        <li id="active" class="treeview">
          <a href="#">
            <i data-feather="mail"></i> <span>Coupon</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'coupon.view') ? 'active' : '' }}"><a href="{{ route('coupon.view') }}"><i class="ti-more"></i>All Coupon</a></li>
          </ul>
        </li>

        <li id="active" class="treeview">
          <a href="#">
            <i data-feather="mail"></i> <span>Shipping Area</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'division.view') ? 'active' : '' }}"><a href="{{ route('division.view') }}"><i class="ti-more"></i>Shipping Division</a></li>
          </ul>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'district.view') ? 'active' : '' }}"><a href="{{ route('district.view') }}"><i class="ti-more"></i>Shipping District</a></li>
          </ul>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'state.view') ? 'active' : '' }}"><a href="{{ route('state.view') }}"><i class="ti-more"></i>Shipping State</a></li>
          </ul>
        </li>
		
        <li id="active" class="treeview">
          <a href="#">
            <i data-feather="file"></i>
            <span>Pages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="profile.html"><i class="ti-more"></i>Profile</a></li>
            <li><a href="invoice.html"><i class="ti-more"></i>Invoice</a></li>
            <li><a href="gallery.html"><i class="ti-more"></i>Gallery</a></li>
            <li><a href="faq.html"><i class="ti-more"></i>FAQs</a></li>
            <li><a href="timeline.html"><i class="ti-more"></i>Timeline</a></li>
          </ul>
        </li> 		  
		 
        <li id="active" class="header nav-small-cap">User Interface</li>
		  
        <li id="active" class="treeview">
          <a href="#">
            <i data-feather="grid"></i>
            <span>Components</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="components_alerts.html"><i class="ti-more"></i>Alerts</a></li>
            <li><a href="components_badges.html"><i class="ti-more"></i>Badge</a></li>
            <li><a href="components_buttons.html"><i class="ti-more"></i>Buttons</a></li>
            <li><a href="components_sliders.html"><i class="ti-more"></i>Sliders</a></li>
            <li><a href="components_dropdown.html"><i class="ti-more"></i>Dropdown</a></li>
            <li><a href="components_modals.html"><i class="ti-more"></i>Modal</a></li>
            <li><a href="components_nestable.html"><i class="ti-more"></i>Nestable</a></li>
            <li><a href="components_progress_bars.html"><i class="ti-more"></i>Progress Bars</a></li>
          </ul>
        </li>
		
        <li id="active" class="treeview">
              <a href="#">
                <i data-feather="credit-card"></i>
                <span>Cards</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-right pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
          <li><a href="card_advanced.html"><i class="ti-more"></i>Advanced Cards</a></li>
          <li><a href="card_basic.html"><i class="ti-more"></i>Basic Cards</a></li>
          <li><a href="card_color.html"><i class="ti-more"></i>Cards Color</a></li>
          </ul>
        </li> 
      </ul>
    </section>
	
	<div class="sidebar-footer">
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
		<!-- item-->
		<a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
	</div>
  </aside>