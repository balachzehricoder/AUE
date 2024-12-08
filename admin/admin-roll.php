<?php 
include 'confiq.php'; 
include 'header.php';
include 'sidebar.php';
?> 


  <div class="content-body">
    <div class="container-fluid">
        <div class="text-right mb-4">
          <button type="button" class="btn mb-1 btn-rounded btn-success add_btn" data-toggle="modal" data-target="#add-new-admin"><span class="btn-icon-left"><i class="fs-6 fa fa-plus-circle"></i> </span>Add New Admin</button>
        </div>
        <div class="row">
                    <div class="col-lg-2 col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="./images/users/8.jpg" class="rounded-circle" alt="">
                                    <h5 class="mt-3 mb-1">Ana Liem</h5>
                                    <p class="m-0">Senior Manager</p>
                                    <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="./images/users/5.jpg" class="rounded-circle" alt="">
                                    <h5 class="mt-3 mb-1">John Abraham</h5>
                                    <p class="m-0">Store Manager</p>
                                    <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="./images/users/7.jpg" class="rounded-circle" alt="">
                                    <h5 class="mt-3 mb-1">John Doe</h5>
                                    <p class="m-0">Sales Man</p>
                                    <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="./images/users/1.jpg" class="rounded-circle" alt="">
                                    <h5 class="mt-3 mb-1">Mehedi Titas</h5>
                                    <p class="m-0">Online Marketer</p>
                                    <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="./images/users/1.jpg" class="rounded-circle" alt="">
                                    <h5 class="mt-3 mb-1">Mehedi Titas</h5>
                                    <p class="m-0">Online Marketer</p>
                                    <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="./images/users/1.jpg" class="rounded-circle" alt="">
                                    <h5 class="mt-3 mb-1">Mehedi Titas</h5>
                                    <p class="m-0">Online Marketer</p>
                                    <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
        <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="active-member">
                                    <div class="table-responsive">
                                        <table class="table table-xs mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Admin Name</th>
                                                    <th>Admin Email</th>
                                                    <th>Admin Contact</th>
                                                    <th>Admin Password</th>
                                                    <th>Admin Roll</th>
                                                    <th>Admin Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><img src="./images/avatar/1.jpg" class=" rounded-circle mr-3" alt="">Shehzad Amin</td>
                                                    <td><span>shehzadamin697@gmail.com</span></td>
                                                    <td><span>340-3434343</span></td>
                                                    <td><i class="fa fa-circle-o text-success  mr-2"></i> shehzad123</td>
                                                    <td><i class="fa fa-circle-o text-success  mr-2"></i> Admin</td>
                                                    <td>
                                                        <div class="updated_btns">
                                                            <a type="button" class="text-white btn mb-0 px-3 py-0 btn-flat btn-success" style="font-size:10px;">Edit</a>
                                                            <a type="button" class="text-white btn mb-0 px-3 py-0 btn-flat btn-success" style="font-size:10px;">Activate</a>
                                                            <a type="button" class="text-white btn mb-0 px-3 py-0 btn-flat btn-danger" style="font-size:10px;">Delete</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img src="./images/avatar/1.jpg" class=" rounded-circle mr-3" alt="">Shehzad Amin</td>
                                                    <td><span>shehzadamin697@gmail.com</span></td>
                                                    <td><span>340-3434343</span></td>
                                                    <td><i class="fa fa-circle-o text-success  mr-2"></i> shehzad123</td>
                                                    <td><i class="fa fa-circle-o text-success  mr-2"></i> Administrator</td>
                                                    <td>
                                                        <div class="updated_btns">
                                                            <a type="button" class="text-white btn mb-0 px-3 py-0 btn-flat btn-primary" style="font-size:10px;">Edit</a>
                                                            <a type="button" class="text-white btn mb-0 px-3 py-0 btn-flat btn-info" style="font-size:10px;">Deactivate</a>
                                                            <a type="button" class="text-white btn mb-0 px-3 py-0 btn-flat btn-danger" style="font-size:10px;">Delete</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img src="./images/avatar/1.jpg" class=" rounded-circle mr-3" alt="">Shehzad Amin</td>
                                                    <td><span>shehzadamin697@gmail.com</span></td>
                                                    <td><span>340-3434343</span></td>
                                                    <td><i class="fa fa-circle-o text-success  mr-2"></i> shehzad123</td>
                                                    <td><i class="fa fa-circle-o text-success  mr-2"></i> Editor</td>
                                                    <td>
                                                        <div class="updated_btns">
                                                            <a type="button" class="text-white btn mb-0 px-3 py-0 btn-flat btn-primary" style="font-size:10px;">Edit</a>
                                                            <a type="button" class="text-white btn mb-0 px-3 py-0 btn-flat btn-info" style="font-size:10px;">Deactivate</a>
                                                            <a type="button" class="text-white btn mb-0 px-3 py-0 btn-flat btn-danger" style="font-size:10px;">Delete</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
  </div>
  <div class="modal fade" id="add-new-admin">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Admin</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form action="#" method="post">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-form-label" for="val-username">Username <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="val-username" name="val-username" placeholder="Enter a username..">
                            </div>
                            <div class="col-lg-6">
                                <label class="col-form-label" for="val-email">Email <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="val-email" name="val-email" placeholder="Your valid email..">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label class="col-form-label" for="val-username">Contact <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="val-username" name="val-username" placeholder="Enter a username..">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                            <label class="col-form-label" for="val-skill">Admin Roll <span class="text-danger">*</span>
                            </label>
                                <select class="form-control" id="val-skill" name="val-skill">
                                    <option value="">Admin Roll</option>
                                    <option value="administrator">Administrator</option>
                                    <option value="admin">Admin</option>
                                    <option value="javascript">Editor</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                            <label class="col-form-label" for="val-skill">Best Skill <span class="text-danger">*</span>
                            </label>
                                <select class="form-control" id="val-skill" name="val-skill">
                                    <option value="">Admin Status</option>
                                    <option value="activate">Activate</option>
                                    <option value="deactivate">Deactivate</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-form-label" for="val-password">Password <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control" id="val-password" name="val-password" placeholder="Choose a safe one..">
                            </div>
                            <div class="col-lg-6">
                                <label class="col-form-label" for="val-confirm-password">Confirm Password <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control" id="val-confirm-password" name="val-confirm-password" placeholder="..and confirm it!">
                            </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-lg-6">
                                <label class="css-control css-control-primary css-checkbox" for="val-terms">
                                    <input type="checkbox" class="css-control-input mr-3" id="val-terms" name="val-terms" value="1"> 
                                    <!-- <span class="css-control-indicator"></span> -->
                                     Terms &amp; Conditions</label>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div> -->
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save Admin</button>
            </div>
        </div>
    </div>
</div>
<?php 
include 'footer.php'; 
?>