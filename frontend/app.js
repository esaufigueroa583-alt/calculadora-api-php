async function calcular(){

    const operador1 =
        document.getElementById("operador1").value;

    const operador2 =
        document.getElementById("operador2").value;

    const operacion =
        document.getElementById("operacion").value;

    const datos = new FormData();

    datos.append("operador1", operador1);

    datos.append("operador2", operador2);

    datos.append("operacion", operacion);

    const respuesta = await fetch(

        "http://localhost/calculadora-api/backend/api.php",

        {
            method: "POST",
            body: datos
        }
    );

    const json = await respuesta.json();

    const resultado =
        document.getElementById("resultado");

    if(json.ok){

        resultado.innerHTML =
            "Resultado: " + json.resultado;

        resultado.style.color = "green";

    }else{

        resultado.innerHTML =
            "Error: " + json.error;

        resultado.style.color = "red";
    }
}