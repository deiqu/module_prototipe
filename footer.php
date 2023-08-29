<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    /* Para paginacion */
    let table = new DataTable('#myTable');

    /* Modal para creacion */
    const showModalButton = document.getElementById('showModal');
    const closeModalButton = document.getElementById('closeModal');
    const modal = document.getElementById('createModal');

    showModalButton.addEventListener('click', () => {
        modal.classList.add('is-active');
    });

    closeModalButton.addEventListener('click', () => {
        modal.classList.remove('is-active');
    });
</script>
</body>

</html>