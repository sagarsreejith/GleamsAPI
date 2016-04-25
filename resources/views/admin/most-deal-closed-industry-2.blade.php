@extends('main-layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $industry_deal_details[0]->user_industry }}
                <small>Position</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('/') }}/admin/dashboard"><i class="fa fa-dashboard"></i> Overall</a></li>
                <li><a href="{{ URL::to('/') }}/admin/industry-closing-most-deals"><i class="fa fa-dashboard"></i> Industry Closing Most Deals</a></li>
                <li class="active"> Industry Closing Most Deals Details</li>
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
                                <a href="{{ URL::to('/') }}/admin/industry-closing-most-deals-export/{{ $industry_deal_details[0]->user_industry }}" class="btn btn-primary btn-sm active" role="button">Download</a>
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
                                    <th>Industry</th>
                                    <th>Status</th>
                                    <th>Deal Type</th>  
                                    <th>Performance Score</th>  
                                    <th>Deal Feedback</th>                                    
                                </tr>

                                @foreach($industry_deal_details as $key => $value)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            {{ $industry_deal_details[$key]->user_id_1_name }}                                            
                                        </td>
                                        <td>
                                            {{ $industry_deal_details[$key]->user_id_2_name }}                                            
                                        </td>
                                        <td>
                                            {{ $industry_deal_details[$key]->amount }}                                            
                                        </td>
                                        <td>
                                            {{ $industry_deal_details[$key]->user_industry }}                                            
                                        </td>
                                        @if($industry_deal_details[$key]->status == 2)
                                            <td><span class="label label-primary">Rejected</span></td>
                                        @elseif($industry_deal_details[$key]->status == 1)
                                            <td><span class="label label-success">Closed</span></td>
                                        @else
                                            <td><span class="label label-warning">Pending</span></td>
                                        @endif
                                        <td>
                                            {{ $industry_deal_details[$key]->deal_type }}                                            
                                        </td>
                                        <td>
                                            {{ $industry_deal_details[$key]->performance_score }}                                            
                                        </td>
                                        <td>
                                            {{ $industry_deal_details[$key]->deal_feedback }}                                            
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