<template>
  <div>
    <navigation :main-route="true" add-link="/" title="Add Course"></navigation>

    <div class="main-content container-fluid">
      <error-alert :errors="errors" v-if="errors"></error-alert>
      <success-alert :message="successMessage" v-if="created"></success-alert>

      <form @submit.prevent="createCourse">
          <div class="row">
              <div class="col-md-12">
                  <div class="card card-border-color card-border-color-primary">
                      <div class="card-header card-header-divider">Course Addition
                          <span class="card-subtitle">These are Courses Addition form</span>
                      </div>
                      <div class="card-body">

                        <div class="form-group row">
                            <div class="col-12 col-md-4">
                                <label class="text-sm-right" for="name">Course Name</label>
                                <input class="form-control" id="name" type="text" v-model="form.name" placeholder="Course Name">
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="text-sm-right" for="level">Level</label>
                                <select id="level" v-model="form.level" class="form-control">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="text-sm-right" for="group">Group</label>
                                <select id="group" v-model="form.group" class="form-control">
                                    <option value="a">A</option>
                                    <option value="b">B</option>
                                </select>
                            </div>
                        </div>

                      </div>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="card card-border-color card-border-color-primary">
                      <div class="card-body">
                          <div class="row pt-3 mt-1">
                              <div class="col-md-11 col-sm-6">
                                  <p class="text-center">
                                      <button class="btn btn-space btn-primary" type="submit">Create</button>
                                      <button class="btn btn-space btn-secondary" type="reset">Reset</button>
                                  </p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: "courses-create",

  data() {
    return {
      created: false,
      successMessage: "",
      errors: null,
      brands: [],
      form: {
        name: "",
        level: "1",
        group: "a",
      }
    }
  },

  mounted() {
    this.$Progress.start();
    this.$store.commit("setHeaderTitle", "Courses");
    this.$Progress.finish();
  },

  methods: {
    createCourse() {
      this.$Progress.start();

      axios.post('/admin-api/courses', this.form)
        .then(response => {
          this.created = true;
          this.successMessage = response.data.msg;

          Toast.fire({
            icon: 'success',
            title: this.successMessage
          });

          this.$Progress.finish();
        })
        .catch(errors => {
          this.errors = errors;
          this.$Progress.fail();
        });
    },
  }
};
</script>
