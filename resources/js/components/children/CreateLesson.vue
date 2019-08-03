<template>
    <div class="modal fade" id="create-lesson-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Lesson</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" @submit.prevent="">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Lesson title" v-model="title" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Vimeo video ID"
                                    v-model="video_id" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Episode number"
                                    v-model="episode_number" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <textarea class="form-control" placeholder="Lesson description" rows="3"
                                    v-model="description"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="createLesson">Save Lesson</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Axios from 'axios';
    export default {
        mounted() {
            this.$parent.$on('create_new_lesson', (seriesID) => {
                $('#create-lesson-modal').modal();
                this.seriesID = seriesID;
            });
        },
        data() {
            return {
                title: '',
                description: '',
                episode_number: '',
                video_id: '',
                series_id: ''
            }
        },
        methods: {
            createLesson() {
                console.log(this.seriesID);
                Axios.post(`/admin/${this.seriesID}/lessons`, {
                        title: this.title,
                        description: this.description,
                        episode_number: this.episode_number,
                        video_id: this.video_id
                    })
                    .then(resp => {
                        this.$parent.$emit('lesson_created', resp.data);
                        $('#create-lesson-modal').modal('hide');
                    })
                    .catch(error => {
                        console.log(error.message);
                    });
            }
        }
    }

</script>
