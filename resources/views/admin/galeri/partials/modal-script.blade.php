<script>
    document.querySelectorAll('[data-gallery-modal-open]').forEach((button) => {
        button.addEventListener('click', () => {
            const modal = document.querySelector(`#${button.dataset.galleryModalOpen}`);
            modal?.classList.remove('hidden');
            modal?.classList.add('flex');
        });
    });

    document.querySelectorAll('[data-gallery-modal-close]').forEach((button) => {
        button.addEventListener('click', () => {
            const modal = document.querySelector(`#${button.dataset.galleryModalClose}`);
            modal?.classList.add('hidden');
            modal?.classList.remove('flex');
        });
    });

    document.querySelectorAll('[data-gallery-modal]').forEach((modal) => {
        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });
    });
</script>
