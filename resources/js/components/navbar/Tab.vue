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
            var newPath = '/' + ( (this.text === 'Play')? '' : this.text.toLowerCase());
            var currentPath = this.$route.path;

            if(newPath != currentPath)
            {
                this.$router.push(newPath);
                this.$store.commit('changeActiveTab',this.id);
            }
        }
    }
}
</script>