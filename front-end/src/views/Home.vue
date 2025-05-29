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
        <p class="text-muted">
          Bem-vindo ao painel administrativo da biblioteca.
        </p>
      </div>
    </div>

    <!-- Cards de estatísticas -->
    <div class="row mb-4">
      <div class="col-md-3 mb-3">
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
            <p class="small text-success mt-2 mb-0">
              <i class="fas fa-arrow-up me-1"></i> 12% desde o mês passado
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
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
            <p class="small text-success mt-2 mb-0">
              <i class="fas fa-arrow-up me-1"></i> 5% desde o mês passado
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
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
            <p class="small text-success mt-2 mb-0">
              <i class="fas fa-arrow-up me-1"></i> 3% desde o mês passado
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card stat-card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="card-title text-muted">Empréstimos</h6>
                <h2 class="mb-0">876</h2>
              </div>
              <div class="stat-icon">
                <i class="fas fa-exchange-alt"></i>
              </div>
            </div>
            <p class="small text-danger mt-2 mb-0">
              <i class="fas fa-arrow-down me-1"></i> 2% desde o mês passado
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Gráficos -->
    <div class="row mb-4">
      <div class="col-md-6 mb-3">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title mb-0">Livros por Categoria</h5>
          </div>
          <div class="card-body">
            <div class="chart-container">
              <div class="chart-placeholder">
                <i class="fas fa-chart-pie"></i>
                <p>
                  Gráfico de pizza mostrando a distribuição de livros por
                  categoria
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title mb-0">Empréstimos Mensais</h5>
          </div>
          <div class="card-body">
            <div class="chart-container">
              <div class="chart-placeholder">
                <i class="fas fa-chart-line"></i>
                <p>
                  Gráfico de linha mostrando empréstimos nos últimos 6 meses
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Atividades recentes -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title mb-0">Atividades Recentes</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Ação</th>
                    <th>Item</th>
                    <th>Usuário</th>
                    <th>Data</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><span class="badge bg-success">Adicionado</span></td>
                    <td>O Senhor dos Anéis: A Sociedade do Anel</td>
                    <td>admin@biblioteca.com</td>
                    <td>29/05/2025</td>
                  </tr>
                  <tr>
                    <td><span class="badge bg-warning">Atualizado</span></td>
                    <td>J.K. Rowling</td>
                    <td>editor@biblioteca.com</td>
                    <td>28/05/2025</td>
                  </tr>
                  <tr>
                    <td><span class="badge bg-info">Empréstimo</span></td>
                    <td>1984 - George Orwell</td>
                    <td>usuario@biblioteca.com</td>
                    <td>28/05/2025</td>
                  </tr>
                  <tr>
                    <td><span class="badge bg-danger">Removido</span></td>
                    <td>Ficção Científica (categoria)</td>
                    <td>admin@biblioteca.com</td>
                    <td>27/05/2025</td>
                  </tr>
                  <tr>
                    <td><span class="badge bg-success">Adicionado</span></td>
                    <td>Dom Quixote</td>
                    <td>editor@biblioteca.com</td>
                    <td>27/05/2025</td>
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
