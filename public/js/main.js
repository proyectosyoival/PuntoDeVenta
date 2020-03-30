
const botones = document.querySelectorAll(".bEliminar");

botones.forEach(boton => {

    boton.addEventListener("click", function(){
        const id = this.dataset.id;
        const funcion = this.dataset.function;
        
        const confirm = window.confirm("¿Deseas eliminar el registro?");

        if(confirm){
            // solicitud AJAX
            httpRequest("http://localhost/PuntodeVenta/"+funcion+"/"+ id, function(){
                var respuesta=this.responseText;
                console.log(respuesta);
                if (respuesta==1) {
                    const tbody = document.querySelector("#tbody-general");
                    const fila  = document.querySelector("#fila-" + id);
                    tbody.removeChild(fila);
                    document.querySelector("#respuesta").innerHTML = "REGISTRO ELIMINADO";
                     // document.querySelector(".respuestat").hidden=false;
                }else{
                    document.querySelector("#respuesta").innerHTML = "NO SE ELIMINO EL REGISTRO";
                    // document.querySelector(".respuestaf").hidden=false;
                }

            });
        }
    });
});

function httpRequest(url, callback){
    const http = new XMLHttpRequest();
    http.open("GET", url);
    http.send();

    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            callback.apply(http);
        }
    }
}