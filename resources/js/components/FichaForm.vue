<style>

    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
                box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }

    .input-group-text {
        width: 100px;
    }
    
</style>

<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Ficha</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- PERSONA -->
                        <div class="col-md-6">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">PERSONA</legend>
                                <div class="row">
                                    <!-- Documento -->
                                    <div class="col-md-6 form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Documento</span>
                                            </div>
                                            <input v-model="form.persona_documento" type="text" class="form-control" @keyup.enter="getHistorial()">
                                        </div>
                                    </div>
                                    <!-- Telefono -->
                                    <div class="col-md-6 form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Telefono</span>
                                            </div>
                                            <input v-model="form.persona_telefono" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <!-- Edad -->
                                    <div class="col-md-6 form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Edad</span>
                                            </div>
                                            <input v-model="form.persona_edad" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <!-- Sexo -->
                                    <div class="col-md-6 form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Sexo</span>
                                            </div>
                                            <select v-model="form.persona_sexo" class="form-control">
                                                <option value="M">MASCULINO</option>
                                                <option value="F">FEMENINO</option>
                                                <option value="X">NIGUNO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Nombre -->
                                    <div class="col-md-12 form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Nombre</span>
                                            </div>
                                            <input v-model="form.persona_nombre" type="text" class="form-control" @keyup.enter="buscarPersona('nombre')">
                                        </div>
                                    </div>
                                    <!-- Solicitante -->
                                    <div class="col-md-12 form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Solicitante</span>
                                            </div>
                                            <input v-model="form.persona_eess" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <!-- Direccion -->
                                    <div class="col-md-12 form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Direccion</span>
                                            </div>
                                            <input v-model="form.persona_direccion" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <!-- Distrito -->
                                    <div class="col-md-12 form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Distrito</span>
                                            </div>
                                            <select v-model="form.persona_distrito" class="form-control">
                                                <option v-for="distrito in distritos" :key="distrito.id" :value="distrito.nombre">
                                                    {{distrito.nombre}}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Localidad -->
                                    <div class="col-md-12 form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Localidad</span>
                                            </div>
                                            <input v-model="form.persona_localidad" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <!-- Personal salud -->
                                    <div class="col-md-6 form-group">
                                        <div class="form-check">
                                            <input v-model="form.persona_personal_salud" class="form-check-input" type="radio">
                                            <label class="form-check-label">Personal de salud</label>
                                        </div>
                                    </div>
                                    <!-- F.Sintomas -->
                                    <div class="col-md-6 form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">F.Sintomas</span>
                                            </div>
                                            <input v-model="form.persona_fecha_sintomas" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <!-- PRUEBA -->
                        <div class="col-md-6">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">PRUEBA</legend>
                                <div class="row">
                                    <!-- F.Ejecucion -->
                                    <div class="col-md-6 form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">F.Ejecucion</span>
                                            </div>
                                            <input v-model="form.prueba_fecha_ejecucion" type="date" class="form-control">
                                        </div>
                                    </div>
                                    <!-- F.Resultado -->
                                    <div class="col-md-6 form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">F.Resultado</span>
                                            </div>
                                            <input v-model="form.prueba_fecha_resultado" type="date" class="form-control">
                                        </div>
                                    </div>
                                    <!-- Tipo -->
                                    <div class="col-md-6 form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Tipo</span>
                                            </div>
                                            <input v-model="form.prueba_tipo" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <!-- Resultado -->
                                    <div class="col-md-6 form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Resultado</span>
                                            </div>
                                            <select v-model="form.prueba_resultado" class="form-control">
                                                <option value="1">Masculino</option>
                                                <option value="2">Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Tamizaje -->
                                    <div class="col-md-6 form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Tamizaje</span>
                                            </div>
                                            <input v-model="form.prueba_tamizaje" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <!-- Insumos -->
                                    <div class="col-md-6 form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Insumos</span>
                                            </div>
                                            <input v-model="form.prueba_insumos" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <!-- Observacion -->
                                    <div class="col-md-12 form-group">
                                        <textarea v-model="form.observacion" rows="2" class="form-control" placeholder="observacion"></textarea>
                                    </div>
                                    <!-- Historial -->
                                    <div class="col-md-12">
                                        <div style="height: 190px; overflow-y: scroll;">
                                            <table class="table table-sm table-hover table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td>#</td>
                                                        <td>Fecha</td>
                                                        <td>Nombre</td>
                                                        <td>Edad</td>
                                                        <td>Resultado</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(item,key) in historial" :key="key">
                                                        <td>{{item.codigo}}</td>
                                                        <td>{{item.fecha_recepcion |datePE}}</td>
                                                        <td>{{item.persona_nombre}}</td>
                                                        <td>{{item.persona_edad}}</td>
                                                        <td>{{item.prueba_resultado}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <!-- HISTORIAL -->
                        <!-- <div class="col-md-12">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">HISTORIAL</legend>
                                <div class="row">
                                    <div class="col">
                                        <table class="table table-sm table-hover">
                                            <thead>
                                                <tr>
                                                    <td>#</td>
                                                    <td>Fecha</td>
                                                    <td>Nombre</td>
                                                    <td>Edad</td>
                                                    <td>Resultado</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item,key) in historial" :key="key">
                                                    <td>{{item.codigo}}</td>
                                                    <td>{{item.fecha_recepcion}}</td>
                                                    <td>{{item.persona_nombre}}</td>
                                                    <td>{{item.persona_edad}}</td>
                                                    <td>{{item.prueba_resultado}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </fieldset>
                        </div> -->
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
                form: new Form({
                    id: '',
                    codigo: '',
                    fecha_recepcion: moment().format('YYYY-MM-DD'),
                    observacion: 'ninguna',

                    persona_documento: '27295382',
                    persona_telefono: '',
                    persona_edad: '',
                    persona_sexo: 'M',
                    persona_nombre: '',
                    persona_eess: '',
                    persona_direccion: '',
                    persona_distrito: '',
                    persona_localidad: '',
                    persona_personal_salud: true,
                    persona_fecha_sintomas: "ASINTOMATICO",

                    prueba_fecha_ejecucion: moment().format('YYYY-MM-DD'),
                    prueba_fecha_resultado: moment().format('YYYY-MM-DD'),
                    prueba_tipo: "PRUEBA RAPIDA",
                    prueba_resultado: "NO REACTIVO",
                    prueba_tamizaje: "1",
                    prueba_insumos: "1",

                    _action: '', // create, edit, delelte,  SHOW
                    _method: '', // POST,   PUT,  DELETE,   GET
                }),
                distritos: [],
                pruebas: [],

                historial: [],
            }

        },

        created() {
            this.form.id = this.$route.params.id===0? '': this.$route.params.id
            if(this.form.id > 0) this.getItem()
        },

        mounted() {
            // this.getItem()
            this.getMeta()
        },

        computed: {
            resultados() {
                let prueba = this.pruebas.find(x => x.id==this.form.tipo_prueba)
                return prueba==null? []: prueba.resultados;
            },

            localidad_init() {
                return 'hola'
            },
        },

        watch: {
            // form: {
            //     distrito_id() {
            //         console.log('sugerir localidad')
            //         this.form.localidad = 'el molino'
            //     }
            // }
            'form.distrito_id': function(new_val, old_val){
                let distrito = this.distritos.find(x => x.id==new_val)
                if( distrito!=null) this.form.localidad = distrito.nombre
            }
        },

        methods: {

            buscarPersona (by){
                let params = { 
                    resource: 'buscar-ficha-persona',
                    word: by==='dni'? this.form.dni: this.form.nombre,
                    by: by,  
                }
                axios.get('/api/common', {params})
                .then(res => {
                    let ficha = res.data
                    if( ficha ){
                        this.form.nombre = ficha.nombre
                        this.form.edad = ficha.nombre
                    }else{
                        console.log('no')
                    }
                })
                .catch(err => {
                    console.log('err', err.response)
                })
            },

            async getHistorial() {
                this.historial = []
                let params = { resource: 'get-historial', documento: this.form.persona_documento }

                console.log(params);
                let data = (await axios.get(`/api/common`, {params})).data;
                this.historial = data
            },

            async getMeta() {
                let params = { resource: 'get-meta-form-ficha' }
                let data = (await axios.get(`/api/common`, {params})).data;
                this.pruebas = data.pruebas
                this.distritos = data.distritos
            },

            async getItem() {
                let data = ( await axios.get(`/api/fichas/${this.form.id}`) ).data;
                this.form.fill(data)
                this.getHistorial()
            }
        }
    }
</script>
