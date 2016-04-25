@extends('main-layout')

@section('content')

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Referrer Details</h4>
                </div>
                <div class="modal-body">
                    <div class="box box-primary place-modal-content">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Most Referred User 
                <small>Networth</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('/') }}/admin/dashboard"><i class="fa fa-dashboard"></i> Overall</a></li>
                <li><a href="{{ URL::to('/') }}/admin/most-referred-user"><i class="fa fa-dashboard"></i> Most Referred User</a></li>
                <li class="active"> Most Referred User Details</li>
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
                                <a href="{{ URL::to('/') }}/admin/most-referred-user-export/{{ $most_referred_user[0]->vendor_id }}" class="btn btn-primary btn-sm active" role="button">Download</a>
                            </div>
                        </div>  

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>Sr no</th>
                                    <th>Referrer Name</th>
                                    <th>Vendor Name</th>
                                    <th>Customer Name</th>
                                    <th>Referrer Location</th>
                                    <th>Refer Time</th>
                                    <th>Status</th>
                                </tr>

                                @foreach($most_referred_user as $key => $value)                             
                                    <tr>
                                        <td>{{ $key+1 }}</td>                                                                            
                                        <td>
                                            <button type="button" class="btn btn-link user-btn" data-toggle="modal" data-target="#myModal"

                                                user-id="{{ $most_referred_user[$key]->refferer_id }}"
                                                user-name="{{ $most_referred_user[$key]->refferer_name }}"
                                                user-email="{{ $most_referred_user[$key]->refferer_email }}"
                                                user-phone-no="{{ $most_referred_user[$key]->refferer_phone_no }}"
                                                user-profile-pic="{{ $most_referred_user[$key]->refferer_profile_pic }}"
                                                user-location="{{ $most_referred_user[$key]->refferer_location }}"
                                                user-position="{{ $most_referred_user[$key]->refferer_position }}"
                                                user-industry="{{ $most_referred_user[$key]->refferer_industry }}"
                                                user-speciality="{{ $most_referred_user[$key]->refferer_speciality }}"
                                                user-summary="{{ $most_referred_user[$key]->refferer_summary }}"
                                                referral-time="{{ $most_referred_user[$key]->created_at }}">

                                                {{ $most_referred_user[$key]->refferer_name }}

                                            </button>

                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-link user-btn" data-toggle="modal" data-target="#myModal"

                                                    user-id="{{ $most_referred_user[$key]->vendor_id }}"
                                                    user-name="{{ $most_referred_user[$key]->vendor_name }}"
                                                    user-email="{{ $most_referred_user[$key]->vendor_email }}"
                                                    user-phone-no ="{{ $most_referred_user[$key]->vendor_phone_no }}"  
                                                    user-profile-pic="{{ $most_referred_user[$key]->vendor_profile_pic }}"                                            

                                                    user-location="{{ $most_referred_user[$key]->vendor_location }}"
                                                    user-position="{{ $most_referred_user[$key]->vendor_position }}"
                                                    user-industry="{{ $most_referred_user[$key]->vendor_industry }}"
                                                    user-speciality="{{ $most_referred_user[$key]->vendor_speciality }}"
                                                    user-summary="{{ $most_referred_user[$key]->vendor_summary }}"
                                                    referral-time="{{ $most_referred_user[$key]->created_at }}">

                                                {{ $most_referred_user[$key]->vendor_name }}

                                            </button>

                                        </td> 

                                        <td>

                                            <button type="button" class="btn btn-link user-btn" data-toggle="modal" data-target="#myModal"

                                                    user-id="{{ $most_referred_user[$key]->customer_id }}"
                                                    user-name="{{ $most_referred_user[$key]->customer_name }}"
                                                    user-email="{{ $most_referred_user[$key]->customer_email }}"
                                                    user--phone-no="{{ $most_referred_user[$key]->customer_phone_no }}"
                                                    user-profile-pic="{{ $most_referred_user[$key]->customer_profile_pic }}"
                                                    user-location="{{ $most_referred_user[$key]->customer_location }}"
                                                    user-position="{{ $most_referred_user[$key]->customer_position }}"
                                                    user-industry="{{ $most_referred_user[$key]->customer_industry }}"
                                                    user-speciality="{{ $most_referred_user[$key]->customer_speciality }}"
                                                    user-summary="{{ $most_referred_user[$key]->customer_summary }}"
                                                    referral-time="{{ $most_referred_user[$key]->created_at }}">

                                                {{ $most_referred_user[$key]->customer_name }}

                                            </button>

                                        </td>

                                        <td>
                                            {{ $most_referred_user[$key]->refferer_location }}
                                        </td>

                                        <td>
                                            {{ $most_referred_user[$key]->created_at }}
                                        </td>

                                        @if($most_referred_user[$key]->status == 2)

                                            <td><span class="label label-primary">Closed</span></td>

                                        @elseif($most_referred_user[$key]->status == 1)

                                            <td><span class="label label-success">Active</span></td>

                                        @else

                                            <td><span class="label label-warning">Pending</span></td>

                                        @endif

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