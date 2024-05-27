document.addEventListener('DOMContentLoaded', function(){
	var video = document.getElementsByTagName('video')[0];
	var ultimo_tiempo = 0;
	var boton = document.querySelector(".oeste");


	video.addEventListener('timeupdate', function(){
		if (video.currentTime > ultimo_tiempo + 0.6){
			video.currentTime = ultimo_tiempo;
		}
		else{
			ultimo_tiempo = video.currentTime;
		}

		if (video.currentTime > video.duration * 0.95){
			boton.removeAttribute("disabled");
			boton.classList.remove("desactivado");
		}
		else{
			boton.classList.add("desactivado");
			boton.setAttribute("disabled", "disabled");
		}
	});

	video.addEventListener('seeking', function(){
		if (video.currentTime > ultimo_tiempo){
			video.currentTime = ultimo_tiempo;
		}
	});
});