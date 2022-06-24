<script setup>
import { computed, ref, watch } from "@vue/runtime-core";
const formCss = `shadow
      appearance-none
      border
      rounded
      w-full
      py-2
      px-3
      text-gray-700
      leading-tight
      focus:outline-none focus:shadow-outline
      my-2.5 `;

const props = defineProps({
    value: undefined,
    handleChange: Function,
    placeholder: { type: String, required: false },
    type: String,
    name: String,
});

const setValue = (e) => {
    props.handleChange(e, e.target);
};
</script>

<template>
    <input
        :class="formCss"
        v-bind:type="props.type"
        v-bind:placeholder="props.placeholder"
        v-bind:name="props.name"
        @input="setValue"
        :value="props.value"
    />
</template>
