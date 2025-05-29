import { useHandleAPI } from "../Helpers/Handle.API";
import { useFetchAPI } from "../Helpers/Fetch.API";

export function useBooksService() {
  const { handleAPI } = useHandleAPI();
  const { fetchAPI } = useFetchAPI();

  function list(queryData = {}) {
    return handleAPI(fetchAPI.get(`/v1/livros`, { params: queryData }));
  }

  function store(data) {
    return handleAPI(fetchAPI.post(`/v1/livros`, data));
  }

  function update(id, data) {
    return handleAPI(fetchAPI.put(`/v1/livros/${id}`, data));
  }

  function show(id) {
    return handleAPI(fetchAPI.get(`/v1/livros/${id}`));
  }

  function destroy(id) {
    return handleAPI(fetchAPI.delete(`/v1/livros/${id}`));
  }

  return {
    list,
    store,
    update,
    show,
    destroy,
  };
}
