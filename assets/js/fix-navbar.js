document.addEventListener('DOMContentLoaded', function(){
  try{
    var fsBtn = document.querySelector('[data-bs-toggle="fullscreen"]');
    if(!fsBtn) return;
    fsBtn.addEventListener('click', function(e){
      e.preventDefault();
      document.body.classList.toggle('fullscreen-enable');
      if (document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement) {
        if (document.cancelFullScreen) document.cancelFullScreen();
        else if (document.mozCancelFullScreen) document.mozCancelFullScreen();
        else if (document.webkitCancelFullScreen) document.webkitCancelFullScreen();
      } else {
        if (document.documentElement.requestFullscreen) document.documentElement.requestFullscreen();
        else if (document.documentElement.mozRequestFullScreen) document.documentElement.mozRequestFullScreen();
        else if (document.documentElement.webkitRequestFullscreen) document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
      }
    });

    function onFsChange(){
      var enabled = !!(document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement);
      document.body.classList.toggle('fullscreen-enable', enabled);
    }
    document.addEventListener('fullscreenchange', onFsChange);
    document.addEventListener('webkitfullscreenchange', onFsChange);
    document.addEventListener('mozfullscreenchange', onFsChange);
  }catch(e){}
});
