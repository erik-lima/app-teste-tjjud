import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useAuthorStore = defineStore('authorStore', () => {
  const model = ref({
    cod: null,
    nome: null,
  });

  function setModel (data) {
    model.value = {
      cod: data.cod || null,
      nome: data.nome || null,
    };
  }

  return {
    model,
    setModel,
  };
});
