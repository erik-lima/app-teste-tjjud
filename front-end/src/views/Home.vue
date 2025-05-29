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
                <h2 class="mb-0">1,254</h2>
              </div>
              <div class="stat-icon">
                <i class="fas fa-book"></i>
              </div>
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
                <h2 class="mb-0">348</h2>
              </div>
              <div class="stat-icon">
                <i class="fas fa-user-edit"></i>
              </div>
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
                <h2 class="mb-0">42</h2>
              </div>
              <div class="stat-icon">
                <i class="fas fa-tags"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
