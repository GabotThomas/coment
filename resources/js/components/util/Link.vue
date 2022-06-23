<script setup>

const props = defineProps({
    to: Object,
    disabled: {
        type: Boolean,
        default: false
    }
});

</script>

<template>
    <router-link v-if="!disabled" :to="props.to">
        <slot></slot>
    </router-link>
    <div v-else>
        <slot></slot>
    </div>
</template>