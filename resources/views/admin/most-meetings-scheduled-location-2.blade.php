@extends('main-layout')



@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Locations Scheduling Most Meetings
                <small> Listing</small>
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
                                <a href="{{ URL::to('/') }}/admin/location-scheduling-most-meetings-export" class="btn btn-primary btn-sm active" role="button">Download</a>
                            </div>
                        </div>

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>Sr no</th>
                                    <th>Location</th>
                                    <th>No of meetings</th>                                    
                                    <th>Details</th>
                                </tr>
                                @foreach($location_meeting_details as $key => $value)

                                    <?php
                                        $meeting_location = str_replace(' ', '-', $location_meeting_details[$key]->meeting_location);
                                    ?>

                                    <tr>
                                        <td> {{ $key+1 }} </td>
                                        <td>
                                            {{ $location_meeting_details[$key]->meeting_location }}
                                        </td>
                                        <td>                                            
                                            <small class="label bg-red my-label"> {{ $location_meeting_details[$key]->meeting_count }} </small>                                            
                                        </td>
                                        <td>
                                            <a href="{{ URL::to('/') }}/admin/location-scheduling-most-meetings/{{ $meeting_location }}" class="btn btn-primary" role="button">Details</a>
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