<template>
	<div class="page page-Settings">

		<div class="avatar"><i class="fas fa-user"></i></div>
		<h2 class="username">Admin</h2>

		<a class="btn-logout" href="/logout"><i class="fas fa-power-off"></i></a>
	</div>
</template>

<script>
export default {
	name: "Template",
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
.page {
	position: relative;
	padding-top: 50px;

	text-align: center;

	.avatar {
		margin: auto;
		position: relative;
		width: 120px;
		height: 120px;
		border-radius: 75px;
		background-color: #4b9dac;

		i {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			color: white;
			font-size: 65px;
		}
	}
	.username {
		padding-top: 10px;
		font-size: 30px;
		font-weight: bold;
	}

	.btn-logout {
		position: absolute;
		height: 40px;
		width: 40px;
		border-radius: 20px;
		right: 10px;
		top: 10px;
    

		i {
      position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			color: #4b9dac;
			font-weight: bold;

      font-size: 30px;
     
			
		}

		&:hover {
			text-decoration: none;
		}
	}
}
</style>
