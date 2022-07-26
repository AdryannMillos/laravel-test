import { http } from "./config";

export default {
  saveTask: (task, token) => {
    return http.post("/tasks/create", task, {
      headers: { Authorization: `Bearer ${token}` },
    });
  },

  readTasks: (params, token) => {
    return http.get(`/tasks/?page=${params}`, {
      headers: { Authorization: `Bearer ${token}` },
    });
  },

  getAll: (token) => {
    return http.get(`/tasks`, {
      headers: { Authorization: `Bearer ${token}` },
    });
  },

  updateTask: (task, token) => {
    return http.put(`/tasks/${task.id}/update`, task, {
      headers: { Authorization: `Bearer ${token}` },
    });
  },
};
