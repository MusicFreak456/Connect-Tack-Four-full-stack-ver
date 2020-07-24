<template>
    <div class='profile-card'>
        <img class='profile-pic-large' :src="getUrl()">
        <h1>{{this.userName}}</h1>
        <h4 class="info-line">About: {{this.about}}</h4>
        <h4 class="info-line">email: {{this.userEmail}}</h4>
    </div>
</template>

<script>
export default {
    data: function (){
        return {
            profile: undefined,
            about: undefined
        }
    },

    computed:{

        userName: function(){
            return this.$store.state.user.username;
        },
        userEmail: function(){
            return this.$store.state.user.email;
        }
    },

    methods:{
        getProfile(){
            axios.get('/sanctum/csrf-cookie').then( response => {
                axios.get('/api/profile')
                    .then(response => {
                        this.profile = response.data;
                        this.about = this.profile.about;
                    })
                    .catch( error => {
                        console.log(error);
                    })
            });
        },
        getUrl(){
            try{
                if(this.profile.image) return this.profile.image;
                else return '/storage/placeholder.jpg';
            }
            catch(error){
                return '/storage/placeholder.jpg';
            }
        }
    },
    created(){
        this.getProfile();
    }
}
</script>