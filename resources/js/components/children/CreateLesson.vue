<template>
    <div class="modal fade" id="create-lesson-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" v-if="editing">Update Lesson</h5>
                    <h5 class="modal-title" id="exampleModalLabel" v-if="!editing">Create New Lesson</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" @submit.prevent="">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Lesson title" v-model="lesson.title" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Vimeo video ID"
                                    v-model="lesson.video_id" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="Episode number"
                                    v-model="lesson.episode_number" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <textarea class="form-control" placeholder="Lesson description" rows="3"
                                    v-model="lesson.description"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="updateLesson" v-if="editing">Update
                        Lesson</button>
                    <button type="button" class="btn btn-primary" @click="createLesson" v-else>Create
                        Lesson</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Axios from 'axios';

    class Lesson {
        constructor(lesson) {
            this.title = lesson.title || '';
            this.description = lesson.description || '';
            this.video_id = lesson.video_id || '';
            this.episode_number = lesson.episode_number || '';
        }
    }

    export default {
        mounted() {
            this.$parent.$on('create_new_lesson', (series_id) => {
                this.series_id = series_id;
                this.editing = false;
                this.lesson = new Lesson({});

                $('#create-lesson-modal').modal();
            });

            this.$parent.$on('edit_lesson', ({
                lesson,
                series_id
            }) => {
                this.lesson_id = lesson.id;
                this.series_id = series_id;
                this.editing = true;
                
                this.lesson = new Lesson(lesson);
                
                $('#create-lesson-modal').modal();
            });
        },
        data() {
            return {
                lesson: {},
                series_id: '',
                editing: false,
                lesson_id: null
            }
        },
        methods: {
            createLesson() {
                Axios.post(`/admin/${this.series_id}/lessons`, this.lesson)
                    .then(resp => {
                        this.$parent.$emit('lesson_created', resp.data);
                        $('#create-lesson-modal').modal('hide');
                    })
                    .catch(error => {
                        window.handleErrors(error);
                    });
            },
            updateLesson() {
                Axios.put(`/admin/${this.series_id}/lessons/${this.lesson_id}`, this.lesson)
                    .then(res => {
                        this.$parent.$emit('lesson_updated', res.data);
                        $('#create-lesson-modal').modal('hide');
                    })
                    .catch(error => {
                        window.handleErrors(error);
                    })
            }
        }
    }

</script>
