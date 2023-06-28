<script setup>

import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <!--
    <GuestLayout>

        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                    autocomplete="current-password" />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Forgot your password?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton>
            </div>
        </form>

    </GuestLayout>
    -->

    <GuestLayout>

        <Head title="Log in" />

        <div class="flex h-screen">

            <div class="flex min-h-full w-1/2 flex-col justify-center px-6 py-12 lg:px-8">


                <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                    {{ status }}
                </div>


                <div class=" sm:mx-auto sm:w-full sm:max-w-sm">
                    <h2 class="mb-10 text-left text-3xl font-bold leading-9 tracking-tight text-gray-500">
                        SUMITEXT DE LA COSTA
                    </h2>

                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">
                                Correo:
                            </label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" autocomplete="email" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    v-model="form.email">
                            </div>
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">
                                Contraseña:
                            </label>

                            <div class="mt-2">
                                <input id="password" name="password" type="password" autocomplete="current-password"
                                    required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    v-model="form.password">
                            </div>

                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div>
                            <button type="submit"
                                class="flex w-full justify-center mt-12 rounded-md bg-indigo-600 px-3 py-3 text-18 font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Iniciar sesion
                            </button>

                        </div>
                    </form>

                    <Link :href="route('register')"
                        class="flex w-full justify-center mt-3 rounded-md bg-indigo-800 px-3 py-3 text-18 font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Registrarse
                    </Link>

                </div>

            </div>
            <div class="w-1/2">
                <img src="https://images.pexels.com/photos/3771080/pexels-photo-3771080.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                    class="w-full h-screen object-cover">
            </div>
        </div>

    </GuestLayout>
</template>
