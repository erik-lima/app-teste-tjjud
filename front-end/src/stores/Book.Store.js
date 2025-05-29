import { defineStore } from "pinia";
import { ref } from "vue";

export const useBookStore = defineStore("bookStore", () => {
  const model = ref({
    cod: null,
    titulo: null,
    editora: null,
    edicao: null,
    valor: 0,
    ano_publicacao: null,
    autores: [],
    assuntos: [],
  });

  function setModel(data) {
    model.value = {
      cod: data.cod || null,
      titulo: data.titulo || null,
      editora: data.editora || null,
      edicao: data.edicao || null,
      valor: data.valor || 0,
      ano_publicacao: data.ano_publicacao || null,
      autores: data.autores || [],
      assuntos: data.assuntos || [],
    };
  }

  return {
    model,
    setModel,
  };
});
