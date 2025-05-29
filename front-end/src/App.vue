<template>
  <div style="position: relative; min-height: 96vh;">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.html">
          Biblioteca
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <router-link class="nav-link active" to="/">
                <i class="fas fa-home me-1"></i> Home
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="livros">
                <i class="fas fa-book me-1"></i> Livros
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="autores">
                <i class="fas fa-user-edit me-1"></i> Autores
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="assuntos">
                <i class="fas fa-tags me-1"></i> Assuntos
              </router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  
    <!-- Conteúdo principal -->
    <div class="container mt-4">
      <div class="row mb-4">
        <div class="col">
          <router-view />
        </div>
      </div>
    </div>
  
    <!-- Footer -->
    <footer class="footer py-3">
      <div class="container">
        <div class="text-center">
          <span class="text-muted">© {{ new Date().getFullYear() }}.</span>
        </div>
      </div>
    </footer>
  </div>
</template>

<style>
:root {
    --primary-color: #5a6f8e;
    --secondary-color: #8da9c4;
    --accent-color: #eef4ed;
    --text-color: #333333;
    --light-bg: #f8f9fa;
    --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

body {
    background-color: #f5f7fa;
    color: var(--text-color);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Navbar */
.navbar {
    background-color: var(--primary-color);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.navbar-brand {
    font-weight: 600;
}

.nav-link {
    font-weight: 500;
    padding: 0.5rem 1rem;
    transition: all 0.3s ease;
}

.nav-link:hover {
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
}

/* Footer */
.footer {
    background-color: var(--light-bg);
    position: absolute !important;
    bottom: -25px;
    width: 100%;
    border-top: 1px solid #e9ecef;
}
</style>
