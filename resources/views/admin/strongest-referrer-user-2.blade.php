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
                Strongest Referrer Details
                <small>Networth</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('/') }}/admin/dashboard"><i class="fa fa-dashboard"></i> Overall</a></li>
                <li><a href="{{ URL::to('/') }}/admin/strongest-referrer"><i class="fa fa-dashboard"></i> Strongest Referrer</a></li>
                <li class="active">Strongest Referrer Details</li>
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
                                <a href="{{ URL::to('/') }}/admin/strongest-referrer-export/{{ $strongest_referrer[0]->user_id }}" class="btn btn-primary btn-sm active" role="button">Download</a>
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

                                @foreach($strongest_referrer as $key => $value)                             
                                    <tr>
                                        <td>{{ $key+1 }}</td>                                                                            
                                        <td>
                                            <button type="button" class="btn btn-link user-btn" data-toggle="modal" data-target="#myModal"

                                                user-id="{{ $strongest_referrer[$key]->refferer_id }}"
                                                user-name="{{ $strongest_referrer[$key]->refferer_name }}"
                                                user-email="{{ $strongest_referrer[$key]->refferer_email }}"
                                                user-phone-no="{{ $strongest_referrer[$key]->refferer_phone_no }}"
                                                user-profile-pic="{{ $strongest_referrer[$key]->refferer_profile_pic }}"
                                                user-location="{{ $strongest_referrer[$key]->refferer_location }}"
                                                user-position="{{ $strongest_referrer[$key]->refferer_position }}"
                                                user-industry="{{ $strongest_referrer[$key]->refferer_industry }}"
                                                user-speciality="{{ $strongest_referrer[$key]->refferer_speciality }}"
                                                user-summary="{{ $strongest_referrer[$key]->refferer_summary }}"
                                                referral-time="{{ $strongest_referrer[$key]->created_at }}">

                                                {{ $strongest_referrer[$key]->refferer_name }}

                                            </button>

                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-link user-btn" data-toggle="modal" data-target="#myModal"

                                                    user-id="{{ $strongest_referrer[$key]->vendor_id }}"
                                                    user-name="{{ $strongest_referrer[$key]->vendor_name }}"
                                                    user-email="{{ $strongest_referrer[$key]->vendor_email }}"
                                                    user-phone-no ="{{ $strongest_referrer[$key]->vendor_phone_no }}"  
                                                    user-profile-pic="{{ $strongest_referrer[$key]->vendor_profile_pic }}"                                            

                                                    user-location="{{ $strongest_referrer[$key]->vendor_location }}"
                                                    user-position="{{ $strongest_referrer[$key]->vendor_position }}"
                                                    user-industry="{{ $strongest_referrer[$key]->vendor_industry }}"
                                                    user-speciality="{{ $strongest_referrer[$key]->vendor_speciality }}"
                                                    user-summary="{{ $strongest_referrer[$key]->vendor_summary }}"
                                                    referral-time="{{ $strongest_referrer[$key]->created_at }}">

                                                {{ $strongest_referrer[$key]->vendor_name }}

                                            </button>

                                        </td> 

                                        <td>

                                            <button type="button" class="btn btn-link user-btn" data-toggle="modal" data-target="#myModal"

                                                    user-id="{{ $strongest_referrer[$key]->customer_id }}"
                                                    user-name="{{ $strongest_referrer[$key]->customer_name }}"
                                                    user-email="{{ $strongest_referrer[$key]->customer_email }}"
                                                    user--phone-no="{{ $strongest_referrer[$key]->customer_phone_no }}"
                                                    user-profile-pic="{{ $strongest_referrer[$key]->customer_profile_pic }}"
                                                    user-location="{{ $strongest_referrer[$key]->customer_location }}"
                                                    user-position="{{ $strongest_referrer[$key]->customer_position }}"
                                                    user-industry="{{ $strongest_referrer[$key]->customer_industry }}"
                                                    user-speciality="{{ $strongest_referrer[$key]->customer_speciality }}"
                                                    user-summary="{{ $strongest_referrer[$key]->customer_summary }}"
                                                    referral-time="{{ $strongest_referrer[$key]->created_at }}">

                                                {{ $strongest_referrer[$key]->customer_name }}

                                            </button>

                                        </td>

                                        <td>
                                            {{ $strongest_referrer[$key]->refferer_location }}
                                        </td>

                                        <td>
                                            {{ $strongest_referrer[$key]->created_at }}
                                        </td>

                                        @if($strongest_referrer[$key]->status == 2)

                                            <td><span class="label label-primary">Closed</span></td>

                                        @elseif($strongest_referrer[$key]->status == 1)

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