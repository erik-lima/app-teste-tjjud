import { useHandleAPI } from "../Helpers/Handle.API";
import { useFetchAPI } from "../Helpers/Fetch.API";

export function useHomeService() {
  const { handleAPI } = useHandleAPI();
  const { fetchAPI } = useFetchAPI();

  function homeData() {
    return handleAPI(fetchAPI.get(`/v1/home-data`));
  }

  return {
    homeData
  };
}
