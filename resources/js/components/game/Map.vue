<template>
    <table class='game_board'>
        <tr
            class='game_row' 
            v-for='row in gameMap.tiles'
            :key="row.id">
            <Tile
                v-for='tile in row.row'
                :key="tile.id"
                :tile='tile'>
            </Tile>
        </tr>
    </table> 
</template>

<script>
import Tile from './Tile';

export default {
    computed:{
        gameMap: function(){
            return this.$store.state.GameStoreModule.gameMap
        }
    },

    components:{
        'Tile': Tile
    }
}
</script>