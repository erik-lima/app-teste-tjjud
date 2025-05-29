import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useSubjectStore = defineStore('subjectStore', () => {
  const model = ref({
    cod: null,
    descricao: null,
  });

  function setModel (data) {
    model.value = {
      cod: data.cod || null,
      descricao: data.descricao || null,
    };
  }

  return {
    model,
    setModel,
  };
});
