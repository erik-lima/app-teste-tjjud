import { useHandleAPI } from "../Helpers/Handle.API";
import { useFetchAPI } from "../Helpers/Fetch.API";

export function useAuthorsService() {
  const { handleAPI } = useHandleAPI();
  const { fetchAPI } = useFetchAPI();

  function list(queryData = {}) {
    return handleAPI(fetchAPI.get(`/v1/autores`, { params: queryData }));
  }

  function store(data) {
    return handleAPI(fetchAPI.post(`/v1/autores`, data));
  }

  function update(id, data) {
    return handleAPI(fetchAPI.put(`/v1/autores/${id}`, data));
  }

  function show(id) {
    return handleAPI(fetchAPI.get(`/v1/autores/${id}`));
  }

  function destroy(id) {
    return handleAPI(fetchAPI.delete(`/v1/autores/${id}`));
  }

  return {
    list,
    store,
    update,
    show,
    destroy,
  };
}
