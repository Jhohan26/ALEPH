let todo = document.querySelector(".todo");
let mas = document.querySelector(".oeste");
let menos = document.querySelector(".este");

var posicion = 0;
let cadena = "mover_js";

function sumar(){
	posicion = (posicion+1) % 3;
	todo.className = "";
	todo.classList.add("todo");
	todo.classList.add(cadena+posicion);
}
function restar(){
	posicion = (posicion-1) % 3;
	if (posicion < 0){
		posicion = 2;
	}
	todo.className = "";
	todo.classList.add("todo");
	todo.classList.add(cadena+posicion);
}
mas.addEventListener("click",sumar);
menos.addEventListener("click",restar);

setInterval(sumar,4000);