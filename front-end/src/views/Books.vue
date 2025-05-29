<script setup>
import { useBooksService } from '@/composables/Services/Books.Service';
import { onMounted, ref } from 'vue';
import ModalForm from '@/components/Books/ModalForm.vue'
import { useBookStore } from '@/stores/Book.Store';

const { list } = useBooksService();
const { setModel } = useBookStore();
const bookList = ref([]);
const isOpenedBookDialog = ref(false);

const filters = ref({
    term: ''
})

async function loadLivros() {
    const { data, error, message } = await list(filters.value);
    if (error) {
        alert(message);
        return;
    }

    bookList.value = data;
}

function openDialogFormModal(item = {}) {
    console.log(item);
    setModel(item)
    isOpenedBookDialog.value = true;
}

onMounted(() => {
    loadLivros();
})
</script>

<script>
export default {
    name: "LivrosScreen"
}
</script>

<template>
    <div class="container mt-4" style="margin-bottom:5rem">
        <div class="row mb-4">
            <div class="col d-flex justify-content-between align-items-center">
                <div>
                    <h2>Livros</h2>
                    <p class="text-muted">Gerenciamento do catálogo de livros</p>
                </div>
                <button class="btn btn-primary" @click="openDialogFormModal">
                    <i class="mdi mdi-plus me-1"></i> Novo Livro
                </button>
            </div>
        </div>

        <!-- Filtros -->
        <!-- <div class="row mb-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Buscar por título...">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-outline-primary w-100">Filtrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Tabela de livros -->
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Título</th>
                                        <th>Editora</th>
                                        <th>Edição</th>
                                        <th>Ano publicação</th>
                                        <th>Autores</th>
                                        <th>Assuntos</th>
                                        <th>Valor</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="book in bookList" :key="book.cod">
                                        <td>{{ book.titulo }}</td>
                                        <td>{{ book.editora }}</td>
                                        <td>{{ book.edicao }}</td>
                                        <td>{{ book.ano_publicacao }}</td>
                                        <td>{{ book.autores ? book.autores.map(e => e.nome).join(', ') : '--' }}</td>
                                        <td>{{ book.assuntos ? book.assuntos.map(e => e.descricao).join(', ') : '--' }}</td>
                                        <td>{{ book.valor }}</td>
                                        <td class="text-right">
                                            <button class="btn btn-sm btn-outline-primary me-1" @click="openDialogFormModal(book)"><i class="mdi mdi-pencil"></i></button>
                                            <button class="btn btn-sm btn-outline-danger"><i class="mdi mdi-delete"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <ModalForm v-model="isOpenedBookDialog" @refresh="loadLivros"/>
    </div>
</template>