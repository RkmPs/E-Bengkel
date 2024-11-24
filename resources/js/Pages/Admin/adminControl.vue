<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

components: {
            Link
        }

defineProps({
    datas: Array,
    auth: Object
})

function deletePost(id) {
        Inertia.delete(`/admin/${id}`)
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
                <div v-if="$page.props.flash.message" class="alert alert-success" role="alert">
                     {{ $page.props.flash.message }}
                </div>
                <!-- flash message -->
                <div class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    <Link href="/admin/create">TAMBAH DATA </Link>
                </div>
                <table>
                    <thead>
                        <td>username</td>
                        <td>nama</td>
                        <td>email</td>
                        <td>nomor</td>
                        <td>Action</td>
                    </thead>

                    <tbody> 
                    <tr v-for="data in datas" :key="data.id">
                        <td>{{ data.username }}</td>
                        <td>{{ data.nama_admin }}</td>
                        <td>{{ data.email }}</td>
                        <td>{{ data.no_telp }}</td>
                        <td class="text-center">
    	                    <Link :href="`/admin/${data.id}/edit`" class="btn btn-sm btn-primary me-2">EDIT</Link>
                            <button @click.prevent="deletePost(`${data.id}`)" class="btn btn-sm btn-danger">DELETE</button>
                        </td>
                    </tr>
                    </tbody>
                    
                </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
