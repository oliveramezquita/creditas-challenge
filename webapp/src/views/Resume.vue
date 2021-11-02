<template>
    <div id="resume">
        <b-breadcrumb :items="items"></b-breadcrumb>
        <h5 class="mt-5">Información registrada</h5>
        <hr>
        <b-row>
            <b-col lg="12">
                <div class="field">
                    <label>Nombre</label>
                    <span>{{ local.name }}</span>
                </div>
                <div class="field">
                    <label>Teléfono</label>
                    <span>{{ local.phone }}</span>
                </div>
                <div class="field">
                    <label>Correo electrónico</label>
                    <span>{{ local.email }}</span>
                </div>
                <div class="field">
                    <label>RFC</label>
                    <span>{{ local.rfc }}</span>
                </div>
                <div class="field">
                    <label>Dirección</label>
                    <span>{{ address }}</span>
                </div>
                <div class="field" v-if="local.type === 'car'">
                    <label>Modelo</label>
                    <span>{{ local.model }}</span>
                </div>
                <div class="field" v-if="local.type === 'car'">
                    <label>Precio</label>
                    <span>{{ local.price }}</span>
                </div>
                <div class="field" v-if="local.type === 'house'">
                    <label>Valor</label>
                    <span>{{ local.value }}</span>
                </div>
                <div class="field" v-if="local.type === 'house'">
                    <label>Dirección de la casa<br>en garantía</label>
                    <span>{{ ag_address }}</span>
                </div>
                <div class="field" v-if="local.type === 'payroll'">
                    <label>Empresa</label>
                    <span>{{ local.company }}</span>
                </div>
                <div class="field" v-if="local.type === 'payroll'">
                    <label>Fecha de ingreso</label>
                    <span>{{ local.date_admission }}</span>
                </div>
                <div class="field">
                    <label>Estatus</label>
                    <span v-bind:class="{ approved: isApproved, rejected: isRejected}">{{ status }}</span>
                </div>
            </b-col>
        </b-row>
        <hr>
        <div class="actions mt-4">
            <b-button variant="success" @click="new_register">Nuevo registro</b-button>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import '../assets/scss/resume.scss'

export default {
  name: 'Resume',
  data() {
      return {
        local: {},
        items: [
            {
                text: 'Inicio',
                href: '/'
            },
            {
                text: 'Resumen',
                active: true
            },
        ]
      }
  },
  computed: {
      address() {
          return this.local.address + ' - ' + this.local.zipcode + ' ' + this.local.city + ', ' + this.local.state
      },
      ag_address() {
          return this.local.ug_address + ' - ' + this.local.ug_zipcode + ' ' + this.local.ug_city + ', ' + this.local.ug_state
      },
      status() {
          return this.local.status === '1' ? 'Rechazada' : 'Aceptada'
      },
      isApproved() {
          return this.local.status === '1' ? false : true
      },
      isRejected() {
          return this.local.status === '1' ? true : false
      }
  },
  methods: {
      new_register() {
          this.$router.push('/').catch(() => {})
      }
  },
  created() {
      axios
        .get(`http://localhost:8000/client/${this.$route.params.client_id}`)
        .then(response => {
          if(response.data.status === 200) {
              this.local = response.data.client
          }
        })
        .catch(error => {
          console.log(error)
          this.errored = true
        })
  }
}
</script>
