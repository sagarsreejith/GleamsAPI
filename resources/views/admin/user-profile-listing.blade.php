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
                Users
                <small>Networth</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('/') }}/admin/dashboard"><i class="fa fa-dashboard"></i> Overall</a></li>                
                <li class="active"> Users</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">User Listing</h3>
                            <div class="box-tools" style="margin-right:100px;">                                

                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">                                      
                                      <li class="dropdown">
                                        <a class="dropdown-toggle my-nav-dropdown" data-toggle="dropdown" href="#" aria-expanded="false">
                                          Dropdown <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" style="left: auto; right: 0 !important;">
                                          <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::to('/') }}/admin/user-profile-listing/{{ $user_profile_listing[0]->page }}/0">None</a></li>
                                          <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::to('/') }}/admin/user-profile-listing/{{ $user_profile_listing[0]->page }}/1">Name</a></li>
                                          <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::to('/') }}/admin/user-profile-listing/{{ $user_profile_listing[0]->page }}/2">Location</a></li>
                                          <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::to('/') }}/admin/user-profile-listing/{{ $user_profile_listing[0]->page }}/3">Industry</a></li>
                                          <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::to('/') }}/admin/user-profile-listing/{{ $user_profile_listing[0]->page }}/4">Position</a></li>
                                        </ul>
                                      </li>                                      
                                    </ul>                                    
                                </div>

                            </div>

                            <div class="box-tools">                                

                                <a href="{{ URL::to('/') }}/admin/user-profile-listing-export" 
                                    class="btn btn-primary btn-sm active" role="button">Download</a>

                            </div>
                        </div><!-- /.box-header -->

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
                                    <th>Details</th>
                                </tr>

                                @foreach($user_profile_listing as $key => $value)
                                    <tr>
                                        <td>{{ $user_profile_listing[$key]->serial_no }}</td>
                                        <td>
                                            {{ $user_profile_listing[$key]->name }}
                                        </td>
                                        <td>
                                            {{ $user_profile_listing[$key]->email }}                                            
                                        </td>
                                        <td>
                                            {{ $user_profile_listing[$key]->phone_no }}                                            
                                        </td>
                                        <td>                                            
                                            {{ $user_profile_listing[$key]->location }}                                            
                                        </td>
                                        <td>
                                            {{ $user_profile_listing[$key]->industry }}                                            
                                        </td>                                        
                                        <td>
                                            {{ $user_profile_listing[$key]->position }}                                            
                                        </td>                                        
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm user-detail-btn" data-toggle="modal" data-target=".bs-example-modal-lg"
                                            user-name="{{ $user_profile_listing[$key]->name }}"                                            
                                            user-profile-pic="{{ $user_profile_listing[$key]->profile_pic }}"
                                            user-position="{{ $user_profile_listing[$key]->position }}"
                                            user-speciality="{{ $user_profile_listing[$key]->speciality }}"
                                            user-summary="{{ $user_profile_listing[$key]->summary }}"
                                            
                                            user-referrer-score="{{ $user_profile_listing[$key]->referral_score }}"
                                            user-referral-received="{{ $user_profile_listing[$key]->referrals_received }}"
                                            user-referral-given="{{ $user_profile_listing[$key]->referrals_given }}"
                                            user-performance-score="{{ $user_profile_listing[$key]->performance_score }}"
                                            user-professional-score="{{ $user_profile_listing[$key]->professional_score }}"
                                            user-personal-score="{{ $user_profile_listing[$key]->personal_score }}"
                                            user-business-val-reff-score="{{ $user_profile_listing[$key]->business_val_reff_score_perc }}"
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

                    <div class="pull-right">                                                                                         
                        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                            <ul class="pagination">                                

                                <?php $sort_type = $user_profile_listing[0]->sort_type; ?>                                
                                
                                <li class="paginate_button previous <?php if($user_profile_listing[0]->page==0) { echo "disabled"; } ?>" id="example2_previous">
                                    <a href="
                                    @if($user_profile_listing[0]->page==0) 
                                        {{ URL::to('/') }}/admin/user-profile-listing/{{ $user_profile_listing[0]->page }}/{{ $sort_type }}
                                    @else 
                                        {{ URL::to('/') }}/admin/user-profile-listing/{{ $user_profile_listing[0]->page-1 }}/{{ $sort_type }}
                                    @endif                                    
                                    " aria-controls="example2" data-dt-idx="0" tabindex="0">Previous</a>
                                </li>

                                @for($i=0; $i<$user_profile_listing[0]->total_list_pages; $i++)
                                    <?php $j = $i ?>

                                    <li class="paginate_button <?php if($i==$user_profile_listing[0]->page) { echo "active"; }  ?>">
                                        <a href="{{ URL::to('/') }}/admin/user-profile-listing/{{ $i }}/{{ $sort_type }}" aria-controls="example2" data-dt-idx="1" tabindex="0"> {{ $j+1 }} </a>
                                    </li>
                                @endfor

                                <li class="paginate_button next <?php if($user_profile_listing[0]->page==($i-1)) { echo "disabled"; } ?>" id="example2_next">
                                    <a href="
                                    @if($user_profile_listing[0]->page==($i-1)) 
                                        {{ URL::to('/') }}/admin/user-profile-listing/{{ $user_profile_listing[0]->page }}/{{ $sort_type }}
                                    @else 
                                        {{ URL::to('/') }}/admin/user-profile-listing/{{ $user_profile_listing[0]->page+1 }}/{{ $sort_type }}
                                    @endif
                                    " aria-controls="example2" data-dt-idx="7" tabindex="0">Next</a>
                                </li>                                
                                
                            </ul>
                        </div>                        
                    </div>

                </div>

            </div>

        </section><!-- /.content -->

    </div><!-- /.content-wrapper -->

@stop