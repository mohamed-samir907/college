<template>
  <div>
    <navigation :main-route="false" add-link="/admin/categories/create" title="Categories"></navigation>

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
                      <th scope="col">Category Name</th>
                      <th scope="col">Course Name</th>
                      <th scope="col">Level</th>
                      <th scope="col">Group</th>
                      <th scope="col">Controls</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-if="categories.length == 0">
                      <td colspan="5" class="text-center">
                        <div class="alert alert-danger p-3">There is no Categories Added</div>
                      </td>
                    </tr>
                    <tr v-for="category in categories.data" :key="category.id">
                      <th scope="row">{{ category.id }}</th>
                      <td>{{ category.name }}</td>
                      <td>{{ category.course.name }}</td>
                      <td>{{ category.course.level }}</td>
                      <td>{{ category.course.group }}</td>
                      <td>
                        <router-link :to="`/admin/categories/${category.id}/edit`" class="btn btn-xs btn-success">Edit</router-link>
                        <button class="btn btn-xs btn-danger" @click="deleteCategory(category.id)">Delete</button>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="5">
                        <pagination :data="categories" @pagination-change-page="getCategories"></pagination>
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
  name: "categories-index",

  data() {
    return {
      isLoading: true,
      categories: []
    };
  },

  mounted() {
    this.$Progress.start();
    this.$store.commit("setHeaderTitle", "Categories");
    this.getCategories();
    this.$Progress.finish();
  },

  methods: {
    getCategories(page = 1) {
      axios.get("/admin-api/categories?page=" + page)
        .then(response => {
          this.categories = response.data.data;
          this.isLoading = false;
        });
    },

    deleteCategory(id) {
      this.$Progress.start();

      let category = this.categories.data.find(elem => {
        return elem.id == id;
      });

      let index = this.categories.data.indexOf(category);

      axios.delete(`/admin-api/categories/${id}`)
        .then(response => {
          Toast.fire({
            icon: "success",
            title: response.data.msg,
          });

          this.categories.data.splice(index, 1);

          this.$Progress.finish();
        });
    }
  }
};
</script>
