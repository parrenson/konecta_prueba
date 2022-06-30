<template>
    <div>
        <b-modal size="xl" hide-footer id="createStock">
            <template v-slot:modal-title>
                <h6 class="font-weight-bold text-uppercase text-dark">Crear Inventario</h6>
            </template> 
            <template v-slot:default>
                <b-row>
                    <b-col col>
                        <b-form-group label="Producto">
                            <b-form-input
                                type="text"
                                size="sm"
                                v-model.trim="$v.producto.$model"
                                :class="{ 'is-invalid':$v.producto.$error }"
                            ></b-form-input>
                            <div class="invalid-feedback">
                                <span v-if="!$v.producto.$required">Este campo es requerido</span>
                            </div>
                        </b-form-group>
                    </b-col>
                    <b-col col>
                        <b-form-group label="Referencia">
                            <b-form-input
                                type="text"
                                size="sm"
                                v-model.trim="$v.referencia.$model"
                                :class="{ 'is-invalid':$v.referencia.$error }"
                            ></b-form-input>
                            <div class="invalid-feedback">
                                <span v-if="!$v.referencia.$required">Este campo es requerido</span>
                            </div>
                        </b-form-group>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col col>
                        <b-form-group label="Precio">
                            <b-form-input
                                type="text"
                                size="sm"
                                v-model.number.lazy="$v.precio.$model"
                                :class="{ 'is-invalid':$v.precio.$error }"
                            ></b-form-input>
                            <div class="invalid-feedback">
                                <span v-if="!$v.precio.$required">Este campo es requerido</span>
                                <br>
                                <span v-if="!$v.precio.$numeric">Formato inválido</span>
                            </div>
                        </b-form-group>
                    </b-col>
                    <b-col col>
                        <b-form-group label="Peso">
                            <b-form-input
                                type="text"
                                size="sm"
                                v-model.number.lazy="$v.peso.$model"
                                :class="{ 'is-invalid':$v.peso.$error }"
                            ></b-form-input>
                            <div class="invalid-feedback">
                                <span v-if="!$v.peso.$required">Este campo es requerido</span>
                                <br>
                                <span v-if="!$v.peso.$numeric">Formato inválido</span>
                            </div>
                        </b-form-group>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col md>
                        <b-form-group label="Categoria">
                            <b-form-input
                                type="text"
                                size="sm"
                                v-model.trim="$v.categoria.$model"
                                :class="{ 'is-invalid':$v.categoria.$error }"
                            ></b-form-input>
                            <div class="invalid-feedback">
                                <span v-if="!$v.categoria.$required">Este campo es requerido</span>
                            </div>
                        </b-form-group>
                    </b-col>
                    <b-col md>
                        <b-form-group label="Stock">
                            <b-form-input
                                type="text"
                                size="sm"
                                v-model.number.lazy="$v.stock.$model"
                                :class="{ 'is-invalid':$v.stock.$error }"
                            ></b-form-input>
                            <div class="invalid-feedback">
                                <span v-if="!$v.stock.$required">Este campo es requerido</span>
                                <br>
                                <span v-if="!$v.stock.$numeric">Formato inválido</span>
                            </div>
                        </b-form-group>
                    </b-col>
                </b-row>
                <hr class="mt-1" />
                <b-row>
                    <b-col col>
                        <b-button
                            @click="createInventario"
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
                            Crear
                        </b-button>
                    </b-col>
                </b-row>
            </template>
        </b-modal>
    </div>
</template>

<script>
import { UPDATE_INVENTARIOS } from "store/store-constants";
import { mapFields } from "vuex-map-fields";
import {required, numeric} from 'vuelidate/lib/validators';
export default {
    data() {
        return {
            onLoadForm: false
        }
    },
    validations: {
            producto: {required},
            referencia: {required, required},
            precio: {required, numeric},
            peso: {required, numeric},
            categoria: {required},
            stock: {required, numeric}
    },
    computed: {
        ...mapFields("inventarios", [
            "form.producto",
            "form.referencia",
            "form.precio",
            "form.peso",
            "form.categoria",
            "form.stock"
        ]),
    },
    methods: {
        createInventario() {
            this.$v.$touch()
            if(this.$v.$invalid){
                return this.submitStatus = "False";
            }else{ 
                this.onLoadForm = true;
                var data = {
                    producto: this.producto,
                    referencia: this.referencia,
                    precio: this.precio,
                    peso: this.peso,
                    categoria: this.categoria,
                    stock: this.stock
                };
                axios.post("/create_inventario", data).then(response => {
                    var parseRes = response.data;
                    if (parseRes.response == "error") {
                        this.onLoadForm = false;
                        this.$swal.fire({
                          icon: 'warning',
                          title: 'Error al crear inventario',
                          text: '¡Revisa los datos e intenta nuevamente!',
                          confirmButtonColor: '#858796'
                        });
                    } else {
                        this.onLoadForm = false;
                        this.$root.$emit( "bv::toggle::modal", "createStock");
                        this.$store.commit(UPDATE_INVENTARIOS, parseRes.inventarios);
                        this.$swal.fire({
                          icon: 'success',
                          title: 'Datos guardados',
                          text: '¡La informacion se guardo correctamente!',
                          confirmButtonColor: '#858796'
                        });
                    }
                });
            }
        }
    }
}
</script>

<style>

</style>