<script setup>
import { makeClassName } from "../../functions/index.js";

const { className, loading } = defineProps({
    className: {
        type: String,
        default: "",
    },
    loading: Boolean,
});

</script>

<template>
    <div v-bind:class="makeClassName(loading ? 'loading' : '', 'block-loader')">
        <div class="loader-container">
            <div class="loader">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="block-child">
            <slot></slot>
        </div>
        <div v-if="loading" class="disabled"></div>
    </div>
</template>
