let datos = document.querySelectorAll(".dato");

for (let dato of datos){
	dato.addEventListener("input", function() {
		if (this.value == ""){
			this.classList.remove("lleno");
		}
		else{
			this.classList.add("lleno");
		}
	});
}

let ojo = document.getElementById("ojo");
let contra = document.getElementById("contra");

ojo.addEventListener("click", function() {
	if (contra.getAttribute("type") == "text"){
		contra.setAttribute("type", "password");
		this.classList.add("fa-eye");
		this.classList.remove("fa-eye-slash");
	}
	else{
		contra.setAttribute("type", "text");
		this.classList.add("fa-eye-slash");
		this.classList.remove("fa-eye");
	}
});
function cerrar(){
	let modal = document.getElementById("dialogo");
	modal.style.display = "none";
}