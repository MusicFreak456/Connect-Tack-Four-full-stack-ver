<template>
    <div class="form-primary">
        <h1>Edit profile</h1>
        <br>

        <form action='#' @submit.prevent='upload()'>
            <div id='names_forms'>
                <h4>About:</h4>
                <textarea rows="3" cols ="40" v-model="about"></textarea>
                <br>
                Profile image:
                <input type="file" id='file' ref='file' @change="handleImageUpload()">
            </div>

            <button type="submit">Submit</button>
        </form>

    </div>
</template>

<script>
export default {
    data: function(){
        return {
            profile: undefined,
            about: '',
            image: undefined
        }
    },

    methods: {
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

        handleImageUpload(){
            this.image = this.$refs.file.files[0];
        },

        upload(){
            let formData = new FormData();
            formData.append('about', this.about);
            formData.append('image',this.image);
            formData.append('_method','put');


            axios.get('/sanctum/csrf-cookie').then( response => {
                axios.post('/api/profile/' + this.$route.params.id,
                          formData
                    )
                    .then(response => {
                        this.$router.push('/profile/' + this.$route.params.id);
                    })
            });
        }
    },

    mounted(){
        this.getProfile();
    }
}
</script>
