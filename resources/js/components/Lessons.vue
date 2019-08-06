<template>
    <div class="lessons">
        <button class="btn btn-primary" @click="createNewLesson">Create New Lesson</button>
        <ul class="list-group d-flex">
            <li class="list-group-item d-flex justify-content-between" v-for="(lesson, key) in lessons"
                :key="lessons.indexOf(lesson)">
                <div>{{ lesson.title }}</div>
                <div>
                    <span><i class="material-icons button-icon text-primary" @click="editLesson(lesson)">create</i></span>
                    <span @click="deleteLesson(lesson.id, key)"><i
                            class="material-icons button-icon text-danger">delete_forever</i></span>
                </div>
            </li>
        </ul>
        <div>
            <create-lesson></create-lesson>
        </div>
    </div>
</template>

<script>
    import CreateLesson from './children/CreateLesson';
    import bootbox from 'bootbox';
    import Axios from 'axios';

    export default {
        mounted() {
            this.$on('lesson_created', (lesson) => {
                    window.noty({
                        message: 'Lesson created successfully!',
                        type: 'success'
                    });
                    this.lessons.push(lesson);
                }),

                this.$on('lesson_updated', (lesson) => {
                    let lesson_index = this.lessons.findIndex(l => {
                        return lesson.id == l.id;
                    });
                    this.lessons.splice(lesson_index, 1, lesson);
                    window.noty({
                        message: 'Lesson updated successfully!',
                        type: 'success'
                    });
                })
        },
        props: [
            'default_lessons', 'series_id'
        ],
        components: {
            'create-lesson': CreateLesson
        },
        data() {
            return {
                lessons: JSON.parse(this.default_lessons),
            }
        },
        methods: {
            createNewLesson() {
                this.$emit('create_new_lesson', this.series_id);
            },
            deleteLesson(id, key) {
                bootbox.confirm("Are you sure you want to delete this lesson?", (result) => {
                    if (result) {
                        Axios.delete(`/admin/${this.series_id}/lessons/${id}`)
                            .then(res => {
                                this.lessons.splice(key, 1);
                                window.noty({
                                    message: 'Lesson deleted!',
                                    type: 'success'
                                });
                            }).catch(error => {
                                window.handleErrors(error);
                            });
                    }
                })
            },
            editLesson(lesson) {
                let series_id = this.series_id
                this.$emit('edit_lesson', {
                    lesson,
                    series_id
                });
            }
        }
    }

</script>
