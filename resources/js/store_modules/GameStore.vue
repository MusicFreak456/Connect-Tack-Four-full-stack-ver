<script>
    const GameStoreModule = {
        state: () => ({
            gameMap: {
                tiles: [],
                height: 0,
                width: 0,
                mode: 0,
            },
            xPlayerName: '',
            oPlayerName: '',
            winner: '',
            currentPlayer: 'X',
            gameFinished: false,
            gameInitialized: false
        }),

        mutations: {
            
            initializeGameMap(state, newMap){
                state.gameInitialized = true;
                state.gameMap = newMap;
            },

            setPlayersNames(state, names){
                this.state.GameStoreModule.xPlayerName = names[0];
                this.state.GameStoreModule.oPlayerName = names[1];
            },

            tileClicked(state,coords){
                var row = coords[0];
                var rowIter;
                var column = coords[1];
                var tile = this.state.GameStoreModule.gameMap.tiles[row].row[column];
                var tiles = this.state.GameStoreModule.gameMap.tiles;

                if(tile.text === ''){
                    this.commit('activateTile',tile);
                }
                else{
                    rowIter = row;

                    while(tile.text != '')
                    {
                        var tileAbove = tiles[rowIter - 1].row[column];
                        tile.text = tileAbove.text;
                        tile = tileAbove;
                        rowIter--;
                    }
                    this.commit('activateTile',tiles[rowIter + 1].row[column]);
                    this.commit('activateTile',tiles[rowIter].row[column]);
                }

                this.commit('checkForVictory');
                this.commit('nextPlayer');
            },

            activateTile(state,tile){
                var newMark = this.state.GameStoreModule.currentPlayer;
                tile.text = newMark;
                tile.clicked = true;
            },

            nextPlayer(state){
                var newMark = this.state.GameStoreModule.currentPlayer;
                if(newMark === 'X') this.state.GameStoreModule.currentPlayer = 'O';
                else this.state.GameStoreModule.currentPlayer = 'X';
            },

            newGame(state){
                this.state.GameStoreModule.gameInitialized = false;
                this.state.GameStoreModule.gameFinished = false;
                this.state.GameStoreModule.currentPlayer = 'X';
            },

            checkForVictory(state){
                var mapHeight = this.state.GameStoreModule.gameMap.height;
                var mapWidth = this.state.GameStoreModule.gameMap.width;
                var map = this.state.GameStoreModule.gameMap.tiles;
                var mode = this.state.GameStoreModule.gameMap.mode;
                var currentPlayer = this.state.GameStoreModule.currentPlayer;
        
                for(var i = mapHeight - 1; i >= 0; i--)
                {
                    for(var j = 0; j <= mapWidth - 1; j++)
                    {
                        var checkTile = function(condition, incrementRow, incrementColumn){
                            var count = 0;
                            var rowIter = 0;
                            var columnIter = 0;
            
                            while(
                                condition(columnIter,rowIter) &&
                                (map[i].row[j].text === map[i - rowIter].row[j + columnIter].text))
                            {
                                count++;
                                columnIter = incrementColumn(columnIter);
                                rowIter = incrementRow(rowIter);
                                if(count===mode)
                                {
                                    return true;
                                }
                            }

                            return false;
                        }

                        if(map[i].row[j].text === '') continue;

                        if(checkTile(
                            (columnIter,rowIter)=>{return j+columnIter < mapWidth}, 
                            rowIter => rowIter, 
                            columnIter => columnIter + 1) ||
                        
                            checkTile(
                            (columnIter,rowIter)=>{return i-rowIter >= 0 }, 
                            rowIter => rowIter + 1, 
                            columnIter => columnIter) ||
                
                            checkTile(
                            (columnIter,rowIter)=>{return i-rowIter >= 0 && j + columnIter < mapWidth }, 
                            rowIter => rowIter + 1, 
                            columnIter => columnIter + 1) ||

                            checkTile(
                            (columnIter,rowIter)=>{return i-rowIter >= 0 && j + columnIter >= 0 }, 
                            rowIter => rowIter + 1, 
                            columnIter => columnIter - 1)){
                            
                            this.state.GameStoreModule.gameFinished = true;
                            this.state.GameStoreModule.winner = this.state.GameStoreModule[currentPlayer.toLowerCase() + 'PlayerName'];
                        }

                    }
                }
            }
        }
    }

export default GameStoreModule;

</script>
