<script setup>

import { ref } from 'vue'

const operador1 = ref('')
const operador2 = ref('')
const operacion = ref('suma')

const resultado = ref('')
const color = ref('black')

async function calcular() {

  try {

    const respuesta = await fetch(
      'http://localhost/calculadora-api/backend/api.php',
      {
        method: 'POST',

        headers: {
          'Content-Type': 'application/json'
        },

        body: JSON.stringify({
          operador1: operador1.value,
          operador2: operador2.value,
          operacion: operacion.value
        })
      }
    )

    const json = await respuesta.json()

    console.log(json)

    if (json.ok) {

      resultado.value =
        'Resultado: ' + json.resultado

      color.value = 'green'

    } else {

      resultado.value =
        'Error: ' + json.error

      color.value = 'red'
    }

  } catch (error) {

    resultado.value =
      'Error al conectar con la API'

    color.value = 'red'

    console.log(error)
  }
}

</script>

<template>

  <div class="contenedor">

    <h1>Calculadora Vue + PHP</h1>

    <input
      v-model="operador1"
      type="text"
      placeholder="Operador 1"
    >

    <input
      v-model="operador2"
      type="text"
      placeholder="Operador 2"
    >

    <select v-model="operacion">

      <option value="suma">
        Suma
      </option>

      <option value="resta">
        Resta
      </option>

      <option value="multiplicacion">
        Multiplicación
      </option>

      <option value="division">
        División
      </option>

    </select>

    <button @click="calcular">
      Calcular
    </button>

    <p :style="{ color: color }">
      {{ resultado }}
    </p>

  </div>

</template>

<style>

body {

  background: #f2f2f2;

  font-family: Arial;
}

.contenedor {

  width: 350px;

  margin: 50px auto;

  background: white;

  padding: 20px;

  border-radius: 10px;

  box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
}

input,
select,
button {

  width: 100%;

  padding: 10px;

  margin-top: 10px;

  box-sizing: border-box;
}

button {

  background: blue;

  color: white;

  border: none;

  cursor: pointer;
}

button:hover {

  background: darkblue;
}

p {

  margin-top: 20px;

  font-weight: bold;
}

</style>