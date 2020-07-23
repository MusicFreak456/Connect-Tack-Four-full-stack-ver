<template>
    <div v-if= 'loggedIn' class="float-left-container">
        <div class='profile-tab'>
            {{this.username}}
        </div>
        <div class='profile-tab' @click="handleLogout()">
            <h4>Logout</h4>
        </div>
        
    </div>
    <div v-else class='profile-tab' @click="goToLogin()">
        <h4>Login</h4>
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            errorOccured: false
        }
    },

    computed: {
        username: function (){
            return this.$store.state.username;
        },

        loggedIn: function (){
            return this.username != '';
        }
    },

    methods: {
        handleLogout(){
            axios.get('/sanctum/csrf-cookie').then( response => {
                 axios.post('/logout')
                    .then(response => {
                        window.location = '/';
                     })
                     .catch( error => {
                         this.errorOccured = true;
                     })
            });
        },
        goToLogin(){
            this.$router.push('/login')
                .catch(error => {})
        }
    }
}
</script>