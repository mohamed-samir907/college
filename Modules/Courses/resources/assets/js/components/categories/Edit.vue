<template>
  <div>
    <navigation :main-route="true" add-link="/" title="Edit Coupon"></navigation>

    <div class="main-content container-fluid">
      
      <template v-if="isLoading">
        <vcl-list height="50%" width="100%" :speed="1" primary="#e2e2e2" secondary="#C0C0C0"></vcl-list>
      </template>
      <template v-else>
        <error-alert :errors="errors" v-if="errors"></error-alert>
        <success-alert :message="successMessage" v-if="updated"></success-alert>

        <form @submit.prevent="updateCoupon">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-border-color card-border-color-primary">
                        <div class="card-header card-header-divider">Coupon Editition
                            <span class="card-subtitle">These are Coupons Editition form</span>
                        </div>
                        <div class="card-body">

                          <div class="form-group row">
                            <div class="col-12 col-md-4">
                                <label class="text-sm-right" for="brand_id">Brand</label>
                                <select id="brand_id" v-model="form.brand_id" class="form-control">
                                  <option v-for="brand in brands" :key="brand.user_id" :value="brand.user_id">{{ brand.brand_name }}</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="text-sm-right" for="type">Type</label>
                                <select id="type" v-model="form.type" class="form-control">
                                    <option value="percentage">Percentage</option>
                                    <option value="fixed">Fixed</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="text-sm-right" for="amount">Amount</label>
                                <input class="form-control" id="amount" type="number" v-model="form.amount" placeholder="Amount">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-md-4">
                                <label class="text-sm-right" for="code">Coupon Code</label>
                                <input class="form-control" id="code" type="text" v-model="form.code" placeholder="Code">
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="text-sm-right" for="usage">Usage</label>
                                <select id="usage" v-model="form.usage" class="form-control">
                                    <option value="one_time">One Time</option>
                                    <option value="multi_times">Multi Times</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="text-sm-right" for="multi_times_count">Multi times usage count</label>
                                <input class="form-control" id="multi_times_count" type="number" v-model="form.multi_times_count" placeholder="Multi times usage count">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-md-4">
                                <label class="text-sm-right" for="user_usage">User Usage</label>
                                <select id="user_usage" v-model="form.user_usage" class="form-control">
                                    <option value="one_time">One Time</option>
                                    <option value="multi_times">Multi Times</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="text-sm-right" for="expires_at">Expires at</label>
                                <input class="form-control" id="expires_at" type="date" v-model="form.expires_at" placeholder="Expires at">
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
                                        <button class="btn btn-space btn-primary" type="submit">Update</button>
                                        <button class="btn btn-space btn-secondary" type="reset">Reset</button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
      </template>

    </div>
  </div>
</template>

<script>
import { VclList } from 'vue-content-loading';
export default {
  name: "coupons-edit",

  components: {
    VclList
  },

  data() {
    return {
      isLoading: true,
      updated: false,
      successMessage: "",
      errors: null,
      brands: [],
      form: {
        brand_id: "",
        type: "",
        amount: "",
        code: "",
        usage: "",
        multi_times_count: 1,
        user_usage: "",
        expires_at: "",
      }
    }
  },

  mounted() {
    this.$Progress.start();
    this.$store.commit("setHeaderTitle", "Coupons");
    this.getCoupon();
    this.$Progress.finish();
  },

  methods: {
    getCoupon() {
      axios.get(`/admin-api/coupons/${this.$route.params.id}/edit`)
        .then(response => {
          let coupon = response.data.data.coupon;
          this.brands = response.data.data.brands;

          this.form = {
            brand_id: coupon.brand_id,
            type: coupon.type,
            amount: coupon.amount,
            code: coupon.code,
            usage: coupon.usage,
            multi_times_count: coupon.multi_times_count,
            user_usage: coupon.user_usage,
            expires_at: coupon.expires_at,
          };

          this.isLoading = false;
        });
    },

    updateCoupon() {
      this.$Progress.start();
      this.errors       = null;
      const constraints = this.getConstraints();
      const errors      = validate(this.form, constraints);

      if (errors) {
        this.errors = errors;
        this.$Progress.fail();
        return;
      }

      axios.put(`/admin-api/coupons/${this.$route.params.id}`, this.form)
        .then(response => {
          this.updated = true;
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

    getConstraints() {
      return {
        brand_id: {
          presence: true,
          inclusion: {
            within: this.brands.map(brand => brand.user_id),
            message: "not exsits in the brads."
          }
        },
        type: {
          presence: true,
          inclusion: {
            within: ["fixed","percentage"],
            message: "not valid."
          }
        },
        amount: {
          numericality: true
        },
        code: {
          presence: true
        },
        usage: {
          presence: true,
          inclusion: {
            within: ["one_time","multi_times"],
            message: "not valid."
          }
        },
        multi_times_count: {
          numericality: true
        },
        user_usage: {
          presence: true,
          inclusion: {
            within: ["one_time","multi_times"],
            message: "not valid."
          }
        },
        expires_at: {
          presence: true,
        }
      }
    }
  }
};
</script>