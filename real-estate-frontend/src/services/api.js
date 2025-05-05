import axios from 'axios';

const API_URL = 'http://127.0.0.1:8001/api';
const API_TOKEN = '5adcb9e1a4c84ca5e4247d22d21991c04c3a20a4d592cbf296dc7902f743c270';

export const api = axios.create({
    baseURL: API_URL,
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'X-API-TOKEN': API_TOKEN
    },
    withCredentials: true
});

export const getProperties = () => api.get('/real-estates');
export const getProperty = (id) => api.get(`/real-estates/${id}`);
export const createProperty = (data) => api.post('/real-estates', data);
export const updateProperty = (id, data) => api.put(`/real-estates/${id}`, data);
export const deleteProperty = (id) => api.delete(`/real-estates/${id}`);
