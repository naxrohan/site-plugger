jQuery(document).ready(function($) {
	var data = {
		'action': 'site_plugger_action',
		'action_step': ajax_object.run_type[0]      // We pass php values differently!
	};
	
        jQuery("#start-scan").click( function(){
        
        jQuery("#scan-status").html("running....");
            jQuery.post(
                ajax_object.ajax_url, 
                data, 
                function(response) {
                    response = jQuery.parseJSON(response);
                    if(response.flag == 'true'){

                        alert('Error Received:' + response.error);

                        jQuery("#scan-status").html(response.error);

                    }else if(response.flag == 'false') {

                        alert('Success Received:' + response.success);

                        jQuery("#scan-status").html(response.success);
                    }
 
                    console.log(response);
//                    console.log(response.error);
                }
            ).fail(function(response) {
                alert( "connection error" );
                jQuery("#scan-status").html(response);
                console.log(response);
            });
        });
        
        jQuery("#next-step").click(function () {
            
            var data2 = {
                'action': 'site_plugger_action',
                'action_step': ajax_object.run_type[1]
            };
            jQuery("#scan-status").html("....Checking log file ...");
            alert("....Checking log file ...");
            jQuery.post(
                    ajax_object.ajax_url,
                    data2,
                    function (response) {
                        response = jQuery.parseJSON(response);
                        
                        jQuery("#scan-status").html(response.success);

                        alert('Success Received:' + response.success);

                        window.location = window.origin + "/wp-admin/admin.php?page=site-plugger-admin&tab=saver";
                    })
                    .fail(function (response) {
                        alert("connection error");
                        jQuery("#scan-status").html(response);
                        console.log(response);
                    });


        });
        
	
});
