@extends('main-layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Most Referral User
                <small> Listing</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('/') }}/admin/dashboard"><i class="fa fa-dashboard"></i> Overall</a></li>                
                <li class="active"> Most Referral User</li>
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
                                <a href="{{ URL::to('/') }}/admin/most-referral-user-export" class="btn btn-primary btn-sm active" role="button">Download</a>
                            </div>
                        </div>

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>Sr no</th>
                                    <th>Referrer Name</th>
                                    <th>No of Referral</th>                                    
                                    <th>Details</th>
                                </tr>
                                @foreach($most_referral_user as $key => $value)
                                    <?php
                                        $refferer_id_2 = str_replace(' ', '-', $most_referral_user[$key]->refferer_id_2);
                                    ?>
                                    <tr>
                                        <td> {{ $key+1 }} </td>
                                        <td>
                                            {{ $most_referral_user[$key]->user_name}}
                                        </td>
                                        <td>                                            
                                            <small class="label bg-red my-label"> {{ $most_referral_user[$key]->most_referral_user }} </small>                                            
                                        </td>
                                        <td>
                                            <a href="{{ URL::to('/') }}/admin/most-referral-user/{{ $refferer_id_2 }}" class="btn btn-primary" role="button">Details</a>
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