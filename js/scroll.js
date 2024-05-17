var scroll = document.querySelectorAll(".scroll");

scroll.forEach(indice => {
	indice.setAttribute("data-animated", true);
	let elemento = indice.querySelector(".elementos");
	let contenido = Array.from(elemento.children);

	contenido.forEach(linea => {
		let duplicado = linea.cloneNode(true);
		duplicado.setAttribute("aria-hidden", true);
		elemento.appendChild(duplicado);
	});
});