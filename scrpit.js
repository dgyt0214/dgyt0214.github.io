document.querySelector('.circle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.add('show');
    });
    
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('show');
    }
    