<template>
    <div id='content'>
        <router-view></router-view>
    </div>
</template>

<script>

import Game from './game/Game';

var App = {
    props: [
        'username'
    ],
    components: {
        'Game': Game
    },

    created(){
        this.$store.commit('setUsername',this.username);
    }
}

export default App;
</script>