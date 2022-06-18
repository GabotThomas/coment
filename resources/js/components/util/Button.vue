<script setup>
import { makeClassName } from '../../functions';

const props = defineProps({
    class: {
        type: String,
        default: ''
    }
})

</script>

<template>
    <div class="btn-container">
        <button :class="makeClassName('btn', props.class)">
            <slot></slot>
        </button>
    </div>
</template>