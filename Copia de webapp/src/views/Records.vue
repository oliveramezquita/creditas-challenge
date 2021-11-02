<template>
    <div id="records">
        <b-breadcrumb :items="items"></b-breadcrumb>
        <h5 class="mt-5">Registros guardados</h5>
        <vue-good-table
            :columns="columns"
            :rows="rows" />
    </div>
</template>

<script>
import axios from 'axios'
import '../assets/scss/records.scss'
import 'vue-good-table/dist/vue-good-table.css'
import { VueGoodTable } from 'vue-good-table';

export default {
  name: 'Records',
  components: {
    VueGoodTable,
  },
  data() {
      return {
        rows: []
      }
  },
  computed: {
      items() {
        let currentPage = ''
        switch(this.$route.params.type) {
            case 'car':
                currentPage = 'Autos'
                break
            case 'house':
                currentPage = 'Casas'
                break
            case 'payroll':
                currentPage = 'Nóminas'
                break
        }
        return [
            {
            text: 'Inicio',
            href: '/'
            },
            {
            text: 'Registros',
            href: '#'
            },
            {
            text: currentPage,
            active: true
            }
        ]
      },
      columns() {
        let customColumns = []
        switch(this.$route.params.type) {
            case 'car':
                customColumns = [
                    {
                        label: 'Nombre',
                        field: 'name',
                    },
                    {
                        label: 'Teléfono',
                        field: 'phone'
                    },
                    {
                        label: 'Correo electrónico',
                        field: 'email',
                    },
                    {
                        label: 'RFC',
                        field: 'rfc'
                    },
                    {
                        label: 'Domicilio',
                        field: 'address',
                    },
                    {
                        label: 'Código Postal',
                        field: 'zipcode'
                    },
                    {
                        label: 'Ciudad',
                        field: 'city',
                    },
                    {
                        label: 'Estado',
                        field: 'state'
                    },
                    {
                        label: 'Modelo',
                        field: 'model'
                    },
                    {
                        label: 'Precio',
                        field: 'price'
                    },
                    {
                        label: 'Estatus',
                        field: this.fieldStatus,
                    },
                    {
                        label: 'Creado',
                        field: 'created'
                    }
                ]
                break
            case 'house':
                customColumns = [
                    {
                        label: 'Nombre',
                        field: 'name',
                    },
                    {
                        label: 'Teléfono',
                        field: 'phone'
                    },
                    {
                        label: 'Correo electrónico',
                        field: 'email',
                    },
                    {
                        label: 'RFC',
                        field: 'rfc'
                    },
                    {
                        label: 'Domicilio',
                        field: 'address',
                    },
                    {
                        label: 'Código Postal',
                        field: 'zipcode'
                    },
                    {
                        label: 'Ciudad',
                        field: 'city',
                    },
                    {
                        label: 'Estado',
                        field: 'state'
                    },
                    {
                        label: 'Valor',
                        field: 'value'
                    },
                    {
                        label: 'Domicilio en garantía',
                        field: 'ug_address'
                    },
                    {
                        label: 'C.P. en garantía',
                        field: 'ug_zipcode'
                    },
                    {
                        label: 'Ciudad en garantía',
                        field: 'ug_city'
                    },
                    {
                        label: 'Estado en garantía',
                        field: 'ug_state'
                    },
                    {
                        label: 'Estatus',
                        field: this.fieldStatus,
                    },
                    {
                        label: 'Creado',
                        field: 'created'
                    }
                ]
                break
            case 'payroll':
                customColumns = [
                    {
                        label: 'Nombre',
                        field: 'name',
                    },
                    {
                        label: 'Teléfono',
                        field: 'phone'
                    },
                    {
                        label: 'Correo electrónico',
                        field: 'email',
                    },
                    {
                        label: 'RFC',
                        field: 'rfc'
                    },
                    {
                        label: 'Domicilio',
                        field: 'address',
                    },
                    {
                        label: 'Código Postal',
                        field: 'zipcode'
                    },
                    {
                        label: 'Ciudad',
                        field: 'city',
                    },
                    {
                        label: 'Estado',
                        field: 'state'
                    },
                    {
                        label: 'Empresa',
                        field: 'company'
                    },
                    {
                        label: 'Fecha de ingreso',
                        field: 'date_admission'
                    },
                    {
                        label: 'Estatus',
                        field: this.fieldStatus,
                    },
                    {
                        label: 'Creado',
                        field: 'created',
                    }
                ]
                break
        }
        return customColumns
      }
  },
  methods: {
    fetchData() {
        axios
            .get(`http://localhost:8000/${this.$route.params.type}`)
            .then(response => {
            this.rows = response.data.clients
            })
            .catch(error => {
            console.log(error)
            this.errored = true
            })
    },
    fieldStatus(rowObj) {
        return rowObj.status === '1' ? 'Rechazada' : 'Aceptada'
    }
  },
  created() {
    this.fetchData()
  }
}
</script>
