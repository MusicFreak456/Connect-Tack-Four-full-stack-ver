<template>
    <div class='profile-card'>
        <img class='profile-pic-large' :src="getUrl()">
        <h1>{{this.userName}}</h1>
        <h4 class="info-line">About: {{this.about}}</h4>
        <h4 class="info-line">email: {{this.userEmail}}</h4>

        <button v-if='isOwner' @click="goToEdit()">Edit</button>
    </div>
</template>

<script>
export default {
    data: function (){
        return {
            profile: undefined,
            about: undefined,
            user: undefined
        }
    },

    computed:{

        userName: function(){
            if(this.user)
            return this.user.username;
            else return undefined;
        },
        userEmail: function(){
            if(this.user)
            return this.user.email;
            else return undefined;
        },
        userId: function(){
            if(this.user)
            return this.user.id;
            else return undefined;
        },
        isOwner: function(){
            var loggedInUser = this.$store.state.user;
            if(loggedInUser) return this.userId === loggedInUser.id;
            else return false;
        }
    },

    methods:{
        getProfile(){
            axios.get('/sanctum/csrf-cookie').then( response => {
                axios.get('/api/profile/' + this.$route.params.id)
                    .then(response => {
                        this.profile = response.data;
                        this.about = this.profile.about;
                    })
                    .catch( error => {
                        console.log(error);
                    })
            });
        },

        goToEdit(){
            this.$router.push('/profile/' + this.$route.params.id + '/edit');
        },

        getUser(){
            axios.get('/sanctum/csrf-cookie').then( response => {
                axios.get('/api/user/' + this.$route.params.id)
                    .then(response => {
                        this.user = response.data;
                    })
                    .catch( error => {
                        console.log(error);
                    })
            });
        },
        getUrl(){
            try{
                if(this.profile.image) return  '../' + this.profile.image;
                else return '/storage/placeholder.jpg';
            }
            catch(error){
                return '/storage/placeholder.jpg';
            }
        }
    },
    mounted(){
        this.getProfile();
        this.getUser();
    }
}
</script>