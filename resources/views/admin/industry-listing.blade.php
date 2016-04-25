@extends('main-layout')



@section('content')

    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

            <h1>

                Industry Details

                <small>Networth</small> 

            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ URL::to('/') }}/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Industry Details</li>
            </ol>

        </section>



        <!-- Main content -->

        <section class="content">

            <div class="row">

                <div class="col-xs-12">

                    <div class="box">

                        <div class="box-header">

                            <h3 class="box-title">Industry</h3>


                        </div><!-- /.box-header -->

                        <div class="box-body table-responsive no-padding">

                            <table class="table table-hover">

                                <tbody>

                                <tr>

                                    <th>Sr no</th>

                                    <th>Industry Name</th>

                                    <th>No of Users</th>

                                    <th>No of Meetings</th>

                                    <th>Meeting Location</th>

                                    <th>Meeting => Deal</th> 

                                    <th>No of Times Referring</th> 

                                    <th>No of Times Referred</th> 

                                    <th>No of Deals Closed</th> 

                                    <th>No of Customers</th> 

                                    <th>No of Vendors</th> 

                                </tr>

                                <tr>

                                    <td>1</td>

                                    <td>Google</td>

                                    <td>12</td>

                                    <td>10</td>

                                    <td>Chandigarh</td>

                                    <td>Closed</td>

                                    <td>20</td>

                                    <td>25</td>

                                    <td>10</td>

                                    <td>7</td>

                                    <td>5</td>

                                </tr>

                                </tbody>

                            </table>

                        </div><!-- /.box-body -->

                    </div><!-- /.box -->

                </div>

            </div>

        </section><!-- /.content -->

    </div><!-- /.content-wrapper -->





@stop