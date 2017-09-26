<template>
    <div>
        <v-app>
            <navigation></navigation>
            <main>
                <v-container fluid>
                    <router-view></router-view>
                </v-container>
            </main>
            <v-footer></v-footer>
        </v-app>
    </div>
</template>

<script>
    export default {

    }
</script>

