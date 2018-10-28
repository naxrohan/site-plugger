jQuery(document).ready(function($) {
	var data = {
		'action': 'site_plugger_action',
		'action_step': ajax_object.run_type[0]      // We pass php values differently!
	};
	
        jQuery("#start-scan").click( function(){
        
            jQuery.post(
                ajax_object.ajax_url, 
                data, 
                function(response) {
                    response = jQuery.parseJSON(response);
                    
                    alert('Got this from the server: ' + response);
                    console.log(response);
                    console.log(response.error);
                }
            ).fail(function(response) {
                alert( "connection error" );
                console.log(response);
            });
        });
        
	
});
