<template>
    <div>
        <v-app>
            <navigation></navigation>
            <loader></loader>
            <main>
                <v-content>
                    <v-container fluid fill-height>
                        <v-layout justify-center align-center>
                            <router-view></router-view>
                        </v-layout>
                    </v-container>
                </v-content>
            </main>
            <v-footer></v-footer>
        </v-app>
    </div>
</template>

<script>
    export default {

    }
</script>

