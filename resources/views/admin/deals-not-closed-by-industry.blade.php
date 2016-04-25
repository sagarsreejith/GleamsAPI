@extends('main-layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Deals Not Closed
                <small> Listing</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('/') }}/admin/dashboard"><i class="fa fa-dashboard"></i> Overall</a></li>
                <li class="active">Deals Not Closed Industry</li>
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
                                <a href="{{ URL::to('/') }}/admin/deals-not-closed-by-industry-export" class="btn btn-primary btn-sm active" role="button">Download</a>
                            </div>
                        </div>

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>Sr no</th>
                                    <th>Industry</th>
                                    <th>Deal Not Closed Count</th>                                    
                                    <th>Details</th>
                                </tr>
                                @foreach($deals_not_closed as $key => $value)
                                    <?php
                                        $user_industry = str_replace(' ', '-', $deals_not_closed[$key]->user_industry);
                                    ?>
                                    <tr>
                                        <td> {{ $key+1 }} </td>
                                        <td>
                                            {{ $deals_not_closed[$key]->user_industry}}
                                        </td>
                                        <td>                                            
                                            <small class="label bg-red my-label"> {{ $deals_not_closed[$key]->deal_not_closed_count }} </small>                                            
                                        </td>
                                        <td>
                                            <a href="{{ URL::to('/') }}/admin/deals-not-closed-by-industry/{{ $user_industry }}" class="btn btn-primary" role="button">Details</a>
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