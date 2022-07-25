import { http } from "./config";

export default {
  saveTask: (task, token) => {
    return http.post("/tasks/create", task, {
      headers: { Authorization: `Bearer ${token}` },
    });
  },

  readTasks: (token) => {
    return http.get("/tasks", {
      headers: { Authorization: `Bearer ${token}` },
    });
  },

  updateTask: (task, token) => {
    return http.put(`/tasks/${task.id}/update`, task, {
      headers: { Authorization: `Bearer ${token}` },
    });
  },
};
