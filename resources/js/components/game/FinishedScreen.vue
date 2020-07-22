<template>
    <div id='finished_overlay'>
        <div id='finished_screen'>
            <h1>{{winnerName}} has won!</h1> <br>
            <button @click='newGame()'> New game </button>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        winnerName: function(){
            return this.$store.state.GameStoreModule.winner;
        }
    },

    methods: {
        newGame(){
            this.$store.commit('newGame');
        }
    }
}
</script>