<script setup>
import { ref, defineModel, defineEmits, onMounted } from "vue";
import { storeToRefs } from "pinia";
import DialogBox from "../DialogBox.vue";
import CurrencyInput from "../CurrencyInput.vue";
import { useBooksService } from "@/composables/Services/Books.Service";
import { useBookStore } from "@/stores/Book.Store";
import { useAuthorsService } from "@/composables/Services/Authors.Service";
import { useSubjectsService } from "@/composables/Services/Subjects.Service";

const emit = defineEmits(["refresh"]);
const model = defineModel();
const { store, update } = useBooksService();
const { model: bookModel } = storeToRefs(useBookStore());
const { list: listAuthors } = useAuthorsService();
const { list: listSubjects } = useSubjectsService();

const dialogModal = ref(null);
const authorList = ref([]);
const subjectList = ref([]);
const userToAdd = ref("");
const subjectToAdd = ref("");
const errors = ref({});

function validate() {
  let isValidate = true;
  if (!bookModel.value.titulo || bookModel.value.titulo == "") {
    errors.value["titulo"] = "O campo título é obrigatório";
    isValidate = false;
  }

  if (!bookModel.value.editora || bookModel.value.editora == "") {
    errors.value["editora"] = "O campo editora é obrigatório";
    isValidate = false;
  }

  if (!bookModel.value.edicao || bookModel.value.edicao == "") {
    errors.value["edicao"] = "O campo edição é obrigatório";
    isValidate = false;
  }

  if (bookModel.value.edicao <= 0) {
    errors.value["edicao"] =
      "O campo edição deve ser um numero positivo acima de zero";
    isValidate = false;
  }

  if (bookModel.value.edicao > 100) {
    errors.value["edicao"] = "O campo edição deve ser um numero abaixo de 100";
    isValidate = false;
  }

  if (!bookModel.value.ano_publicacao || bookModel.value.ano_publicacao == "") {
    errors.value["ano_publicacao"] = "O campo ano publicação é obrigatório";
    isValidate = false;
  }

  if (bookModel.value.ano_publicacao && bookModel.value.ano_publicacao < 1300) {
    errors.value["ano_publicacao"] =
      "O campo ano publicação deve ser a partir de 1300";
    isValidate = false;
  }

  if (
    bookModel.value.ano_publicacao &&
    bookModel.value.ano_publicacao > new Date().getFullYear()
  ) {
    errors.value["ano_publicacao"] =
      "O campo ano publicação deve ser até o ano corrente (" +
      new Date().getFullYear() +
      ")";
    isValidate = false;
  }

  if (!bookModel.value.valor || bookModel.value.valor == "") {
    errors.value["valor"] = "O campo valor é obrigatório";
    isValidate = false;
  }

  if (bookModel.value.valor && bookModel.value.valor == 0) {
    errors.value["valor"] = "O campo valor deve ser maior que 0";
    isValidate = false;
  }

  if (bookModel.value.valor && bookModel.value.valor >= 100000) {
    errors.value["valor"] = "O campo valor deve ser menor que R$ 100.000,00";
    isValidate = false;
  }

  if (bookModel.value.autores.length === 0) {
    errors.value["autores"] = "Ao menos um autor é necessário";
    isValidate = false;
  }

  if (bookModel.value.assuntos.length === 0) {
    errors.value["assuntos"] = "Ao menos um assunto é necessário";
    isValidate = false;
  }
  return isValidate;
}

async function saveData() {
  const isValidated = validate();
  if (!isValidated) {
    return;
  }

  const { error, message } = await store(bookModel.value);
  if (error) {
    alert(message);
    return;
  }
  emit("refresh");
  model.value = false;
}

async function updateData() {
  const isValidated = validate();
  if (!isValidated) {
    return;
  }
  const { error, message } = await update(bookModel.value.cod, bookModel.value);
  if (error) {
    alert(message);
    return;
  }
  emit("refresh");
  model.value = false;
}

async function loadAuthors() {
  const { data } = await listAuthors();
  authorList.value = data.data;
}

async function loadSubjects() {
  const { data } = await listSubjects();
  subjectList.value = data.data;
}

function addAuthor() {
  if (
    userToAdd.value &&
    !bookModel.value.autores.find((e) => e.cod === userToAdd.value)
  ) {
    const find = authorList.value.find((e) => e.cod === userToAdd.value);

    bookModel.value.autores.push(find);
    userToAdd.value = "";
  }
}

function addSubject() {
  if (
    subjectToAdd.value &&
    !bookModel.value.assuntos.find((e) => e.cod === subjectToAdd.value)
  ) {
    const find = subjectList.value.find((e) => e.cod === subjectToAdd.value);

    bookModel.value.assuntos.push(find);
    subjectToAdd.value = "";
  }
}

onMounted(async () => {
  loadAuthors();
  loadSubjects();
});
</script>

