<template>
  <div id="app">
    <template v-if="route.path.startsWith('/admin')">
      <admin-header></admin-header>
    </template>
    <template v-else>
      <header-info></header-info>
    </template>
    <main>
      <router-view></router-view>
    </main>
  </div>
</template>

<script setup>
import { useRoute } from 'vue-router';

const route = useRoute();
</script>