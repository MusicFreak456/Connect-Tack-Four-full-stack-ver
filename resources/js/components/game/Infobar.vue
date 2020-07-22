<template>
    <div id='infobar'>
        <h1>Turn: {{currentPlayerName}}</h1>
    </div>
</template>

<script>
export default {
    computed: {
        currentPlayer: function(){
            return this.$store.state.GameStoreModule.currentPlayer;
        },

        currentPlayerName: function(){
            var currentPlayerMark = this.currentPlayer;
            var property = currentPlayerMark.toLowerCase() + 'PlayerName';
            return this.$store.state.GameStoreModule[property];
        }
    }
}
</script>