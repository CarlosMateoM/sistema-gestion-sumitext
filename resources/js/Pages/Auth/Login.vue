<script setup>
import { useForm, Head, Link } from '@inertiajs/vue3'
import { mdiAccount, mdiAsterisk } from '@mdi/js'
import LayoutGuest from '@/layouts/LayoutGuest.vue'
import SectionFullScreen from '@/components/SectionFullScreen.vue'
import CardBox from '@/components/CardBox.vue'
import FormCheckRadioGroup from '@/components/FormCheckRadioGroup.vue'
import FormField from '@/components/FormField.vue'
import FormControl from '@/components/FormControl.vue'
import BaseDivider from '@/components/BaseDivider.vue'
import BaseButton from '@/components/BaseButton.vue'
import BaseButtons from '@/components/BaseButtons.vue'
import FormValidationErrors from '@/components/FormValidationErrors.vue'
import NotificationBarInCard from '@/components/NotificationBarInCard.vue'
import BaseLevel from '@/components/BaseLevel.vue'

const props = defineProps({
  canResetPassword: Boolean,
  status: {
    type: String,
    default: null
  }
})

const form = useForm({
  email: '',
  password: '',
  remember: []
})

const submit = () => {
  form
    .transform(data => ({
      ... data,
      remember: form.remember && form.remember.length ? 'on' : ''
    }))
    .post(route('login'), {
      onFinish: () => form.reset('password'),
    })
}
</script>

<template>
  <LayoutGuest>
    <Head title="Login" />
    
    <SectionFullScreen
      v-slot="{ cardClass }"
    >
      <CardBox
        :class="cardClass"
        is-form
        @submit.prevent="submit"
      >
        <FormValidationErrors />

        <NotificationBarInCard 
          v-if="status"
          color="info"
        >
          {{ status }}
        </NotificationBarInCard>

        <FormField
          label="Correo"
          label-for="email"
          help="Por favor, ingrese su correo electronico"
        >
          <FormControl
            v-model="form.email"
            :icon="mdiAccount"
            id="email"
            autocomplete="email"
            type="email"
            required
          />
        </FormField>

        <FormField
          label="Contraseña"
          label-for="password"
          help="Por favor, ingrese su contraseña"
        >
          <FormControl
            v-model="form.password"
            :icon="mdiAsterisk"
            type="password"
            id="password"
            autocomplete="current-password"
            required
          />
        </FormField>
        <!--

          PROXIMAMENTE!!

          <FormCheckRadioGroup
          v-model="form.remember"
          name="remember"
          :options="{ remember: 'Remember' }"
          />
        -->

        <BaseDivider />

        <BaseLevel>
          <BaseButtons>
            <BaseButton
              type="submit"
              color="info"
              label="Iniciar sesion"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            />
            <!--
              
              PROXIMAMENTE!!

              <BaseButton
              v-if="canResetPassword"
              route-name="password.request"
              color="info"
              outline
              label="Remind"
              />
            -->
            <BaseButton 
              route-name="register" 
              color="info" 
              outline 
              label="Registrarse" 
            />
          </BaseButtons>
        </BaseLevel>
      </CardBox>
    </SectionFullScreen>
  </LayoutGuest>
</template>
