<template>
  <div>
    <h1>My Todo</h1>
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-8 mx-auto">
        <div class="card login">
          <b>{{ this.error }}</b>
          <form class="form-group" @submit.prevent="create">
            <input
              v-model="task.description"
              type="text"
              name="description"
              id="description"
              class="form-control"
              placeholder="Description"
              maxlength="20"
              required
            />
            <input
              v-model="task.expiration_date"
              type="date"
              name="expiration_date"
              id="expiration_date"
              class="form-control"
              placeholder="Expiration Date"
              required
            />
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-8 mx-auto">
        <div class="card login">
          <h1>Tasks</h1>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th v-if="isAdmin">Email</th>
                <th>Description</th>
                <th>Exp. Date</th>
                <th>Done Dt.</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody v-for="(task, index) in allTasks" :key="index">
            <td v-if="isAdmin">{{task.user.email}}</td>
              <td>
                <input
                  v-model="task.description"
                  type="text"
                  name="description"
                  id="description"
                  class="form-control"
                  placeholder="Description"
                  maxlength="30"
                  required
                />
              </td>
              <td>
                <input
                  v-model="task.expiration_date"
                  type="date"
                  name="description"
                  id="description"
                  class="form-control"
                  placeholder="Description"
                  required
                />
              </td>
              <td>
                <input
                  v-model="task.done_date"
                  type="date"
                  name="description"
                  id="description"
                  class="form-control"
                  placeholder="Description"
                  required
                />
              </td>
              <td v-if="task.done == false">
                <button
                  type="submit"
                  class="btn btn-primary"
                  @click="edit(task)"
                >
                  Edit
                </button>
                <button
                  type="submit"
                  class="btn btn-primary"
                  @click="done(task)"
                >
                  Don
                </button>
              </td>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Tasks from "../services/tasks";

export default {
  name: "TodoView",
  data() {
    return {
      task: {
        description: "",
        done: false,
        done_date: "",
        expiration_date: "",
      },
      token: "",
      error: "",
      allTasks: "",
      truthy: true,
      isAdmin: ""
    };
  },
  created() {
    this.token = localStorage.getItem("userToken");
    if (!this.token) {
      this.$router.push("/");
    }
    this.read();
  },
  computed: {},
  methods: {
    create() {
      Tasks.saveTask(this.task, this.token)
        .then((response) => {
          alert(response.data.message);
          window.location.reload();
        })
        .catch((error) => {
          this.error = error.response.data.message;
        });
    },
    read() {
      Tasks.readTasks(this.token)
        .then((response) => {
          this.allTasks = response.data;
          this.isAdmin = (typeof this.allTasks[0].user !== "undefined" );
        })
        .catch((error) => {
          this.error = error.response.data.message;
        });
    },
    edit(task) {
      Tasks.updateTask(task, this.token)
        .then((response) => {
          alert(response.data.message);
          window.location.reload();
        })
        .catch((error) => {
          this.error = error.response.data.message;
        });
    },
    done(task) {
      let today = new Date();
      let year = today.getFullYear();
      let month = ("0"+(today.getMonth() + 1)).slice(-2);
      let day = today.getDate();
      let date = year + "-" + month + "-" + day;
      task.done = true;
      task.done_date = date;
      Tasks.updateTask(task, this.token)
        .then((response) => {
          alert(response.data.message);
          window.location.reload();
        })
        .catch((error) => {
          this.error = error.response.data.message;
        });
    },
  },
};
</script>

<style scoped>
p {
  line-height: 1rem;
}

.card {
  padding: 20px;
  /* width: 600px; */
}

.form-group input {
  margin-bottom: 20px;
}
.card {
  box-shadow: 0 20px 50px 0 rgba(0, 0, 0, 0.3);
}
.btn {
  background-color: none;
}
</style>
