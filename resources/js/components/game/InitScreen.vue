<template>
    <div id='init_form'>
            <h1>New game</h1>
            <br>

            <form>  
                <div id='names_forms'>
                    Enter players names:<br>
                    <input 
                        v-model='xPlayerName' ><br>
                    <input 
                        v-model='oPlayerName' ><br>
                </div>

                <div id='config_forms'>
                    Choose game configuration:<br>
                    Map size: 
                    <input 
                        v-model='mapSize' 
                        type='number'
                        min='5'
                        max='10'
                        ><br>
                    How many in a row?:
                    <input 
                        v-model='mode' 
                        type='number'
                        min='3'
                        max='4'
                        ><br>
                </div>

                <button @click='initializeGameMap(mapSize,mapSize,mode)'>start game</button>
            </form>
        </div>
</template>

<script>
export default {
    data: function() {
        return {
            xPlayerName: 'First Player',
            oPlayerName: 'Second Player',
            mapSize: 7,
            mode: 3
        }
    },

    methods:{
        initializeGameMap(height,width,mode){
            var newTiles = [];
            var id = 1;

            for(var i = 0; i<height; i++)
            {
                var newRow = []
                for(var j = 0; j<width; j++)
                {
                    newRow.push({
                        id: id,
                        row: i,
                        column: j,
                        text: '',
                        clicked: false
                    });
                    id++;
                }
                newTiles.push({
                    id: i,
                    row: newRow
                });
            }

            this.$store.commit( 'initializeGameMap', {
                tiles: newTiles,
                height: height,
                width: width,
                mode: mode
            });

            this.$store.commit('setPlayersNames', [this.xPlayerName,this.oPlayerName]);
        }
    }
}
</script>