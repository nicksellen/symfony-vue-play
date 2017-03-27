<template>
  <div>
    <h1 :class="$style.title">
      this is my yay component
    </h1>
    <ul>
      <li>text is <strong>{{ text }}</strong></li>
      <li>number is <strong>{{ number }}</strong></li>
    </ul>
  </div>
</template>

<script>
  import axios from 'axios';
  export default {
    name: 'yay',
    data: () => {
      return {
        number: -1,
        text: 'initial text',
      };
    },
    created() {
      axios.get('/api/yay').then(({ data: { text, number } }) => {
        this.text = text;
        this.number = number;
      });
    }
  }
</script>

<style module>
  .title {
    color: red;
  }
</style>
