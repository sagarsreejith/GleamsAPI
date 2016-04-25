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

                {{ $industry_meeting_details[0]->user_industry }}

                <small> Industry</small>

            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ URL::to('/') }}/admin/dashboard"><i class="fa fa-dashboard"></i> Overall</a></li>
                <li><a href="{{ URL::to('/') }}/admin/most-referred-user"><i class="fa fa-dashboard"></i> Industries Scheduling Most Meetings</a></li>
                <li class="active"> Industries Scheduling Most Meetings Details</li>
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
                                <a href="{{ URL::to('/') }}/admin/industry-scheduling-most-meetings-export/{{ $industry_meeting_details[0]->user_industry }}" class="btn btn-primary btn-sm active" role="button">Download</a>
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

                                @foreach($industry_meeting_details as $key => $value)

                                    <tr>

                                        <td> {{ $key+1 }} </td>

                                        <td>

                                            {{ $industry_meeting_details[$key]->user_id_1_name }}

                                        </td>

                                        <td>

                                            {{ $industry_meeting_details[$key]->user_id_2_name }}

                                        </td>

                                        <td>

                                            {{ $industry_meeting_details[$key]->datetime }}

                                        </td>

                                        <td>

                                            {{ $industry_meeting_details[$key]->location }}

                                        </td>

                                        @if($industry_meeting_details[$key]->status == 2)

                                            <td><span class="label label-primary">Rejected</span></td>

                                        @elseif($industry_meeting_details[$key]->status == 1)

                                            <td><span class="label label-success">Accepted</span></td>

                                        @else

                                            <td><span class="label label-warning">Pending</span></td>

                                        @endif

                                        <td>

                                            <button type="button" class="btn btn-info btn-sm meeting-detail-btn" data-toggle="modal" data-target=".bs-example-modal-lg"

                                            user-id-1="{{ $industry_meeting_details[$key]->user_id_1 }}"

                                            user-id-1-name="{{ $industry_meeting_details[$key]->user_id_1_name }}"

                                            user-id-1-profile-pic="{{ $industry_meeting_details[$key]->user_id_1_profile_pic }}"

                                            user-id-1-type="{{ $industry_meeting_details[$key]->user_id_1_type }}"

                                            user-id-1-location="{{ $industry_meeting_details[$key]->user_id_1_location }}"

                                            user-id-1-position="{{ $industry_meeting_details[$key]->user_id_1_position }}"

                                            user-id-1-industry="{{ $industry_meeting_details[$key]->user_id_1_industry }}"



                                            user-id-2="{{ $industry_meeting_details[$key]->user_id_2 }}"

                                            user-id-2-name="{{ $industry_meeting_details[$key]->user_id_2_name }}"

                                            user-id-2-profile-pic="{{ $industry_meeting_details[$key]->user_id_2_profile_pic }}"

                                            user-id-2-type="{{ $industry_meeting_details[$key]->user_id_2_type }}"

                                            user-id-2-location="{{ $industry_meeting_details[$key]->user_id_2_location }}"

                                            user-id-2-position="{{ $industry_meeting_details[$key]->user_id_2_position }}"

                                            user-id-2-industry="{{ $industry_meeting_details[$key]->user_id_2_industry }}"



                                            title="{{ $industry_meeting_details[$key]->title }}"

                                            description="{{ $industry_meeting_details[$key]->description }}"

                                            datetime="{{ $industry_meeting_details[$key]->datetime }}"

                                            location="{{ $industry_meeting_details[$key]->location }}"

                                            message="{{ $industry_meeting_details[$key]->message }}"

                                            prev-meeting-datetime="{{ $industry_meeting_details[$key]->prev_meeting_datetime }}"

                                            reschedule-count="{{ $industry_meeting_details[$key]->reschedule_count }}"

                                            deal-status="{{ $industry_meeting_details[$key]->deal_status }}"

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