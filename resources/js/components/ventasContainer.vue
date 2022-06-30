<template>
    <div>
        <b-row align-h="between" class="mb-3">
            <b-col cols="12" md="6" sm="12">
                <h1 class="h3 mb-0 font-weight-bold text-black">
                    Ventas
                </h1>
            </b-col>
        </b-row>
        <b-row>
            <b-col col>
                <b-form-group label="Producto">
                    <select
                        @change="changeProducto"
                        class="form-control form-select"
                        v-model.trim="$v.id_producto.$model"
                        :class="{ 'is-invalid':$v.id_producto.$error }"
                    >
                        <option value="">Seleccione producto...</option>
                        <option
                            v-for="item in inventarios"
                            :key="item.id"
                            :value="item.id"
                        >
                           ID: {{ item.id }} - {{ item.producto }}
                        </option>
                    </select>
                    <div class="invalid-feedback">
                        <span v-if="!$v.id_producto.$required">Este campo es requerido</span>
                    </div>
                </b-form-group>
            </b-col>
        </b-row>
        <b-row>
            <b-col md>
                <b-form-group label="Cantidad">
                    <b-form-input
                        type="text"
                        size="sm"
                        v-model.number.lazy="$v.cantidad.$model"
                        :class="{ 'is-invalid':$v.cantidad.$error }"
                    ></b-form-input>
                    <div class="invalid-feedback">
                        <span v-if="!$v.cantidad.$required">Este campo es requerido</span>
                        <br>
                        <span v-if="!$v.cantidad.$numeric">Formato inválido</span>
                    </div>
                </b-form-group>
            </b-col>
        </b-row>
        <hr class="mt-1" />
        <b-row>
            <b-col col>
                <b-button
                    @click="createVenta"
                    :disabled="onLoadForm"
                    variant="outline-danger"
                    size="sm"
                    block
                >
                    <clip-loader
                    :class="{ 'd-none': !onLoadForm }"
                    style="display: inline;"
                    color="#fff"
                    size="15px"
                    ></clip-loader>
                    Vender
                </b-button>
            </b-col>
        </b-row>
    </div>
</template>

<script>
import {required, numeric} from 'vuelidate/lib/validators';
import { mapFields } from "vuex-map-fields";
export default {
    data() {
        return {
            onLoadForm: false,
            inventario: []
        }
    },
    validations: {
            id_producto: {required},
            cantidad: {required, numeric}
    },
    props: {
        inventarios: {
            type: Array,
            default: []
        }
    },
    computed: {
        ...mapFields("ventas", [
            "form.cantidad",
            "form.id_producto"
        ]),
    },
    methods: {
        changeProducto(e) {
            this.id_producto = e.target.value;
            this.validate_cant();
        },
        validate_cant() {
            var data = {
                id: this.id_producto,
            };
            axios.post('/search_producto', data).then(response => {
                var parseRes = response.data;
                this.inventario = parseRes.inventario;
                if(parseRes.inventario.stock <= 0 ) {
                    this.$swal.fire({
                      icon: 'warning',
                      title: 'Producto sin stock',
                      text: '¡Escoge otro producto e intenta nuevamente!',
                      confirmButtonColor: '#858796'
                    });
                    this.id_producto = '';
                    this.cantidad = 0;
                }
            });
        },
        createVenta() {
            this.$v.$touch()
            if(this.$v.$invalid){
                return this.submitStatus = "False";
            }else{ 
                if(this.cantidad > this.inventario.stock) {
                    this.$swal.fire({
                      icon: 'warning',
                      title: 'Producto sin stock',
                      text: '¡Escoge otro producto e intenta nuevamente!',
                      confirmButtonColor: '#858796'
                    });
                    this.id_producto = '';
                    this.cantidad = 0;
                }else {
                    this.onLoadForm = true;
                    var data = {
                        id: this.id_producto,
                        cantidad: this.cantidad,
                    };
                    axios.post('/create_venta', data).then(response => {
                        this.onLoadForm = false;
                        var parseRes = response.data;
                        this.$swal.fire({
                          icon: 'success',
                          title: 'Datos guardados',
                          text: '¡La informacion se guardo correctamente!',
                          confirmButtonColor: '#858796'
                        });
                    });
                }
            }
        }
    }
}
</script>

<style>
th {
    text-align: center;
}
</style>