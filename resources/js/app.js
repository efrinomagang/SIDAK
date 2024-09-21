import Alpine from 'alpinejs';
import axios from 'axios';

window.Alpine = Alpine;
window.axios = axios;
Alpine.start();

window.confirmDelete = function(id) {
    const form = document.getElementById(`delete-form-${id}`);
    if (form && confirm('Are you sure you want to delete this item?')) {
        form.submit();
    }
};
