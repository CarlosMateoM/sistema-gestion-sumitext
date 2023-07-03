<script setup>
import { ref } from "vue";
import { mdiCheck , mdiAccount, mdiPhone, mdiDirections } from "@mdi/js";
import { useForm } from "@inertiajs/vue3";
import CardBox from "@/components/CardBox.vue";
import FormField from "@/components/FormField.vue";
import FormControl from "@/components/FormControl.vue";
import BaseDivider from "@/components/BaseDivider.vue";
import BaseButton from "@/components/BaseButton.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import FormValidationErrorsNotification from "@/components/FormValidationErrorsNotification.vue";
import NotificationBar from "@/components/NotificationBar.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";

const notification = ref(null);
const successNotification = ref(null);

const form = useForm({
  first_name: "",
  last_name: "",
  phone: "",
  address: "",
});

const submit = () => {
    form.post(route('customers.store'), {
        preserveScroll: true,
        onSuccess: () => {
          form.reset();
          successNotification.value.dismiss()
        },
        onError: () => notification.value.dismiss()
    });
};

</script>

<template>

      <SectionTitleLineWithButton
        :icon="mdiAccount"
        title="Registrar cliente"
        main
      />

      <FormValidationErrorsNotification ref="notification" />

      <NotificationBar ref="successNotification" color="success" :icon="mdiCheck">    
          <b>Cliente registrado satisfactoriamente.</b> 
      </NotificationBar>

      <CardBox is-form @submit.prevent="submit">

        <FormField>
            <FormField 
            label="Nombre" 
            label-for="first_name"
            help="Ingrese su nombre. Max 50 carácteres.">
                <FormControl 
                    id="first_name"
                    name="first_name"
                    v-model="form.first_name" 
                    :icon="mdiAccount" 
                    required
                    autocomplete="given-name"
                />  
            </FormField>
            
            <FormField  
              label="Apellidos"
              label-for="last_name"
              help="Ingrese sus apellidos. Max 100 carácteres." >
                <FormControl
                    id="last_name" 
                    name="last_name"
                    v-model="form.last_name" 
                    :icon="mdiAccount" 
                    required
                    autocomplete="family-name"
                />
            </FormField>
        </FormField>

        <FormField 
          label="Teléfono" 
          label-for="phone"
          help="Ingrese su número de teléfono.">
          <FormControl
            id="phone"
            name="phone"
            v-model="form.phone"
            :icon="mdiPhone"
            type="tel"
            required
            autocomplete="tel"
          />
        </FormField>

        <FormField 
          label="Dirección" 
          label-for="address"
          help="Ingrese su dirección.">
          <FormControl
            id="address"
            name="adress"
            v-model="form.address"
            :icon="mdiDirections"
            required
            autocomplete="street-address"
          />
        </FormField>

        <BaseDivider />

        <template #footer>
          <BaseButtons>
            <BaseButton 
              type="submit" 
              color="info" 
              label="Guardar" 
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing" 
            />
            <BaseButton 
              type="reset" 
              color="info" 
              outline 
              label="Restablecer formulario" 
            />
          </BaseButtons>
        </template>
      </CardBox>  
</template>
