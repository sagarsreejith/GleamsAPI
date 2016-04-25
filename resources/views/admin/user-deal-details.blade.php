@extends('main-layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Pending & Closed Deals
                <small>Networth</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('/') }}/admin/dashboard"><i class="fa fa-dashboard"></i> Overall</a></li>                
                <li class="active">Pending & Closed Deals</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">

                        <div class="box-header">
                            <div class="row">

                                <div class="col-lg-4 col-md-4 col-sm-2">
                                    <h3 class="box-title">Deals</h3>
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
                                                        if(isset($user_deal_details[0]->page)) {
                                                            echo URL::to('/admin/user-deal-details').'/'.$user_deal_details[0]->page.'/0/'.$user_deal_details[0]->filter_type.'/'.$user_deal_details[0]->filter_value;
                                                        }
                                                    ?>">None</a></li>
                                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php 
                                                        if(isset($user_deal_details[0]->page)) {
                                                            echo URL::to('/admin/user-deal-details').'/'.$user_deal_details[0]->page.'/1/'.$user_deal_details[0]->filter_type.'/'.$user_deal_details[0]->filter_value;
                                                        }
                                                    ?>">Deal Made By</a></li>
                                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php 
                                                        if(isset($user_deal_details[0]->page)) {
                                                            echo URL::to('/admin/user-deal-details').'/'.$user_deal_details[0]->page.'/2/'.$user_deal_details[0]->filter_type.'/'.$user_deal_details[0]->filter_value;
                                                        }
                                                    ?>">Deal Made To</a></li>
                                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php 
                                                        if(isset($user_deal_details[0]->page)) {
                                                            echo URL::to('/admin/user-deal-details').'/'.$user_deal_details[0]->page.'/3/'.$user_deal_details[0]->filter_type.'/'.$user_deal_details[0]->filter_value;
                                                        }
                                                    ?>">Amount</a></li>
                                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php 
                                                        if(isset($user_deal_details[0]->page)) {
                                                            echo URL::to('/admin/user-deal-details').'/'.$user_deal_details[0]->page.'/4/'.$user_deal_details[0]->filter_type.'/'.$user_deal_details[0]->filter_value;
                                                        }
                                                    ?>">Status</a></li>
                                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php 
                                                        if(isset($user_deal_details[0]->page)) {
                                                            echo URL::to('/admin/user-deal-details').'/'.$user_deal_details[0]->page.'/5/'.$user_deal_details[0]->filter_type.'/'.$user_deal_details[0]->filter_value;
                                                        }
                                                    ?>">Deal Type</a></li>
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
                                                                  <input type="checkbox" value="deal_made_by" class="deal_made_by" 
                                                                    <?php
                                                                    if(isset($user_deal_details[0]->filter_type)) {
                                                                        if($user_deal_details[0]->filter_type == 1 || 
                                                                            $user_deal_details[0]->filter_type == 4 || 
                                                                            $user_deal_details[0]->filter_type == 5 ||
                                                                            $user_deal_details[0]->filter_type == 7) {
                                                                            echo "checked";
                                                                        }
                                                                    }                                                                        
                                                                    ?> 
                                                                  >
                                                                  Deal Made By
                                                                </label>
                                                              </div>

                                                              <div class="checkbox my-checkbox">
                                                                <label>
                                                                  <input type="checkbox" value="deal_made_to" class="deal_made_to"
                                                                    <?php 
                                                                    if(isset($user_deal_details[0]->filter_type)) {
                                                                        if($user_deal_details[0]->filter_type == 2 || 
                                                                            $user_deal_details[0]->filter_type == 4 ||
                                                                            $user_deal_details[0]->filter_type == 6 ||
                                                                            $user_deal_details[0]->filter_type == 7) {
                                                                            echo "checked";
                                                                        }
                                                                    }       
                                                                    ?>
                                                                  >
                                                                  Deal Made To
                                                                </label>
                                                              </div>

                                                              <div class="checkbox my-checkbox">
                                                                <label>
                                                                  <input type="checkbox" value="deal_type" class="deal_type"
                                                                    <?php 
                                                                    if(isset($user_deal_details[0]->filter_type)) {
                                                                        if($user_deal_details[0]->filter_type == 3 || 
                                                                            $user_deal_details[0]->filter_type == 5 ||
                                                                            $user_deal_details[0]->filter_type == 6 ||
                                                                            $user_deal_details[0]->filter_type == 7) {
                                                                            echo "checked";
                                                                        }
                                                                    }
                                                                    ?>
                                                                  >
                                                                  Deal Type
                                                                </label>
                                                              </div>

                                                            </div>

                                                        </ul> 
                                                    </div><!-- /btn-group -->                                                    
                                                    <input type="text" class="form-control filter-value" value="<?php
                                                    if(isset($user_deal_details[0]->filter_value)) {
                                                        if($user_deal_details[0]->filter_value=="0") {
                                                            echo "";
                                                        }
                                                        else {
                                                            echo $user_deal_details[0]->filter_value;    
                                                        }
                                                    }                                                          
                                                    ?> ">
                                                    <input type="hidden" class="hidden-page-val" value="<?php echo isset($user_deal_details[0]->page) ? $user_deal_details[0]->page : ""; ?>" >        
                                                    <input type="hidden" class="hidden-sort-type" value="<?php echo isset($user_deal_details[0]->sort_type) ? $user_deal_details[0]->sort_type : ""; ?>" >                                                                                    
                                                </div>    
                                            </div>
                                            <div class="col-xs-4">
                                                <button type="submit" class="btn btn-primary btn-sm user-deal-filter-btn">Filter</button>                                        
                                            </div>
                                        </div>                                                                                                                    
                                    
                                    </div>
                                </div>

                                <div class="col-sm-2"> 

                                    <a href="
                                    @if(isset($user_deal_details[0]->filter_type) && isset($user_deal_details[0]->filter_value))
                                        {{ URL::to('/') }}/admin/user-deal-details-export/{{$user_deal_details[0]->filter_type}}/{{$user_deal_details[0]->filter_value}}" class="btn btn-primary btn-sm active
                                    @else
                                        {{ URL::to('/') }}/admin/user-deal-details-export/0/0" class="btn btn-primary btn-sm active
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
                                        <td>{{ $user_deal_details[$key]->serial_no }}</td>
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

                    <div class="pull-right">                                                                                         
                        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                            <ul class="pagination">                                

                                <?php 
                                if(isset($user_deal_details[0]->sort_type))
                                    $sort_type = $user_deal_details[0]->sort_type; 
                                else {
                                    $sort_type = 0; 
                                }
                                ?>
                                
                                <li class="paginate_button previous 
                                <?php 
                                    if(isset($user_deal_details[0]->page)) { 
                                        if($user_deal_details[0]->page==0) { 
                                            echo "disabled"; 
                                        } 
                                    } 
                                ?>" id="example2_previous">
                                    <a href="
                                    @if(isset($user_deal_details[0]->page))
                                        @if($user_deal_details[0]->page==0) 
                                            {{ URL::to('/') }}/admin/user-deal-details/{{ $user_deal_details[0]->page }}/{{ $sort_type }}/{{$user_deal_details[0]->filter_type}}/{{$user_deal_details[0]->filter_value}}
                                        @else 
                                            {{ URL::to('/') }}/admin/user-deal-details/{{ $user_deal_details[0]->page-1 }}/{{ $sort_type }}/{{$user_deal_details[0]->filter_type}}/{{$user_deal_details[0]->filter_value}}
                                        @endif
                                    @endif                                    
                                    " aria-controls="example2" data-dt-idx="0" tabindex="0">Previous</a>
                                </li> 

                                @if(isset($user_deal_details[0]->page))

                                    @for($i=0; $i<$user_deal_details[0]->total_list_pages; $i++)  
                                        <?php $j = $i ?>

                                        <li class="paginate_button <?php if($i==$user_deal_details[0]->page) { echo "active"; }  ?>">
                                            <a href="{{ URL::to('/') }}/admin/user-deal-details/{{ $i }}/{{ $sort_type }}/{{$user_deal_details[0]->filter_type}}/{{$user_deal_details[0]->filter_value}}" aria-controls="example2" data-dt-idx="1" tabindex="0"> {{ $j+1 }} </a>
                                        </li>
                                    @endfor
                                @endif

                                <li class="paginate_button next 
                                <?php 
                                    if(isset($user_deal_details[0]->page)) {
                                        if($user_deal_details[0]->page==($i-1)) { echo "disabled"; } 
                                    }
                                ?>" id="example2_next">
                                    <a href="
                                    @if(isset($user_deal_details[0]->page))
                                        @if($user_deal_details[0]->page==($i-1)) 
                                            {{ URL::to('/') }}/admin/user-deal-details/{{ $user_deal_details[0]->page }}/{{ $sort_type }}/{{$user_deal_details[0]->filter_type}}/{{$user_deal_details[0]->filter_value}}
                                        @else 
                                            {{ URL::to('/') }}/admin/user-deal-details/{{ $user_deal_details[0]->page+1 }}/{{ $sort_type }}/{{$user_deal_details[0]->filter_type}}/{{$user_deal_details[0]->filter_value}}
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