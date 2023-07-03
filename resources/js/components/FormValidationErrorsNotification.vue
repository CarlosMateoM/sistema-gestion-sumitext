<script setup>
import { mdiAlert } from '@mdi/js';
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import { ref } from 'vue';
import NotificationBar from "@/components/NotificationBar.vue";

const notification = ref(null);

const errors = computed(() => usePage().props.errors);

const hasErrors = computed(() => Object.keys(errors.value).length > 0);

const dismiss = () => {
  if(hasErrors){
    notification.value.dismiss();
  } 
};

defineExpose({
  dismiss,
})

</script>

<template>
  <NotificationBar ref="notification" v-if="hasErrors" color="danger" :icon="mdiAlert">
    <b>Ups! algo salió mal. </b> 
    <span v-for="(error, key) in errors" :key="key">{{ error }}</span>
  </NotificationBar>
</template>
