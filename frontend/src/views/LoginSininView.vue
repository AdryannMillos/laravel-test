<template>
  <div>
    <b>{{ this.error }}</b>
    <div class="login-page">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-8 mx-auto">
            <div
              v-if="!registerActive"
              class="card login"
              v-bind:class="{ error: emptyFields }"
            >
              <h1>Sign In</h1>
              <form class="form-group" @submit.prevent="login">
                <input
                  v-model="user.email"
                  type="text"
                  name="email"
                  id="email"
                  class="form-control"
                  placeholder="Email"
                  required
                />
                <input
                  v-model="user.password"
                  type="password"
                  class="form-control"
                  placeholder="Password"
                  name="password"
                  id="password"
                  required
                />
                <button type="submit" class="btn btn-primary">Submit</button>
                <p>
                  Don't have an account?
                  <a
                    href="#"
                    @click="
                      (registerActive = !registerActive), (emptyFields = false)
                    "
                    >Sign up here</a
                  >
                </p>
              </form>
            </div>

            <div
              v-else
              class="card register"
              v-bind:class="{ error: emptyFields }"
            >
              <h1>Sign Up</h1>
              <form class="form-group" @submit.prevent="create">
                <input
                  v-model="user.name"
                  type="text"
                  class="form-control"
                  placeholder="Name"
                  name="name"
                  id="name"
                  required
                />
                <input
                  v-model="user.email"
                  type="email"
                  class="form-control"
                  placeholder="Email"
                  name="email"
                  id="email"
                  required
                />
                <input
                  v-model="user.password"
                  type="password"
                  class="form-control"
                  placeholder="Password"
                  name="password"
                  id="password"
                  required
                />
                <input
                  v-model="user.confirmPassword"
                  type="password"
                  class="form-control"
                  placeholder="Confirm Password"
                  name="confirmPassword"
                  id="confirmPassword"
                  required
                />
                <button type="submit" class="btn btn-primary">Submit</button>
                <p>
                  Already have an account?
                  <a
                    href="#"
                    @click="
                      (registerActive = !registerActive), (emptyFields = false)
                    "
                    >Sign in here</a
                  >
                </p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Users from "../services/users";
export default {
  name: "LoginSinin",
  data() {
    return {
      user: {
        name: "",
        email: "",
        password: "",
        confirmPassword: "",
      },
      error: "",
      registerActive: false,
      emptyFields: false,
    };
  },
  components: {},
  methods: {
    create() {
      Users.saveUser(this.user)
        .then((response) => {
          alert(response.data.message);
          window.location.reload();
        })
        .catch((error) => {
          this.error = error.response.data.message;
        });
    },
    login() {
      Users.loginUser(this.user)
        .then((response) => {
          localStorage.setItem("userToken", response.data);
          this.$router.push("/my-todo");
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
}

.form-group input {
  margin-bottom: 20px;
}
.card {
  box-shadow: 0 20px 50px 0 rgba(0, 0, 0, 0.3);
}
</style>
