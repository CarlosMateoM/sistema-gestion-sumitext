<script setup>

import {  ref } from "vue";
import {
  mdiAccount,
  mdiAccountCheck,
} from "@mdi/js";
import { debounce } from 'lodash';
import { useForm } from "@inertiajs/vue3";
import CardBox from "@/components/CardBox.vue";
import CardBoxModal from "@/components/CardBoxModal.vue";
import FormField from "@/components/FormField.vue";
import FormControl from "@/components/FormControl.vue";
import BaseButton from "@/components/BaseButton.vue";
import BaseButtons from "@/components/BaseButtons.vue";

const emits = defineEmits(['customer-selected']);

const props = defineProps({
    customers: Object,
});

const selectedCustomer = ref(null);
const isModalCustomersActive = ref(false);

const searchCustomers = useForm({
  searchCustomer: "",
});

const searchCustomer = debounce(() => {
  searchCustomers.get(route('orders.index'), {
    preserveScroll: true,
    preserveState: true
  })
}, 500);

const selectCustomer = (customer) => {
  isModalCustomersActive.value = false;
  emits('customer-selected', customer);
};

const toggleModal = () => {
    isModalCustomersActive.value = !isModalCustomersActive.value;
}

defineExpose({
    toggleModal,
    selectedCustomer
});

</script>
<template>

<CardBoxModal  
    v-model="isModalCustomersActive" 
    title="Seleccionar cliente"
    button="danger"
    button-label="Cerrar"    
  >
    <FormField 
      label="Cliente" 
      label-for="cliente" 
      help="Buscar cliente por su nombre, número de telefono o dirección."
    >
      <FormControl id="cliente" name="cliente" v-model="searchCustomers.searchCustomer" :icon="mdiAccount"
        @input="searchCustomer" type="search" required autocomplete="search" 
      />
    </FormField>
    <CardBox>
      <table>
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Dirección</th> 
          </tr>
        </thead>
        <tbody>
          <tr v-for="customer in customers" :key="customer.id">
            <td data-label="Nombre">
              {{ customer.first_name + " " + customer.last_name }}
            </td>
            <td data-label="Telefono">
              {{ customer.phone }}
            </td>
            <td data-label="Direccion">
              {{ customer.address }}
            </td>
            <td class="before:hidden lg:w-1 whitespace-nowrap">
              <BaseButtons type="justify-start lg:justify-end" no-wrap>
                <BaseButton 
                  small
                  color="success" 
                  :icon="mdiAccountCheck" 
                  @click="selectCustomer(customer)"
                />
              </BaseButtons>
            </td>
          </tr>
        </tbody>
      </table>
    </CardBox>
  </CardBoxModal>

</template>