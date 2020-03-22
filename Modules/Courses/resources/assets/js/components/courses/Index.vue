<template>
  <div>
    <navigation :main-route="false" add-link="/admin/courses/create" title="Courses"></navigation>

    <div class="main-content container-fluid">
      <div class="card-content p-3 bg-custom">
        <div class="row">
          <div class="col-md-12">

            <template v-if="isLoading == true">
              <vcl-table :speed="1" primary="#e2e2e2" secondary="#C0C0C0"></vcl-table>
            </template>
            <template v-else>
              <div class="table-responsive-lg">
                <table id="datatable" class="table table-sm table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Course Name</th>
                      <th scope="col">Level</th>
                      <th scope="col">Group</th>
                      <th scope="col">Controls</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-if="courses.length == 0">
                      <td colspan="5" class="text-center">
                        <div class="alert alert-danger p-3">There is no Courses Added</div>
                      </td>
                    </tr>
                    <tr v-for="course in courses.data" :key="course.id">
                      <th scope="row">{{ course.id }}</th>
                      <td>{{ course.name }}</td>
                      <td>{{ course.level }}</td>
                      <td>{{ course.group }}</td>
                      <td>
                        <router-link :to="`/admin/courses/${course.id}/edit`" class="btn btn-xs btn-success">Edit</router-link>
                        <button class="btn btn-xs btn-danger" @click="deleteCourse(course.id)">Delete</button>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="5">
                        <pagination :data="courses" @pagination-change-page="getCourses"></pagination>
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </template>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { VclTable } from 'vue-content-loading';
export default {
  components: {
    VclTable
  },
  name: "courses-index",

  data() {
    return {
      isLoading: true,
      courses: []
    };
  },

  mounted() {
    this.$Progress.start();
    this.$store.commit("setHeaderTitle", "Courses");
    this.getCourses();
    this.$Progress.finish();
  },

  methods: {
    getCourses(page = 1) {
      axios.get("/admin-api/courses?page=" + page)
        .then(response => {
          this.courses = response.data.data;
          this.isLoading = false;
        });
    },

    deleteCourse(id) {
      this.$Progress.start();

      let course = this.courses.data.find(elem => {
        return elem.id == id;
      });

      let index = this.courses.data.indexOf(course);

      axios.delete(`/admin-api/courses/${id}`)
        .then(response => {
          Toast.fire({
            icon: "success",
            title: response.data.msg,
          });

          this.courses.data.splice(index, 1);

          this.$Progress.finish();
        });
    }
  }
};
</script>
