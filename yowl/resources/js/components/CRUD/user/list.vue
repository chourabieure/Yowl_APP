<template>
	<div class="page-crud-user">
		<div class="header-page">
			<router-link :to="{name:'CRUD'}" class="btn-back"><i class="fas fa-arrow-left"></i></router-link>

			<h2 class="title">User</h2>

			<router-link :to="{name:'CRUD_USER_ADD'}" class="btn-add"><i class="fas fa-plus-circle"></i></router-link>
		</div>
		<div class="content">

			<table class="table">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Name</th>
						<th scope="col">Email</th>
						<th scope="col">Role</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="user in users" :key="user.id" @click="redirect(user.id)">
						<th scope="row">{{user.id}}</th>
						<td>{{user.name}}</td>
						<td>{{user.email}}</td>
						<td>{{user.is_admin ? 'ADMIN' : 'USER'}}</td>
					</tr>
				</tbody>
			</table>
		</div>

	</div>
</template>

<script>
export default {
	name: "CRUD_USER",
	//Composants utilisés a l'intérieur de celui la
	components: {},
	//Variables propres au composant
	data() {
		return {
			users: {},
		};
	},
	//Executé au montage du composant
	mounted() {
		axios
			.get("/api/admin/users")
			.then((response) => {
				this.users = response.data;
			})
			.catch((error) => console.log(error));
	},
	//Methods du composant
	methods: {
		redirect(id) {
			this.$router.push({ name: "CRUD_USER_SHOW", params: { id: id } });
		},
	},
};
</script>

<style scoped lang="scss">
tr {
	&:hover {
		background-color: lightgray;
		cursor: pointer;
	}
}
</style>
