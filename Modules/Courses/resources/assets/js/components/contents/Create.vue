<template>
  <div>
    <navigation :main-route="true" add-link="/" title="Add Content"></navigation>

    <div class="main-content container-fluid">
      <error-alert :errors="errors" v-if="errors"></error-alert>
      <success-alert :message="successMessage" v-if="created"></success-alert>

      <form @submit.prevent="createContent">
          <div class="row">
              <div class="col-md-12">
                  <div class="card card-border-color card-border-color-primary">
                      <div class="card-header card-header-divider">Content Addition
                          <span class="card-subtitle">These are Contents Addition form</span>
                      </div>
                      <div class="card-body">

                        <div class="form-group row">
                            <div class="col-12 col-md-4">
                                <label class="text-sm-right" for="group">Category - Course</label>
                                <select id="group" v-model="form.category_id" class="form-control">
                                    <option v-for="category in categories" :value="category.id" :key="category.id">
                                        {{ '(' + category.course.level + ', ' + category.course.group + ') (' + category.name + ') (' + category.course.name + ')' }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="text-sm-right" for="name">Content Name</label>
                                <input class="form-control" id="name" type="text" v-model="form.name" placeholder="Content Name">
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
  name: "contents-create",

  data() {
    return {
      created: false,
      successMessage: "",
      errors: null,
      categories: [],
      form: {
        category_id: "",
        level: "1",
        group: "a",
      }
    }
  },

  mounted() {
    this.$Progress.start();
    this.$store.commit("setHeaderTitle", "Contents");
    this.init();
    this.$Progress.finish();
  },

  methods: {
    init() {
        axios.get("/admin-api/contents/create")
            .then(response => {
                this.categories = response.data.data;
            });
    },
    createContent() {
      this.$Progress.start();

      axios.post('/admin-api/contents', this.form)
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
