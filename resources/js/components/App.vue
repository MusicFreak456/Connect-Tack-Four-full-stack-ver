<template>
    <div id='content'>
        <Game></Game>
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