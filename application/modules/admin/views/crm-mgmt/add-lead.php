<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">CRM Management</span> - Add New Lead</h4>
         </div>
         <div class="heading-elements">
            <div class="heading-btn-group">
               <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
               <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
               <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
            </div>
         </div>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">CRM Management</a></li>
            <li class="active">Add New Lead</li>
         </ul>
         <ul class="breadcrumb-elements">
            <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
            <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <i class="icon-gear position-left"></i>
               Settings
               <span class="caret"></span>
               </a>
               <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                  <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                  <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                  <li class="divider"></li>
                  <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
               </ul>
            </li>
         </ul>
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <div class="panel panel-flat">
         <div class="panel-heading">
            <h5 class="panel-title">Add New Lead</h5>
         </div>
         <div class="panel-body">
            <div class="row">
               <fieldset>
                  <legend class="text-semibold"><i class="icon-truck position-left"></i> Personal Detail of Lead</legend>
                  <div class="row">
                     <div class="form-group">
                        <select name="select" class="form-control input-xs">
                           <option value="opt1">Area of Interest</option>
                           <option value="opt2">High</option>
                           <option value="opt3">Medium</option>
                           <option value="opt4">Low</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <label class="col-lg-3 control-label">Your name:</label>
                        <div class="col-lg-9">
                           <div class="row">
                              <div class="col-md-6">
                                 <input type="text" placeholder="First name" class="form-control">
                              </div>
                              <div class="col-md-6">
                                 <input type="text" placeholder="Last name" class="form-control">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <label class="col-lg-3 control-label">Email:</label>
                        <div class="col-lg-9">
                           <input type="text" placeholder="eugene@kopyov.com" class="form-control">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <label class="col-lg-3 control-label">Phone #:</label>
                        <div class="col-lg-9">
                           <input type="text" placeholder="+99-99-9999-9999" class="form-control">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <label class="col-lg-3 control-label">Location:</label>
                        <div class="col-lg-9">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="mb-15">
                                    <select data-placeholder="Select your country" class="select">
                                       <option></option>
                                       <option value="1">Canada</option>
                                       <option value="2">USA</option>
                                       <option value="3">Australia</option>
                                       <option value="4">Germany</option>
                                    </select>
                                 </div>
                                 <input type="text" placeholder="ZIP code" class="form-control">
                              </div>
                              <div class="col-md-6">
                                 <input type="text" placeholder="State/Province" class="form-control mb-15">
                                 <input type="text" placeholder="City" class="form-control">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <label class="col-lg-3 control-label">Address:</label>
                        <div class="col-lg-9">
                           <input type="text" placeholder="Your address of living" class="form-control">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <label class="col-lg-3 control-label">Additional message:</label>
                        <div class="col-lg-9">
                           <textarea rows="5" cols="5" class="form-control" placeholder="Enter your message here"></textarea>
                        </div>
                     </div>
                  </div>
               </fieldset>
            </div>
            <div class="row">
               <button type="button" class="btn btn-primary"><i class="icon-cog3 position-left"></i> Submit </button>
            </div>
         </div>
      </div>
      <!-- Footer -->
      <?php $this->load->view('common/footer-text');?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /content wrapper -->