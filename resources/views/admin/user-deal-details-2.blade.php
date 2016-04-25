@extends('main-layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Deal Details
                <small>Networth</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('/') }}/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Deals</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">

                        <div class="box-header">
                            <h3 class="box-title">Listing</h3>                            

                            <div class="box-tools">                                
                                <a href="{{ URL::to('/') }}/admin/user-deal-details-export/1" class="btn btn-primary btn-sm active" role="button">Download</a>
                            </div>
                        </div>

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>Sr no</th>
                                    <th>Deal Made By</th>
                                    <th>Deal Made To</th>
                                    <th>Amount</th>                                                                        
                                    <th>Status</th>
                                    <th>Deal Type</th> 
                                    <th>Performance Score</th> 
                                    <th>Deal Feedback</th>                                    
                                </tr>

                                @foreach($user_deal_details as $key => $value)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            {{ $user_deal_details[$key]->user_id_1_name }}                                            
                                        </td>
                                        <td>
                                            {{ $user_deal_details[$key]->user_id_2_name }}                                            
                                        </td>
                                        <td>
                                            {{ $user_deal_details[$key]->amount }}                                            
                                        </td>
                                        @if($user_deal_details[$key]->status == 2)
                                            <td><span class="label label-primary">Rejected</span></td>
                                        @elseif($user_deal_details[$key]->status == 1)
                                            <td><span class="label label-success">Closed</span></td>
                                        @else
                                            <td><span class="label label-warning">Pending</span></td>
                                        @endif
                                        <td>
                                            {{ $user_deal_details[$key]->deal_type }}                                            
                                        </td>
                                        <td>
                                            {{ $user_deal_details[$key]->performance_score }}                                            
                                        </td>
                                        <td>
                                            {{ $user_deal_details[$key]->deal_feedback }}                                            
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>

                            </table>

                        </div><!-- /.box-body -->

                    </div><!-- /.box -->

                </div>

            </div>

        </section><!-- /.content -->

    </div><!-- /.content-wrapper -->

@stop