<template>
    <div class="row pt-5">
        <button class="btn btn-primary" @click="resetLogin">Reset Login Attempts</button>
    </div>
</template>

<script>
    export default {
        props: ['userId'],

        mounted() {
            //console.log('Component mounted.')
        },

        methods: {
            resetLogin() {
                axios.post('/reset-login/' + this.userId)
            }
        }
    }
</script>
