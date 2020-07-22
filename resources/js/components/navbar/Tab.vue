<template>
    <li v-bind:class='{ active_tab: selected }' 
        @click='changeTab()'> 
        <slot></slot>
    </li>
</template>

<script>
export default {
    props: {
        id: {},
        text: {}
    },

    computed:{
        selected: function(){
            return this.id === this.$store.state.activeTab;
        }
    },

    methods:{
        changeTab(){

            if(this.text != 'Play')this.$router.push('/' + this.text.toLowerCase())
            else this.$router.push('/');
            this.$store.commit('changeActiveTab',this.id);
        }
    }
}
</script>