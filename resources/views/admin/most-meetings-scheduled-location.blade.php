@extends('main-layout')



@section('content')



    <!-- Modal -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Meeting Details</h4>
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
                {{ $location_meeting_details[0]->meeting_location }}
                <small> Location</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
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
                                <a href="{{ URL::to('/') }}/admin/location-scheduling-most-meetings-export/{{ $location_meeting_details[0]->meeting_location }}" class="btn btn-primary btn-sm active" role="button">Download</a>
                            </div>
                        </div>

                        <div class="box-body table-responsive no-padding">

                            <table class="table table-hover">

                                <tbody>

                                <tr>

                                    <th>Sr no</th>

                                    <th>Meeting Made By</th>

                                    <th>Meeting Made To</th>

                                    <th>Meeting Time</th>

                                    <th>Location</th>

                                    <th>Status</th>

                                    <th>Details</th>

                                </tr>

                                @foreach($location_meeting_details as $key => $value)

                                    <tr>

                                        <td> {{ $key+1 }} </td>

                                        <td>

                                            {{ $location_meeting_details[$key]->user_id_1_name }}

                                        </td>

                                        <td>

                                            {{ $location_meeting_details[$key]->user_id_2_name }}

                                        </td>

                                        <td>

                                            {{ $location_meeting_details[$key]->datetime }}

                                        </td>

                                        <td>

                                            {{ $location_meeting_details[$key]->meeting_location }}

                                        </td>

                                        @if($location_meeting_details[$key]->status == 2)

                                            <td><span class="label label-primary">Rejected</span></td>

                                        @elseif($location_meeting_details[$key]->status == 1)

                                            <td><span class="label label-success">Accepted</span></td>

                                        @else

                                            <td><span class="label label-warning">Pending</span></td>

                                        @endif

                                        <td>

                                            <button type="button" class="btn btn-info btn-sm meeting-detail-btn" data-toggle="modal" data-target=".bs-example-modal-lg"

                                            user-id-1="{{ $location_meeting_details[$key]->user_id_1 }}"

                                            user-id-1-name="{{ $location_meeting_details[$key]->user_id_1_name }}"

                                            user-id-1-profile-pic="{{ $location_meeting_details[$key]->user_id_1_profile_pic }}"

                                            user-id-1-type="{{ $location_meeting_details[$key]->user_id_1_type }}"

                                            user-id-1-location="{{ $location_meeting_details[$key]->user_id_1_location }}"

                                            user-id-1-position="{{ $location_meeting_details[$key]->user_id_1_position }}"

                                            user-id-1-industry="{{ $location_meeting_details[$key]->user_id_1_industry }}"



                                            user-id-2="{{ $location_meeting_details[$key]->user_id_2 }}"

                                            user-id-2-name="{{ $location_meeting_details[$key]->user_id_2_name }}"

                                            user-id-2-profile-pic="{{ $location_meeting_details[$key]->user_id_2_profile_pic }}"

                                            user-id-2-type="{{ $location_meeting_details[$key]->user_id_2_type }}"

                                            user-id-2-location="{{ $location_meeting_details[$key]->user_id_2_location }}"

                                            user-id-2-position="{{ $location_meeting_details[$key]->user_id_2_position }}"

                                            user-id-2-industry="{{ $location_meeting_details[$key]->user_id_2_industry }}"



                                            title="{{ $location_meeting_details[$key]->title }}"

                                            description="{{ $location_meeting_details[$key]->description }}"

                                            datetime="{{ $location_meeting_details[$key]->datetime }}"

                                            location="{{ $location_meeting_details[$key]->meeting_location }}"

                                            message="{{ $location_meeting_details[$key]->message }}"

                                            prev-meeting-datetime="{{ $location_meeting_details[$key]->prev_meeting_datetime }}"

                                            reschedule-count="{{ $location_meeting_details[$key]->reschedule_count }}"

                                            deal-status="{{ $location_meeting_details[$key]->deal_status }}"

                                                    >

                                            Details

                                            </button>

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