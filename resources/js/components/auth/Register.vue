<template>
    <div class='form-primary'>
        <h1>Register</h1>

        <form action="#" @submit.prevent='handleRegister()'>
            <div id='names_forms'>
                <label for="username">Username: </label>
                <input type='text' id='username' v-model='formData.username'>
                <br>
                <label for="email">E-mail: </label>
                <input type='text' id='email' v-model='formData.email'>
                <br>
                <label for="password">Password: </label>
                <input type='password' id='password' v-model='formData.password'>
                <div v-if='errorOccured' class="error-line">
                    Check if all fields are valid
                </div>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            formData: {
                username: '',
                email: '',
                password: ''
            },
            errorOccured: false
        }
    },

    methods: {
        handleRegister() {
            axios.get('/sanctum/csrf-cookie').then( response => {
                 axios.post('/register', this.formData)
                    .then(response => {
                        this.$router.push('/').catch(error => {});
                     })
                     .catch( error => {
                         this.errorOccured = true;
                     })
            });
        }
    }
}
</script>