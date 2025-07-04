// Funcionalidad del menú de usuario
document.addEventListener('DOMContentLoaded', function() {
    const userBtn = document.getElementById('userBtn');
    const userDropdown = document.getElementById('userDropdown');
    let isDropdownOpen = false;    
    // Función para mostrar/ocultar el dropdown
    function toggleDropdown() {
        isDropdownOpen = !isDropdownOpen;
        
        if (isDropdownOpen) {
            userDropdown.classList.add('show');
        } else {
            userDropdown.classList.remove('show');
        }
    }
    // Event listener para el botón
    userBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        toggleDropdown();
    });
    // Cerrar dropdown al hacer clic fuera
    document.addEventListener('click', function(e) {
        if (!userBtn.contains(e.target) && !userDropdown.contains(e.target)) {
            if (isDropdownOpen) {
                userDropdown.classList.remove('show');
                isDropdownOpen = false;
            }
        }
    });
    /* Cerrar dropdown con la tecla Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && isDropdownOpen) {
            userDropdown.classList.remove('show');
            isDropdownOpen = false;
        }
    });
    // Prevenir que el dropdown se cierre al hacer clic dentro de él
    userDropdown.addEventListener('click', function(e) {
        e.stopPropagation();
    });
    userBtn.addEventListener('mouseleave', function() {
        if (!isDropdownOpen) {
            this.style.transform = 'translateY(0) scale(1)';
        }
    });
});

document.addEventListener("DOMContentLoaded", () => {
  const iniciales = localStorage.getItem("iniciales");
  if (iniciales) {
    document.querySelector(".user-btn").innerText = iniciales;
  }*/
});
