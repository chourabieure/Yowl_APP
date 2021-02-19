<template>
	<form @submit.prevent="submit" class="page-crud-post-add">

		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Deleting Post</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Do you really want to delete this post ?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-danger" @click="deletePost" data-dismiss="modal">Delete</button>
					</div>
				</div>
			</div>
		</div>

		<div class="header-page">
			<router-link :to="{name:'CRUD_POST_SHOW',params:{id:id}}" class="btn-back"><i class="fas fa-arrow-left"></i></router-link>

			<h2 class="title">Edit Post</h2>
			<a href="" class="btn-check"><i class="fas fa-check-circle"></i></a>
			<button class="btn-check" type="submit" :disabled="submitStatus === 'PENDING'"></button>

		</div>

		<div class="content">
			<p class="typo__p" v-if="submitStatus === 'OK'">Thanks for your submission!</p>
			<p class="typo__p" v-if="submitStatus === 'ERROR'">Please fill the form correctly.</p>
			<p class="typo__p" v-if="submitStatus === 'PENDING'">Sending...</p>
			<p class="typo__p" v-if="submitStatus === 'OUPS'">Oups something went wrong</p>

			<div class="id">
				<h1>ID : </h1>
				<h2>{{post.id}}</h2>
			</div>
			<div class="url">
				<div class="form-group" :class="{ 'form-group--error': $v.url.$error }">
					<div class="header">
						<label class="form__label">Url : </label>
						<div class="error-message" v-if="!$v.url.required">Field is required</div>

					</div>
					<input class="form__input" v-model.trim="$v.url.$model" :class="status($v.url)" :placeholder="post.url" />
				</div>
			</div>
			<div class="desc">
				<div class="form-group" :class="{ 'form-group--error': $v.desc.$error }">
					<div class="header">
						<label class="form__label">Description : </label>
						<div class="error-message" v-if="!$v.desc.required">Field is required</div>

					</div>

					<input class="form__input" v-model.trim="$v.desc.$model" :class="status($v.desc)" :placeholder="post.description" />
				</div>
			</div>

			<a href="" class="btn-suppr" data-toggle="modal" data-target="#exampleModal">Supprimer ce Post</a>
		</div>

	</form>
</template>


<script>
import { required, minLength, email, sameAs } from "vuelidate/lib/validators";
import $ from 'jquery'
export default {
	name: "CRUD_POST_EDIT",
	//Composants utilisés a l'intérieur de celui la
	props: ["id"],
	data() {
		return {
			post: {},
			url: "",
			desc: "",
			submitStatus: null,
		};
	},
	validations: {
		url: {
			required,
		},
		desc: {
			required,
		},
	},
	methods: {
		status(validation) {
			return {
				error: validation.$error,
				dirty: validation.$dirty,
			};
		},
		submit() {
			this.$v.$touch();
			if (this.$v.$invalid) {
				this.submitStatus = "ERROR";
			} else {
				// do your submit logic here
				this.submitStatus = "PENDING";

				axios
					.post("/api/admin/post/edit", {
						post_info: {
							url: this.url,
							description: this.desc,
						},
						id: this.post.id,
					})
					.then((response) => {
						if (response.data == "ok") {
							this.submitStatus = "OK";
							setTimeout(
								() =>
									this.$router.push({
										name: "CRUD_POST_SHOW",
										params: { id: this.post.id },
									}),
								500
							);
						} else {
							this.submitStatus = "OUPS";
						}
					})
					.catch((error) => console.log(error));
			}
		},
		deletePost() {
			axios
				.post("/api/admin/post/delete", {
					post_id: this.id,
				})
				.then((response) => {
					setTimeout(
						() =>
							this.$router.push({
								name: "CRUD_POST",
							}),
						500
					);
				})
				.catch((error) => console.log(error));
		},
	},
	//Executé au montage du composant
	mounted() {
		axios
			.get("/api/admin/post/" + this.id)
			.then((response) => {
				this.post = response.data;
				this.url = response.data.url;
				this.desc = response.data.description;
			})
			.catch((error) => console.log(error));
	},
};
</script>


<style scoped lang="scss">
.header-page button {
	position: absolute;
	outline: none !important;
	border: none !important;

	right: 20px;
	height: 40px;
	width: 40px;
	background-color: transparent;
}

.btn-suppr {
	display: block;
	margin-top: 50px;
	width: 100%;
	padding: 5px 10px;
	text-align: center;
	color: white;
	font-size: 23px;
	font-weight: bold;
	background-color: red;
	border: solid 5px white;
	border-radius: 15px;
	box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
	&:hover {
		text-decoration: none;
	}
}
.content {
	text-align: center;
	.typo__p {
		width: 100%;
		text-align: center;
		margin: 0;
		margin-bottom: 5px;
		font-weight: bold;
		color: red;
	}

	.form-group {
		margin: 0;
	}
	.toggle {
		display: flex;
		justify-content: space-between;
		align-items: center;
	}
	padding: 16px;
	& > div {
		text-align: left;
		background: lightgray;
		border-radius: 10px;
		padding: 10px;
		margin-bottom: 16px;
		box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px,
			rgba(0, 0, 0, 0.23) 0px 3px 6px;
		h1,
		label {
			font-size: 20px;
			margin-bottom: 5px;
			font-weight: bold;
			margin: 0;
		}
		.header {
			display: flex;
			justify-content: space-between;
			align-items: center;
		}
		h2 {
			color: #c45e38;
			font-weight: bold;
			margin: 0;
			font-size: 18px;
		}
		input {
			width: 100%;
			border: 1px solid silver;
			border-radius: 4px;
			// background: white;
			padding: 5px 10px;
		}
	}
	.dirty {
		border: solid 2px #8e8 !important;
		background: #efe;
	}
	.dirty:focus {
		outline-color: #8e8;
	}
	.error {
		border: solid 2px red !important;
		background: #fdd;
	}
	.error:focus {
		outline-color: #f99;
	}
	.error-message {
		color: red;
		font-weight: bold;
	}
}

.switch {
	display: inline-block;
	height: 34px;
	position: relative;
	width: 60px;
}

.switch input {
	display: none;
}

.slider {
	background-color: rgb(114, 114, 114);
	bottom: 0;
	cursor: pointer;
	left: 0;
	position: absolute;
	right: 0;
	top: 0;
	transition: 0.4s;
}

.slider:before {
	background-color: #fff;
	bottom: 4px;
	content: "";
	height: 26px;
	left: 4px;
	position: absolute;
	transition: 0.4s;
	width: 26px;
}

input:checked + .slider {
	background-color: #66bb6a;
}

input:checked + .slider:before {
	transform: translateX(26px);
}

.slider.round {
	border-radius: 34px;
}

.slider.round:before {
	border-radius: 50%;
}
</style>