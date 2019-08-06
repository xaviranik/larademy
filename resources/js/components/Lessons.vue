<template>
    <div class="lessons">
        <button class="btn btn-primary" @click="createNewLesson">Create New Lesson</button>
        <ul class="list-group d-flex">
            <li class="list-group-item d-flex justify-content-between" v-for="(lesson, key) in lessons"
                :key="lessons.indexOf(lesson)">
                <div>{{ lesson.title }}</div>
                <div>
                    <button class="button-icon bg-primary"><i class="material-icons" @click="editLesson(lesson)">create</i></button>
                    <button class="button-icon bg-danger" @click="deleteLesson(lesson.id, key)"><i
                            class="material-icons">delete_forever</i></button>
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
                    message : 'Lesson created successfully!',
                    type: 'success'
                });
                this.lessons.push(lesson);
            }),

            this.$on('lesson_updated', (lesson) => {
                let lesson_index = this.lessons.findIndex(l => {
                    return lesson.id == l.id;
                });

                this.lessons.splice(lesson_index, 1, lesson);
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
                    if(result) {
                        Axios.delete(`/admin/${this.series_id}/lessons/${id}`)
                        .then(res => {
                            this.lessons.splice(key, 1);
                        }).catch(error => {
                            console.log(error)
                        });
                    }
                })
            },
            editLesson(lesson) {
                let series_id = this.series_id
                this.$emit('edit_lesson', {lesson, series_id });
            }
        }
    }

</script>