<template>
  <DialogBox v-model="model" title="Novo livro" ref="dialogModal">
    <template #body>
      <form>
        <div class="form-group">
          <label>Título</label>
          <input
            v-model="bookModel.titulo"
            class="form-control"
            :class="{ 'is-invalid': errors.titulo }"
            maxlength="40"
          />
          <div class="invalid-feedback">
            <span v-if="errors.titulo">{{ errors.titulo }}</span>
          </div>
        </div>

        <div class="form-group">
          <label>Editora</label>
          <input
            v-model="bookModel.editora"
            class="form-control"
            :class="{ 'is-invalid': errors.editora }"
            maxlength="40"
          />
          <div class="invalid-feedback">
            <span v-if="errors.editora">{{ errors.editora }}</span>
          </div>
        </div>

        <div class="form-group">
          <label>Edição</label>
          <input
            v-model="bookModel.edicao"
            :class="{ 'is-invalid': errors.edicao }"
            class="form-control"
            max="99"
            type="number"
          />
          <div class="invalid-feedback">
            <span v-if="errors.edicao">{{ errors.edicao }}</span>
          </div>
        </div>

        <div class="form-group">
          <label>Ano publicação</label>
          <input
            v-model="bookModel.ano_publicacao"
            class="form-control"
            :class="{ 'is-invalid': errors.ano_publicacao }"
            max="9999"
            type="number"
          />
          <div class="invalid-feedback">
            <span v-if="errors.ano_publicacao">{{
              errors.ano_publicacao
            }}</span>
          </div>
        </div>

        <div class="form-group">
          <label>Valor</label>
          <CurrencyInput
            v-model="bookModel.valor"
            :class="{'is-invalid': errors.valor}"
          />
          <div class="invalid-feedback">
            <span v-if="errors.valor">{{ errors.valor }}</span>
          </div>
        </div>

        <div class="mt-4 mb-3">
          <h6>Autores</h6>
          <hr />
        </div>

        <div class="row">
          <div class="col-md-9">
            <div class="form-group">
              <small>Selecione um autor e clique em adicionar</small>
              <select
                v-model="userToAdd"
                placeholder="Selecione um autor"
                :class="{ 'is-invalid': errors.autores }"
                class="form-control"
              >
                <option
                  :value="author.cod"
                  v-for="author in authorList"
                  :key="author.cod"
                >
                  {{ author.nome }}
                </option>
              </select>
              <div class="invalid-feedback">
                <span v-if="errors.autores">{{ errors.autores }}</span>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <button
              class="btn btn-primary mt-4 w-100"
              @click.prevent="addAuthor"
            >
              Adicionar
            </button>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-12 group-chips">
            <span
              v-for="author in bookModel.autores"
              :key="author.cod"
              class="label-author"
            >
              <span>{{ author.nome }}</span>
              <button>X</button>
            </span>
          </div>
        </div>

        <div class="mt-4 mb-3">
          <h6>Assuntos</h6>
          <hr />
        </div>

        <div class="row">
          <div class="col-md-9">
            <div class="form-group">
              <small>Selecione um assunto e clique em adicionar</small>
              <select
                v-model="subjectToAdd"
                class="form-control"
                :class="{ 'is-invalid': errors.assuntos }"
              >
                <option
                  :value="subject.cod"
                  v-for="subject in subjectList"
                  :key="subject.cod"
                >
                  {{ subject.descricao }}
                </option>
              </select>
              <div class="invalid-feedback">
            <span v-if="errors.assuntos">{{ errors.assuntos }}</span>
          </div>
            </div>
          </div>
          <div class="col-md-3">
            <button
              class="btn btn-primary mt-4 w-100"
              @click.prevent="addSubject"
            >
              Adicionar
            </button>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-12 group-chips">
            <span
              v-for="subject in bookModel.assuntos"
              :key="subject"
              class="label-author"
            >
              <span>{{ subject.descricao }}</span>
              <button>X</button>
            </span>
          </div>
        </div>
      </form>
    </template>

    <template #footer>
      <button
        v-if="bookModel.cod"
        class="btn btn-success"
        @click.prevent="updateData"
      >
        Atualizar
      </button>
      <button v-else class="btn btn-success" @click="saveData">Salvar</button>
    </template>
  </DialogBox>
</template>

<style scoped>
.label-author {
  padding: 0.2rem 0.3rem 0.2rem 1rem;
  font-size: 0.8rem;
  background: var(--primary-color);
  color: #fff;
  border-radius: 2rem;
  display: inline-flex;
  justify-content: space-between;
  gap: 0.5rem;
  /* max-width: 5rem; */

  & span {
    margin-right: 1rem;
  }

  & button {
    background: transparent;
    border: 0;
    color: #fff;
  }
}

.group-chips {
  display: flex;
  gap: 0.5rem;
}
</style>
