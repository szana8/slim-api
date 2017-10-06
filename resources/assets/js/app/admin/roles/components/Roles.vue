<template>
    <div>

        <horizontal></horizontal>

    </div>
</template>

<script>
    import { horizontal, search } from '../../common/components'
    import table from './Table.vue'

    export default {

        methods: {

            setActiveClass (link) {
                return this.$route.name === link;
            }

        }

    }
</script>