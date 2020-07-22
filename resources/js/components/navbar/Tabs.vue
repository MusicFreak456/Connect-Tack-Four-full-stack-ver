<template>
    <ul>
        <Tab 
            v-for='tab in tabs' 
            :key='tab.id' 
            :id = 'tab.id'
            :text = 'tab.text'>
                {{tab.text}}
        </Tab>
    </ul>
</template>

<script>
import Tab from './Tab';

export default {
    data: function() 
    {
        return {
            tabs: [
                {id:1, text:'Play'},
                {id:2, text:'Rules'},
                {id:3, text:'About'}
            ]
        }
    },

    components: {
        'Tab': Tab
    }
}
</script>