@extends('main-layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Strongest Referrer
                <small> Listing</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('/') }}/admin/dashboard"><i class="fa fa-dashboard"></i> Overall</a></li>
                <li class="active">Strongest Referrer</li>
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
                                <a href="{{ URL::to('/') }}/admin/strongest-referrer-export" class="btn btn-primary btn-sm active" role="button">Download</a>
                            </div>
                        </div>

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>Sr no</th>
                                    <th>User Name</th>
                                    <th>Power</th>                                    
                                    <th>Details</th>
                                </tr>
                                @foreach($strongest_referrer as $key => $value)
                                    <?php
                                        $user_id = str_replace(' ', '-', $strongest_referrer[$key]->user_id);
                                    ?>
                                    <tr>
                                        <td> {{ $key+1 }} </td>
                                        <td>
                                            {{ $strongest_referrer[$key]->user_name}}
                                        </td>
                                        <td>                                            
                                            <small class="label bg-red my-label"> {{ $strongest_referrer[$key]->power }} </small>                                            
                                        </td>
                                        <td>
                                            <a href="{{ URL::to('/') }}/admin/strongest-referrer/{{ $user_id }}" class="btn btn-primary" role="button">Details</a>
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