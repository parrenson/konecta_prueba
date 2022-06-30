<template>
    <div>
        <b-row align-h="between" class="mb-3">
            <b-col cols="12" md="6" sm="12">
                <h1 class="h3 mb-0 font-weight-bold text-black">
                    Inventarios
                    <b-dropdown
                        variant="link"
                        size="md"
                        toggle-class="text-decoration-none"
                        no-caret
                    >
                        <template #button-content>
                            <i class="fas fa-ellipsis-v text-muted"></i>
                        </template>
                        <b-dropdown-item @click="createStock">
                            Añadir
                        </b-dropdown-item>
                    </b-dropdown>
                </h1>
            </b-col>
        </b-row>
        <div class="table-responsive mt-5">
            <table class="table table-bordered table-hover table-sm">
                <thead class="table-dark">
                <tr>
                    <th>Referencia</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Peso</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Fecha Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in inventarioList" :key="index">
                    <td>{{item.referencia}}</td>
                    <td>{{item.producto}}</td>
                    <td>{{item.precio}}</td>
                    <td>{{item.peso}}</td>
                    <td>{{item.categoria}}</td>
                    <td>{{item.stock}}</td>
                    <td>{{item.format_date}}</td>
                    <td>
                        <button @click="editProducto(item)" type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar producto">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button @click="deleteProducto(item.id)" type="button" class="btn btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar producto">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
            </table>
        </div>
        <createInventario/>
        <updateInventario/>
    </div>
</template>

<script>
import createInventario from './createInventarioModal';
import updateInventario from './updateInventarioModal';
import { UPDATE_INVENTARIOS } from "store/store-constants";
import { UPDATE_ITEM } from "store/store-constants";
import { mapFields } from "vuex-map-fields";
export default {
    data() {
        return {
            item: {}
        }
    },
    props: {
        inventarios: {
            type: Array,
            default: []
        }
    },
    mounted() {
        this.$store.commit(UPDATE_INVENTARIOS, this.inventarios);
    },
    computed: {
        inventarioList() {
            return this.$store.state.inventarios.inventario;
        },
        ...mapFields("inventarios", [
            "form.id",
            "form.producto",
            "form.referencia",
            "form.precio",
            "form.peso",
            "form.categoria",
            "form.stock"
        ]),
    },
    components: {
        createInventario,
        updateInventario
    },
    methods: {
        createStock() {
            this.$root.$emit( "bv::toggle::modal", "createStock");
        },
        editProducto(item) {
            this.$store.commit(UPDATE_ITEM, item);
            this.$root.$emit( "bv::toggle::modal", "updateInventario");
        },
        deleteProducto(id) {
            axios.post('/delete_inventario/'+id).then(response => {
                var parseRes = response.data;
                this.$store.commit(UPDATE_INVENTARIOS, parseRes.inventarios);
                this.$swal.fire({
                  icon: 'success',
                  title: 'Datos guardados',
                  text: '¡El producto se elimino correctamente!',
                  confirmButtonColor: '#858796'
                });
            });
        }
    }
}
</script>

<style>
th {
    text-align: center;
}
</style>