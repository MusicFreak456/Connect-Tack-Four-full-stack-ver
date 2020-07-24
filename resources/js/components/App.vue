<template>
    <div id='content'>
        <router-view></router-view>
    </div>
</template>

<script>

import Game from './game/Game';

var App = {
    props: [
        'user'
    ],
    components: {
        'Game': Game
    },

    computed:{
        userObject: function() {
            return JSON.parse(this.user);
        }
    },

    created(){
        if(this.user)this.$store.commit('setUser',this.userObject);
    }
}

export default App;
</script>