<template>
	<div class="page-Feed">
		<h2>Page Feed</h2>

		<Menu />
	</div>
</template>

<script>
import Menu from "../views/Menu.vue";
export default {
	name: "Feed",
	//Composants utilisés a l'intérieur de celui la
	components: {
		Menu,
	},
	//Variables propres au composant
	data() {
		return {};
	},
	//Executé au montage du composant
	mounted() {},
	//Methods du composant
	methods: {},
};
</script>

<style scoped lang="scss">
</style>
