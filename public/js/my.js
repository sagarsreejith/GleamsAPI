$(document).ready(function(){



    $(".user-btn").click(function(){

        var user_id = parseInt($(this).attr('user-id'));
        var user_name = $(this).attr('user-name');
        var user_email = $(this).attr('user-email');
        var user_phone_no = $(this).attr('user-phone-no');
        var user_profile_pic = $(this).attr('user-profile-pic');
        var user_location = $(this).attr('user-location');
        var user_position = $(this).attr('user-position');
        var user_industry = $(this).attr('user-industry');
        var user_speciality = $(this).attr('user-speciality');
        var user_summary = $(this).attr('user-summary');
        var referral_time = $(this).attr('referral-time');

        var html_data = '<div class="box-body box-profile">' +
                '<img class="profile-user-img img-responsive img-circle" src="'+
                user_profile_pic +
                '" alt="User profile picture">' +
                '<h3 class="profile-username text-center">' +
                user_name +
                '</h3>' +
                '<p class="text-muted text-center">' +
                user_position +
               '</p>' +
                '<ul class="list-group list-group-unbordered">' +
                    '<li class="list-group-item">' +
                        '<b>Location</b> <a class="pull-right">' +
                        user_location +
                        '</a>' +
                    '</li>' +
                    '<li class="list-group-item">' +
                        '<b>Email</b> <a class="pull-right">' +
                        user_email +
                        '</a>' +
                    '</li>' +
                    '<li class="list-group-item">' +
                        '<b>Phone no</b> <a class="pull-right">' +
                        user_phone_no +
                        '</a>' +
                    '</li>' +
                    '<li class="list-group-item">' +
                        '<b>Position</b> <a class="pull-right">' +
                        user_position +
                        '</a>' +
                    '</li>' +
                    '<li class="list-group-item">' +
                        '<b>Industry</b> <a class="pull-right">' +
                        user_industry +
                        '</a>' +
                    '</li>' +
                    '<li class="list-group-item">' +
                        '<b>Speciality</b> <a class="pull-right">' +
                        user_speciality +
                        '</a>' +
                    '</li>' +
                    '<li class="list-group-item">' +
                        '<b>Summary</b> <a class="pull-right">' +
                        user_summary +
                        '</a>' +
                    '</li>' +
                    '<li class="list-group-item">' +
                        '<b>Time Referral Made</b> <a class="pull-right">' +
                        referral_time +
                        '</a>' + 
                    '</li>' +
                '</ul>' +
            '</div><!-- /.box-body -->';

        $(".place-modal-content").html(html_data);

    });


    $(".meeting-detail-btn").click(function(){

        var user_id_1 = parseInt($(this).attr('user-id-1'));
        var user_id_1_name = $(this).attr('user-id-1-name');
        var user_id_1_profile_pic = $(this).attr('user-id-1-profile-pic');
        var user_id_1_type = $(this).attr('user-id-1-type');
        var user_id_1_location = $(this).attr('user-id-1-location');
        var user_id_1_position = $(this).attr('user-id-1-position');
        var user_id_1_industry = $(this).attr('user-id-1-industry');

        var user_id_2 = parseInt($(this).attr('user-id-2'));
        var user_id_2_name = $(this).attr('user-id-2-name');
        var user_id_2_profile_pic = $(this).attr('user-id-2-profile-pic');
        var user_id_2_type = $(this).attr('user-id-2-type');
        var user_id_2_location = $(this).attr('user-id-2-location');
        var user_id_2_position = $(this).attr('user-id-2-position');
        var user_id_2_industry = $(this).attr('user-id-2-industry');

        var title = $(this).attr('title');
        var description = $(this).attr('description');
        var datetime = $(this).attr('datetime');
        var location = $(this).attr('location');
        var message = $(this).attr('message');
        var prev_meeting_datetime = $(this).attr('prev-meeting-datetime');
        var reschedule_count = $(this).attr('reschedule-count');
        var deal_status = $(this).attr('deal-status');

        var html_data = '<div class="row">' +
            '<div class="col-sm-6">' +
        '<div class="box-body box-profile">' +
        '<img class="profile-user-img img-responsive img-circle" src="' +
            user_id_1_profile_pic +
        '" alt="User profile picture">' +
        '<h3 class="profile-username text-center">' +
            user_id_1_name +
        '</h3>' +
        '<p class="text-muted text-center">' +
            user_id_1_type +
        '</p>' +

        '<ul class="list-group list-group-unbordered">' +
        '<li class="list-group-item">' +
        '<b>Location</b> <a class="pull-right">' +
            user_id_1_location +
        '</a>' +
        '</li>' +
        '<li class="list-group-item">' +
        '<b>Position</b> <a class="pull-right">' +
            user_id_1_position +
        '</a>' +
        '</li>' +
        '<li class="list-group-item">' +
        '<b>Industry</b> <a class="pull-right">' +
            user_id_1_industry +
        '</a>' +
        '</li>' +
        '</ul>' +
        '</div><!-- /.box-body -->' +
        '</div>' +

        '<div class="col-sm-6">' +
        '<div class="box-body box-profile">' +
        '<img class="profile-user-img img-responsive img-circle" src="' +
            user_id_2_profile_pic +
        '" alt="User profile picture">' +
        '<h3 class="profile-username text-center">' +
            user_id_2_name +
        '</h3>' +
        '<p class="text-muted text-center">' +
            user_id_2_type +
        '</p>' +

        '<ul class="list-group list-group-unbordered">' +
        '<li class="list-group-item">' +
        '<b>Location</b> <a class="pull-right">' +
            user_id_2_location +
        '</a>' +
        '</li>' +
        '<li class="list-group-item">' +
        '<b>Position</b> <a class="pull-right">' +
            user_id_2_position +
        '</a>' +
        '</li>' +
        '<li class="list-group-item">' +
        '<b>Industry</b> <a class="pull-right">' +
            user_id_2_industry +
        '</a>' +
        '</li>' +
        '</ul>' +
        '</div><!-- /.box-body -->' +
        '</div>' +
        '</div>' +



        '<div class="row">' +
        '<div class="col-sm-12">' +
        '<div class="box box-primary">' +
        '<div class="box-header with-border">' +
        '<h3 class="box-title">More Details</h3>' +
        '</div><!-- /.box-header -->' +
        '<div class="box-body">' +

        '<div class="row">' +
        '<div class="col-sm-4">' +
        '<strong><i class="fa fa-file-text-o margin-r-5"></i> Title</strong>' +
        '<p>' +
            title +
        '</p>' +
        '</div>' +
        '<div class="col-sm-4">' +
        '<strong><i class="fa fa-file-text-o margin-r-5"></i> Time</strong>' +
        '<p>' +
            datetime +
        '</p>' +
        '</div>' +
        '<div class="col-sm-4">' +
        '<strong><i class="fa fa-file-text-o margin-r-5"></i> Location</strong>' +
        '<p>' +
            location +
        '</p>' +
        '</div>' +
        '</div>' +
        '<hr>' +

        '<div class="row">' +
        '<div class="col-sm-4">' +
        '<strong><i class="fa fa-file-text-o margin-r-5"></i> First meeting time</strong>' +
        '<p>' +
            prev_meeting_datetime +
        '</p>' +
        '</div>' +
        '<div class="col-sm-4">' +
        '<strong><i class="fa fa-file-text-o margin-r-5"></i> Number of time meeting rescheduled</strong>' +
        '<p>' +
            reschedule_count +
        '</p>' +
        '</div>' +
        '<div class="col-sm-4">' +
        '<strong><i class="fa fa-file-text-o margin-r-5"></i> Deal Status</strong>' +
        '<p>' +
            deal_status +
        '</p>' +
        '</div>' +
        '</div>' +

        '<hr>' +

        '<strong><i class="fa fa-file-text-o margin-r-5"></i> Description</strong>' +

        '<p>' +

            description +

        '</p>' +



        '<hr>' +

        '<strong><i class="fa fa-file-text-o margin-r-5"></i> Message</strong>' +

        '<p>' +

            message +

        '</p>' +



        '</div><!-- /.box-body -->' +

        '</div>' +

        '</div>' +

        '</div>';

        $(".place-modal-content").html(html_data);

    });

    $(".user-detail-btn").click(function(){
        
        var user_profile_pic = $(this).attr('user-profile-pic');
        var user_name = $(this).attr('user-name');
        var user_position = $(this).attr('user-position');
        var user_speciality = $(this).attr('user-speciality');
        var user_summary = $(this).attr('user-summary');
        var user_referrer_score = $(this).attr('user-referrer-score');
        var user_referral_received = $(this).attr('user-referral-received');
        var user_referral_given = $(this).attr('user-referral-given');
        var user_performance_score = $(this).attr('user-performance-score');
        var user_professional_score = $(this).attr('user-professional-score');
        var user_personal_score = $(this).attr('user-personal-score');
        var user_business_val_reff_score = $(this).attr('user-business-val-reff-score');   
        
        var html_data = '<div class="box-body box-profile">' +
                '<img class="profile-user-img img-responsive img-circle" src="'+
                user_profile_pic +
                '" alt="User profile picture">' +
                '<h3 class="profile-username text-center">' +
                user_name +
                '</h3>' +
                '<p class="text-muted text-center">' +
                user_position +
               '</p>' +
                '<ul class="list-group list-group-unbordered">' +
                    '<li class="list-group-item">' +
                        '<b>Referrar Score</b> <a class="pull-right">' +
                        user_referrer_score +
                        '</a>' +
                    '</li>' +
                    '<li class="list-group-item">' +
                        '<b>User Referral Received</b> <a class="pull-right">' +
                        user_referral_received +
                        '</a>' +
                    '</li>' +
                    '<li class="list-group-item">' +
                        '<b>User Referral Given</b> <a class="pull-right">' +
                        user_referral_given +
                        '</a>' +
                    '</li>' +
                    '<li class="list-group-item">' +
                        '<b>User Performance Score</b> <a class="pull-right">' +
                        user_performance_score +
                        '</a>' +
                    '</li>' +
                    '<li class="list-group-item">' +
                        '<b>User Professional Score</b> <a class="pull-right">' +
                        user_professional_score +
                        '</a>' +
                    '</li>' +
                    '<li class="list-group-item">' +
                        '<b>User Personal Score</b> <a class="pull-right">' +
                        user_performance_score +
                        '</a>' +
                    '</li>' +
                    '<li class="list-group-item">' +
                        '<b>User Business Value Score</b> <a class="pull-right">' +
                        user_business_val_reff_score +
                        '</a>' +
                    '</li>' +                                    
                '</ul>' +
            '</div><!-- /.box-body -->' +

            '<div class="box box-primary">' +
                '<div class="box-header with-border">' +
                  '<h3 class="box-title">More Information</h3>' +
                '</div><!-- /.box-header -->' +
                '<div class="box-body">' +

                    '<strong><i class="fa fa-file-text-o margin-r-5"></i> User Speciality</strong>' +
                    '<p>' +
                    user_speciality +
                    '</p>' +

                  '<strong><i class="fa fa-file-text-o margin-r-5"></i> User Summary</strong>' +
                  '<p>' +
                    user_summary +
                  '</p>' +

                '</div><!-- /.box-body -->' +
              '</div>'

            ;                    

        $(".place-modal-content").html(html_data);

    });

    $(".user-network-filter-btn").click(function() {        

        referrer_name = $(".referrer-name").val();
        vendor_name = $(".vendor-name").val();
        customer_name = $(".customer-name").val();

        page = $(".hidden-page-val").val();
        sort_type = $(".hidden-sort-type").val();

        filter_value = $(".filter-value").val();
        filter_value = $.trim(filter_value);        

        if(filter_value=="") {
            alert("Please provide some value to filter");
        }
        else {

            var filter_value_2 = filter_value.replace(/\ /g, '-');                

            var referrer_name = $('.referrer-name:checked').length > 0;
            var vendor_name = $('.vendor-name:checked').length > 0;
            var customer_name = $('.customer-name:checked').length > 0;     

            //alert(referrer_name+' '+vendor_name+' '+customer_name);

            if(referrer_name == true && vendor_name == false && customer_name == false) {
                filter_type = 1;
            }
            else if(referrer_name == false && vendor_name == true && customer_name == false) {
                filter_type = 2;    
            }
            else if(referrer_name == false && vendor_name == false && customer_name == true) {
                filter_type = 3;    
            }        
            else if(referrer_name == true && vendor_name == true && customer_name == false) {
                filter_type = 4;    
            }
            else if(referrer_name == true && vendor_name == false && customer_name == true) {
                filter_type = 5;    
            }
            else if(referrer_name == false && vendor_name == true && customer_name == true) {
                filter_type = 6;    
            }
            else if(referrer_name == true && vendor_name == true && customer_name == true) {
                filter_type = 7;    
            }    
            else {
                alert("Please select one of the checkbox");
            }    

            //alert(referrer_name+' '+vendor_name+' '+customer_name+' '+page + "/" + sort_type + "/" + filter_type + "/" +filter_value);        

            // alert(window.location.protocol + "//" + window.location.host + "/admin/user-network-details/" + page + "/" + sort_type + "/" + filter_type + "/" +filter_value);

            window.location.href = window.location.protocol + "//" + window.location.host + "/admin/user-network-details/0/0/" + filter_type + "/" +filter_value_2;

        }

    });

    
    $(".user-meeting-filter-btn").click(function() {         

        meeting_made_by_name = $(".meeting_made_by_name").val();
        meeting_made_to_name = $(".meeting_made_to_name").val();
        location = $(".location").val();

        page = $(".hidden-page-val").val();
        sort_type = $(".hidden-sort-type").val();

        filter_value = $(".filter-value").val();
        filter_value = $.trim(filter_value);     



        if(filter_value=="") {
            alert("Please provide some value to filter");
        }
        else {

            var filter_value_2 = filter_value.replace(/\ /g, '-');                

            var meeting_made_by_name = $('.meeting_made_by_name:checked').length > 0;
            var meeting_made_to_name = $('.meeting_made_to_name:checked').length > 0;
            var location = $('.location:checked').length > 0;     

            // alert(meeting_made_by_name+' '+meeting_made_to_name+' '+location);

            if(meeting_made_by_name == true && meeting_made_to_name == false && location == false) {
                filter_type = 1;
            }
            else if(meeting_made_by_name == false && meeting_made_to_name == true && location == false) {
                filter_type = 2;    
            }
            else if(meeting_made_by_name == false && meeting_made_to_name == false && location == true) {
                filter_type = 3;    
            }        
            else if(meeting_made_by_name == true && meeting_made_to_name == true && location == false) {
                filter_type = 4;    
            }
            else if(meeting_made_by_name == true && meeting_made_to_name == false && location == true) {
                filter_type = 5;    
            }
            else if(meeting_made_by_name == false && meeting_made_to_name == true && location == true) {
                filter_type = 6;    
            }
            else if(meeting_made_by_name == true && meeting_made_to_name == true && location == true) {
                filter_type = 7;    
            }    
            else {
                alert("Please select one of the checkbox");
            }    

            //alert(referrer_name+' '+vendor_name+' '+customer_name+' '+page + "/" + sort_type + "/" + filter_type + "/" +filter_value);        

            // alert(window.location.protocol + "//" + window.location.host + "/admin/user-network-details/" + page + "/" + sort_type + "/" + filter_type + "/" +filter_value);

            window.location.href = window.location.protocol + "//" + window.location.host + "/admin/user-meeting-details/0/0/" + filter_type + "/" +filter_value_2;

        }

    });

    $(".user-deal-filter-btn").click(function() {         

        deal_made_by = $(".deal_made_by").val();
        deal_made_to = $(".deal_made_to").val();
        deal_type = $(".deal_type").val();

        page = $(".hidden-page-val").val();
        sort_type = $(".hidden-sort-type").val();

        filter_value = $(".filter-value").val();
        filter_value = $.trim(filter_value);     



        if(filter_value=="") {
            alert("Please provide some value to filter");
        }
        else {

            var filter_value_2 = filter_value.replace(/\ /g, '-');                

            var deal_made_by = $('.deal_made_by:checked').length > 0;
            var deal_made_to = $('.deal_made_to:checked').length > 0;
            var deal_type = $('.deal_type:checked').length > 0;     

            // alert(meeting_made_by_name+' '+meeting_made_to_name+' '+location);

            if(deal_made_by == true && deal_made_to == false && deal_type == false) {
                filter_type = 1;
            }
            else if(deal_made_by == false && deal_made_to == true && deal_type == false) {
                filter_type = 2;    
            }
            else if(deal_made_by == false && deal_made_to == false && deal_type == true) {
                filter_type = 3;    
            }        
            else if(deal_made_by == true && deal_made_to == true && deal_type == false) {
                filter_type = 4;    
            }
            else if(deal_made_by == true && deal_made_to == false && deal_type == true) {
                filter_type = 5;    
            }
            else if(deal_made_by == false && deal_made_to == true && deal_type == true) {
                filter_type = 6;    
            }
            else if(deal_made_by == true && deal_made_to == true && deal_type == true) {
                filter_type = 7;    
            }    
            else {
                alert("Please select one of the checkbox");
            }    

            //alert(referrer_name+' '+vendor_name+' '+customer_name+' '+page + "/" + sort_type + "/" + filter_type + "/" +filter_value);        

            // alert(window.location.protocol + "//" + window.location.host + "/admin/user-network-details/" + page + "/" + sort_type + "/" + filter_type + "/" +filter_value);

            window.location.href = window.location.protocol + "//" + window.location.host + "/admin/user-deal-details/0/0/" + filter_type + "/" +filter_value_2;

        }

    });



});