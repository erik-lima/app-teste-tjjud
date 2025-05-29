# TESTE ERIK LIMA

Este projeto é composto por duas partes principais: **back-end** e **front-end**. Abaixo estão listadas as tecnologias utilizadas em cada uma delas.

---

## 📦 Back-end

O back-end do projeto está localizado na pasta `back-end` e utiliza as seguintes tecnologias:

- **PHP** (8+)
- **Laravel** (framework principal v12)
- **Composer** (gerenciador de dependências PHP)
- **Banco de Dados** (MySQL, MariaDB ou similar, utilizado via Eloquent ORM)
- **Eloquent ORM** (ORM do Laravel para manipulação de dados)
- **PSR-4 Autoloading** (padrão de autoload do Composer)
- **Migrations** (para versionamento do banco de dados)
- **Controllers, Services e Models** (padrão MVC do Laravel)

---

## 💻 Front-end

O front-end do projeto está localizado na pasta `front-end` e utiliza as seguintes tecnologias:

- **Vue.js 3** (framework JavaScript principal)
- **Vite** (ferramenta de build e desenvolvimento)
- **Pinia** (state management para Vue 3)
- **Bootstrap 5** (framework CSS para estilização)
- **Axios** (para requisições HTTP)
- **Sass/SCSS** (pré-processador CSS, se utilizado)
- **ESLint/Prettier** (ferramentas de lint e formatação, se configuradas)
- **Componentes Single File (`.vue`)**
- **Composables** (padrão de composição do Vue 3)
- **Icons** (ex: Material Design Icons)

---

## instruções para iniciar o projeto em modo dev

## 📋 Pré-requisitos

- Docker e Docker Compose
- Node.js (para desenvolvimento local)
- Composer (para desenvolvimento local)

## 🔧 Instalação Back

1. Acesse o back:

```bash
cd back-end
```

2. Configure o ambiente:

```bash
cp .env.example .env
```

3. Inicie os containers Docker:

```bash
docker compose up -d --build
```

4. Instale as dependências do PHP:

```bash
docker exec -it app composer install
```

5. Instale as dependências do Node.js:

```bash
npm install
```

6. Execute as migrações do banco de dados:

```bash
docker exec -it app php artisan migrate
```

7. Gere a chave da aplicação:

```bash
docker exec -it app php artisan key:generate
```

8. Dê permissão total para a pasta storage:

```bash
docker exec -it app chmod -R 777 storage
```

9. Acesse o back com:

```bash
http://localhost:8074
```

## 🔧 Instalação Front

1. Acesse o front:

```bash
cd front-end
```

2. instale as dependências:

```bash
npm run install ou yarn
```

3. Inicie o front:

```bash
npm run serve ou yarn serve
```

## 📄 Licença

Este projeto está sob a licença MIT.
