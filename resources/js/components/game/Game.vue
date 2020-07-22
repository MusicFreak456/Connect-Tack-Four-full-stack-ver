<template>
    <div>
        <InitScreen v-if='!initialized'></InitScreen>
        <div v-else>
            <Map></Map>
            <Infobar></Infobar>
        </div>
        <FinishedScreen v-if='finished'></FinishedScreen>
    </div>
</template>

<script>
import Map from './Map';
import InitScreen from './InitScreen';
import Infobar from './Infobar';
import FinishedScreen from './FinishedScreen'

export default {
    components:{
        'Map': Map,
        'InitScreen': InitScreen,
        'Infobar': Infobar,
        'FinishedScreen': FinishedScreen
    },

    computed:{
        initialized: function(){
            return this.$store.state.GameStoreModule.gameInitialized;
        },

        finished: function(){
            return this.$store.state.GameStoreModule.gameFinished;
        }
    }
}
</script>