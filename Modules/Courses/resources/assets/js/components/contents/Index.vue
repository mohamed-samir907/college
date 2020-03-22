<template>
  <div>
    <navigation :main-route="false" add-link="/admin/contents/create" title="Contents"></navigation>

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
                      <th scope="col">Title</th>
                      <th scope="col">Type</th>
                      <th scope="col">Controls</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-if="contents.length == 0">
                      <td colspan="5" class="text-center">
                        <div class="alert alert-danger p-3">There is no Contents Added</div>
                      </td>
                    </tr>
                    <tr v-for="content in contents.data" :key="content.id">
                      <th scope="row">{{ content.id }}</th>
                      <td>{{ content.name }}</td>
                      <td>{{ content.level }}</td>
                      <td>{{ content.group }}</td>
                      <td>
                        <router-link :to="`/admin/contents/${content.id}/edit`" class="btn btn-xs btn-success">Edit</router-link>
                        <button class="btn btn-xs btn-danger" @click="deleteContent(content.id)">Delete</button>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="5">
                        <pagination :data="contents" @pagination-change-page="getContents"></pagination>
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
  name: "contents-index",

  data() {
    return {
      isLoading: true,
      contents: []
    };
  },

  mounted() {
    this.$Progress.start();
    this.$store.commit("setHeaderTitle", "Contents");
    this.getContents();
    this.$Progress.finish();
  },

  methods: {
    getContents(page = 1) {
      axios.get("/admin-api/contents?page=" + page)
        .then(response => {
          this.contents = response.data.data;
          this.isLoading = false;
        });
    },

    deleteContent(id) {
      this.$Progress.start();

      let content = this.contents.data.find(elem => {
        return elem.id == id;
      });

      let index = this.contents.data.indexOf(content);

      axios.delete(`/admin-api/contents/${id}`)
        .then(response => {
          Toast.fire({
            icon: "success",
            title: response.data.msg,
          });

          this.contents.data.splice(index, 1);

          this.$Progress.finish();
        });
    }
  }
};
</script>
