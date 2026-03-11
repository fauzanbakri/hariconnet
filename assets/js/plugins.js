(function(){
	var need = document.querySelector("[toast-list]") || document.querySelector("[data-choices]") || document.querySelector("[data-provider]");
	if (!need) return;
	var scripts = [
		'https://cdn.jsdelivr.net/npm/toastify-js',
		'assets/libs/choices.js/public/assets/scripts/choices.min.js',
		'assets/libs/flatpickr/flatpickr.min.js'
	];
	scripts.forEach(function(src){
		try{
			var s = document.createElement('script');
			s.type = 'text/javascript';
			s.src = src;
			s.async = false;
			document.head.appendChild(s);
		}catch(e){}
	});
})();