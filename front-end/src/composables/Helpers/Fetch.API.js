import axios from "axios"

export function useFetchAPI() {
  const endpoint = "http://localhost:8074/api"
  
  const fetchAPI = axios.create({
    baseURL: endpoint
  });

  return {
    fetchAPI
  }
}
