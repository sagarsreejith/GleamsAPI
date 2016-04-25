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
                Referrals & Location
                <small>Networth</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('/') }}/admin/dashboard"><i class="fa fa-dashboard"></i> Overall</a></li>                
                <li class="active">Referrals & Location</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="row">                                
                                <div class="col-lg-4 col-md-3 col-sm-1">
                                    <h3 class="box-title">Connections</h3>
                                </div>

                                <div class="col-lg-2 col-md-3 col-sm-4">
                                    <div class="box-tools">                                
                                        <div class="nav-tabs-custom no-bottom-margin">
                                            <ul class="nav nav-tabs">                                      
                                              <li class="dropdown">
                                                <a class="dropdown-toggle my-nav-dropdown" data-toggle="dropdown" href="#" aria-expanded="false">
                                                  Sort Data <span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php 
                                                        if(isset($user_network_details[0]->page)) {
                                                            echo URL::to('/admin/user-network-details').'/'.$user_network_details[0]->page.'/0/'.$user_network_details[0]->filter_type.'/'.$user_network_details[0]->filter_value;
                                                        }
                                                    ?>">None</a></li>
                                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php 
                                                        if(isset($user_network_details[0]->page)) {
                                                            echo URL::to('/admin/user-network-details').'/'.$user_network_details[0]->page.'/1/'.$user_network_details[0]->filter_type.'/'.$user_network_details[0]->filter_value;
                                                        }
                                                    ?>">Referrer Name</a></li>
                                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php 
                                                        if(isset($user_network_details[0]->page)) {
                                                            echo URL::to('/admin/user-network-details').'/'.$user_network_details[0]->page.'/2/'.$user_network_details[0]->filter_type.'/'.$user_network_details[0]->filter_value;
                                                        }
                                                    ?>">Vendor Name</a></li>
                                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php 
                                                        if(isset($user_network_details[0]->page)) {
                                                            echo URL::to('/admin/user-network-details').'/'.$user_network_details[0]->page.'/3/'.$user_network_details[0]->filter_type.'/'.$user_network_details[0]->filter_value;
                                                        }
                                                    ?>">Customer Name</a></li>
                                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php 
                                                        if(isset($user_network_details[0]->page)) {
                                                            echo URL::to('/admin/user-network-details').'/'.$user_network_details[0]->page.'/4/'.$user_network_details[0]->filter_type.'/'.$user_network_details[0]->filter_value;
                                                        }
                                                    ?>">Status</a></li>
                                                </ul>
                                              </li>                                      
                                            </ul>                                    
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-5 col-sm-6">
                                    <div class="box-tools">                                 
                                        <div class="row">
                                            <div class="col-xs-8">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-btn">
                                                      <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action <span class="fa fa-caret-down"></span></button>
                                                        <ul class="dropdown-menu">
                                                            <!-- <li><a href="#">Referrer Name</a></li>
                                                            <li><a href="#">Vendor Name</a></li>
                                                            <li><a href="#">Customer Name</a></li> -->

                                                            <div class="form-group">                                                            
                                                              <div class="checkbox my-checkbox">
                                                                <label>
                                                                  <input type="checkbox" value="referrer_name" class="referrer-name" 
                                                                    <?php
                                                                    if(isset($user_network_details[0]->filter_type)) {
                                                                        if($user_network_details[0]->filter_type == 1 || 
                                                                            $user_network_details[0]->filter_type == 4 || 
                                                                            $user_network_details[0]->filter_type == 5 ||
                                                                            $user_network_details[0]->filter_type == 7) {
                                                                            echo "checked";
                                                                        }
                                                                    }                                                                        
                                                                    ?> 
                                                                  >
                                                                  Referrer Name
                                                                </label>
                                                              </div>

                                                              <div class="checkbox my-checkbox">
                                                                <label>
                                                                  <input type="checkbox" value="vendor_name" class="vendor-name"
                                                                    <?php 
                                                                    if(isset($user_network_details[0]->filter_type)) {
                                                                        if($user_network_details[0]->filter_type == 2 || 
                                                                            $user_network_details[0]->filter_type == 4 ||
                                                                            $user_network_details[0]->filter_type == 6 ||
                                                                            $user_network_details[0]->filter_type == 7) {
                                                                            echo "checked";
                                                                        }
                                                                    }       
                                                                    ?>
                                                                  >
                                                                  Vendor Name
                                                                </label>
                                                              </div>

                                                              <div class="checkbox my-checkbox">
                                                                <label>
                                                                  <input type="checkbox" value="customer_name" class="customer-name"
                                                                    <?php 
                                                                    if(isset($user_network_details[0]->filter_type)) {
                                                                        if($user_network_details[0]->filter_type == 3 || 
                                                                            $user_network_details[0]->filter_type == 5 ||
                                                                            $user_network_details[0]->filter_type == 6 ||
                                                                            $user_network_details[0]->filter_type == 7) {
                                                                            echo "checked";
                                                                        }
                                                                    }
                                                                    ?>
                                                                  >
                                                                  Customer Name
                                                                </label>
                                                              </div>

                                                            </div>

                                                        </ul> 
                                                    </div><!-- /btn-group -->                                                    
                                                    <input type="text" class="form-control filter-value" value="<?php
                                                    if(isset($user_network_details[0]->filter_value)) {
                                                        if($user_network_details[0]->filter_value==0) {
                                                            echo "";
                                                        }
                                                        else {
                                                            echo $user_network_details[0]->filter_value;    
                                                        }
                                                    }                                                          
                                                    ?> ">
                                                    <input type="hidden" class="hidden-page-val" value="<?php echo isset($user_network_details[0]->page) ? $user_network_details[0]->page : ""; ?>" >        
                                                    <input type="hidden" class="hidden-sort-type" value="<?php echo isset($user_network_details[0]->sort_type) ? $user_network_details[0]->sort_type : ""; ?>" >                                                                                    
                                                </div>    
                                            </div>
                                            <div class="col-xs-4">
                                                <button type="submit" class="btn btn-primary btn-sm user-network-filter-btn">Filter</button>
                                            </div>
                                        </div>                                                                                                                    
                                    
                                    </div>
                                </div>

                                <div class="col-sm-2">                                    

                                    <a href="
                                    @if(isset($user_network_details[0]->filter_type) && isset($user_network_details[0]->filter_value))
                                        {{ URL::to('/') }}/admin/user-network-details-export/{{$user_network_details[0]->filter_type}}/{{$user_network_details[0]->filter_value}}" class="btn btn-primary btn-sm active
                                    @else
                                        {{ URL::to('/') }}/admin/user-network-details-export/0/0" class="btn btn-primary btn-sm active
                                    @endif
                                    " role="button">Download</a>
                                     
                                </div>

                            </div>                                                                                                       

                        </div><!-- /.box-header -->

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
                                    <th>Who Contacted First</th>
                                </tr>

                                @foreach($user_network_details as $key => $value)                             
                                    <tr>
                                        <td>{{ $user_network_details[$key]->serial_no }}</td>                                                                            
                                        <td>
                                            <button type="button" class="btn btn-link user-btn" data-toggle="modal" data-target="#myModal"

                                                user-id="{{ $user_network_details[$key]->refferer_id }}"
                                                user-name="{{ $user_network_details[$key]->refferer_name }}"
                                                user-email="{{ $user_network_details[$key]->refferer_email }}"
                                                user-phone-no="{{ $user_network_details[$key]->refferer_phone_no }}"
                                                user-profile-pic="{{ $user_network_details[$key]->refferer_profile_pic }}"
                                                user-location="{{ $user_network_details[$key]->refferer_location }}"
                                                user-position="{{ $user_network_details[$key]->refferer_position }}"
                                                user-industry="{{ $user_network_details[$key]->refferer_industry }}"
                                                user-speciality="{{ $user_network_details[$key]->refferer_speciality }}"
                                                user-summary="{{ $user_network_details[$key]->refferer_summary }}"
                                                referral-time="{{ $user_network_details[$key]->created_at }}">

                                                {{ $user_network_details[$key]->refferer_name }}

                                            </button>

                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-link user-btn" data-toggle="modal" data-target="#myModal"

                                                    user-id="{{ $user_network_details[$key]->vendor_id }}"
                                                    user-name="{{ $user_network_details[$key]->vendor_name }}"
                                                    user-email="{{ $user_network_details[$key]->vendor_email }}"
                                                    user-phone-no ="{{ $user_network_details[$key]->vendor_phone_no }}"  
                                                    user-profile-pic="{{ $user_network_details[$key]->vendor_profile_pic }}"                                            

                                                    user-location="{{ $user_network_details[$key]->vendor_location }}"
                                                    user-position="{{ $user_network_details[$key]->vendor_position }}"
                                                    user-industry="{{ $user_network_details[$key]->vendor_industry }}"
                                                    user-speciality="{{ $user_network_details[$key]->vendor_speciality }}"
                                                    user-summary="{{ $user_network_details[$key]->vendor_summary }}"
                                                    referral-time="{{ $user_network_details[$key]->created_at }}">

                                                {{ $user_network_details[$key]->vendor_name }}

                                            </button>

                                        </td> 

                                        <td>

                                            <button type="button" class="btn btn-link user-btn" data-toggle="modal" data-target="#myModal"

                                                    user-id="{{ $user_network_details[$key]->customer_id }}"
                                                    user-name="{{ $user_network_details[$key]->customer_name }}"
                                                    user-email="{{ $user_network_details[$key]->customer_email }}"
                                                    user--phone-no="{{ $user_network_details[$key]->customer_phone_no }}"
                                                    user-profile-pic="{{ $user_network_details[$key]->customer_profile_pic }}"
                                                    user-location="{{ $user_network_details[$key]->customer_location }}"
                                                    user-position="{{ $user_network_details[$key]->customer_position }}"
                                                    user-industry="{{ $user_network_details[$key]->customer_industry }}"
                                                    user-speciality="{{ $user_network_details[$key]->customer_speciality }}"
                                                    user-summary="{{ $user_network_details[$key]->customer_summary }}"
                                                    referral-time="{{ $user_network_details[$key]->created_at }}">

                                                {{ $user_network_details[$key]->customer_name }}

                                            </button>

                                        </td>

                                        <td>
                                            {{ $user_network_details[$key]->refferer_location }}
                                        </td>

                                        <td>
                                            {{ $user_network_details[$key]->created_at }}
                                        </td>

                                        @if($user_network_details[$key]->status == 2)
                                            <td><span class="label label-primary">Closed</span></td>
                                        @elseif($user_network_details[$key]->status == 1)
                                            <td><span class="label label-success">Active</span></td>
                                        @else
                                            <td><span class="label label-warning">Pending</span></td>
                                        @endif

                                        @if($user_network_details[$key]->who_contacted_first == "No contact made yet.")
                                            <td> <span class="label label-danger"> {{ $user_network_details[$key]->who_contacted_first }} </span> </td>   
                                        @else
                                            <td> {{ $user_network_details[$key]->who_contacted_first }} </td>   
                                        @endif

                                    </tr>

                                @endforeach                                

                                </tbody>

                            </table>

                        </div><!-- /.box-body -->

                    </div><!-- /.box -->

                    <div class="pull-right">                                                                                         
                        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                            <ul class="pagination">                                

                                <?php 
                                if(isset($user_network_details[0]->sort_type))
                                    $sort_type = $user_network_details[0]->sort_type; 
                                else {
                                    $sort_type = 0; 
                                }
                                ?>
                                
                                <li class="paginate_button previous 
                                <?php 
                                    if(isset($user_network_details[0]->page)) { 
                                        if($user_network_details[0]->page==0) { 
                                            echo "disabled"; 
                                        } 
                                    } 
                                ?>" id="example2_previous">
                                    <a href="
                                    @if(isset($user_network_details[0]->page))
                                        @if($user_network_details[0]->page==0) 
                                            {{ URL::to('/') }}/admin/user-network-details/{{ $user_network_details[0]->page }}/{{ $sort_type }}/{{$user_network_details[0]->filter_type}}/{{$user_network_details[0]->filter_value}}
                                        @else 
                                            {{ URL::to('/') }}/admin/user-network-details/{{ $user_network_details[0]->page-1 }}/{{ $sort_type }}/{{$user_network_details[0]->filter_type}}/{{$user_network_details[0]->filter_value}}
                                        @endif
                                    @endif                                    
                                    " aria-controls="example2" data-dt-idx="0" tabindex="0">Previous</a>
                                </li> 

                                @if(isset($user_network_details[0]->page))

                                    @for($i=0; $i<$user_network_details[0]->total_list_pages; $i++)  
                                        <?php $j = $i ?>

                                        <li class="paginate_button <?php if($i==$user_network_details[0]->page) { echo "active"; }  ?>">
                                            <a href="{{ URL::to('/') }}/admin/user-network-details/{{ $i }}/{{ $sort_type }}/{{$user_network_details[0]->filter_type}}/{{$user_network_details[0]->filter_value}}" aria-controls="example2" data-dt-idx="1" tabindex="0"> {{ $j+1 }} </a>
                                        </li>
                                    @endfor
                                @endif

                                <li class="paginate_button next 
                                <?php 
                                    if(isset($user_network_details[0]->page)) {
                                        if($user_network_details[0]->page==($i-1)) { echo "disabled"; } 
                                    }
                                ?>" id="example2_next">
                                    <a href="
                                    @if(isset($user_network_details[0]->page))
                                        @if($user_network_details[0]->page==($i-1)) 
                                            {{ URL::to('/') }}/admin/user-network-details/{{ $user_network_details[0]->page }}/{{ $sort_type }}/{{$user_network_details[0]->filter_type}}/{{$user_network_details[0]->filter_value}}
                                        @else 
                                            {{ URL::to('/') }}/admin/user-network-details/{{ $user_network_details[0]->page+1 }}/{{ $sort_type }}/{{$user_network_details[0]->filter_type}}/{{$user_network_details[0]->filter_value}}
                                        @endif
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