<script>
    import bootbox from 'bootbox';
    import {setTimeout} from 'timers';
    export default {
        created() {
            window.events.$on('notification', (payload) => {
                bootbox.alert(payload.message);
            });
        }
    }

</script>
