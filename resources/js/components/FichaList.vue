<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5>Fichas
                            <router-link :to="{ name: 'ficha', params: {id: 0} }" class="badge badge-primary">Nueva</router-link>
                        </h5>
                    </div>

                    <div class="card-body p-0">

                        <div class="row my-3 mx-1">
                            <div class="col-12 col-md-4">
                                <input type="text" v-model="search.nombre" class="form-control form-control-sm" placeholder="Nombre/DNI">
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="input-group input-group-sm">
                                    <input type="date" class="form-control">
                                    <input type="date" class="form-control">
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <select v-model="search.resultado" class="form-control form-control-sm" placeholder="Resultado">
                                    <option value="">Resultado</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-4">
                                <a href="#" class="btn btn-sm btn-secondary">LIMPIAR</a>
                                <a href="#" class="btn btn-sm btn-success">BUSCAR</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover mb-0">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>FECHA RECEPCION</td>
                                        <td>DNI</td>
                                        <td>NOMBRE</td>
                                        <td>RESULTADO</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in items.data" :key="item.id">
                                        <td>{{item.id}}</td>
                                        <td>{{item.fecha_recepcion | datePE}}</td>
                                        <td>{{item.persona_documento}}</td>
                                        <td>{{item.persona_nombre}}</td>
                                        <td>{{item.prueba_resultado}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <pagination :data="items" size="small" align="right" :limit="5" @pagination-change-page="getItems" class="mb-0"></pagination>
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
                search: { nombre: '', fecha_desde: '', fecha_hasta: '', resultado: '' },
                items: {}
            }
        },

        mounted() {
            this.getItems()
        },

        methods: {

            
            async getItems( page=1 ) {
                let params = {
                    page: page,
                    search: '',
                }
                let results = await axios.get('/api/fichas', {params} );
                this.items = results.data;
            }
        }
    }
</script>
