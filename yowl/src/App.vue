<template>
  <div id="app">
    <router-view/>
		<Menu />
  </div>
</template>

<script>
import Menu from "./views/Menu.vue";
export default {
  components:{
    Menu
  }  

}
</script>

<style scoped lang="scss">


</style>
