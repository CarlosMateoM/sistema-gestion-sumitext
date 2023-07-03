<script setup>
import { ref } from "vue";
import { mdiEye, mdiTrashCan } from "@mdi/js";
import CardBoxModal from "@/components/CardBoxModal.vue";
import TableCheckboxCell from "@/components/TableCheckboxCell.vue";
import BaseLevel from "@/components/BaseLevel.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import BaseButton from "@/components/BaseButton.vue";
import UserAvatar from "@/components/UserAvatar.vue";
import CardBox from "./CardBox.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  customers: Object,
  checkable: Boolean,
});

const isModalActive = ref(false);

const isModalDangerActive = ref(false);

const customerSelectedToDestroy = ref(null);

const openCustomerDestroyModal = (customer) => {
  isModalDangerActive.value = true;
  customerSelectedToDestroy.value = customer;
};

const destroyCustomer = () => {
  const customerId = customerSelectedToDestroy.value.id;

  useForm({}).delete(route('customers.destroy', {
     customer: customerId 
    }), {
      preserveScroll: true,
      onSuccess: () => {

      }
    });  
};

</script>

<template>
  <CardBox class="mb-6" has-table>
  <CardBoxModal  
    v-model="isModalActive"
    title="Sample modal" 
  >
    <p>Lorem ipsum dolor sit amet <b>adipiscing elit</b></p>
    <p>This is sample modal</p>
  </CardBoxModal>
    
  <CardBoxModal
    v-model="isModalDangerActive"
    title="Confirmación de eliminación"
    button="danger"
    has-cancel
    button-label="Aceptar"
    @confirm="destroyCustomer"
  >
    <p>Desea eliminar el cliente <b v-if="customerSelectedToDestroy"> {{ customerSelectedToDestroy.first_name  + " " + customerSelectedToDestroy.last_name }} </b></p>
  </CardBoxModal>
  
  <!--
    <div v-if="checkedRows.length" class="p-3 bg-gray-100/50 dark:bg-slate-800">
    <span
    v-for="checkedRow in checkedRows"
    :key="checkedRow.id"
    class="inline-block px-2 py-1 rounded-sm mr-2 text-sm bg-gray-100 dark:bg-slate-700"
    >
    {{ checkedRow.name }}
  </span>
</div>

-->
  <table>
    <thead>
      <tr>
        <th v-if="checkable" />
        <th />
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>Dirección</th>
        <!--
          <th>Progreso</th>
        -->
        <th>Creado en</th>

        <th />
      </tr>
    </thead>
    <tbody>
      <tr v-for="customer in props.customers.data" :key="customer.id">
        <TableCheckboxCell
          v-if="checkable"
          @checked="checked($event, customer)"
        />
        <td class="border-b-0 lg:w-6 before:hidden">
          <UserAvatar
            :username="customer.first_name"
            class="w-24 h-24 mx-auto lg:w-6 lg:h-6"
          />
        </td>
        <td data-label="Nombre">
          {{ customer.first_name + " " + customer.last_name }}
        </td>
        <td data-label="Telefono">
          {{ customer.phone }}
        </td>
        <td data-label="Direccion">
          {{ customer.address }}
        </td>
        <!--

          <td data-label="progress">
            <progress
            class="flex w-2/5 self-center lg:w-full"
            max="100"
            :value="23"
            />
          </td>
        -->
        <td data-label="Created" >
          <small
            class="text-gray-500 dark:text-slate-400"
            :title="customer.created_at"
            >{{ (customer.created_at + "").slice(0, 10) }}</small
          >
        </td>
        <td class="before:hidden lg:w-1 whitespace-nowrap">
          <BaseButtons type="justify-start lg:justify-end" no-wrap>
            <!-- PROXIMAMENTE
            <BaseButton
              color="info"
              :icon="mdiEye"
              small
              @click="isModalActive = true"
              />
              -->
              <BaseButton
              color="danger"
              :icon="mdiTrashCan"
              @click="openCustomerDestroyModal(customer)"   
              small
            />
          </BaseButtons>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="p-3 lg:px-6 border-t border-gray-100 dark:border-slate-800">
    <BaseLevel>
      <BaseButtons>  
    <BaseButton
      v-if="props.customers.prev_page_url"
      :label="'&laquo; Anterior'"
      :color="'whiteDark'"
      small
      @click="$inertia.visit(props.customers.prev_page_url, { preserveScroll: true })"
    />
    <BaseButton
      v-for="page in props.customers.links.slice(1, -1)"
      :key="page.url"
      :active="page.active"
      :label="page.label"
      :color="page.active ? 'lightDark' : 'whiteDark'"
      small
      @click="$inertia.visit(page.url, { preserveScroll: true })"
    />
    <BaseButton
      v-if="props.customers.next_page_url"
      :label="'Siguiente &raquo;'"
      :color="'whiteDark'"
      small
      @click="$inertia.visit(props.customers.next_page_url, { preserveScroll: true })"
    />
        </BaseButtons>
      <small>Página {{ props.customers.current_page }} de {{ props.customers.last_page }}</small>
    </BaseLevel>
  </div>
</CardBox>

</template>
