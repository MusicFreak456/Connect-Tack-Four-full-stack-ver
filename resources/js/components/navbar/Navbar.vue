<template>
    <div class="navbar">
        <Logo></Logo>
        <Tabs></Tabs>
        <Redirects></Redirects>
    </div>
</template>

<script>
import Logo from './Logo';
import Tabs from './Tabs';
import Redirects from './Redirects';

export default {
    components: {
        'Logo': Logo,
        'Tabs': Tabs,
        'Redirects': Redirects
    }
}
</script>