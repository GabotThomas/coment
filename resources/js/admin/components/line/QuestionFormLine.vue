<script setup>
import TextArea from '../form/module/Textarea.vue';
import InputVue from '../form/module/Input.vue';
import { useEditor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'

const props = defineProps({
    value: Object,
    handleChange: Function,
    index: Number
});

const editor = useEditor({
    content: '<p>I’m running Tiptap with Vue.js. 🎉</p>',
    extensions: [
        StarterKit,
    ],
})

const handleChangeController = (e, { name, value }) => {
    props.handleChange(props.index, { [name]: value })
}

const handleCheck = (e, { name, checked }) => {
    props.handleChange(props.index, { [name]: checked })
}

</script>

<template>
    <text-area :value="props.value.text" :name="'text'" :handle-change="handleChangeController" :placeholder="'name'" />
    <editor-content :editor="editor" />
    <InputVue :value="props.value.text" :name="'is_sexist'" :handle-change="handleCheck" :placeholder="'name'"
        :type="'checkbox'" />
</template>