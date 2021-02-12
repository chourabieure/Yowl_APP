<template>
	<div class="page-crud-user-add">
		<div class="header-page">
			<router-link :to="{name:'CRUD_USER'}" class="btn-back"><i class="fas fa-arrow-left"></i></router-link>

			<h2 class="title">Adding User</h2>
		</div>

		<form @submit.prevent="submit" class="create">
			<div class="field">
				<div class="form-group" :class="{ 'form-group--error': $v.name.$error }">
					<div class="header">

						<label class="form__label">Name : </label>
						<div class="error-message" v-if="!$v.name.required">Field is required</div>
						<div class="error-message" v-if="!$v.name.minLength">Name must have at least {{$v.name.$params.minLength.min}} letters.</div>
						<div class="error-message" v-if="!$v.name.isUnique">This name is already registered.</div>

					</div>
					<input class="form__input" v-model.trim="$v.name.$model" :class="status($v.name)" />
				</div>

			</div>
			<div class="field">
				<div class="form-group" :class="{ 'form-group--error': $v.email.$error }">
					<div class="header">
						<label class="form__label">Email : </label>
						<div class="error-message" v-if="!$v.email.required">Field is required</div>
						<div class="error-message" v-if="!$v.email.email">Bad email format</div>
						<div class="error-message" v-if="!$v.email.isUnique">This Email is already registered.</div>

					</div>

					<input class="form__input" v-model.trim="$v.email.$model" :class="status($v.email)" />
				</div>

			</div>

			<div class="field">
				<div class="form-group" :class="{ 'form-group--error': $v.password.$error }">
					<div class="header">
						<label class="form__label">Password</label>
						<div class="error-message" v-if="!$v.password.required">Password is required.</div>
						<div class="error-message" v-if="!$v.password.minLength">Password must have at least {{ $v.password.$params.minLength.min }} letters.</div>
					</div>
					<input type="password" class="form__input" v-model.trim="$v.password.$model" :class="status($v.password)" />
				</div>

			</div>
			<div class="field">
				<div class="form-group" :class="{ 'form-group--error': $v.repeatPassword.$error }">
					<div class="header">
						<label class="form__label">Repeat password</label>
						<div class="error-message" v-if="!$v.repeatPassword.sameAsPassword">Passwords must be identical.</div>
					</div>
					<input type="password" class="form__input" v-model.trim="$v.repeatPassword.$model" :class="status($v.repeatPassword)" />
				</div>

			</div>
			<div class="field">
				<div class="form-group toggle">
					<label class="form__label" for="is_admin">Role admin ? </label>

					<label class="switch" for="is_admin">
						<input id="is_admin" type="checkbox" v-model="is_admin" />
						<div class="slider round"></div>
					</label>
				</div>
			</div>

			<button class="button" type="submit" :disabled="submitStatus === 'PENDING'">Submit!</button>

			<p class="typo__p" v-if="submitStatus === 'OK'">Thanks for your submission!</p>
			<p class="typo__p" v-if="submitStatus === 'ERROR'">Please fill the form correctly.</p>
			<p class="typo__p" v-if="submitStatus === 'PENDING'">Sending...</p>
			<p class="typo__p" v-if="submitStatus === 'OUPS'">Oups something went wrong</p>

		</form>
	</div>
</template>

<script>
import { required, minLength, email, sameAs } from "vuelidate/lib/validators";

export default {
	name: "CRUD_USER_ADD",
	//Composants utilisés a l'intérieur de celui la
	components: {},
	//Variables propres au composant
	data() {
		return {
			name: "",
			email: "",
			password: "",
			repeatPassword: "",
			submitStatus: null,
			is_admin: false,
		};
	},
	validations: {
		name: {
			required,
			minLength: minLength(4),
			async isUnique(value) {
				if (value === "") return true;
				const response = await fetch(`/api/admin/name/${value}`);
				return Boolean(await response.json());
			},
		},
		email: {
			required,
			email,
			async isUnique(value) {
				if (value === "") return true;
				const response = await fetch(`/api/admin/email/${value}`);
				return Boolean(await response.json());
			},
		},
		password: {
			required,
			minLength: minLength(8),
		},
		repeatPassword: {
			required,
			sameAsPassword: sameAs("password"),
		},
	},
	//Executé au montage du composant
	mounted() {},
	//Methods du composant
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
					.post("/api/admin/users/add", {
						user_info: {
							name: this.name,
							email: this.email,
							password: this.password,
							is_admin: this.is_admin,
						},
					})
					.then((response) => {
						if (response.data == "ok") {
							this.submitStatus = "OK";
							setTimeout(
							() =>
								this.$router.push({
									name: "CRUD_USER",
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
};
</script>

<style scoped lang="scss">
.create {
	padding: 20px;
	.field {
		padding-top: 10px;

		.form-group {
			margin-bottom: 8px;
			display: flex;
			flex-direction: column;

			.header {
				display: flex;
				justify-content: space-between;
			}
			input {
				border: 1px solid silver;
				border-radius: 4px;
				// background: white;
				padding: 5px 10px;
			}
		}
	}

	.button {
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
	.typo__p {
		width: 100%;
		text-align: center;
		margin-top: 25px;
		font-weight: bold;
		color: red;
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
