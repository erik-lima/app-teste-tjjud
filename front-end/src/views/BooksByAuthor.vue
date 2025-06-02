<script setup>
import { useAuthorsService } from "@/composables/Services/Authors.Service";
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import PieGraph from "@/components/Authors/PieGraph.vue";

const { id } = useRoute().params;
const { booksByAuthor } = useAuthorsService();

const authorData = ref(null);
const graphData = ref({});
const isLoaded = ref(false);
const totalValue = ref(0)

async function loadData() {
  const { data, error, message } = await booksByAuthor(id);
  if (error) {
    alert(message);
    return;
  }
  authorData.value = data;

  let bookValue = 0;

  for (let item of data) {
    bookValue += parseInt(item.valor);
    const assuntosList = item.assuntos.split(',');
    for (let ass of assuntosList) {
        const assunto = ass.trim();
        if (!graphData.value[assunto]) {
            graphData.value[assunto] = 0;
        }
        graphData.value[assunto]++;
    }
  }
  
  isLoaded.value = true;
  totalValue.value = formatCurrency(bookValue)
}

function formatCurrency(value) {
    return new Intl.NumberFormat("pt-BR", { style: "currency", currency: "BRL" }).format(value / 100)
}

onMounted(() => {
  loadData();
});
</script>

<template>
  <div class="container mt-4" style="margin-bottom: 5rem">
    <div class="row mb-4">
      <div class="col d-flex justify-content-between align-items-center">
        <div>
          <h2>Livros</h2>
          <p class="text-muted">Gerenciamento do catálogo de livros</p>
        </div>
      </div>
    </div>

    <!-- Dados do livro e gráfico -->
    <div v-if="isLoaded" class="row mb-5">
      <div class="col-md-6">
        <div class="card stat-card" style="height:130px">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="card-title text-muted">Total de Livros</h6>
                <h2 class="mb-0">{{ authorData.length }}</h2>
              </div>
              <div class="stat-icon">
                <i class="mdi mdi-book"></i>
              </div>
            </div>
          </div>
        </div>

        <div class="card stat-card mt-3" style="height:130px">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="card-title text-muted">Valor em Livros</h6>
                <h2 class="mb-0">{{ totalValue }}</h2>
              </div>
              <div class="stat-icon">
                <i class="mdi mdi-cash"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card stat-card" style="height:275px">
            <div class="card-body">
                <div class="align-items-center">
                    <h6 class="card-title text-muted mb-3 text-center">Assuntos dos livros</h6>
                    <PieGraph v-model="graphData" />
                </div>

            </div>
        </div>
      </div>
    </div>

    <!-- Tabela de livros -->
    <div v-if="isLoaded" class="row">
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
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="book in authorData" :key="book.cod">
                    <td>{{ book.titulo }}</td>
                    <td>{{ book.editora }}</td>
                    <td>{{ book.edicao }}</td>
                    <td>{{ book.ano_publicacao }}</td>
                    <td>{{ book.autores}}</td>
                    <td>{{ book.assuntos }}</td>
                    <td>{{ formatCurrency(book.valor) }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
