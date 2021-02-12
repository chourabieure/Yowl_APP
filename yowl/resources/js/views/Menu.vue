<template>
	<div class="view-Menu">
		<router-link :to="{name:'Settings'}"><i class="fas fa-bars"></i></router-link>
		<router-link :to="{name:'Feed'}"><i class="fas fa-home"></i></router-link>
		<router-link :to="{name:'Amis'}"><i class="fas fa-user-friends"></i></router-link>

		<div class="btn-poly">
			<div class="button"></div>
		</div>
	</div>
</template>

<script>

import { mapGetters, mapActions } from "vuex";

export default {
	name: "Menu",
	data() {
		return {};
	},
	created() {
		this.fetchAuthUser();
	},
	mounted() {

	},
	methods: {
		...mapActions(["fetchAuthUser"]),
	},
    computed: {
		...mapGetters(["getAuthUser"]),
	},
};
</script>

<style scoped lang="scss">
.view-Menu {
	background-color: #214e5b;
}
.view-Menu {
	position: fixed;
	bottom: 0;
	width: 100%;
	display: flex;
	justify-content: space-around;
	align-items: center;
	padding: 20px 20px;
	padding-right: 30px;

	i {
		font-size: 30px !important;
		color: white;
	}
	.btn-poly {
		// background-color:#4B9DAC ;
		height: 60px;
		width: 30px;
		position: relative;

		.button {
			position: absolute;
			background-color: #4b9dac;
			border: solid 5px white;
			border-radius: 15px;
			top: -55px;
			left: 50%;
			transform: translate(-50%);
			height: 75px;
			width: 75px;
			box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px,
				rgba(0, 0, 0, 0.23) 0px 3px 6px;
		}
	}
}
</style>
