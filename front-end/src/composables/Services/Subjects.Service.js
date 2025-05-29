import { useHandleAPI } from "../Helpers/Handle.API";
import { useFetchAPI } from "../Helpers/Fetch.API";

export function useSubjectsService() {
  const { handleAPI } = useHandleAPI();
  const { fetchAPI } = useFetchAPI();

  function list(queryData = {}) {
    return handleAPI(fetchAPI.get(`/v1/assuntos`, { params: queryData }));
  }

  function store(data) {
    return handleAPI(fetchAPI.post(`/v1/assuntos`, data));
  }

  function update(id, data) {
    return handleAPI(fetchAPI.put(`/v1/assuntos/${id}`, data));
  }

  function show(id) {
    return handleAPI(fetchAPI.get(`/v1/assuntos/${id}`));
  }

  function destroy(id) {
    return handleAPI(fetchAPI.delete(`/v1/assuntos/${id}`));
  }

  return {
    list,
    store,
    update,
    show,
    destroy,
  };
}
