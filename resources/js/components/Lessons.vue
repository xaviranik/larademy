<template>
    <div class="lessons">
        <button class="btn btn-primary" @click="createNewLesson">Create New Lesson</button>
        <ul class="list-group">
            <li class="list-group-item" v-for="lesson in formattedLessons" :key="lessons.indexOf(lesson)">
                {{ lesson.title }}
            </li>
        </ul>
        <div>
            <create-lesson></create-lesson>
        </div>
    </div>
</template>

<script>
    import CreateLesson from './children/CreateLesson';

    export default {
        props: [
            'default_lessons', 'series_id'
        ],
        components: {
            'create-lesson' : CreateLesson
        },
        data() {
            return {
                lessons: this.default_lessons,
            }
        },
        computed: {
            formattedLessons() {
                return JSON.parse(this.lessons);
            }
        },
        methods:{
            createNewLesson() {
                this.$emit('create_new_lesson', this.series_id);
            }
        }
    }

</script>
