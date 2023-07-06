<script setup>
import { ref } from "vue";
import {
  mdiCheck,
  mdiFileDocumentEditOutline
} from "@mdi/js";
import { useForm } from "@inertiajs/vue3";
import CardBox from "@/components/CardBox.vue";
import FormField from "@/components/FormField.vue";
import FormControl from "@/components/FormControl.vue";
import BaseDivider from "@/components/BaseDivider.vue";
import BaseButton from "@/components/BaseButton.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import CustomerOrderModal from './CustomerOrderModal.vue';
import FormValidationErrorsNotification from "@/components/FormValidationErrorsNotification.vue";
import NotificationBar from "@/components/NotificationBar.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";

const notification = ref(null);
const selectedCustomer = ref(null);
const successNotification = ref(null);
const CustomersOrderModal = ref(null);

defineProps({
  customers: Object,
});

const form = useForm({
  customers_id: "",
  observations: ""
});

const submit = () => {
  form.post(route('orders.store'), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
      selectedCustomer.value = null;
      successNotification.value.dismiss()
    },
    onError: () =>{
      notification.value.dismiss()
    } 
  });
};

const handleCustomerSelected = (customer) => {
  form.customers_id = customer.id;
  selectedCustomer.value = customer;
};


</script>

<template>
  
  <CustomerOrderModal ref="CustomersOrderModal" @customer-selected="handleCustomerSelected" :customers="customers" />

  <SectionTitleLineWithButton :icon="mdiFileDocumentEditOutline" title="Registrar pedido" main />

  <FormValidationErrorsNotification ref="notification" />

  <NotificationBar ref="successNotification" color="success" :icon="mdiCheck">
    <b>Cliente registrado satisfactoriamente.</b>
  </NotificationBar>

  <CardBox is-form @submit.prevent="submit">

    <FormField 
      label="Cliente"   
      label-for="seleccionar_cliente" 
      help="Seleccione el cliente del pedido."
    >
      <p v-if="selectedCustomer" class="font-bold" >
        {{ selectedCustomer.first_name + " " + selectedCustomer.last_name}}
      </p>

      <BaseButtons>  
        <BaseButton 
          id="seleccionar_cliente" 
          @click="CustomersOrderModal.toggleModal()" 
          color="info" 
            label="Selecionar cliente"
          :class="{ 'opacity-25': form.processing }" :disabled="form.processing" 
        />
      </BaseButtons>
    </FormField>

    <FormField label="Observaciones" label-for="observations" help="Ingrese los detalles del pedido.">
      <FormControl 
        required
        type="textarea"
        id="observations" 
        name="observations" 
        v-model="form.observations" 
        autocomplete="street-address" />
    </FormField>

    <BaseDivider />

    <template #footer>
      <BaseButtons>
        <BaseButton type="submit" color="info" label="Guardar" :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing" />
        <BaseButton type="reset" color="info" outline label="Restablecer formulario" />
      </BaseButtons>
    </template>
  </CardBox>
</template>
