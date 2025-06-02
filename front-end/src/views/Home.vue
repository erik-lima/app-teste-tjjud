<script setup>
import { useHomeService } from '@/composables/Services/Home.Service';
import { onMounted, ref } from 'vue';

const { homeData } = useHomeService();
const totalLivros = ref(0);
const totalAutores = ref(0);
const totalAssuntos = ref(0);

async function loadData() {
  const { data, error, message } = await homeData();
  if (error) {
    alert(message);
  }

  totalLivros.value = data.livros;
  totalAutores.value = data.autores;
  totalAssuntos.value = data.assuntos;
}

onMounted(() => {
  loadData()
})
</script>

<script>
export default {
  name: "HomeScreen",
};
</script>

<template>
  <div class="container mt-4">
    <div class="row mb-4">
      <div class="col">
        <h2>Dashboard</h2>
      </div>
    </div>

    <!-- Cards de estatísticas -->
    <div class="row mb-4">
      <div class="col-md-4 mb-3">
        <div class="card stat-card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="card-title text-muted">Total de Livros</h6>
                <h2 class="mb-0">{{ totalLivros }}</h2>
              </div>

              <router-link to="/livros">Ver todos</router-link>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card stat-card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="card-title text-muted">Autores</h6>
                <h2 class="mb-0">{{ totalAutores  }}</h2>
              </div>
              <router-link to="/autores">Ver todos</router-link>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card stat-card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="card-title text-muted">Assuntos</h6>
                <h2 class="mb-0">{{ totalAssuntos }}</h2>
              </div>
              <router-link to="/assuntos">Ver todos</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
