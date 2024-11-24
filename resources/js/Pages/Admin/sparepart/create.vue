<script setup>
    import { reactive } from 'vue'
    import { Inertia } from '@inertiajs/inertia'

        //props
        defineProps({
            errors: Object,
            kategori: Array
        })

            //state posts
            const sparepart = reactive({
                nama_sparepart  : '',
                harga           : '',
                stok            : '',
                image           : null,
                kategori_id     : ''
            })

            function handleImageUpload(event) {
                const file = event.target.files[0]
                 console.log("File yang dipilih:", file);
                if (file) {
                    sparepart.image = file // Simpan file ke state
                }
            }

            //function storePost
function storePost() {
    console.log("State sebelum dikirim:", sparepart);
    const formData = new FormData()
    formData.append('nama_sparepart', sparepart.nama_sparepart)
    formData.append('harga', sparepart.harga)
    formData.append('stok', sparepart.stok)
    formData.append('kategori_id', sparepart.kategori_id)
    if (sparepart.image) {
        formData.append('image', sparepart.image) // Sertakan file gambar
    }


    // Debugging FormData
    for (let [key, value] of formData.entries()) {
        console.log(key + ': ' + value);
    }

    // Kirim data dengan FormData
    console.log("Data yang dikirim:", formData);

    // Kirim data dengan FormData
    Inertia.post('/admin/sparepart', formData)

}
</script>

<template>
     <div>
        <div class="card border-0 rounded shadow">
            <div class="card-body">
                <h4>TAMBAH POST</h4>
                <hr>
                <form @submit.prevent="storePost" enctype="multipart/form-data">

                    <div>
                        <label for="image">Gambar</label>
                        <input type="file" id="image" @change="handleImageUpload" accept="image/*" />
                        <span v-if="errors.image">{{ errors.image }}</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Sparepart</label>
                        <input type="text" class="form-control" v-model="sparepart.nama_sparepart" placeholder="Masukkan Title Post">
                        <div v-if="errors.nama_sparepart" class="mt-2 alert alert-danger">
                            {{ errors.nama_sparepart }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" class="form-control" v-model="sparepart.harga" placeholder="Masukkan Title Post">
                        <div v-if="errors.harga" class="mt-2 alert alert-danger">
                            {{ errors.harga }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" class="form-control" v-model="sparepart.stok" placeholder="Masukkan Title Post">
                        <div v-if="errors.stok" class="mt-2 alert alert-danger">
                            {{ errors.stok }}
                        </div>
                    </div>

                    <div>
                        <label for="kategori_id">Kategori</label>
                        <select v-model="sparepart.kategori_id" id="kategori_id">
                            <option value="">Pilih Kategori</option>
                            <option v-for="k in kategori" :key="k.id" :value="k.id">{{ k.nama_kategori }}</option>
                        </select>
                        <span v-if="errors.kategori_id">{{ errors.kategori_id }}</span>
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

</template>