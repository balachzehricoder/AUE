<?php 
include 'confiq.php'; 
include 'header.php';
include 'sidebar.php';
?> 
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">List Tab</h4>
                                <div class="basic-list-group">
                                    <div class="row">
                                        <div class="col-xl-4 col-md-4 col-sm-3 mb-4 mb-sm-0">
                                            <div class="list-group" id="list-tab" role="tablist">
                                                <a class="list-group-item list-group-item-action active" id="list-Services-list" data-toggle="list" href="#list-Services" role="tab" aria-controls="Services">Services</a>
                                                <a class="list-group-item list-group-item-action" id="list-Blogs-list" data-toggle="list" href="#list-Blogs" role="tab" aria-controls="Blogs">Blogs</a> 
                                                <a class="list-group-item list-group-item-action" id="list-Articales-list" data-toggle="list" href="#list-Articales" role="tab" aria-controls="Articales">Articales</a> 
                                                <a class="list-group-item list-group-item-action" id="list-Our-Teams-list" data-toggle="list" href="#list-Our-Teams" role="tab" aria-controls="Our-Teams">Our Teams</a>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 col-md-8 col-sm-9">
                                            <div class="tab-content" id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="list-Services">
                                                  <div class="basic-list-group d-flex align-items-center w-100 h-100">
                                                        <ul class="list-group w-100">
                                                            <li class="list-group-item d-flex justify-content-between align-items-center"><h6 style="font-weight:bold;">Category Descrption</h6><h6 style="font-weight:bold;">Category Post</h6></li>
                                                            <li class="list-group-item"><a href="./table-datatable.php" class="d-flex justify-content-between align-items-center">Cras justo odio <span class="badge badge-primary badge-pill">14</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="list-Blogs" role="tabpanel">
                                                    <div class="basic-list-group d-flex align-items-center w-100 h-100">
                                                        <ul class="list-group w-100">
                                                            <li class="list-group-item d-flex justify-content-between align-items-center"><h6 style="font-weight:bold;">Category Descrption</h6><h6 style="font-weight:bold;">Category Post</h6></li>
                                                            <li class="list-group-item"><a href="./table-datatable.php" class="d-flex justify-content-between align-items-center">Cras justo odio <span class="badge badge-primary badge-pill">14</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="list-Articales">
                                                   <div class="basic-list-group d-flex align-items-center w-100 h-100">
                                                        <ul class="list-group w-100">
                                                            <li class="list-group-item d-flex justify-content-between align-items-center"><h6 style="font-weight:bold;">Category Descrption</h6><h6 style="font-weight:bold;">Category Post</h6></li>
                                                            <li class="list-group-item"><a href="./table-datatable.php" class="d-flex justify-content-between align-items-center">Cras justo odio <span class="badge badge-primary badge-pill">14</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="list-Our-Teams">
                                                    <div class="basic-list-group d-flex align-items-center w-100 h-100">
                                                        <ul class="list-group w-100">
                                                            <li class="list-group-item d-flex justify-content-between align-items-center"><h6 style="font-weight:bold;">Category Descrption</h6><h6 style="font-weight:bold;">Category Post</h6></li>
                                                            <li class="list-group-item"><a href="./table-datatable.php" class="d-flex justify-content-between align-items-center">Cras justo odio <span class="badge badge-primary badge-pill">14</span></a></li>
                                                        </ul>
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
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
    
<?php 
include 'footer.php'; 
?>