@extends('main-layout')



@section('content')

    <!-- Modal -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">User Details</h4>
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
                Users Scheduling Most Meetings
                <small>Networth</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('/') }}/admin/dashboard"><i class="fa fa-dashboard"></i> Overall</a></li>
                <li class="active">User Scheduling Most Meetings</li>
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
                                <a href="{{ URL::to('/') }}/admin/user-scheduling-most-meetings-export" class="btn btn-primary btn-sm active" role="button">Download</a>
                            </div>
                        </div>

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>

                                    <th>Sr no</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone No</th>
                                    <th>Location</th>
                                    <th>Industry</th>                                    
                                    <th>Position</th>                                    
                                    <th>Meeting Details</th>
                                    <th>User Details</th>

                                </tr>

                                @foreach($user_meeting_details as $key => $value)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            {{ $user_meeting_details[$key]->name }}
                                        </td>
                                        <td>
                                            {{ $user_meeting_details[$key]->email }}                                            
                                        </td>
                                        <td>
                                            {{ $user_meeting_details[$key]->phone_no }}                                            
                                        </td>
                                        <td>                                            
                                            {{ $user_meeting_details[$key]->location }}                                            
                                        </td>
                                        <td>
                                            {{ $user_meeting_details[$key]->industry }}                                            
                                        </td>                                        
                                        <td>
                                            {{ $user_meeting_details[$key]->position }}                                            
                                        </td>                                                                                
                                        <td>
                                            <a href="{{ URL::to('/') }}/admin/user-scheduling-most-meetings-details/{{ $user_meeting_details[$key]->user_id_1_2 }}" class="btn btn-primary" role="button"> {{ $user_meeting_details[$key]->meeting_count }} </a>                                            
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm user-detail-btn" data-toggle="modal" data-target=".bs-example-modal-lg"
                                            user-name="{{ $user_meeting_details[$key]->name }}"                                            
                                            user-profile-pic="{{ $user_meeting_details[$key]->profile_pic }}"
                                            user-position="{{ $user_meeting_details[$key]->position }}"
                                            user-speciality="{{ $user_meeting_details[$key]->speciality }}"
                                            user-summary="{{ $user_meeting_details[$key]->summary }}"
                                            user-referrer-score="{{ $user_meeting_details[$key]->referral_score }}"
                                            user-referral-received="{{ $user_meeting_details[$key]->referrals_received }}"
                                            user-referral-given="{{ $user_meeting_details[$key]->referrals_given }}"
                                            user-performance-score="{{ $user_meeting_details[$key]->performance_score }}"
                                            user-professional-score="{{ $user_meeting_details[$key]->professional_score }}"
                                            user-personal-score="{{ $user_meeting_details[$key]->personal_score }}"
                                            user-business-val-reff-score="{{ $user_meeting_details[$key]->business_val_reff_score }}"
                                                    >

                                            User Details

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