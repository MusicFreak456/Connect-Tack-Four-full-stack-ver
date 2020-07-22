<template>
    <th 
        :style="{width: tileWidth + 'px',
                 height:tileWidth + 'px'}"
        :class="[
            'game_tile',
            {
                'game_tile_clicked': tile.clicked,
                'game_tile_highlightable': isClickable
            }]"

        @click='updateTile(tile.row, tile.column)'>
            <h1>{{tile.text}}</h1>
    </th>
</template>

<script>
export default {
    props: ['tile'],

    computed:{
        tileWidth: function(){
            return 600.0 / this.$store.state.GameStoreModule.gameMap.width;
        },

        gameMap: function(){
            return this.$store.state.GameStoreModule.gameMap;
        },

        currentPlayer: function(){
            return this.$store.state.GameStoreModule.currentPlayer;
        },

        isClickable: function(){
            var row = this.tile.row;
            var column = this.tile.column;
            var gameMap = this.gameMap;

            if(
                (!this.tile.clicked && (
                    (row === (gameMap.height - 1)) ||
                    (gameMap.tiles[row + 1].row[column].text != ''))
                ) ||
                (
                    (row === (gameMap.height - 1)) &&
                    (gameMap.tiles[0].row[column].text === '') &&
                    (this.tile.text === this.currentPlayer)) 
                )
            return true;

            return false;
        }
    },

    methods: {
        updateTile(row, column)
        {
            if(this.isClickable)
            {
                this.$store.commit('tileClicked', [row,column]);
            }
        }
    }
}
</script>