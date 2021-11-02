<template>
  <div id="home">
    <h2 class="text-center mt-5 mb-3">Technical Challenge</h2>
    <h5 class="text-center mb-4">Selecciona una de las siguientes opciones para generar un nuevo lead:</h5>
    <div class="nav-container">
      <router-link to="/registration/car" @click.stop.prevent>
        <font-awesome-icon icon="car" size="3x" />
        <span>Auto</span>
      </router-link>
      <router-link to="/registration/house" @click.stop.prevent>
        <font-awesome-icon icon="home" size="3x" />
        <span>Casa</span>
      </router-link>
      <router-link to="/registration/payroll" @click.stop.prevent>
        <font-awesome-icon icon="money-check" size="3x" />
        <span>Nómina</span>
      </router-link>
    </div>
  </div>
</template>

<script>
import '../assets/scss/home.scss'

export default {
  name: 'Home'
}
</script>
