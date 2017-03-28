<template>
  <div>
    <h1 :class="$style.title">
      This is OtherPage.vue
    </h1>
    <yay></yay>
    <a href="/">home</a>
  </div>
</template>

<script>
  import yay from './yay.vue';
  export default {
    name: 'OtherPage',
    components: { yay },
  }
</script>

<style module>
  .title {
    color: blue;
  }
</style>
