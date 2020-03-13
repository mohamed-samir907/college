<template>
  <div>
    <navigation :main-route="false" add-link="/admin/coupons/create" title="Coupons"></navigation>

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
                      <th scope="col">Coupon Code</th>
                      <th scope="col">Type</th>
                      <th scope="col">Usage Type</th>
                      <th scope="col">Usage Count</th>
                      <th scope="col">Expires at</th>
                      <th scope="col">Controls</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-if="coupons.length == 0">
                      <td colspan="5" class="text-center">
                        <div class="alert alert-danger p-3">There is no Coupons Added</div>
                      </td>
                    </tr>
                    <tr v-for="coupon in coupons.data" :key="coupon.id">
                      <th scope="row">{{ coupons.data.indexOf(coupon) + 1 }}</th>
                      <td>{{ coupon.code }}</td>
                      <td>{{ coupon.type }}</td>
                      <td>{{ coupon.usage }}</td>
                      <td>{{ coupon.multi_times_count }}</td>
                      <td>{{ coupon.expires_at }}</td>
                      <td>
                        <router-link :to="`/admin/coupons/${coupon.id}/edit`" class="btn btn-xs btn-success">Edit</router-link>
                        <button class="btn btn-xs btn-danger" @click="deleteAdmin(coupon.id)">Delete</button>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="5">
                        <pagination :data="coupons" @pagination-change-page="getCoupons"></pagination>
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
  name: "coupons-index",

  data() {
    return {
      isLoading: true,
      coupons: []
    };
  },

  mounted() {
    this.$Progress.start();
    this.$store.commit("setHeaderTitle", "Coupons");
    this.getCoupons();
    this.$Progress.finish();
  },

  methods: {
    getCoupons(page = 1) {
      axios.get("/admin-api/coupons?page=" + page)
        .then(response => {
          this.coupons = response.data.data;
          this.isLoading = false;
        });
    },

    deleteAdmin(id) {
      this.$Progress.start();

      let coupon = this.coupons.data.find(elem => {
        return elem.id == id;
      });

      let index = this.coupons.data.indexOf(coupon);

      axios.delete(`/admin-api/coupons/${id}`)
        .then(response => {
          Toast.fire({
            icon: "success",
            title: response.data.msg,
          });

          this.coupons.data.splice(index, 1);

          this.$Progress.finish();
        });
    }
  }
};
</script>