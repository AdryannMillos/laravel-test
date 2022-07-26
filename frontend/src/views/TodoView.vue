<template>
  <div>
    <h1>My Todo</h1>
    <div class="row" v-if="!isAdmin">
        <div class="card login">
          <b>{{ this.error }}</b>
          <form class="form-group" @submit.prevent="create()">
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
    <div class="row">
        <div class="card login">
          <h1>Tasks</h1>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th v-if="isAdmin">Email</th>
                <th>Description</th>
                <th>Exp. Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody v-for="(task, index) in allTasks" :key="index">
              <td v-if="isAdmin">{{ task.user.email }}</td>
              <td>
                <input
                  v-if="new Date(task.expiration_date) < new Date()"
                  v-model="task.description"
                  type="text"
                  name="description"
                  id="description"
                  class="form-control danger"
                  placeholder="Description"
                  maxlength="30"
                  required
                />
                <input
                  v-else
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
              <td v-if="task.done == false && !isAdmin">
                <button
                  type="submit"
                  class="btn btn-primary"
                  @click="edit(task)"
                >
                  🖊️
                </button>
                <button
                  type="submit"
                  class="btn btn-primary"
                  @click="done(task)"
                >
                  ✔️
                </button>
              </td>
            </tbody>
            <button v-if="isAdmin" type="submit" class="btn btn-primary" @click="expired()">
              Expired
            </button>
            <button v-if="isAdmin"
              type="submit"
              class="btn btn-primary"
              @click="read(pageParam)"
            >
              clear
            </button>
          </table>
      </div>
    </div>
    <ul class="pagination justify-content-center">
      <li v-for="(page, index) of pages" :key="index" class="page-item">
        <a
          v-if="!isNaN(page.label)"
          class="page-link"
          :href="'/my-todo/?page=' + page.label"
          >{{ !isNaN(page.label) ? page.label : "" }}</a
        >
      </li>
    </ul>
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
      isAdmin: "",
      pageParam: "",
      pages: "",
    };
  },
  created() {
    this.token = localStorage.getItem("userToken");
    if (!this.token) {
      this.$router.push("/");
    }
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
    read(params) {
      Tasks.readTasks(params, this.token)
        .then((response) => {
          this.allTasks = response.data.data;
          this.isAdmin = typeof this.allTasks[0].user !== "undefined";
          this.pages = response.data.links;
        })
        .catch((error) => {
            console.error(error);
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
      let month = ("0" + (today.getMonth() + 1)).slice(-2);
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
    expired() {
      return (this.allTasks = this.allTasks.filter(
        (item) => new Date(item.expiration_date) < new Date()
      ));
    },
  },
  mounted() {
    this.pageParam = this.$route.query.page;
    if (!this.pageParam) {
      this.pageParam = 1;
    }
    this.read(this.pageParam);
  },
};
</script>

<style scoped>
p {
  line-height: 1rem;
}

.card {
  padding: 20px;
  width: 1000px;
}
.row {
  display: flex;
  justify-content: center;
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
.danger {
  border-color: red;
}
</style>
