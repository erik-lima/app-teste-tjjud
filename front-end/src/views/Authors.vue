<script setup>
import { useAuthorsService } from "@/composables/Services/Authors.Service";
import { onMounted, ref } from "vue";
import ModalForm from "@/components/Authors/ModalForm.vue";
import { useAuthorStore } from "@/stores/Author.Store";

const { list } = useAuthorsService();
const { setModel } = useAuthorStore();
const authorList = ref([]);
const isOpenedBookDialog = ref(false);

const filters = ref({
  term: "",
});

async function loadAuthors() {
  const { data, error, message } = await list(filters.value);
  if (error) {
    alert(message);
    return;
  }

  authorList.value = data;
}

function openDialogFormModal(item = {}) {
  setModel(item);
  isOpenedBookDialog.value = true;
}

onMounted(() => {
    loadAuthors();
});
</script>

<script>
export default {
  name: "AutoresScreen",
};
</script>

<template>
  <div class="container mt-4">
    <div class="row mb-4">
      <div class="col d-flex justify-content-between align-items-center">
        <div>
          <h2>Autores</h2>
          <p class="text-muted">Gerenciamento de autores cadastrados</p>
        </div>
        <button class="btn btn-primary" @click="openDialogFormModal">
          <i class="mdi mdi-plus me-1"></i> Novo Autor
        </button>
      </div>
    </div>

    <!-- Filtros -->
    <div class="row mb-4">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <div class="row g-3">
              <div class="col-md-10">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Buscar por nome..."
                />
              </div>

              <div class="col-md-2">
                <button class="btn btn-outline-primary w-100">Filtrar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Tabela de autores -->
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Nome</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="author in authorList.data" :key="author.cod">
                    <td>{{ author.nome }}</td>
                    <td>
                      <button class="btn btn-sm btn-outline-primary me-1">
                        <i class="mdi mdi-pencil"></i>
                      </button>
                      <button class="btn btn-sm btn-outline-danger">
                        <i class="mdi mdi-delete"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <ModalForm v-model="isOpenedBookDialog" @refresh="loadAuthors" />
  </div>
</template>
