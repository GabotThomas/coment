<script setup>
import TextArea from '../form/module/Textarea.vue';
import InputVue from '../form/module/Input.vue';

const props = defineProps({
    value: Object,
    handleChange: Function,
    index: Number
});

const handleChangeController = (e, { name, value }) => {
    props.handleChange(props.index, { [name]: value })
}

const handleCheck = (e, { name, checked }) => {
    props.handleChange(props.index, { [name]: checked })
}

</script>

<template>
    <text-area :value="props.value.text" :name="'text'" :handle-change="handleChangeController" :placeholder="'name'" />
    <InputVue :value="props.value.text" :name="'is_sexist'" :handle-change="handleCheck" :placeholder="'name'"
        :type="'checkbox'" />
</template>