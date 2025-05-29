<script setup>
import { ref, defineModel, defineEmits } from "vue";
import { storeToRefs } from "pinia";
import DialogBox from "../DialogBox.vue";
import { useAuthorsService } from "@/composables/Services/Authors.Service";
import { useAuthorStore } from "@/stores/Author.Store";

const emit = defineEmits(["refresh"]);
const model = defineModel();
const { store, update } = useAuthorsService();
const { model: authorModel } = storeToRefs(useAuthorStore());

const dialogModal = ref(null);

async function saveData() {
  const { error, message } = await store(authorModel.value);
  if (error) {
    alert(message);
  }
  emit("refresh");
  model.value = false;
}

async function updateData() {
  const { error, message } = await update(
    authorModel.value.id,
    authorModel.value
  );
  if (error) {
    alert(message);
  }
  emit("refresh");
  model.value = false;
}
</script>

<template>
  <DialogBox v-model="model" title="Novo livro" ref="dialogModal">
    <template #body>
      <form>
        <div class="form-group">
          <label>Nome</label>
          <input
            v-model="authorModel.nome"
            class="form-control"
            maxlength="40"
          />
        </div>
      </form>
    </template>

    <template #footer>
      <button
        v-if="authorModel.cod"
        @click="updateData"
        class="btn btn-success"
      >
        Atualizar
      </button>
      <button v-else @click="saveData" class="btn btn-success">Salvar</button>
    </template>
  </DialogBox>
</template>
