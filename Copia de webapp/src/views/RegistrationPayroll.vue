<template>
  <div id="registration">
    <b-breadcrumb :items="items"></b-breadcrumb>
    <h5 class="mt-5">Información general</h5>
    <hr>
    <label class="additional-text">Información requerida para el registro</label>
    
    <b-row>
      <b-col lg="6">
          <b-form-group
            id="fieldset-name"
            label="Nombre completo"
            label-for="name"
            class="mt-3">
              <b-form-input id="name" v-model="name" type="text" placeholder="Introduzca su nombre completo"></b-form-input>
          </b-form-group>
      </b-col>
      <b-col lg="6">
        <b-form-group
          id="fieldset-phone"
          label="Teléfono"
          label-for="phone"
          class="mt-3">
          <b-form-input id="phone" v-model="phone" type="text" placeholder="Introduzca su teléfono a diez dígitos" v-on:keypress="isLetterOrNumber($event)"></b-form-input>
        </b-form-group>
      </b-col>
      <b-col lg="6">
        <b-form-group
          id="fieldset-email"
          label="Correo electrónico"
          label-for="email"
          class="mt-3">
          <b-form-input id="email" v-model="email" type="email" placeholder="Introduzca su correo electrónico"></b-form-input>
        </b-form-group>
      </b-col>
      <b-col lg="6">
        <b-form-group
          id="fieldset-rfc"
          label="RFC"
          label-for="rfc"
          class="mt-3">
          <b-form-input id="rfc" v-model="rfc" type="text" placeholder="Introduzca su RFC con homoclave"></b-form-input>
        </b-form-group>
      </b-col>
      <b-col lg="8">
        <b-form-group
          id="fieldset-address"
          label="Domicilio"
          label-for="address"
          class="mt-3">
          <b-form-input id="address" v-model="address" type="text" placeholder="Introduzca su domicilio"></b-form-input>
        </b-form-group>
      </b-col>
      <b-col lg="4">
        <b-form-group
          id="fieldset-zipcode"
          label="Código Postal"
          label-for="zipcode"
          class="mt-3">
          <b-form-input id="zipcode" v-model="zipcode" type="text" placeholder="Introduzca su código postal" v-on:keypress="isLetterOrNumber($event)"></b-form-input>
        </b-form-group>
      </b-col>
      <b-col lg="6">
        <b-form-group
          id="fieldset-city"
          label="Ciudad"
          label-for="city"
          class="mt-3">
          <b-form-input id="city" v-model="city" type="text" placeholder="Introduzca su ciudad"></b-form-input>
        </b-form-group>
      </b-col>
        <b-col lg="6">
          <b-form-group
            id="fieldset-state"
            label="Estado"
            label-for="state"
            class="mt-3">
            <v-select v-model="local_state" :options="states" name="state" label="name" />
          </b-form-group>
      </b-col>
    </b-row>
    <h5 class="mt-5">Información adicional</h5>
    <hr>
    <label class="additional-text">Información requerida de la nómina a dejar en garantía</label>
    <b-row>
      <b-col lg="8">
          <b-form-group
              id="fieldset-company"
              label="Nombre de la empresa"
              label-for="company"
              class="mt-3">
              <b-form-input id="company" v-model="company" type="text" placeholder="Introduzca el nombre de la empresa"></b-form-input>
          </b-form-group>
      </b-col>
      <b-col lg="4">
          <b-form-group
              id="fieldset-date_admission"
              label="Fecha de ingreso"
              label-for="date_admission"
              class="mt-3">
              <b-form-datepicker id="date_admission" placeholder="Selecciona la fecha de ingreso" local="es" v-model="date_admission" />
          </b-form-group>
      </b-col>
      <b-col class="mt-5" v-if="request_errors">
        <b-alert show variant="secondary">
          <label class="alert-heading">Ocurrió un error al momento de ingresar la información:</label>
          <hr>
          <ul v-if="typeof request_errors === 'object' && request_errors !== null">
            <li v-for="(error, index) in request_errors" :key="index">{{error}}</li>
          </ul>
          <p v-if="typeof request_errors === 'string' && request_errors !== null">{{request_errors}}</p>
        </b-alert>
      </b-col>
    </b-row>
    <div class="actions mt-4">
      <b-button variant="secondary" @click="back">Regresar</b-button>
      <b-button variant="success" @click="formSubmitted">Enviar información</b-button>
    </div>
  </div>
</template>

<script>
import vSelect from 'vue-select'
import '../assets/scss/registration.scss'
import axios from 'axios'

