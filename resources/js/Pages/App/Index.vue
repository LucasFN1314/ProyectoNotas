<template>
  <div>
    <Header></Header>
    <Main></Main>
    <Footer></Footer>
  </div>
</template>

<script>
import Header from '@/Components/Header/Header.vue'
import Footer from '@/Components/Footer/Footer.vue'
import Main from '@/Components/Main/Main.vue'
export default {
    components: {
        Header,
        Footer,
        Main
    }
}
</script>

<style>

</style>