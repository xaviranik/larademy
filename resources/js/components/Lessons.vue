<template>
    <div class="lessons">
        <button class="btn btn-primary" @click="createNewLesson">Create New Lesson</button>
        <ul class="list-group">
            <li class="list-group-item" v-for="lesson in lessons" :key="lessons.indexOf(lesson)">
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
        mounted() {
            this.$on('lesson_created', (lesson) => {
                this.lessons.push(lesson);
            })
        },
        props: [
            'default_lessons', 'series_id'
        ],
        components: {
            'create-lesson' : CreateLesson
        },
        data() {
            return {
                lessons: JSON.parse(this.default_lessons),
            }
        },
        methods:{
            createNewLesson() {
                this.$emit('create_new_lesson', this.series_id);
            }
        }
    }

</script>
