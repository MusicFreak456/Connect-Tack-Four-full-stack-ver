<template>
    <div id='content'>
        <router-view></router-view>
    </div>
</template>

<script>

import Game from './game/Game';

var App = {
    components: {
        'Game': Game
    }
}

export default App;
</script>