(function(){
	// include [data-toast] so Toastify is loaded when elements use data-toast attributes
	var need = document.querySelector("[toast-list]") || document.querySelector("[data-toast]") || document.querySelector("[data-choices]") || document.querySelector("[data-provider]");
	if (!need) return;

	function loadScript(src, onload, onerror){
		try{
			var s = document.createElement('script');
			s.type = 'text/javascript';
			s.src = src;
			s.async = false;
			if (onload) s.onload = onload;
			if (onerror) s.onerror = onerror;
			document.head.appendChild(s);
			return s;
		}catch(e){ if (onerror) onerror(e); }
	}

	// Load Toastify from CDN first; on error fallback to local copy
	loadScript('https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.js', null, function(){
		loadScript('assets/libs/toastify/toastify.min.js');
	});

	// Load other scripts
	loadScript('assets/libs/choices.js/public/assets/scripts/choices.min.js');
	loadScript('assets/libs/flatpickr/flatpickr.min.js');
})();