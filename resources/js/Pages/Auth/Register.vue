<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Register" />

        <!--

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    v-model="form.password_confirmation"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
        -->

        <div class="flex h-screen">

            <div class="flex min-h-full w-1/2 flex-col justify-center px-6 py-12 lg:px-8">

                <div class=" sm:mx-auto sm:w-full sm:max-w-sm">
                    <h2 class="mb-10 text-left text-3xl font-bold leading-9 tracking-tight text-gray-500">
                        SUMITEXT DE LA COSTA
                    </h2>

                    <form @submit.prevent="submit" class="space-y-6">


                        <div>
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">
                                Nombre:
                            </label>
                            <div class="mt-2">
                                <input id="name" type="text" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    v-model="form.name">
                            </div>
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>


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
                            <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">
                                Contraseña:
                            </label>

                            <div class="mt-2">
                                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="current-password"
                                    required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    v-model="form.password_confirmation">
                            </div>

                            <InputError class="mt-2" :message="form.errors.password_confirmation" />
                        </div>

                        <div>
                            <button type="submit"
                                class="flex w-full justify-center mt-12 rounded-md bg-indigo-600 px-3 py-3 text-18 font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Registrarse
                            </button>

                        </div>
                    </form>

                    <Link :href="route('login')"
                        class="flex w-full justify-center mt-3 rounded-md bg-indigo-800 px-3 py-3 text-18 font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Iniciar sesion
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
