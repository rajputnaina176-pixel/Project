function upload(event) {
    const preview = document.getElementById('previewImage');
    const container = document.getElementById('imagePreviewContainer');

    if (event.target.files && event.target.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block'; 
        }
        
        reader.readAsDataURL(event.target.files[0]); 
    } else {
        preview.src = '#';
        preview.style.display = 'none';
    }
}
