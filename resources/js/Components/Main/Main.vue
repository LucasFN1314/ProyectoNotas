<template>
    <main>
        <Notas></Notas>
    </main>
</template>

<script>
import Notas from '../Notas/Notas.vue'
export default {
    components: {
        Notas
    }
}
</script>

<style scoped lang="scss">
    main {
        height: 80vh;
        overflow-y: scroll;
    }
</style>