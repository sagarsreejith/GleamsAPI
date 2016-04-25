@extends('main-layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $deals_not_closed[0]->name }}
                <small>User</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('/') }}/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Deal Details</li>
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
                                <a href="{{ URL::to('/') }}/admin/deals-not-closed-by-user-export/{{ $deals_not_closed[0]->user_id }}" class="btn btn-primary btn-sm active" role="button">Download</a>
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
                                    <th>User</th>
                                    <th>Status</th>
                                    <th>Deal Type</th>  
                                    <th>Performance Score</th>  
                                    <th>Deal Feedback</th>                                    
                                </tr>

                                @foreach($deals_not_closed as $key => $value)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            {{ $deals_not_closed[$key]->user_id_1_name }}                                            
                                        </td>
                                        <td>
                                            {{ $deals_not_closed[$key]->user_id_2_name }}                                            
                                        </td>
                                        <td>
                                            {{ $deals_not_closed[$key]->amount }}                                            
                                        </td>
                                        <td>
                                            {{ $deals_not_closed[$key]->name }}                                            
                                        </td>
                                        @if($deals_not_closed[$key]->status == 2)
                                            <td><span class="label label-primary">Rejected</span></td>
                                        @elseif($deals_not_closed[$key]->status == 1)
                                            <td><span class="label label-success">Closed</span></td>
                                        @else
                                            <td><span class="label label-warning">Pending</span></td>
                                        @endif
                                        <td>
                                            {{ $deals_not_closed[$key]->deal_type }}                                            
                                        </td>
                                        <td>
                                            {{ $deals_not_closed[$key]->performance_score }}                                            
                                        </td>
                                        <td>
                                            {{ $deals_not_closed[$key]->deal_feedback }}                                            
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