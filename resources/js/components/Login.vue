<template>
  <div class="login-modal">
    <div class="modal fade" id="signupModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-signup" role="document">
        <div class="modal-content">
          <div class="card card-signup card-plain">
            <div class="modal-header p-4">
              <h3 class="modal-title card-title">Login</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="material-icons">clear</i>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <form class="form" method action>
                    <div class="card-body">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                              <i class="material-icons">email</i>
                            </div>
                          </div>
                          <input
                            type="text"
                            class="form-control"
                            placeholder="Email..."
                            v-model="email"
                          />
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                              <i class="material-icons">lock_outline</i>
                            </div>
                          </div>
                          <input
                            type="password"
                            placeholder="Password..."
                            class="form-control"
                            v-model="password"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                      <button
                        class="btn btn-primary btn-round"
                        :disabled="!isValidLoginForm"
                        @click.prevent="attempLogin"
                      >Login</button>
                    </div>
                    <div class="text-center">
                      <a class="btn btn-link" href="#">Don't have an account? Create one here!</a>
                    </div>
                  </form>
                  <hr />
                  <h4>Or Login with:</h4>
                  <div class="social text-center">
                    <button class="btn btn-just-icon btn-round btn-twitter">
                      <i class="fa fa-twitter"></i>
                    </button>
                    <button class="btn btn-just-icon btn-round btn-dribbble">
                      <i class="fa fa-dribbble"></i>
                    </button>
                    <button class="btn btn-just-icon btn-round btn-facebook">
                      <i class="fa fa-facebook"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      email: "",
      password: "",
      loading: false
    };
  },

  methods: {
    validateEmail() {
      let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(String(this.email).toLowerCase());
    },

    attempLogin() {
      this.loading = true;
      axios
        .post("/login", {
          email: this.email,
          password: this.password
        })
        .then(res => {
          location.reload();
        })
        .catch(error => {
          console.log(error.message);
          this.loading = false;
        });
    }
  },

  computed: {
    isValidLoginForm() {
      return this.validateEmail() && this.password && !this.loading;
    }
  }
};
</script>
