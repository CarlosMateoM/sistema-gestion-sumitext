<script setup>
import {
  mdiAccountMultiple
} from "@mdi/js";
import SectionMain from "@/components/SectionMain.vue";
import CustomerForm from "./CustomerForm.vue";
import TableCustomers from "@/components/TableCustomers.vue";
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";


const props = defineProps({
  customers: Object
});

</script>

<template>
  <LayoutAuthenticated>
    <SectionMain>
      
      <SectionTitleLineWithButton 
        :icon="mdiAccountMultiple" 
        title="Clientes" 
        main 
      />

      <TableCustomers 
        :customers="customers"
      />
      
      <CustomerForm/>

    </SectionMain>
  </LayoutAuthenticated>
</template>
