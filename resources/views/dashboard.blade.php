@extends('layouts.app')

@section('title','Dashboard');

@section('content')

<section class="section">
    <ul class="breadcrumb breadcrumb-style ">
    <li class="breadcrumb-item">
        <h4 class="page-title m-b-0">Dashboard</h4>
    </li>
    <li class="breadcrumb-item">
        <a href="index-2.html">
        <i data-feather="home"></i></a>
    </li>
    <li class="breadcrumb-item active">Dashboard 2</li>
    </ul>
    <div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="card">
        <div class="card-statistic-5">
            <div class="info-box7-block">
            <div class="row ">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                <div class="banner-img">
                    <img src="assets/img/banner/1.png" alt="">
                </div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                <h6 class="m-b-20 text-right">New Customers</h6>
                <h4 class="text-right"><span>2,342</span>
                </h4>
                </div>
            </div>
            <div id="cardChart1"></div>
            </div>
        </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
        <div class="card-statistic-5">
            <div class="info-box7-block">
            <div class="row ">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                <div class="banner-img">
                    <img src="assets/img/banner/2.png" alt="">
                </div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                <h6 class="m-b-20 text-right">Orders Received</h6>
                <h4 class="text-right"><span>10.3K</span>
                </h4>
                </div>
            </div>
            <div id="cardChart2"></div>
            </div>
        </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
        <div class="card-statistic-5">
            <div class="info-box7-block">
            <div class="row ">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                <div class="banner-img">
                    <img src="assets/img/banner/3.png" alt="">
                </div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                <h6 class="m-b-20 text-right">Tickets Resolved</h6>
                <h4 class="text-right"><span>754</span>
                </h4>
                </div>
            </div>
            <div id="cardChart3"></div>
            </div>
        </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
        <div class="card-statistic-5">
            <div class="info-box7-block">
            <div class="row ">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                <div class="banner-img">
                    <img src="assets/img/banner/4.png" alt="">
                </div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                <h6 class="m-b-20 text-right">Revenue Today</h6>
                <h4 class="text-right"><span>$22,973</span>
                </h4>
                </div>
            </div>
            <div id="cardChart4"></div>
            </div>
        </div>
        </div>
    </div>
    </div>
    <div class="row">
    <div class="col-md-12 col-lg-8 col-xl-8 ">
        <div class="card">
        <div class="card-header">
            <h4>Revenue Chart</h4>
            <div class="card-header-action">
            <ul class="nav nav-pills" role="tablist" id="chart-tabs">
                <li class="nav-item">
                <a class="nav-link active card-tab-style" data-toggle="tab" data-id="1" role="tab"
                    aria-selected="true">2017</a>
                </li>
                <li class="nav-item">
                <a class="nav-link card-tab-style" data-toggle="tab" data-id="2" role="tab"
                    aria-selected="false">2018</a>
                </li>
                <li class="nav-item">
                <a class="nav-link card-tab-style" data-toggle="tab" data-id="3" role="tab"
                    aria-selected="false">2019</a>
                </li>
            </ul>
            </div>
        </div>
        <div class="card-body">
            <div id="chart1"></div>
        </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-4 col-xl-4">
        <div class="card">
        <div class="card-header">
            <h4>Project Team</h4>
        </div>
        <div class="card-body">
            <div class="media-list position-relative">
            <div class="table-responsive" id="project-team-scroll">
                <table class="table table-hover table-xl mb-0">
                <thead>
                    <tr>
                    <th>Project Name</th>
                    <th>Employees</th>
                    <th>Cost</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td class="text-truncate">Project X</td>
                    <td class="text-truncate">
                        <ul class="list-unstyled order-list m-b-0">
                        <li class="team-member team-member-sm"><img class="rounded-circle"
                            src="assets/img/users/user-8.png" alt="user" data-toggle="tooltip" title=""
                            data-original-title="Wildan Ahdian"></li>
                        <li class="team-member team-member-sm"><img class="rounded-circle"
                            src="assets/img/users/user-9.png" alt="user" data-toggle="tooltip" title=""
                            data-original-title="John Deo"></li>
                        <li class="team-member team-member-sm"><img class="rounded-circle"
                            src="assets/img/users/user-10.png" alt="user" data-toggle="tooltip" title=""
                            data-original-title="Sarah Smith"></li>
                        <li class="avatar avatar-sm"><span class="badge badge-primary">+3</span></li>
                        </ul>
                    </td>
                    <td class="text-truncate">$8999</td>
                    </tr>
                    <tr>
                    <td class="text-truncate">Project AB2</td>
                    <td class="text-truncate">
                        <ul class="list-unstyled order-list m-b-0">
                        <li class="team-member team-member-sm"><img class="rounded-circle"
                            src="assets/img/users/user-1.png" alt="user" data-toggle="tooltip" title=""
                            data-original-title="Wildan Ahdian"></li>
                        <li class="team-member team-member-sm"><img class="rounded-circle"
                            src="assets/img/users/user-3.png" alt="user" data-toggle="tooltip" title=""
                            data-original-title="John Deo"></li>
                        <li class="team-member team-member-sm"><img class="rounded-circle"
                            src="assets/img/users/user-2.png" alt="user" data-toggle="tooltip" title=""
                            data-original-title="Sarah Smith"></li>
                        <li class="avatar avatar-sm"><span class="badge badge-primary">+1</span></li>
                        </ul>
                    </td>
                    <td class="text-truncate">$5550</td>
                    </tr>
                    <tr>
                    <td class="text-truncate">Project DS3</td>
                    <td class="text-truncate">
                        <ul class="list-unstyled order-list m-b-0">
                        <li class="team-member team-member-sm"><img class="rounded-circle"
                            src="assets/img/users/user-5.png" alt="user" data-toggle="tooltip" title=""
                            data-original-title="Wildan Ahdian"></li>
                        <li class="team-member team-member-sm"><img class="rounded-circle"
                            src="assets/img/users/user-9.png" alt="user" data-toggle="tooltip" title=""
                            data-original-title="Sarah Smith"></li>
                        <li class="avatar avatar-sm"><span class="badge badge-primary">+4</span></li>
                        </ul>
                    </td>
                    <td class="text-truncate">$9000</td>
                    </tr>
                    <tr>
                    <td class="text-truncate">Project XCD</td>
                    <td class="text-truncate">
                        <ul class="list-unstyled order-list m-b-0">
                        <li class="team-member team-member-sm"><img class="rounded-circle"
                            src="assets/img/users/user-8.png" alt="user" data-toggle="tooltip" title=""
                            data-original-title="Wildan Ahdian"></li>
                        <li class="team-member team-member-sm"><img class="rounded-circle"
                            src="assets/img/users/user-3.png" alt="user" data-toggle="tooltip" title=""
                            data-original-title="John Deo"></li>
                        <li class="team-member team-member-sm"><img class="rounded-circle"
                            src="assets/img/users/user-5.png" alt="user" data-toggle="tooltip" title=""
                            data-original-title="Sarah Smith"></li>
                        <li class="avatar avatar-sm"><span class="badge badge-primary">+2</span></li>
                        </ul>
                    </td>
                    <td class="text-truncate">$7500</td>
                    </tr>
                    <tr>
                    <td class="text-truncate">Project Z2</td>
                    <td class="text-truncate">
                        <ul class="list-unstyled order-list m-b-0">
                        <li class="team-member team-member-sm"><img class="rounded-circle"
                            src="assets/img/users/user-8.png" alt="user" data-toggle="tooltip" title=""
                            data-original-title="Wildan Ahdian"></li>
                        <li class="team-member team-member-sm"><img class="rounded-circle"
                            src="assets/img/users/user-10.png" alt="user" data-toggle="tooltip" title=""
                            data-original-title="Sarah Smith"></li>
                        <li class="avatar avatar-sm"><span class="badge badge-primary">+3</span></li>
                        </ul>
                    </td>
                    <td class="text-truncate">$8500</td>
                    </tr>
                    <tr>
                    <td class="text-truncate">Project GTe</td>
                    <td class="text-truncate">
                        <ul class="list-unstyled order-list m-b-0">
                        <li class="team-member team-member-sm"><img class="rounded-circle"
                            src="assets/img/users/user-3.png" alt="user" data-toggle="tooltip" title=""
                            data-original-title="Wildan Ahdian"></li>
                        <li class="team-member team-member-sm"><img class="rounded-circle"
                            src="assets/img/users/user-5.png" alt="user" data-toggle="tooltip" title=""
                            data-original-title="Sarah Smith"></li>
                        <li class="avatar avatar-sm"><span class="badge badge-primary">+3</span></li>
                        </ul>
                    </td>
                    <td class="text-truncate">$8500</td>
                    </tr>
                </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
    <div class="row">
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
        <div class="card">
        <div class="card-header">
            <h4>Revenue Chart</h4>
        </div>
        <div class="card-body">
            <div class="row text-center p-t-10">
            <div class="col-sm-4 col-6">
                <h4 class="margin-0">$ 209 </h4>
                <p class="text-muted"> Today's Income</p>
            </div>
            <div class="col-sm-4 col-6">
                <h4 class="margin-0">$ 837 </h4>
                <p class="text-muted">This Week's Income</p>
            </div>
            <div class="col-sm-4 col-6">
                <h4 class="margin-0">$ 3410 </h4>
                <p class="text-muted">This Month's Income</p>
            </div>
            </div>
            <div id="amchartLineDashboard" class="amChartHeight"></div>
        </div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
        <div class="card">
        <div class="card-header">
            <h4>Revenue Chart</h4>
        </div>
        <div class="card-body">
            <div class="row text-center p-t-10">
            <div class="col-sm-4 col-6">
                <h4 class="margin-0">$ 209 </h4>
                <p class="text-muted"> Today's Income</p>
            </div>
            <div class="col-sm-4 col-6">
                <h4 class="margin-0">$ 837 </h4>
                <p class="text-muted">This Week's Income</p>
            </div>
            <div class="col-sm-4 col-6">
                <h4 class="margin-0">$ 3410 </h4>
                <p class="text-muted">This Month's Income</p>
            </div>
            </div>
            <div id="dumbbellPlotChart" class="amChartHeight"></div>
        </div>
        </div>
    </div>
    </div>
    <div class="row">
    <div class="col-md-12 col-lg-4 col-xl-4">
        <div class="card">
        <div class="card-header">
            <h4>Project List</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="project-list">
            <table class="table table-hover table-xl mb-0">
                <tbody>
                <tr>
                    <td>Java Software</td>
                    <td class="text-right">
                    <span class="badge-outline col-purple">25%</span>
                    </td>
                </tr>
                <tr>
                    <td>Landing Page</td>
                    <td class="text-right">
                    <div class="badge-outline col-red">Rejected</div>
                    </td>
                </tr>
                <tr>
                    <td>Logo Design</td>
                    <td class="text-right">
                    <div class="badge-outline col-green">Completed</div>
                    </td>
                </tr>
                <tr>
                    <td>E-commerce Website</td>
                    <td class="text-right">
                    <span class="badge-outline col-purple">40%</span>
                    </td>
                </tr>
                <tr>
                    <td>.Net Project</td>
                    <td class="text-right">
                    <span class="badge-outline col-orange">Pending</span>
                    </td>
                </tr>
                <tr>
                    <td>PHP Website</td>
                    <td class="text-right">
                    <span class="badge-outline col-green">Completed</span>
                    </td>
                </tr>
                <tr>
                    <td>Angular Website</td>
                    <td class="text-right">
                    <span class="badge-outline col-purple">98%</span>
                    </td>
                </tr>
                <tr>
                    <td>SEO Website</td>
                    <td class="text-right">
                    <span class="badge-outline col-red">Rejected</span>
                    </td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-8 col-xl-8">
        <div class="card">
        <div class="card-header">
            <h4>Client Details</h4>
        </div>
        <div class="card-body">
            <div class="tableBody" id="client-details">
            <div class="table-responsive">
                <table class="table table-hover dashboard-task-infos">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Rating</th>
                    <th>Project Name</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td class="table-img">
                        <img src="assets/img/users/user-5.png" alt="">
                    </td>
                    <td>John Doe</td>
                    <td>xyz@email.com</td>
                    <td>
                        <i class="fas fa-star col-orange"></i>
                        <i class="fas fa-star col-orange"></i>
                        <i class="fas fa-star col-orange"></i>
                        <i class="fas fa-star col-orange"></i>
                        <i class="far fa-star col-orange"></i>
                    </td>
                    <td>ERP System</td>
                    <td>
                        <a class="btn tblEditBtn" data-toggle="tooltip" title="" data-original-title="Edit">
                        <i class="material-icons">mode_edit</i>
                        </a>
                        <a class="btn tblDelBtn" data-toggle="tooltip" title="" data-original-title="Delete">
                        <i class="material-icons">delete</i>
                        </a>
                    </td>
                    </tr>
                    <tr>
                    <td class="table-img">
                        <img src="assets/img/users/user-2.png" alt="">
                    </td>
                    <td>Sarah Smith</td>
                    <td>xyz@email.com</td>
                    <td>
                        <i class="fas fa-star col-orange"></i>
                        <i class="fas fa-star col-orange"></i>
                        <i class="fas fa-star-half-alt col-orange"></i>
                        <i class="far fa-star col-orange"></i>
                        <i class="far fa-star col-orange"></i>
                    </td>
                    <td>Abc Website</td>
                    <td>
                        <a class="btn tblEditBtn" data-toggle="tooltip" title="" data-original-title="Edit">
                        <i class="material-icons">mode_edit</i>
                        </a>
                        <a class="btn tblDelBtn" data-toggle="tooltip" title="" data-original-title="Delete">
                        <i class="material-icons">delete</i>
                        </a>
                    </td>
                    </tr>
                    <tr>
                    <td class="table-img">
                        <img src="assets/img/users/user-7.png" alt="">
                    </td>
                    <td>Airi Satou</td>
                    <td>xyz@email.com</td>
                    <td>
                        <i class="fas fa-star col-orange"></i>
                        <i class="fas fa-star col-orange"></i>
                        <i class="fas fa-star col-orange"></i>
                        <i class="fas fa-star col-orange"></i>
                        <i class="fas fa-star-half-alt col-orange"></i>
                    </td>
                    <td>Android App</td>
                    <td>
                        <a class="btn tblEditBtn" data-toggle="tooltip" title="" data-original-title="Edit">
                        <i class="material-icons">mode_edit</i>
                        </a>
                        <a class="btn tblDelBtn" data-toggle="tooltip" title="" data-original-title="Delete">
                        <i class="material-icons">delete</i>
                        </a>
                    </td>
                    </tr>

                    <tr>
                    <td class="table-img">
                        <img src="assets/img/users/user-1.png" alt="">
                    </td>
                    <td>Ashton Cox</td>
                    <td>xyz@email.com</td>
                    <td>
                        <i class="fas fa-star col-orange"></i>
                        <i class="fas fa-star col-orange"></i>
                        <i class="fas fa-star col-orange"></i>
                        <i class="fas fa-star col-orange"></i>
                        <i class="fas fa-star col-orange"></i>
                    </td>
                    <td>Java Website</td>
                    <td>
                        <a class="btn tblEditBtn" data-toggle="tooltip" title="" data-original-title="Edit">
                        <i class="material-icons">mode_edit</i>
                        </a>
                        <a class="btn tblDelBtn" data-toggle="tooltip" title="" data-original-title="Delete">
                        <i class="material-icons">delete</i>
                        </a>
                    </td>
                    </tr>
                    <tr>
                    <td class="table-img">
                        <img src="assets/img/users/user-9.png" alt="">
                    </td>
                    <td>Cara Stevens</td>
                    <td>xyz@email.com</td>
                    <td>
                        <i class="fas fa-star col-orange"></i>
                        <i class="fas fa-star col-orange"></i>
                        <i class="fas fa-star col-orange"></i>
                        <i class="fas fa-star col-orange"></i>
                        <i class="far fa-star col-orange"></i>
                    </td>
                    <td>Desktop App</td>
                    <td>
                        <a class="btn tblEditBtn" data-toggle="tooltip" title="" data-original-title="Edit">
                        <i class="material-icons">mode_edit</i>
                        </a>
                        <a class="btn tblDelBtn" data-toggle="tooltip" title="" data-original-title="Delete">
                        <i class="material-icons">delete</i>
                        </a>
                    </td>
                    </tr>
                    <tr>
                    <td class="table-img">
                        <img src="assets/img/users/user-8.png" alt="">
                    </td>
                    <td>Angelica Ramos</td>
                    <td>xyz@email.com</td>
                    <td>
                        <i class="fas fa-star col-orange"></i>
                        <i class="fas fa-star col-orange"></i>
                        <i class="fas fa-star col-orange"></i>
                        <i class="fas fa-star col-orange"></i>
                        <i class="far fa-star col-orange"></i>
                    </td>
                    <td>Angular App</td>
                    <td>
                        <a class="btn tblEditBtn" data-toggle="tooltip" title="" data-original-title="Edit">
                        <i class="material-icons">mode_edit</i>
                        </a>
                        <a class="btn tblDelBtn" data-toggle="tooltip" title="" data-original-title="Delete">
                        <i class="material-icons">delete</i>
                        </a>
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
</section>

@endsection