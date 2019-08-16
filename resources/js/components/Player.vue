<template>
    <div class="player">
        <div class="embed-responsive embed-responsive-16by9">
            <div class="embed-responsive-item" v-if="lesson" data-vimeo-autoplay="true" :data-vimeo-id="lesson.video_id"
                id="handstick"></div>
        </div>
    </div>
</template>

<script>
    import bootbox from 'bootbox'
    import Player from '@vimeo/player'
    export default {
        props: ['default_lesson', 'next_lesson_url'],
        data() {
            return {
                lesson: JSON.parse(this.default_lesson)
            }
        },
        methods: {
            displayVideoCompleteAlert() {
                if (this.next_lesson_url) {
                    bootbox.confirm("You have completed this lesson!\nProceed to next lesson?", (result) => {
                        if (result) {
                            window.location = this.next_lesson_url;
                        }
                    });
                }else {
                    bootbox.alert("Congratulations, You have completed the series!", () => {
                        window.location = '/';
                    });
                }
            }
        },
        mounted() {
            const player = new Player('handstick');

            player.on('ended', () => {
                this.displayVideoCompleteAlert();
            });
        }
    }

</script>
