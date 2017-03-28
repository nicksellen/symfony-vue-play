<template>
  <div>
    <h1 :class="$style.title">
      This is HomePage.vue
    </h1>
    <yay></yay>
    <a href="/other-page">other-page</a>
  </div>
</template>

<script>
  import yay from './yay.vue';
  export default {
    name: 'HomePage',
    components: { yay },
  }
</script>

<style module>
  .title {
    color: orange;
  }
</style>
