<template>
  <div class="alert alert-success alert-icon alert-icon-border alert-dismissible" role="alert">
    <div class="icon">
      <span class="mdi mdi-check"></span>
    </div>
    <div class="message">
      <button class="close" type="button" data-dismiss="alert" aria-label="Close">
        <span class="mdi mdi-close" aria-hidden="true"></span>
      </button>
      {{ message }}
    </div>
  </div>
</template>

<script>
export default {
  props: ["message"]
};
</script>