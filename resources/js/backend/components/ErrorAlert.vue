<template>
  <div class="alert alert-danger alert-icon alert-icon-border alert-dismissible" role="alert">
    <div class="icon">
      <span class="mdi mdi-close-circle-o"></span>
    </div>
    <div class="message">
      <button class="close" type="button" data-dismiss="alert" aria-label="Close">
        <span class="mdi mdi-close" aria-hidden="true"></span>
      </button>
      <ul>
        <li v-for="(filedErrors, filedName) in errors" :key="filedName">
            <strong>{{ filedName }}</strong> {{ filedErrors.join("\n") }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  props: ["errors"]
};
</script>