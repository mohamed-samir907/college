import Swal               from 'sweetalert2'
import vform              from 'vform';
import {objectToFormData} from  'object-to-formdata';

window.Swal     = Swal;
window.Form     = vform;
window.objectToFormData = objectToFormData;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

window.Toast = Toast;
