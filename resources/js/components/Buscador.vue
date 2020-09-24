<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Buscador</div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Servicio</span>
                                    </div>
                                    <select v-model="buscador.servicio" class="form-control" @change="handleServicio">
                                        <option v-for="(item,key) in servicios" :key="key" :value="item">{{item}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Buscar por</span>
                                    </div>
                                    <select v-model="buscador.buscar_por" class="form-control">
                                        <option v-for="(item,key) in busquedas" :key="key" :value="item">{{item}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row" v-if="buscar_por_dni">
                            <div class="col-md-4 form-group">
                                <input v-model="buscador.dni" type="text" class="form-control form-control-sm" placeholder="DNI" @keyup.enter="buscar()">
                            </div>
                        </div>

                        <div class="row" v-else>
                            <div class="col-md-4 form-group">
                                <input v-model="buscador.nombres" type="text" class="form-control form-control-sm" placeholder="Nombres">
                            </div>
                            <div class="col-md-4 form-group">
                                <input v-model="buscador.apaterno" type="text" class="form-control form-control-sm" placeholder="Apellido paterno">
                            </div>
                            <div class="col-md-4 form-group">
                                <input v-model="buscador.amaterno" type="text" class="form-control form-control-sm" placeholder="Apellido materno">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 form-group text-right">
                                <a href="#" @click.prevent="buscar()" class="btn btn-sm btn-primary" v-if="!buscando">Buscar</a>
                                <a href="#" @click.prevent="buscar()" class="btn btn-sm btn-primary disabled" v-if="buscando">Buscando...</a>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <table class="table table-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th>DNI</th>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th colspan="2">Edad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item,key) in items" :key="key">
                                            <td>{{item.dni}}</td>
                                            <td>{{item.nombres}}</td>
                                            <td>{{item.apellidos}}</td>
                                            <td>{{item.edad}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                servicios: [ 'eldni', 'siscovid', 'local' ],
                busquedas: [ 'dni', 'nombre' ],
                buscando: false,

                buscador: {
                    servicio: 'eldni',
                    buscar_por: 'dni',
                    dni: '72918104',
                    nombres: 'romel',
                    apaterno: 'diaz',
                    amaterno: 'ramos',
                },

                items: [],
            }

        },

        computed: {
            buscar_por_dni: function() {
                return this.buscador.buscar_por==='dni'
            },
        },

        created() {

        },

        mounted() {

        },

        methods: {
            handleServicio() {
                if( this.buscador.servicio==='siscovid' ){
                    this.busquedas = ['dni']
                    this.buscador.buscar_por = 'dni'
                }else{
                    this.busquedas = ['dni', 'nombre']
                }
            },

            buscar() {
                this.buscando = true
                this.items = []
                axios.get(`/api/common?resource=buscar-persona`, {params: this.buscador})
                .then(res => {
                    this.items = res.data
                    this.buscando = false
                })
                .catch( err => {
                    this.buscando = false
                })
            }
        }
    }
</script>
