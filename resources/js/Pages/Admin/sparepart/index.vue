<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

prop:{
    spareparts: Array
}

component: {
    Link
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        You're logged in!
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-2">
                <Link href="/admin/sparepart/create" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    ADD PRODUCT</Link>
                    
                    <!-- tabel -->
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-3">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="p-4">
                                    Image
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Sparepart
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Harga
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Stok
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Kategori
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="sparepart in spareparts" :key="sparepart.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            
                                <td class="w-4 p-4">
                                <img src="{{ asset('/storage/spareparts/'.$sparepart -> image) }}" >
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ sparepart.nama_sparepart }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ sparepart.harga}}
                                </td>
                                <td class="px-6 py-4">
                                    {{ sparepart.stok}}
                                </td>
                                <td class="px-6 py-4">
                                    {{  sparepart.kategori_id?.nama_kategori }}
                                </td>
                                <td class="px-6 py-4">
                                   <Link
                                        :href="route('admin.edit', room.id)"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                        >
                                        EDIT
                                        </Link>
                                    {/* <button type="submit" class="font-medium text-red-600 dark:text-green-500 hover:underline">DELETE</button>           
                              */}</td> 
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    </AuthenticatedLayout>
</template>
