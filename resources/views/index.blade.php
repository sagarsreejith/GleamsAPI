@extends('main-layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Overall
                <small>Name Networth</small>
            </h1>
            <ol class="breadcrumb">
                {{-- <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li> --}}
                {{-- <li class="active">Overall</li> --}}
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">                        

            <div class="box box-default">
              <div class="box-header with-border">
                <i class="fa fa-codepen"></i>
                <h3 class="box-title">Users</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
              
                <div class="row">        

                  <!-- X number of active users 6 -->
                  <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-olive my-dash-box">
                      <div class="inner my-dash-box-2">       
                        @if(isset($dashboard_details[6][0]->total_active_user_count))               
                          <a href="{{ URL::to('/') }}/admin/user-profile-listing" class="modify-anchor">
                            <h3> {{$dashboard_details[6][0]->total_active_user_count}} </h3>
                            <p>
                              Active Users                            
                            </p>
                          </a>
                        @endif                          
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        <!-- More info <i class="fa fa-arrow-circle-right"></i> -->
                      </a>
                    </div>
                  </div><!-- ./col -->   

                  <!-- X user is the strongest referrer 11 -->
                  <div class="col-lg-4 col-xs-6">
                    <!-- small box -->                  
                    <div class="small-box bg-purple my-dash-box">
                      <div class="inner my-dash-box-2">    
                        @if(isset($dashboard_details[11][0]->power))                      
                          <a href="{{ URL::to('/') }}/admin/strongest-referrer" class="modify-anchor">
                            <h3> {{$dashboard_details[11][0]->power}} </h3>   
                            <p>
                              {{$dashboard_details[11][0]->user_name}} user is the strongest referrer
                            </p>
                          </a>
                        @endif
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        <!-- More info <i class="fa fa-arrow-circle-right"></i> -->
                      </a>
                    </div>
                  </div><!-- ./col -->               

                  <!-- X user has scheduled the most meetings 0 -->
                  <div class="col-lg-4 col-xs-6">
                    <!-- small box -->                  
                    <div class="small-box bg-aqua my-dash-box">
                      <div class="inner my-dash-box-2">
                        @if(isset($dashboard_details[0][0]->meeting_count))
                          <a href="{{ URL::to('/') }}./admin/user-scheduling-most-meetings" class="modify-anchor">
                            <h3> {{$dashboard_details[0][0]->meeting_count}} </h3>
                            <p>
                              {{$dashboard_details[0][0]->username}} has scheduled most meeting 
                              &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                            </p>
                          </a>
                        @endif
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        <!-- More info <i class="fa fa-arrow-circle-right"></i> -->
                      </a>
                    </div>
                  </div><!-- ./col -->                 

                  <!-- X user has made the most referrals 9 -->
                  <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow my-dash-box">
                      <div class="inner my-dash-box-2">                      
                        @if(isset($dashboard_details[9][0]->most_referral_user))
                          <a href="{{ URL::to('/') }}./admin/most-referral-user" class="modify-anchor">
                            <h3> {{$dashboard_details[9][0]->most_referral_user}} </h3>
                            <p>
                              {{$dashboard_details[9][0]->user_name}} user has made the most referrals
                              &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            </p>
                          </a>
                        @endif
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        <!-- More info <i class="fa fa-arrow-circle-right"></i> -->
                      </a>
                    </div>
                  </div><!-- ./col -->

                  <!-- X user has been referred the most 10 -->
                  <div class="col-lg-4 col-xs-6">
                    <!-- small box -->                  
                    <div class="small-box bg-red my-dash-box">
                      <div class="inner my-dash-box-2">     
                        @if(isset($dashboard_details[10][0]->referred_count))                 
                          <a href="{{ URL::to('/') }}./admin/most-referred-user" class="modify-anchor">
                            <h3>{{ $dashboard_details[10][0]->referred_count }}</h3>   
                            <p>
                              {{ $dashboard_details[10][0]->user_name }} has been referred the most
                            </p>
                          </a>
                        @endif
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        <!-- More info <i class="fa fa-arrow-circle-right"></i> -->
                      </a>
                    </div>
                  </div><!-- ./col -->                   

                </div>              

              </div><!-- /.box-body -->
            </div>             

            <div class="box box-default">
              <div class="box-header with-border">
                <i class="fa fa-codepen"></i>
                <h3 class="box-title">Industry</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
              
                <div class="row">                                  

                  <!-- X industry is scheduling the most meetings 1 -->
                  <div class="col-lg-4 col-xs-6">
                    <!-- small box -->                  
                    <div class="small-box bg-green my-dash-box">
                      <div class="inner my-dash-box-2">
                        @if(isset($dashboard_details[1][0]->user_industry))                 
                          <?php
                            $user_industry = str_replace(' ', '-', $dashboard_details[1][0]->user_industry);
                          ?>
                          <a href="{{ URL::to('/') }}./admin/industry-scheduling-most-meetings" class="modify-anchor">
                            <h3>{{ $dashboard_details[1][0]->meeting_count }}</h3>
                            <p>
                              {{ $dashboard_details[1][0]->user_industry }} industry is scheduling most meetings                         
                            </p>
                          </a>
                        @endif
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        <!-- More info <i class="fa fa-arrow-circle-right"></i> -->
                      </a>
                    </div>
                  </div><!-- ./col -->

                  <!-- X industry has closed the most deals 5 -->
                  <div class="col-lg-4 col-xs-6">
                    <!-- small box -->                  
                    <div class="small-box bg-navy my-dash-box">
                      <div class="inner my-dash-box-2">               
                        @if(isset($dashboard_details[5][0]->deal_closed_count))         
                          <a href="{{ URL::to('/') }}/admin/industry-closing-most-deals" class="modify-anchor">
                            <h3>{{ $dashboard_details[5][0]->deal_closed_count }}</h3>
                            <p>
                              {{ $dashboard_details[5][0]->user_industry }} industry has closed the most deals
                            </p>
                          </a>
                        @endif
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        <!-- More info <i class="fa fa-arrow-circle-right"></i> -->
                      </a>
                    </div>
                  </div><!-- ./col -->                                  

                </div>                

              </div><!-- /.box-body -->
            </div> 

            <div class="box box-default">
              <div class="box-header with-border">
                <i class="fa fa-codepen"></i>
                <h3 class="box-title">Position</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
              
                <div class="row">                                  

                  <!-- X position is scheduling the most meetings 3 -->
                  <div class="col-lg-4 col-xs-6">
                    <!-- small box -->                  
                    <div class="small-box bg-red my-dash-box">
                      <div class="inner my-dash-box-2">                      
                        @if(isset($dashboard_details[3][0]->meeting_count))         
                          <a href="{{ URL::to('/') }}/admin/position-scheduling-most-meetings" class="modify-anchor">
                            <h3>{{ $dashboard_details[3][0]->meeting_count }}</h3>
                            <p>
                              {{ $dashboard_details[3][0]->user_position }} position is scheduling most meetings                         
                            </p>
                          </a>
                        @endif
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        <!-- More info <i class="fa fa-arrow-circle-right"></i> -->
                      </a>
                    </div>
                  </div><!-- ./col -->

                  <!-- X position/company has closed the most deals 4 -->
                  <div class="col-lg-4 col-xs-6">
                    <!-- small box -->                  
                    <div class="small-box bg-purple">
                      <div class="inner">
                        @if(isset($dashboard_details[4][0]->user_position)) 
                          <?php
                            $most_deal_closed_position = str_replace(' ', '-', $dashboard_details[4][0]->user_position);
                          ?>
                          <a href="{{ URL::to('/') }}/admin/position-closing-most-deals" class="modify-anchor">
                            <h3>{{ $dashboard_details[4][0]->deal_closed_count }}</h3>
                            <p>
                              {{ $dashboard_details[4][0]->user_position }} position has closed most deals
                              &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                            </p>
                          </a>
                        @endif
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        <!-- More info <i class="fa fa-arrow-circle-right"></i> -->
                      </a>
                    </div>
                  </div><!-- ./col -->                                

                </div>                

              </div><!-- /.box-body -->
            </div>  

            <div class="box box-default">
              <div class="box-header with-border">
                <i class="fa fa-codepen"></i>
                <h3 class="box-title">Locations Scheduling Most Meetings</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
              
                <div class="row">                                  

                  <!-- X location is scheduling the most meetings 2 -->
                  <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow my-dash-box">
                      <div class="inner my-dash-box-2">
                        @if(isset($dashboard_details[2][0]->meeting_location)) 
                          <?php
                            $meeting_location = str_replace(' ', '-', $dashboard_details[2][0]->meeting_location);
                          ?>
                          <a href="{{ URL::to('/') }}./admin/location-scheduling-most-meetings" class="modify-anchor">
                            <h3>{{ $dashboard_details[2][0]->meeting_count }}</h3>
                            <p>
                              {{ $dashboard_details[2][0]->meeting_location }} location has most meeting scheduled
                              &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            </p>
                          </a>
                        @endif
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        <!-- More info <i class="fa fa-arrow-circle-right"></i> -->
                      </a>
                    </div>
                  </div><!-- ./col -->                

                </div>                

              </div><!-- /.box-body -->
            </div>  

            <div class="box box-default">
              <div class="box-header with-border">
                <i class="fa fa-codepen"></i>
                <h3 class="box-title">Total Deals</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
              
                <div class="row">                                  

                  <!-- X number of deals have been closed 7 -->
                  <div class="col-lg-4 col-xs-6">
                    <!-- small box -->                  
                    <div class="small-box bg-maroon my-dash-box">
                      <div class="inner my-dash-box-2">
                        @if(isset($dashboard_details[7][0]->total_deals_closed_count)) 
                          <a href="{{ URL::to('/') }}/admin/user-deal-details/1" class="modify-anchor">
                            <h3>{{ $dashboard_details[7][0]->total_deals_closed_count }}</h3>
                            <p>
                              Number of deals have been closed
                            </p>
                          </a>
                        @endif
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        <!-- More info <i class="fa fa-arrow-circle-right"></i> -->
                      </a>
                    </div>
                  </div><!-- ./col -->                                            

                  <!-- X number of deals have been closed by industry 12 -->
                  <div class="col-lg-4 col-xs-6">
                    <!-- small box -->                  
                    <div class="small-box bg-purple my-dash-box">
                      <div class="inner my-dash-box-2">
                        @if(isset($dashboard_details[12][0]->deal_not_closed_count)) 
                          <a href="{{ URL::to('/') }}/admin/deals-not-closed-by-industry" class="modify-anchor">
                            <h3>{{ $dashboard_details[12][0]->deal_not_closed_count }}</h3>
                            <p>
                              Number of deals not been closed by {{ $dashboard_details[12][0]->user_industry }} Industry
                            </p>
                          </a>
                        @endif
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        <!-- More info <i class="fa fa-arrow-circle-right"></i> -->
                      </a>
                    </div>
                  </div><!-- ./col -->     

                  <!-- X number of deals have been closed by position 13 -->
                  <div class="col-lg-4 col-xs-6">
                    <!-- small box -->                  
                    <div class="small-box bg-yellow my-dash-box">
                      <div class="inner my-dash-box-2">
                        @if(isset($dashboard_details[13][0]->deal_not_closed_count)) 
                          <a href="{{ URL::to('/') }}/admin/deals-not-closed-by-position" class="modify-anchor">
                            <h3>{{ $dashboard_details[13][0]->deal_not_closed_count }}</h3>
                            <p>
                              Number of deals not been closed by {{ $dashboard_details[13][0]->user_position }} Position
                            </p>
                          </a>
                        @endif
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        <!-- More info <i class="fa fa-arrow-circle-right"></i> -->
                      </a>
                    </div>
                  </div><!-- ./col -->     

                  <!-- X number of deals have been closed by location 14 -->
                  <div class="col-lg-4 col-xs-6">
                    <!-- small box -->                  
                    <div class="small-box bg-red my-dash-box">
                      <div class="inner my-dash-box-2">
                        @if(isset($dashboard_details[14][0]->deal_not_closed_count)) 
                          <a href="{{ URL::to('/') }}/admin/deals-not-closed-by-location" class="modify-anchor">
                            <h3>{{ $dashboard_details[14][0]->deal_not_closed_count }}</h3>
                            <p>
                              Number of deals not been closed by {{ $dashboard_details[14][0]->user_location }} Location
                            </p>
                          </a>
                        @endif
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        <!-- More info <i class="fa fa-arrow-circle-right"></i> -->
                      </a>
                    </div>
                  </div><!-- ./col -->                                                

                  <!-- X number of deals have been user 15 -->
                  <div class="col-lg-4 col-xs-6">
                    <!-- small box -->                  
                    <div class="small-box bg-navy my-dash-box">
                      <div class="inner my-dash-box-2">
                        @if(isset($dashboard_details[15][0]->deal_not_closed_count)) 
                          <a href="{{ URL::to('/') }}/admin/deals-not-closed-by-user" class="modify-anchor">   
                            <h3>{{ $dashboard_details[15][0]->deal_not_closed_count }}</h3>
                            <p>  
                              Number of deals not been closed by {{ $dashboard_details[15][0]->name }} User
                            </p>
                          </a>
                        @endif
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        <!-- More info <i class="fa fa-arrow-circle-right"></i> -->
                      </a>
                    </div>
                  </div><!-- ./col -->              

                </div>              
  
              </div><!-- /.box-body -->
            </div>             

            <div class="box box-default">
              <div class="box-header with-border">
                <i class="fa fa-codepen"></i> 
                <h3 class="box-title">Total Meetings</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
              
                <div class="row">                                  

                  <!-- X number of meetings have occurred 8 -->
                  <div class="col-lg-4 col-xs-6">
                    <!-- small box -->                  
                    <div class="small-box bg-aqua my-dash-box">
                      <div class="inner my-dash-box-2">
                        @if(isset($dashboard_details[8][0]->total_meeting_count)) 
                          <a href="{{ URL::to('/') }}./admin/user-meeting-details" class="modify-anchor">
                            <h3>{{ $dashboard_details[8][0]->total_meeting_count }}</h3>
                            <p>
                              Number of meetings have occurred 
                              &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                            </p>
                          </a>
                        @endif
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        <!-- More info <i class="fa fa-arrow-circle-right"></i> -->
                      </a>
                    </div>
                  </div><!-- ./col -->                

                </div>                

              </div><!-- /.box-body -->
            </div>             

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

@stop