<template>
  <footer>
    <a class="boton" @click="Logout">CERRAR SESION</a>
  </footer>
</template>

<script>
import {router } from '@inertiajs/vue3';

export default {
  methods: {
    Logout () {
      router.post(route('logout'));
    }
  }
};
</script>

<style scoped lang="scss">
footer {
  width: 100vw;
  height: 10vh;

  background: var(--azul);

  display: flex;
  align-items: center;
  justify-content: center;

  a {
    background: white;
    color: var(--azul)
  }
}
</style>