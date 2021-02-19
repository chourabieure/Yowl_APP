<template>
	<div class="page-crud-post">
		<div class="header-page">
			<router-link :to="{name:'CRUD'}" class="btn-back"><i class="fas fa-arrow-left"></i></router-link>

			<h2 class="title">Posts</h2>

			<router-link :to="{name:'CRUD_POST_ADD'}" class="btn-add"><i class="fas fa-plus-circle"></i></router-link>
		</div>
		<div class="content">

			<table class="table">
				<tbody>
					<tr v-for="post in posts" :key="post.id" @click="redirect(post.id)">
						<td scope="row">
							<div class="info">
								<div class="header">
									<h2 class="id">
										#{{post.id}}
									</h2>

									<h2 class="owner">Mattis</h2>
								</div>

								<div class="body">
									<h2 class="url">
										url : <span>{{post.url}}</span>
									</h2>
									<h2 class="likes">
										<span>{{post.likes}}</span> : likes
									</h2>
								</div>

								<h2 class="desc">
									<span>"</span>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Amet neque, possimus nesciunt tempora nobis commodi ab earum labore necessitatibus id aliquid odio quisquam, vero, perferendis aliquam? Ut magnam aspernatur error.<span>"</span>
								</h2>

								<h2 class="cr_at">
									{{post.created_at | formatDate}}
								</h2>

							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

	</div>
</template>


<style scoped lang="scss">
.header-page {
	position: fixed;
	background-color: #f8fafc;
	border-bottom: solid 1px gray;
}
.content {
	padding-top: 90px;
	padding-bottom: 120px;
	tr {
		&:hover {
			background-color: lightgray;
			cursor: pointer;
		}
	}
	.info {
		.header {
			margin: 5px 0;
			display: flex;
			justify-content: space-between;
			align-items: center;
			.id {
				font-size: 17px;
				color: black;
				font-weight: bold;
				margin: 0;
			}
			.owner {
				font-size: 17px;
				color: gray;
				margin: 0;
			}
		}
		.body {
			margin: 5px 0;
			display: flex;
			justify-content: space-between;
			align-items: center;
			.url {
				font-size: 16px;
				color: black;
				margin: 0;
				span {
					font-style: italic;
					color: gray;
				}
			}
			.likes {
				font-size: 16px;
				color: black;
				margin: 0;
				span {
					font-weight: bold;
					color: gray;
				}
			}
		}

		.desc {
			display: block;
			justify-content: space-between;
			font-size: 16px;
			margin: 0;
			span {
				font-weight: bold;
				color: black;
			}
		}

		.cr_at {
			font-size: 16px;
			color: black;
			margin: 0;
			text-align: right;
		}
	}
}
</style>


<script>
export default {
	name: "CRUD_POST",
	//Composants utilisés a l'intérieur de celui la
	components: {},
	//Variables propres au composant
	data() {
		return {
			posts: {},
		};
	},
	//Executé au montage du composant
	mounted() {
		axios
			.get("/api/admin/posts")
			.then((response) => {
				this.posts = response.data;
			})
			.catch((error) => console.log(error));
	},
	//Methods du composant
	methods: {
		redirect(id) {
			this.$router.push({ name: "CRUD_POST_SHOW", params: { id: id } });
		},
	},
};
</script>
