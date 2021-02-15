<template>
	<div class="page page-Settings">

		<a class="btn-logout" href="/logout"><i class="fas fa-power-off"></i></a>
		<div class="avatar"><i class="fas fa-user"></i></div>
		<h2 class="username">{{getAuthUser.name}}</h2>


		

		<router-link :to="{name:'CRUD'}" class="btn-crud" v-if="getAuthUser.is_admin">CRUD</router-link>
	</div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
	name: "Settings",
	//Composants utilisés a l'intérieur de celui la
	components: {},
	//Variables propres au composant
	data() {
		return {};
	},
	//Executé au montage du composant
	mounted() {
		
	},
    computed: {
		...mapGetters(["getAuthUser"]),
	},
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
