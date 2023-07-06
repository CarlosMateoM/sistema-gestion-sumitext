<script setup>
import {
    mdiAccountMultiple
} from "@mdi/js";
import { ref } from "vue";
import { createApi } from 'unsplash-js';
import CardBox from "@/components/CardBox.vue";
import SectionMain from "@/components/SectionMain.vue";
import FormControl from "@/components/FormControl.vue";
import BaseButton from "@/components/BaseButton.vue";
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";

const images = ref(null);

const search = ref(null);

const props = defineProps({
    customers: Object
});

const unsplash = createApi({
    accessKey: import.meta.env.VITE_UNSPLASH_ACCESS_KEY,
});

const submit = () => unsplash.photos.getRandom({
    query: search.value,
    count: 10,
})
    .then(response => {
        images.value = response.response;
        console.log(response.response);
    })
    .catch(error => {
        console.error(error);
    });

</script>

<template>
    <LayoutAuthenticated>
        <SectionMain>

            <SectionTitleLineWithButton :icon="mdiAccountMultiple" title="Diseños" main />

            <CardBox class="flex mb-6" is-form @submit.prevent="submit">
                <div class="flex gap-3">
                    <FormControl id="searchDising" v-model="search" name="searchDesign" class="w-full" placeholder="Buscar" autocomplete="on" />
                    <BaseButton class="w-32" type="submit" color="info" label="Buscar" />
                </div>
            </CardBox>

            <CardBox>
                <div class="container mx-auto ">
                    <div class="-m-1 flex flex-wrap md:-m-2">
                        <div v-for="image, index in images"  :key="index" class="flex w-1/3 flex-wrap" >
                            <div class="w-full p-1 md:p-2">
                                <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                                    :src="image.urls.regular" />
                            </div>

                        </div>

                    </div>
                </div>
            </CardBox>

        </SectionMain>
    </LayoutAuthenticated>
</template>
