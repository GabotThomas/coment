<script setup>
import { computed, ref, watch } from "@vue/runtime-core";


const props = defineProps({
    value: undefined,
    handleChange: Function,
    placeholder: { type: String, required: false },
    name: String,
});

const setValue = (e) => {
    props.handleChange(e, e.target);
};
</script>

<template>
    <textarea class="ui input textarea" v-bind:placeholder="props.placeholder" v-bind:name="props.name"
        @input="setValue" :value="props.value" rows="2" cols="33">
    </textarea>

</template>
