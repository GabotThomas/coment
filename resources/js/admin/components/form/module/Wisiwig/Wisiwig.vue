<script setup>
import { ref } from "@vue/runtime-core";
import { EditorContent, useEditor } from "@tiptap/vue-3";
import StarterKit from '@tiptap/starter-kit';
import TextStyle from '@tiptap/extension-text-style';
import { Color } from '@tiptap/extension-color'

const props = defineProps({
    handleChange: Function,
    content: {
        type: String,
        default: '<p>Mettez votre code ici </p>'
    }
})

const localHTML = ref('');
const editorObject = useEditor({
    content: props.content
    , extensions: [
        StarterKit,
        TextStyle,
        Color,
    ],
    onUpdate: ({ editor }) => {
        props.handleChange(editor.getHTML())
    },
},
)

</script>

<template>
    <div class="editor">
        <div class="menubar">
            <button class="menubar__button" :class="{ 'is-active': true }"
                @click="editorObject.commands.setBold()">Bold</button>

            <button class="menubar__button" :class="{ 'is-active': true }"
                @click="editorObject.chain().focus().setColor('#FED320').run()">Yellow</button>
            <!--
            <button class="menubar__button" :class="{ 'is-active': isActive.customwisiwig({ level: 'body-green' }) }"
                @click="commands.customwisiwig({ level: 'body-green' })">Body Green</button>
            <button class="menubar__button" :class="{ 'is-active': isActive.customwisiwig({ level: 'body-blue' }) }"
                @click="commands.customwisiwig({ level: 'body-blue' })">Body Blue</button>
            <button class="menubar__button" :class="{ 'is-active': isActive.customwisiwig({ level: 'body-red' }) }"
                @click="commands.customwisiwig({ level: 'body-red' })">Body Red</button>
                 -->
        </div>

        <editor-content class="editor__content" style="background: rgba(100,100,0,0.2)" :editor="editorObject" />

        <pre>{{ localHTML }}</pre>
    </div>
</template>