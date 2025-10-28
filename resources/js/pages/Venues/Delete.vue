<script setup>
import {ref} from 'vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Modal from '@/Components/Modal.vue';

const props = defineProps({
    venues: Array,
    message: String,
});

const showDeleteModal = ref(false);
const venueToDelete = ref(null);

const confirmDelete = (venue) => {
    venueToDelete.value = venue;
    showDeleteModal.value = true;
};

const closeModal = () => {
    showDeleteModal.value = false;
};

const deleteForm = useForm({});

const deleteVenue = () => {
    deleteForm.delete(route('venues.destroy', venueToDelete.value.id), {
        onSuccess: () => {
            showDeleteModal.value = false;
        },
    });
};
</script>

<template>
    <AppLayout>
        <Head title="Delete Venues" />
        
        <!-- Botón de eliminar en fila de venue -->
        <button @click="confirmDelete(venue)"
                class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">
            Eliminar
        </button>

        <!-- Modal de confirmación de eliminación -->
        <Modal :show="showDeleteModal" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    ¿Estás seguro de que deseas eliminar este escenario?
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Esta acción no se puede deshacer.
                </p>
                <div class="mt-6 flex justify-end space-x-3">
                    <SecondaryButton @click="closeModal">Cancelar</SecondaryButton>
                    <DangerButton :class="{ 'opacity-25': deleteForm.processing }" :disabled="deleteForm.processing"
                                  @click="deleteVenue">
                        Delete
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </AppLayout>
</template>