export default {
  name: 'Registration',
  components: {
    vSelect,
  },
  data() {
    return {
      name: '',
      phone: '',
      email: '',
      rfc: '',
      address: '',
      zipcode: '',
      city: '',
      state: '',
      company: '',
      date_admission: '',
      states: [
        {
          "id": "1",
          "key": "01",
          "name": "Aguascalientes",
          "shortname": "Ags."
        },
        {
          "id": "2",
          "key": "02",
          "name": "Baja California",
          "shortname": "BC"
        },
        {
          "id": "3",
          "key": "03",
          "name": "Baja California Sur",
          "shortname": "BCS"
        },
        {
          "id": "4",
          "key": "04",
          "name": "Campeche",
          "shortname": "Camp."
        },
        {
          "id": "5",
          "key": "05",
          "name": "Coahuila de Zaragoza",
          "shortname": "Coah."
        },
        {
          "id": "6",
          "key": "06",
          "name": "Colima",
          "shortname": "Col."
        },
        {
          "id": "7",
          "key": "07",
          "name": "Chiapas",
          "shortname": "Chis."
        },
        {
          "id": "8",
          "key": "08",
          "name": "Chihuahua",
          "shortname": "Chih."
        },
        {
          "id": "9",
          "key": "09",
          "name": "Ciudad de México",
          "shortname": "CDMex"
        },
        {
          "id": "10",
          "key": "10",
          "name": "Durango",
          "shortname": "Dgo."
        },
        {
          "id": "11",
          "key": "11",
          "name": "Guanajuato",
          "shortname": "Gto."
        },
        {
          "id": "12",
          "key": "12",
          "name": "Guerrero",
          "shortname": "Gro."
        },
        {
          "id": "13",
          "key": "13",
          "name": "Hidalgo",
          "shortname": "Hgo."
        },
        {
          "id": "14",
          "key": "14",
          "name": "Jalisco",
          "shortname": "Jal."
        },
        {
          "id": "15",
          "key": "15",
          "name": "México",
          "shortname": "Mex."
        },
        {
          "id": "16",
          "key": "16",
          "name": "Michoacán de Ocampo",
          "shortname": "Mich."
        },
        {
          "id": "17",
          "key": "17",
          "name": "Morelos",
          "shortname": "Mor."
        },
        {
          "id": "18",
          "key": "18",
          "name": "Nayarit",
          "shortname": "Nay."
        },
        {
          "id": "19",
          "key": "19",
          "name": "Nuevo León",
          "shortname": "NL"
        },
        {
          "id": "20",
          "key": "20",
          "name": "Oaxaca",
          "shortname": "Oax."
        },
        {
          "id": "21",
          "key": "21",
          "name": "Puebla",
          "shortname": "Pue."
        },
        {
          "id": "22",
          "key": "22",
          "name": "Querétaro",
          "shortname": "Qro."
        },
        {
          "id": "23",
          "key": "23",
          "name": "Quintana Roo",
          "shortname": "Q. Roo"
        },
        {
          "id": "24",
          "key": "24",
          "name": "San Luis Potosí",
          "shortname": "SLP"
        },
        {
          "id": "25",
          "key": "25",
          "name": "Sinaloa",
          "shortname": "Sin."
        },
        {
          "id": "26",
          "key": "26",
          "name": "Sonora",
          "shortname": "Son."
        },
        {
          "id": "27",
          "key": "27",
          "name": "Tabasco",
          "shortname": "Tab."
        },
        {
          "id": "28",
          "key": "28",
          "name": "Tamaulipas",
          "shortname": "Tamps."
        },
        {
          "id": "29",
          "key": "29",
          "name": "Tlaxcala",
          "shortname": "Tlax."
        },
        {
          "id": "30",
          "key": "30",
          "name": "Veracruz de Ignacio de la Llave",
          "shortname": "Ver."
        },
        {
          "id": "31",
          "key": "31",
          "name": "Yucatán",
          "shortname": "Yuc."
        },
        {
          "id": "32",
          "key": "32",
          "name": "Zacatecas",
          "shortname": "Zac."
        }
      ],
      items: [
        {
          text: 'Inicio',
          href: '/'
        },
        {
          text: 'Nuevo registro',
          href: '#'
        },
        {
          text: 'Nómina',
          active: true
        }
      ],
      request_errors: null,
    }
  },
  computed: {
    local_state: {
        get() {
          return this.state
        },
        set(s) {
          this.state = s.name
        }
    },
  },
  methods: {
    isLetterOrNumber(e) {
      let char = String.fromCharCode(e.keyCode);
      if (/^[0-9]+$/.test(char)) return true;
      else e.preventDefault();
    },
    back() {
      this.$router.push('/').catch(() => {})
    },
    formSubmitted() {
      const obj = {
        name: this.name,
        phone: this.phone,
        email: this.email,
        rfc: this.rfc,
        address: this.address,
        zipcode: this.zipcode,
        city: this.city,
        state: this.state,
        company: this.company,
        date_admission: this.date_admission,
      }
      axios
        .post('http://localhost:8000/payroll', obj)
        .then(response => {
          if(response.data.status === 201) {
            this.$router.push(`/resume/${response.data.client_id}`).catch(() => {})
          } 
        })
        .catch(error => {
          this.request_errors = error.response.data.messages
        })
    },
  }
}
</script>