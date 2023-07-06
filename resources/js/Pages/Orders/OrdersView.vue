<script setup>
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import TableOrders from "@/components/TableOrders.vue";
import SectionMain from "@/components/SectionMain.vue"
import OrderForm from './OrderForm.vue';
import  { 
    mdiPlaylistCheck
} from "@mdi/js";


defineProps({
    orders: Object,
    customers: Object
});

</script>

<template>
    <LayoutAuthenticated>
        
        <SectionMain>

            <SectionTitleLineWithButton 
            :icon="mdiPlaylistCheck" 
            title="Pedidos" 
            main 
            />

            <TableOrders 
            :orders="orders" 
            />

            <OrderForm :customers="customers" />

        </SectionMain>

    </LayoutAuthenticated>
</template>
