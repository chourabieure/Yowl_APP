<template>
	<div class="page-crud">
		<div class="header-page">
			<router-link :to="{name:'Settings'}" class="btn-back"><i class="fas fa-arrow-left"></i></router-link>

			<h2 class="title">Admin</h2>
		</div>
		<div class="links">
			<router-link :to="{name:'CRUD_USER'}" class="link">Users</router-link>
			<router-link :to="{name:'CRUD_POST'}" class="link">Posts</router-link>
		</div>

	</div>
</template>

<script>
export default {
	name: "CRUD",
	//Composants utilisés a l'intérieur de celui la
	components: {},
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
.page-crud {
	.links {
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		padding: 0 30px;
		padding-top: 50px;
		.link {
			margin-top: 30px;
			width: 100%;
			padding: 5px 10px;
			text-align: center;
			color: white;
			font-size: 23px;
			font-weight: bold;
			background-color: #4b9dac;
			border: solid 5px white;
			border-radius: 15px;
			box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px,
				rgba(0, 0, 0, 0.23) 0px 3px 6px;
			&:hover {
				text-decoration: none;
			}
		}
	}
}
</style>
