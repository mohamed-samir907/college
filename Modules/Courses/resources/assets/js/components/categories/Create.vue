<template>
  <div>
    <navigation :main-route="true" add-link="/" title="Add Category"></navigation>

    <div class="main-content container-fluid">
      <error-alert :errors="errors" v-if="errors"></error-alert>
      <success-alert :message="successMessage" v-if="created"></success-alert>

      <form @submit.prevent="createCategory">
          <div class="row">
              <div class="col-md-12">
                  <div class="card card-border-color card-border-color-primary">
                      <div class="card-header card-header-divider">Category Addition
                          <span class="card-subtitle">These are Categories Addition form</span>
                      </div>
                      <div class="card-body">

                        <div class="form-group row">
                            <div class="col-12 col-md-4">
                                <label class="text-sm-right" for="brand_id">Course</label>
                                <select id="brand_id" v-model="form.course_id" class="form-control">
                                  <option v-for="course in courses" :key="course.id" :value="course.id">{{ course.name }}</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="text-sm-right" for="name">Category Name</label>
                                <input class="form-control" id="name" type="text" v-model="form.name" placeholder="Course Name">
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
  name: "categories-create",

  data() {
    return {
      created: false,
      successMessage: "",
      errors: null,
      courses: [],
      form: {
        course_id: "",
        name: "",
      }
    }
  },

  mounted() {
    this.$Progress.start();
    this.$store.commit("setHeaderTitle", "Categories");
    this.init();
    this.$Progress.finish();
  },

  methods: {
    init() {
      axios.get("/admin-api/categories/create")
        .then(response => {
          this.courses = response.data.data;
        });
    },

    createCategory() {
      this.$Progress.start();

      axios.post('/admin-api/categories', this.form)
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
