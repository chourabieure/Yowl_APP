<template>
	<div class="page-crud-post-add">
		
		<div class="header-page">
			<router-link :to="{name:'CRUD_POST'}" class="btn-back"><i class="fas fa-arrow-left"></i></router-link>

			<h2 class="title">Showing Post</h2>
			<router-link :to="{name:'CRUD_POST_EDIT',params:{id:id}}" class="btn-edit"><i class="fas fa-wrench"></i></router-link>

		</div>

		<div class="content">
			<div class="id">
				<h1>ID : </h1>
				<h2>{{post.id}}</h2>
			</div>
			<div class="url">
				<h1>Url : </h1>
				<h2>{{post.url}}</h2>
			</div>
			<div class="owner">
				<h1>id_owner : </h1>
				<h2>{{post.id_owner}}</h2>
			</div>
			<div class="desc">
				<h1>Description : </h1>
				<h2>{{post.description}}</h2>
			</div>
			<div class="likes">
				<h1>nb_likes : </h1>
				<h2>{{post.likes}}</h2>
			</div>
			<div class="cr_at">
				<h1>created_at : </h1>
				<h2>{{post.created_at | formatDate}}</h2>
			</div>
		</div>
	</div>
</template>

<style scoped lang="scss">
.content {
	padding: 16px;
	padding-bottom: 150px;
	div {
		background: lightgray;
		border-radius: 10px;
		padding: 10px;
		margin-bottom: 16px;
		box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px,
			rgba(0, 0, 0, 0.23) 0px 3px 6px;
		h1 {
			font-size: 20px;
			width: 150px;
			margin-bottom: 5px;
			font-weight: bold;
		}

		h2 {
			color: #c45e38;
			font-weight: bold;
			margin: 0;
			font-size: 18px;
		}
	}
	.button {
		width: 100%;
		padding: 5px 10px;
		text-align: center;
		color: white;
		font-size: 23px;
		font-weight: bold;
		background-color: red;
		border: solid 5px white;
		border-radius: 15px;
		box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px,
			rgba(0, 0, 0, 0.23) 0px 3px 6px;
		&:hover {
			text-decoration: none;
		}
	}
}
</style>

<script>
export default {
	name: "CRUD_POST_SHOW",
	//Composants utilisés a l'intérieur de celui la
	props: ["id"],
	data() {
		return {
			post: {},
		};
	},
	//Executé au montage du composant
	mounted() {
		axios
			.get("/api/admin/post/" + this.id)
			.then((response) => {
				this.post = response.data;
			})
			.catch((error) => console.log(error));
	},
	//Methods du composant
	methods: {
	},
};
</script>

