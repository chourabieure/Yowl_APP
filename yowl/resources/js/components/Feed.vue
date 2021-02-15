<template>
	<div class="page page-Feed">
		<h2 class="text-center pt-4">Page Feed</h2>

		<div class="my-card" v-for="post in posts" :key="post.id">
			<div class="my-card-header">
				<img src="https://via.placeholder.com/273x160" alt="">
				<div class="buttons">
					<div class="btn-like">
						<h2>{{post.likes}}</h2>
						<i class="far fa-heart"></i>
					</div>
					<div class="btn-comment">
						<h2>0</h2>
						<i class="fas fa-comment"></i>
					</div>
				</div>
			</div>
			<div class="my-card-body">
				<div class="top">
					<div class="d-flex">

						<div class="avatar">
							<i class="fas fa-user"></i>
							<!-- <img src="" alt=""> -->
						</div>
						<div class="info-owner">
							<h2 class="name">{{post.owner_name}}</h2>
							<h2 class="groupe">...</h2>
						</div>
					</div>

					<div class="time">
						<i class="far fa-clock"></i>

						<h2>{{getTimeDif(post.created_at)}}</h2>
					</div>
				</div>
				<div class="bottom">
					<p>Descriptionsdfdsfsdf sdf sdf dsf dsf sdf sdf dsf sdf dsf sdf sdfdsfsdsdfsdfsd fsd f</p>
				</div>
			</div>

		</div>

	</div>
</template>

<script>
export default {
	name: "Feed",
	//Composants utilisés a l'intérieur de celui la

	//Variables propres au composant
	data() {
		return {
			posts: {},
		};
	},
	//Executé au montage du composant
	mounted() {
		axios
			.get("/api/posts")
			.then((response) => {
				this.posts = response.data;
			})
			.catch((error) => console.log(error));
	},
	//Methods du composant
	methods: {
		getTimeDif(post_date) {
			
			let time_ago = new Date(post_date);

			let time_elapsed = Math.abs(time_ago - new Date()) / 1000

			let seconds = time_elapsed;
			let minutes = Math.round(time_elapsed / 60);
			let hours = Math.round(time_elapsed / 3600);
			let days = Math.round(time_elapsed / 86400);
			let weeks = Math.round(time_elapsed / 604800);
			let months = Math.round(time_elapsed / 2600640);
			let years = Math.round(time_elapsed / 31207680);

			// Seconds
			if (seconds <= 60) {
				return "just now";
			}
			//Minutes
			else if (minutes <= 60) {
				if (minutes == 1) {
					return "1 minute ago";
				} else {
					return minutes+" mins";
				}
			}
			//Hours
			else if (hours <= 24) {
				if (hours == 1) {
					return "an hour ago";
				} else {
					return  hours+" hrs";
				}
			}
			//Days
			else if (days <= 7) {
				if (days == 1) {
					return "yesterday";
				} else {
					return  days+" days";
				}
			}
			//Weeks
			else if (weeks <= 4.3) {
				if (weeks == 1) {
					return "a week ago";
				} else {
					return  weeks+" weeks";
				}
			}
			//Months
			else if (months <= 12) {
				if (months == 1) {
					return "a month ago";
				} else {
					return  months+" months";
				}
			}
			//Years
			else {
				if (years == 1) {
					return "one year ago";
				} else {
					return  years+" years";
				}
			}
		},
	},
	computed: {},
};
</script>

<style scoped lang="scss">
.page-Feed {
	margin-bottom: 100px;
}
</style>
