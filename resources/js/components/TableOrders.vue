<script setup>
import { ref } from "vue";
import { mdiEye, mdiTrashCan } from "@mdi/js";
import CardBoxModal from "@/components/CardBoxModal.vue";
import BaseLevel from "@/components/BaseLevel.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import BaseButton from "@/components/BaseButton.vue";
import UserAvatar from "@/components/UserAvatar.vue";
import CardBox from "./CardBox.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  orders: Object,
  checkable: Boolean,
});

const isModalActive = ref(false);

const isModalDangerActive = ref(false);

const orderSelectedToDestroy = ref(null);

const openOrderDestroyModal = (order) => {
  isModalDangerActive.value = true;
  orderSelectedToDestroy.value = order;
};

const destroyOrder = () => {
  const id = orderSelectedToDestroy.value.id;

  useForm({}).delete(route('orders.destroy', {
     order: id 
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
    @confirm="destroyOrder"
  >
    <p>Desea eliminar el pedido del cliente <b v-if="orderSelectedToDestroy"> {{ orderSelectedToDestroy.customer.first_name  + " " + orderSelectedToDestroy.customer.last_name }} </b></p>
  </CardBoxModal>
  <table>
    <thead>
      <tr>
        <th v-if="checkable" />
        <th />
        <th>Cliente</th>
        <th>Observaciones</th>
        <th>Estado</th>     
        <th>Creado en</th>
        <th />
      </tr>
    </thead>
    
    <tbody>

      <tr v-for="order in props.orders.data" :key="order.id">
      
        <td class="border-b-0 lg:w-6 before:hidden">
          <UserAvatar
            :username="order.customer.first_name"
            class="w-24 h-24 mx-auto lg:w-6 lg:h-6"
          />
        </td>
        <td data-label="Cliente">
          {{ order.customer.first_name + " " + order.customer.last_name }}
        </td>
        
        <td data-label="Observaciones" class="max-w-md">
          {{ (order.observations + "").slice(0, 50) + "..." }}
        </td>
        <td data-label="Estado">
          {{ (order.order_status + "").toUpperCase() }}
        </td>
        <td data-label="Created" >
          <small
            class="text-gray-500 dark:text-slate-400"
            :title="order.created_at"
            >{{ (order.created_at + "").slice(0, 10) }}</small
          >
        </td>
        <td class="before:hidden lg:w-1 whitespace-nowrap">
          <BaseButtons type="justify-start lg:justify-end" no-wrap>

            <BaseButton
              color="info"
              :icon="mdiEye"
              small
              @click="isModalActive = true"
              />
                       
              <BaseButton
              color="danger"
              :icon="mdiTrashCan"
              @click="openOrderDestroyModal(order)"   
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
          v-if="props.orders.prev_page_url"
          :label="'&laquo; Anterior'"
          :color="'whiteDark'"
          small
          @click="$inertia.visit(props.orders.prev_page_url, { preserveScroll: true })"
        />
        <BaseButton
          v-for="page in props.orders.links.slice(1, -1)"
          :key="page.url"
          :active="page.active"
          :label="page.label"
          :color="page.active ? 'lightDark' : 'whiteDark'"
          small
          @click="$inertia.visit(page.url, { preserveScroll: true })"
        />
        <BaseButton
          v-if="props.orders.next_page_url"
          :label="'Siguiente &raquo;'"
          :color="'whiteDark'"
          small
          @click="$inertia.visit(props.orders.next_page_url, { preserveScroll: true })"
        />
      </BaseButtons>

      <small>Página {{ props.orders.current_page }} de {{ props.orders.last_page }}</small>
    </BaseLevel>
  </div>
</CardBox>

</template>
