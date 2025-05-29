export function useHandleAPI() {
  async function handleAPI(promise) {
    try {
      const response = await promise;
      return response.data;
    } catch (error) {
      const errorObj = {
        error: true,
        message: 'Erro de rede',
      };

      if (error.status && error.status === 401) {
        errorObj.message = 'Token inválido';
      } else if (error.status && error.status === 403) {
        errorObj.message = 'Você não tem permissão para acessar esta página';
      } else if (error.status && error.status === 404) {
        errorObj.message = 'Página requisitada não encontrada';
      } else if (error.status && error.status >= 500) {
        errorObj.message = 'Erro interno do servidor';
      } else if (error.status && error.status >= 400) {
        if (error.response && error.response.data && error.response.data.message) {
          errorObj.message = error.response.data.message;
        } else {
          errorObj.message = 'Erro de validação';
        }
      }

      return errorObj;
    }
  }

  return {
    handleAPI,
  };
}
