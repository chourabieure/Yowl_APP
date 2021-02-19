<template>
	<div class="page page-Amis">
		<h2 class="amis">Amis</h2>

		<div class="content">
			<h2 v-for="friend in friends" :key="friend.id" class="user">
				{{friend.name}}
			</h2>
		</div>
	</div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
	name: "Amis",
	//Composants utilisés a l'intérieur de celui la

	//Variables propres au composant
	data() {
		return {
			friends: {},
		};
	},
	//Executé au montage du composant
	mounted() {
		axios
			.get("/api/admin/relations")
			.then((response) => {
				this.friends = response.data;
			})
			.catch((error) => console.log(error));
	},
	//Methods du composant
	methods: {},
};
</script>

<style scoped lang="scss">
.page-Amis {
	.user {
		margin: 5px auto;

		background: gray;
		width: 80%;
		padding: 5px;
		color: white;
		border-radius: 10px;
		text-align: center;
	}
}
</style>
