jQuery(document).ready(function($) {
	var data = {
		'action': 'site_plugger_action',
		'whatever': ajax_object.we_value      // We pass php values differently!
	};
	
        jQuery("#start-scan").click( function(){
        
            jQuery.post(ajax_object.ajax_url, data, function(response) {
		alert('Got this from the server: ' + response);
		alert(ajax_object.ajax_url);
            });
        });
        
	
});
