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

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input v-model="texto" type="text" class="form-control form-control-sm" :placeholder="buscador.buscar_por==='dni'?'documento':'A.Paterno, A.Materno, Nombre'" @keyup.enter="buscar()" :class="(errors.dni||errors.nombres||errors.apaterno||errors.amaterno)? 'is-invalid': ''">
                                <div class="invalid-feedback" v-if="errors.dni">{{errors.dni}}</div>
                                <div class="invalid-feedback" v-if="errors.nombres">{{errors.nombres}}</div>
                                <div class="invalid-feedback" v-if="errors.apaterno">{{errors.apaterno}}</div>
                                <div class="invalid-feedback" v-if="errors.amaterno">{{errors.amaterno}}</div>
                            </div>
                        </div>

                        <!-- <div class="row" v-else>
                            <div class="col-md-4 form-group">
                                <input v-model="buscador.nombres" type="text" class="form-control form-control-sm" placeholder="Nombres" @keyup.enter="buscar()" :class="errors.nombres? 'is-invalid': ''">
                                <div class="invalid-feedback" v-if="errors.nombres">{{errors.nombres}}</div>
                            </div>
                            <div class="col-md-4 form-group">
                                <input v-model="buscador.apaterno" type="text" class="form-control form-control-sm" placeholder="Apellido paterno" @keyup.enter="buscar()" :class="errors.apaterno? 'is-invalid': ''">
                                <div class="invalid-feedback" v-if="errors.apaterno">{{errors.apaterno}}</div>
                            </div>
                            <div class="col-md-4 form-group">
                                <input v-model="buscador.amaterno" type="text" class="form-control form-control-sm" placeholder="Apellido materno" @keyup.enter="buscar()" :class="errors.amaterno? 'is-invalid': ''">
                                <div class="invalid-feedback" v-if="errors.amaterno">{{errors.amaterno}}</div>
                            </div>
                        </div> -->

                        <div class="row">
                            <div class="col-12 form-group text-right">
                                <a href="#" @click.prevent="buscar()" class="btn btn-sm btn-primary" v-if="!buscando">Buscar</a>
                                <a href="#" @click.prevent="buscar()" class="btn btn-sm btn-primary disabled" v-if="buscando">Buscando...</a>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th>DNI</th>
                                            <th>Apellidos y Nombres</th>
                                            <th>Edad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item,key) in items" :key="key">
                                            <td>
                                                <a href="#" @click.prevent="" 
                                                    v-clipboard:copy="item.dni"
                                                    v-clipboard:success="onCopy"
                                                    v-clipboard:error="onError">
                                                    {{item.dni}}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" @click.prevent="" 
                                                    v-clipboard:copy="item.apellidos+' '+item.nombres"
                                                    v-clipboard:success="onCopy"
                                                    v-clipboard:error="onError">
                                                    {{item.apellidos+' '+item.nombres}}
                                                </a>
                                            </td>
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

                texto: '',

                buscador: {
                    servicio: 'eldni',
                    buscar_por: 'dni',
                    dni: '',
                    nombres: '',
                    apaterno: '',
                    amaterno: '',
                },

                errors: {},

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
            onCopy: function (e) {
                toast.fire('Copiado!', '', 'success')
            },
            onError: function (e) {
                toast.fire('No copiado!', '', 'error')
            },

            handleServicio() {
                if( this.buscador.servicio==='siscovid' ){
                    this.busquedas = ['dni']
                    this.buscador.buscar_por = 'dni'
                }else{
                    this.busquedas = ['dni', 'nombre']
                }
            },

            copiarNombre()
            {
                alert('copiando....')
            },

            buscar() {
                this.buscador.dni = ''
                this.buscador.apaterno = ''
                this.buscador.amaterno = ''
                this.buscador.nombres = ''

                if( this.buscador.buscar_por==='nombre'){
                    let data = this.texto.split(',');
                    if (typeof data[0] !== 'undefined') this.buscador.apaterno = data[0].trim()
                    if (typeof data[1] !== 'undefined') this.buscador.amaterno = data[1].trim()
                    if (typeof data[2] !== 'undefined') this.buscador.nombres = data[2].trim()
                }else{
                    this.buscador.dni = this.texto
                }

                this.errors = {}
                this.buscando = true
                this.items = []
                axios.get(`/api/common?resource=buscar-persona`, {params: this.buscador})
                .then(res => {
                    this.items = res.data
                    this.buscando = false
                })
                .catch( err => {
                    let errors = err.response.data.errors
                    if( err.response.status === 422 )
                    {
                        if (typeof errors.dni !== 'undefined') this.errors.dni = errors.dni[0] 
                        if (typeof errors.nombres !== 'undefined') this.errors.nombres = errors.nombres[0] 
                        if (typeof errors.apaterno !== 'undefined') this.errors.apaterno = errors.apaterno[0] 
                        if (typeof errors.amaterno !== 'undefined') this.errors.amaterno = errors.amaterno[0] 
                    }
                    this.buscando = false
                })
            }
        }
    }
</script>
