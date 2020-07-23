<template>
    <div class='form-primary'>
        <h1>Login</h1>

        <form action="#" @submit.prevent='handleLogin()'>
            <div id='names_forms'>
                <label for="email">E-mail: </label>
                <input id='email' v-model='formData.email'>
                <br>
                <label type='string' for="password">Password: </label>
                <input type='password' id='password' v-model='formData.password'>
                <div v-if='errorOccured' class="error-line">
                    email or password do not match out records
                </div>
                <div class='note-line' style="cursor: pointer;" @click="goToRegister()">
                    You don't have an account? Click here to register
                </div>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            formData: {
                email: '',
                password: ''
            },
            errorOccured: false
        }
    },

    methods: {
        handleLogin() {
            axios.get('/sanctum/csrf-cookie').then( response => {
                axios.post('/login', this.formData)
                    .then(response => {
                        window.location = '/';
                    })
                    .catch( error => {
                        this.errorOccured = true;
                    })
            });
        },
        goToRegister(){
            this.$router.push('/register');
        }
    }
}
</script>