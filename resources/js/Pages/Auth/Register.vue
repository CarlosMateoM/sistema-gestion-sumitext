<script setup>
import { useForm, usePage, Head } from "@inertiajs/vue3";
import { computed } from "vue";
import { mdiAccount, mdiEmail, mdiFormTextboxPassword } from "@mdi/js";
import LayoutGuest from "@/layouts/LayoutGuest.vue";
import SectionFullScreen from "@/components/SectionFullScreen.vue";
import CardBox from "@/components/CardBox.vue";
import FormCheckRadioGroup from "@/components/FormCheckRadioGroup.vue";
import FormField from "@/components/FormField.vue";
import FormControl from "@/components/FormControl.vue";
import BaseDivider from "@/components/BaseDivider.vue";
import BaseButton from "@/components/BaseButton.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import FormValidationErrors from "@/components/FormValidationErrors.vue";

const form = useForm({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  terms: [],
});

const hasTermsAndPrivacyPolicyFeature = computed(
  () => usePage().props.jetstream?.hasTermsAndPrivacyPolicyFeature
);

const submit = () => {
  form
    .transform((data) => ({
      ...data,
      terms: form.terms && form.terms.length,
    }))
    .post(route("register"), {
      onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
  <LayoutGuest>

    <Head title="Register" />

    <SectionFullScreen v-slot="{ cardClass }" >
      <CardBox
        :class="cardClass"
        class="my-24"
        is-form
        @submit.prevent="submit"
      >
        <FormValidationErrors />

        <FormField 
          label="Nombre" 
          label-for="name" 
          help="Por favor, ingrese su nombre"
        >
          <FormControl
            v-model="form.name"
            id="name"
            :icon="mdiAccount"
            autocomplete="name"
            type="text"
            required
          />
        </FormField>

        <FormField
          label="Correo"
          label-for="email"
          help="Por favor, ingrese su correo electronico"
        >
          <FormControl
            v-model="form.email"
            id="email"
            :icon="mdiEmail"
            autocomplete="email"
            type="email"
            required
          />
        </FormField>

        <FormField
          label="Contraseña"
          label-for="password"
          help="Por favor, ingrese la contraseña"
        >
          <FormControl
            v-model="form.password"
            id="password"
            :icon="mdiFormTextboxPassword"
            type="password"
            autocomplete="new-password"
            required
          />
        </FormField>

        <FormField
          label="Confirme la contraseña"
          label-for="password_confirmation"
          help="Por favor, confirme la contraseña"
        >
          <FormControl
            v-model="form.password_confirmation"
            id="password_confirmation"
            :icon="mdiFormTextboxPassword"
            type="password"
            autocomplete="new-password"
            required
          />
        </FormField>

        <FormCheckRadioGroup
          v-if="hasTermsAndPrivacyPolicyFeature"
          v-model="form.terms"
          name="remember"
          :options="{ agree: 'I agree to the Terms' }"
        />

        <BaseDivider />

        <BaseButtons>
          <BaseButton
            type="submit"
            color="info"
            label="Registrarse"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          />
          <BaseButton 
            route-name="login" 
            color="info" 
            outline 
            label="Iniciar sesion" 
          />
        </BaseButtons>
      </CardBox>
    </SectionFullScreen>
  </LayoutGuest>
</template>
