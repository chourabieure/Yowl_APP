<template>
	<form @submit.prevent="submit" class="page-crud-user-add">
		<div class="header-page">
			<router-link :to="{name:'CRUD_USER_SHOW',params:{id:id}}" class="btn-cancel"><i class="fas fa-times-circle"></i></router-link>

			<h2 class="title">Edit User</h2>
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
				<h2>{{user.id}}</h2>
			</div>
			<div class="name">
				<div class="form-group" :class="{ 'form-group--error': $v.name.$error }">
					<div class="header">
						<label class="form__label">Name : </label>
						<div class="error-message" v-if="!$v.name.required">Field is required</div>
						<div class="error-message" v-if="!$v.name.minLength">Name must have at least {{$v.name.$params.minLength.min}} letters.</div>

					</div>
					<input class="form__input" v-model.trim="$v.name.$model" :class="status($v.name)" :placeholder="user.name" />
				</div>
			</div>
			<div class="email">
				<div class="form-group" :class="{ 'form-group--error': $v.email.$error }">
					<div class="header">
						<label class="form__label">Email : </label>
						<div class="error-message" v-if="!$v.email.required">Field is required</div>
						<div class="error-message" v-if="!$v.email.email">Bad email format</div>

					</div>

					<input class="form__input" v-model.trim="$v.email.$model" :class="status($v.email)" :placeholder="user.email" />
				</div>
			</div>
			<div class="Role">
				<div class="form-group toggle">
					<label class="form__label" for="is_admin">Role admin ? </label>

					<label class="switch" for="is_admin">
						<input id="is_admin" type="checkbox" v-model="is_admin" />
						<div class="slider round"></div>
					</label>
				</div>
			</div>

			<a href="" class="btn-suppr">Supprimer cet utilisateur</a>
		</div>

	</form>
</template>


<script>
import { required, minLength, email, sameAs } from "vuelidate/lib/validators";

export default {
	name: "CRUD_USER_EDIT",
	//Composants utilisés a l'intérieur de celui la
	props: ["id"],
	data() {
		return {
			user: {},
			is_admin: false,
			name: "",
			email: "",
			submitStatus: null,
		};
	},
	validations: {
		name: {
			required,
			minLength: minLength(4),
		},
		email: {
			required,
			email,
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

				if (this.is_admin == true) {
					this.is_admin = 1;
				} else {
					this.is_admin = 0;
				}
				axios
					.post("/api/admin/users/edit", {
						user_info: {
							name: this.name,
							email: this.email,
							is_admin: this.is_admin,
						},
						id: this.user.id,
					})
					.then((response) => {
						if (response.data == "ok") {
							this.submitStatus = "OK";
                            setTimeout(
							() =>
								this.$router.push({
									name: "CRUD_USER_SHOW",
									params: { id: this.user.id },
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
	},
	//Executé au montage du composant
	mounted() {
		axios
			.get("/api/admin/user/" + this.id)
			.then((response) => {
				this.user = response.data;
				this.name = response.data.name;
				this.email = response.data.email;
				this.is_admin = response.data.is_admin;
			})
			.catch((error) => console.log(error));
	},
};
</script>


<style scoped lang="scss">
button {
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