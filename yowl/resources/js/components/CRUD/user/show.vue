<template>
	<div class="page-crud-user-add">
		<div class="header-page">
			<router-link :to="{name:'CRUD_USER'}" class="btn-back"><i class="fas fa-arrow-left"></i></router-link>

			<h2 class="title">Showing User</h2>
			<router-link :to="{name:'CRUD_USER_EDIT',params:{id:id}}" class="btn-edit"><i class="fas fa-wrench"></i></router-link>

		</div>

        <div class="content">
            <div class="id">
                <h1>ID : </h1>
                <h2>{{user.id}}</h2>
            </div>
            <div class="name">
                <h1>Name : </h1>
                <h2>{{user.name}}</h2>
            </div>
            <div class="email">
                <h1>Email : </h1>
                <h2>{{user.email}}</h2>
            </div>
            <div class="Role">
                <h1>Role : </h1>
                <h2>{{user.is_admin ? 'ADMIN' : 'USER'}}</h2>
            </div>
            <div class="em_at">
                <h1>verified_at : </h1>
                <h2 v-if="user.email_verified_at">{{user.email_verified_at | formatDate}}</h2>
                <h2 v-else>Not yet verified</h2>
            </div>
            <div class="cr_at">
                <h1>created_at : </h1>
                <h2>{{user.created_at | formatDate}}</h2>
            </div>
            <div class="up_at">
                <h1>updated_at : </h1>
                <h2>{{user.updated_at | formatDate}}</h2>
            </div>
        </div>
	</div>
</template>

<style scoped lang="scss">
.content{
    padding: 16px;
    div{
        background:lightgray;
        border-radius: 10px;
        padding: 10px;
        margin-bottom: 16px;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px,
				rgba(0, 0, 0, 0.23) 0px 3px 6px;
        h1{
            font-size: 20px;
            width: 150px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        h2{
            color: #c45e38;
            font-weight: bold;
            margin: 0;
            font-size: 18px;
        }
    }
}
</style>

<script>

export default {
	name: "CRUD_USER_SHOW",
	//Composants utilisés a l'intérieur de celui la
    props: ['id'],
	data() {
		return {
            user: {}
		};
	},
	//Executé au montage du composant
	mounted() {

        axios
        .get('/api/admin/user/'+this.id)
        .then((response)=>{
            this.user = response.data
        })
        .catch((error)=>console.log(error))
    },
	//Methods du composant
	methods: {
		
	},
};
</script>

