(function( $ ) {
	'use strict';

	//Javascript GET cookie parameter
	var $_GET = {};
	document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
	    function decode(s) {
	        return decodeURIComponent(s.split("+").join(" "));
	    }

	    $_GET[decode(arguments[1])] = decode(arguments[2]);
	});

	// Get time var defined in woo backend
	var $time = parseInt(skyfort_sys_ref.timee);
	//If raf is set, add cookie.
	if( typeof $_GET["ref"] !== 'undefined' && $_GET["ref"] !== null ){
		//console.log(window.location.hostname);
		cookie.set("skyfort_sys_ref",$_GET["ref"],{ expires: $time, path:'/' });
	}

})( jQuery );
