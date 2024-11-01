window.addEventListener("load", function() {
    // Agrega la clase para suavizar la desaparición
    document.getElementById("preloader").classList.add("hidden");
    
    // Muestra el contenido de la página después de la transición
    setTimeout(function() {
        document.getElementById("preloader").style.display = "none";
        document.getElementById("contenido").style.display = "block";
    }, 1000); // Duración en milisegundos de la transición
});
