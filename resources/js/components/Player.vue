<template>
    <div class="player">
        <div class="embed-responsive embed-responsive-16by9">
            <div class="embed-responsive-item" v-if="lesson" :data-vimeo-id="lesson.video_id" id="handstick"></div>
        </div>
    </div>
</template>

<script>
    import Player from '@vimeo/player'
    export default {
        props: ['default_lesson'],
        data() {
            return {
                lesson: JSON.parse(this.default_lesson)
            }
        },
        mounted() {
            const player = new Player('handstick');
        }
    }

</script>
