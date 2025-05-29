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

async function saveData() {
  const { error, message } = await store(bookModel.value);
  if (error) {
    alert(message);
    return;
  }
  emit("refresh");
  model.value = false;
}

async function updateData() {
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
          <input v-model="bookModel.titulo" class="form-control" maxlength="40" />
        </div>

        <div class="form-group">
          <label>Editora</label>
          <input v-model="bookModel.editora" class="form-control" maxlength="40" />
        </div>

        <div class="form-group">
          <label>Edição</label>
          <input v-model="bookModel.edicao" class="form-control" max="99" type="number" />
        </div>

        <div class="form-group">
          <label>Ano publicação</label>
          <input v-model="bookModel.ano_publicacao" class="form-control" max="9999" type="number"/>
        </div>

        <div class="form-group">
          <label>Valor</label>
          <CurrencyInput v-model="bookModel.valor"/>
        </div>

        <div class="my-3">
          <h6>Autores</h6>
        </div>

        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label>Autor</label>
              <select v-model="userToAdd" class="form-control">
                <option
                  :value="author.cod"
                  v-for="author in authorList"
                  :key="author.cod"
                >
                  {{ author.nome }}
                </option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <button
              class="btn btn-primary mt-4 w-100"
              @click.prevent="addAuthor"
            >
              Adicionar
            </button>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-12">
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

        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label>Assunto</label>
              <select v-model="subjectToAdd" class="form-control">
                <option
                  :value="subject.cod"
                  v-for="subject in subjectList"
                  :key="subject.cod"
                >
                  {{ subject.descricao }}
                </option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <button
              class="btn btn-primary mt-4 w-100"
              @click.prevent="addSubject"
            >
              Adicionar
            </button>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-12">
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
      <button v-if="bookModel.cod" class="btn btn-success" @click.prevent="updateData">Atualizar</button>
      <button v-else class="btn btn-success" @click="saveData">Salvar</button>
    </template>
  </DialogBox>
</template>

<style scoped>
.label-author {
  padding: 0.7rem;
  font-size: 0.8rem;
  background: blue;
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
</style>
