<template>
  <div>
    <div class="page-head">
      <div class="row">
        <div class="col-sm-12 col-md-6">
          <h2 class="page-head-title">
            <button class="btn btn-rounded btn-space btn-secondary" 
              v-if="mainRoute" @click="goBack"><i class="icon mdi mdi-arrow-left"></i></button>
            {{ title }}
          </h2>
        </div>
        <div class="col-sm-12 col-md-6 pt-2 text-right" v-if="!mainRoute">
          <router-link :to="addLink" class="btn btn-primary">Add {{ title }}</router-link>
        </div>
      </div>
    </div>
    <!-- <hr /> -->
  </div>
</template>

<script>
export default {
  props: {
    title: String,
    addLink: String,
    mainRoute: Boolean,
    hasButton: Boolean
  },
  
  data () {
    return {
      prevRoute: false
    }
  },

  mounted() {
    if (window.history.length > 1) {
      this.prevRoute = true;
    }
  },

  methods: {
    goBack() {
      window.history.length > 1 ? this.$router.go(-1) : this.$router.push('/')
    }
  }
};
</script>