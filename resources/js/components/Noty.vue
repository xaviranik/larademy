<template>
    <div class="alert alert-noty" role="alert" v-if="notification" :class="type">
        <p class="text-center">
            {{ notification.message }}
        </p>
    </div>
</template>

<script>
    import {setTimeout} from 'timers';
    export default {
        created() {
            window.events.$on('notification', (payload) => {
                this.notification = payload;
                setTimeout(() => {
                    this.notification = null
                }, 3000)
            });
        },
        data() {
            return {
                notification: null
            }
        },
        computed: {
            type() {
                return `alert-${this.notification.type}`
            }
        }

    }

</script>

<style>
    .alert-noty {
        position: fixed;
        right: 50px;
        top: 100px;
        z-index: 50;
        border-radius: 4px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

</style>
