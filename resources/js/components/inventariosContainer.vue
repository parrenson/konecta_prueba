<template>
    <div>
        <b-row align-h="between" class="mb-3">
            <b-col cols="12" md="6" sm="12">
                <h1 class="h3 mb-0 text-gray">
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
                        <b-dropdown-item>
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
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style>
th {
    text-align: center;
}
</style>