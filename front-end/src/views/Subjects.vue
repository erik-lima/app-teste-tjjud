<script setup>
import { useSubjectsService } from "@/composables/Services/Subjects.Service";
import { onMounted, ref } from "vue";
import ModalForm from "@/components/Subjects/ModalForm.vue";
import { useSubjectStore } from "@/stores/Subject.Store";

const { list, destroy } = useSubjectsService();
const { setModel } = useSubjectStore();
const subjectList = ref([]);
const isOpenedBookDialog = ref(false);

const filters = ref({
  term: "",
});

async function loadSubjects() {
  const { data, error, message } = await list(filters.value);
  if (error) {
    alert(message);
    return;
  }

  subjectList.value = data;
}

function openDialogFormModal(item = {}) {
  setModel(item);
  isOpenedBookDialog.value = true;
}

async function removeItem(item) {
  if (window.confirm("Quer realmente remover esse assunto?")) {
    await destroy(item.cod);
    await loadSubjects();
  }
}

onMounted(() => {
  loadSubjects();
});
</script>

<script>
export default {
  name: "AssuntosScreen",
};
</script>

<template>
  <div class="container mt-4" style="margin-bottom: 5rem">
    <div class="row mb-4">
      <div class="col d-flex justify-content-between align-items-center">
        <div>
          <h2>Assuntos</h2>
          <p class="text-muted">Gerenciamento de categorias e assuntos</p>
        </div>
        <button class="btn btn-primary" @click="openDialogFormModal">
          <i class="mdi mdi-plus me-1"></i> Novo Assunto
        </button>
      </div>
    </div>

    <!-- Filtros -->
    <div class="row mb-4">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <div class="row g-3">
              <div class="col-md-8">
                <input
                  v-model="filters.term"
                  type="text"
                  class="form-control"
                  placeholder="Buscar por nome..."
                />
              </div>
              <div class="col-md-4">
                <button
                  class="btn btn-outline-primary w-100"
                  @click="loadSubjects"
                >
                  Filtrar
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Tabela de assuntos -->
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th width="80%">Descrição</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="subject in subjectList.data" :key="subject.cod">
                    <td>{{ subject.descricao }}</td>
                    <td>
                      <button
                        class="btn btn-sm btn-outline-primary me-1"
                        @click="openDialogFormModal(subject)"
                      >
                        <i class="mdi mdi-pencil"></i>
                      </button>
                      <button
                        class="btn btn-sm btn-outline-danger"
                        @click="removeItem(subject)"
                      >
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

    <ModalForm v-model="isOpenedBookDialog" @refresh="loadSubjects" />
  </div>
</template>
